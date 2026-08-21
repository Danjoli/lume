<?php

namespace App\Services\Store\Checkout;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\ShipmentStatus;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Notifications\Orders\OrderCreatedNotification;
use App\Services\Admin\NotificationService;
use App\Services\Store\Shipping\MelhorEnvioService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutService
{
    public function __construct(
        private readonly NotificationService $notificationService,
        private readonly MelhorEnvioService $melhorEnvioService,
        private readonly CheckoutContext $context,
    ) {}

    public function getCheckoutData(): array
    {
        $cart = $this->context->cart();

        $addresses = $this->context->user()
            ->addresses()
            ->orderByDesc('is_default')
            ->latest()
            ->get();

        $selectedAddress = $addresses
            ->firstWhere('is_default', true)
            ?? $addresses->first();

        $shippingError = null;
        try {
            $shippingOptions = $selectedAddress ? $this->getShippingOptions($selectedAddress, $cart) : collect();
        } catch (\Throwable $exception) {
            report($exception);
            $shippingOptions = collect();
            $shippingError = $exception->getMessage();
        }

        return [
            'cart' => $cart,
            'addresses' => $addresses,
            'shippingOptions' => $shippingOptions,
            'shippingPrice' => 0,
            'shippingError' => $shippingError,
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function checkout(
        array $data
    ): Order {
        $cart = $this->context->cart();

        if ($cart->items->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => 'Seu carrinho está vazio.',
            ]);
        }

        $address = $this->context->address(
            (int) $data['address_id']
        );

        $this->context->validateStock($cart);

        $shippingOption = $this->getShippingOption(
            $address,
            $cart,
            $data['shipping_service']
        );

        $order = DB::transaction(function () use (
            $cart,
            $address,
            $shippingOption,
            $data
        ) {
            $subtotal = $this->context->subtotal($cart);

            $shipping = (float) $shippingOption['price'];

            $discount = 0;

            $total =
                $subtotal
                + $shipping
                - $discount;

            $order = Order::create([
                'user_id' => $this->context->user()->id,

                'status' => OrderStatus::PENDING,

                'payment_status' => PaymentStatus::PENDING,

                'payment_method' => $data['payment_method'],

                'subtotal' => $subtotal,

                'shipping' => $shipping,

                'discount' => $discount,

                'total' => $total,

                'cpf' => $data['cpf'],

                /*
                 * Snapshot do endereço.
                 */
                'recipient_name' => $address->recipient_name,

                'phone' => $data['phone'],

                'street' => $address->street,

                'number' => $address->number,

                'complement' => $address->complement,

                'neighborhood' => $address->neighborhood,

                'city' => $address->city,

                'state' => $address->state,

                'cep' => $address->cep,
            ]);

            /*
             * Snapshot dos itens comprados.
             */
            foreach ($cart->items as $item) {
                $book = $item->book;

                $unitPrice =
                    $book->sale_price
                    ?? $book->price;

                $order->items()->create([
                    'book_id' => $book->id,

                    'title' => $book->title,

                    'quantity' => $item->quantity,

                    'price' => $unitPrice,

                ]);
            }

            /*
             * Dados logísticos do pedido.
             */
            $order->shipment()->create([
                'carrier' => $shippingOption['carrier']
                    ?? null,

                'service' => $shippingOption['id'],

                'status' => ShipmentStatus::PENDING,

                'shipping_cost' => $shipping,
                'delivery_min_days' => $shippingOption['delivery_min_days'] ?? null,
                'delivery_max_days' => $shippingOption['delivery_max_days'] ?? null,
                'gateway_payload' => $shippingOption,
            ]);

            /*
             * Esvazia o carrinho após
             * criar o pedido com sucesso.
             */
            $cart->items()->delete();

            return $order->refresh();
        });

        $this->notificationService
            ->notifyAdmins(
                new OrderCreatedNotification($order)
            );

        return $order;
    }

    /**
     * Temporário até integrar
     * o serviço real de frete.
     */
    private function getShippingOptions(
        Address $address,
        Cart $cart
    ): Collection {
        return $this->melhorEnvioService->calculate($address, $cart);
    }

    private function getShippingOption(
        Address $address,
        Cart $cart,
        string $service
    ): array {
        $option = $this->getShippingOptions(
            $address,
            $cart
        )->firstWhere(
            'id',
            $service
        );

        if (! $option) {
            throw ValidationException::withMessages([
                'shipping_service' => 'A forma de entrega selecionada é inválida.',
            ]);
        }

        return $option;
    }
}
