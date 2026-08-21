<?php

namespace App\Services\Store\Shipping;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Setting;
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
        if (! ctype_digit((string) $shipment->service)) {
            throw new RuntimeException('O serviço deste envio não possui um ID válido do Melhor Envio. Recalcule o frete ou utilize um pedido criado pelo checkout integrado.');
        }

        $shipment->loadMissing('order.items.book', 'order.user');
        $order = $shipment->order;
        $response = $this->client()->post('/me/cart', [
            'service' => (int) $shipment->service,
            'from' => $this->sender(),
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

    /**
     * @return array<string, mixed>
     */
    private function sender(): array
    {
        $settings = Setting::query()->first();
        $sender = [
            'name' => $settings?->company_name ?: $settings?->store_name,
            'phone' => $settings?->phone,
            'email' => $settings?->email,
            'postal_code' => preg_replace('/\D/', '', (string) ($settings?->origin_cep ?: config('services.melhor_envio.from_postal_code'))),
            'address' => $settings?->street,
            'number' => $settings?->number,
            'complement' => $settings?->complement,
            'district' => $settings?->neighborhood,
            'city' => $settings?->city,
            'state_abbr' => $settings?->state,
        ];

        $document = preg_replace('/\D/', '', (string) $settings?->cnpj);
        if (strlen($document) === 14) {
            $sender['company_document'] = $document;
        } elseif (strlen($document) === 11) {
            $sender['document'] = $document;
        }

        $required = [
            'name' => 'nome/razão social',
            'phone' => 'telefone',
            'email' => 'e-mail',
            'postal_code' => 'CEP de origem',
            'address' => 'logradouro',
            'number' => 'número',
            'district' => 'bairro',
            'city' => 'cidade',
            'state_abbr' => 'estado',
        ];
        $missing = collect($required)
            ->filter(fn (string $label, string $field) => blank($sender[$field] ?? null))
            ->values();

        if (! in_array(strlen($document), [11, 14], true)) {
            $missing->push('CPF/CNPJ válido');
        }

        if ($missing->isNotEmpty()) {
            throw new RuntimeException('Complete os dados do remetente em Administração > Configurações: '.$missing->implode(', ').'.');
        }

        return array_filter($sender, fn ($value) => filled($value));
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

    public function printUrl(Shipment $shipment): string
    {
        $response = $this->client()->post('/me/shipment/print', ['orders' => [$shipment->melhor_envio_order_id], 'mode' => 'private']);
        if ($response->failed()) {
            throw new RuntimeException($response->json('message', 'Falha ao obter a etiqueta para impressão.'));
        }

        $url = $response->json('url');
        if (! is_string($url) || $url === '') {
            throw new RuntimeException('O Melhor Envio não retornou a URL de impressão da etiqueta.');
        }

        return $url;
    }

    public function tracking(Shipment $shipment): array
    {
        $response = $this->client()->get('/me/shipment/tracking', ['orders' => [$shipment->melhor_envio_order_id]]);
        if ($response->failed()) {
            throw new RuntimeException($response->json('message', 'Falha ao consultar rastreamento.'));
        }

        $payload = $response->json();
        if (! is_array($payload) || $payload === []) {
            return [];
        }

        $tracking = $payload[$shipment->melhor_envio_order_id] ?? null;
        if (is_array($tracking)) {
            return $tracking;
        }

        if (array_is_list($payload) && is_array($payload[0] ?? null)) {
            return $payload[0];
        }

        return $payload;
    }
}
