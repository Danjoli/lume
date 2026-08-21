<?php

namespace App\Services\Store\Shipping;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Shipment;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class MelhorEnvioService
{
    public function __construct(private readonly MelhorEnvioTokenService $tokens) {}

    private function client(): PendingRequest
    {
        return Http::baseUrl(rtrim((string) config('services.melhor_envio.base_url'), '/'))
            ->withToken($this->tokens->accessToken())
            ->withHeaders(['User-Agent' => config('services.melhor_envio.user_agent')])
            ->acceptJson()->timeout(30)->retry(2, 300, throw: false);
    }

    public function calculate(
        Address $address,
        Cart $cart
    ): Collection {
        $from = preg_replace('/\D/', '', (string) config('services.melhor_envio.from_postal_code'));
        if ($from === '') {
            $environment = strtoupper((string) config('services.melhor_envio.environment', 'sandbox'));

            throw new RuntimeException("Configure MELHOR_ENVIO_{$environment}_FROM_POSTAL_CODE no arquivo .env.");
        }

        $products = $cart->items->map(fn ($item) => [
            'id' => (string) $item->book->id,
            'width' => max(11, (float) ($item->book->width ?: 16)),
            'height' => max(2, (float) ($item->book->height ?: 3)),
            'length' => max(16, (float) ($item->book->length ?: 23)),
            'weight' => max(.1, (float) ($item->book->weight ?: .5)),
            'insurance_value' => (float) ($item->book->sale_price ?? $item->book->price),
            'quantity' => (int) $item->quantity,
        ])->values()->all();

        $response = $this->client()->post('/me/shipment/calculate', [
            'from' => ['postal_code' => $from],
            'to' => ['postal_code' => preg_replace('/\D/', '', $address->cep)],
            'products' => $products,
            'options' => ['receipt' => false, 'own_hand' => false, 'collect' => false],
        ]);
        if ($response->failed()) {
            throw new RuntimeException($response->json('message', 'Não foi possível calcular o frete.'));
        }

        return collect($response->json())->filter(fn ($option) => empty($option['error']) && isset($option['price']))
            ->map(fn ($option) => [
                'id' => (string) $option['id'], 'name' => $option['name'] ?? 'Entrega',
                'carrier' => data_get($option, 'company.name'), 'price' => (float) $option['price'],
                'delivery_time' => (string) ($option['delivery_time'] ?? ''),
                'delivery_min_days' => (int) data_get($option, 'delivery_range.min', $option['delivery_time'] ?? 0),
                'delivery_max_days' => (int) data_get($option, 'delivery_range.max', $option['delivery_time'] ?? 0),
            ])->values();
    }

    public function addToCart(Shipment $shipment): array
    {
        $shipment->loadMissing('order.items.book', 'order.user');
        $order = $shipment->order;
        $response = $this->client()->post('/me/cart', [
            'service' => (int) $shipment->service,
            'from' => ['postal_code' => preg_replace('/\D/', '', config('services.melhor_envio.from_postal_code'))],
            'to' => ['name' => $order->recipient_name, 'phone' => $order->phone, 'email' => $order->user->email,
                'document' => preg_replace('/\D/', '', $order->cpf), 'postal_code' => preg_replace('/\D/', '', $order->cep),
                'address' => $order->street, 'number' => $order->number, 'complement' => $order->complement,
                'district' => $order->neighborhood, 'city' => $order->city, 'state_abbr' => $order->state],
            'products' => $order->items->map(fn ($item) => ['name' => $item->title, 'quantity' => $item->quantity,
                'unitary_value' => (float) $item->price, 'width' => max(11, (float) ($item->book?->width ?: 16)),
                'height' => max(2, (float) ($item->book?->height ?: 3)), 'length' => max(16, (float) ($item->book?->length ?: 23)),
                'weight' => max(.1, (float) ($item->book?->weight ?: .5))])->all(),
            'options' => ['insurance_value' => (float) $order->subtotal, 'receipt' => false, 'own_hand' => false],
        ]);
        if ($response->failed()) {
            throw new RuntimeException($response->json('message', 'Falha ao incluir o envio no Melhor Envio.'));
        }

        return $response->json();
    }

    public function purchase(Shipment $shipment): array
    {
        $response = $this->client()->post('/me/shipment/checkout', ['orders' => [$shipment->melhor_envio_order_id]]);
        if ($response->failed()) {
            throw new RuntimeException($response->json('message', 'Falha ao comprar a etiqueta.'));
        }

        return $response->json();
    }

    public function generate(Shipment $shipment): array
    {
        $response = $this->client()->post('/me/shipment/generate', ['orders' => [$shipment->melhor_envio_order_id]]);
        if ($response->failed()) {
            throw new RuntimeException($response->json('message', 'Falha ao gerar a etiqueta.'));
        }

        return $response->json();
    }

    public function printUrl(Shipment $shipment): ?string
    {
        $response = $this->client()->post('/me/shipment/print', ['orders' => [$shipment->melhor_envio_order_id], 'mode' => 'private']);

        return $response->successful() ? $response->json('url') : null;
    }

    public function tracking(Shipment $shipment): array
    {
        $response = $this->client()->get('/me/shipment/tracking', ['orders' => [$shipment->melhor_envio_order_id]]);
        if ($response->failed()) {
            throw new RuntimeException($response->json('message', 'Falha ao consultar rastreamento.'));
        }

        return $response->json($shipment->melhor_envio_order_id, $response->json());
    }
}
