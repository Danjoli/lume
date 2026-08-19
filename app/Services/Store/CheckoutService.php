<?php

namespace App\Services\Store;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\ShipmentStatus;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Notifications\Orders\OrderCreatedNotification;
use App\Services\Admin\NotificationService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutService
{
    public function __construct(
        private readonly NotificationService $notificationService,
    ) {
    }

    public function getCheckoutData(): array
    {
        $cart = $this->getCart();

        $addresses = $this->user()
            ->addresses()
            ->orderByDesc('is_default')
            ->latest()
            ->get();

        $selectedAddress = $addresses
            ->firstWhere('is_default', true)
            ?? $addresses->first();

        $shippingOptions = $selectedAddress
            ? $this->getShippingOptions(
                $selectedAddress,
                $cart
            )
            : collect();

        return [
            'cart' => $cart,
            'addresses' => $addresses,
            'shippingOptions' => $shippingOptions,
            'shippingPrice' => 0,
        ];
    }

    /**
     * @param array<string, mixed> $data
     */
    public function checkout(
        array $data
    ): Order {
        $cart = $this->getCart();

        if ($cart->items->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => 'Seu carrinho está vazio.',
            ]);
        }

        $address = $this->getAddress(
            (int) $data['address_id']
        );

        $this->validateStock($cart);

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
            $subtotal = $this->calculateSubtotal($cart);

            $shipping = (float) $shippingOption['price'];

            $discount = 0;

            $total =
                $subtotal
                + $shipping
                - $discount;

            $order = Order::create([
                'user_id' => $this->user()->id,

                'status' => OrderStatus::PENDING,

                'payment_status' => PaymentStatus::PENDING,

                'payment_method' =>
                    $data['payment_method'],

                'subtotal' => $subtotal,

                'shipping' => $shipping,

                'discount' => $discount,

                'total' => $total,

                'cpf' =>
                    $data['cpf'],

                /*
                 * Snapshot do endereço.
                 */
                'recipient_name' =>
                    $address->recipient_name,

                'phone' =>
                    $data['phone'],

                'street' =>
                    $address->street,

                'number' =>
                    $address->number,

                'complement' =>
                    $address->complement,

                'neighborhood' =>
                    $address->neighborhood,

                'city' =>
                    $address->city,

                'state' =>
                    $address->state,

                'cep' =>
                    $address->cep,
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

                    'quantity' =>
                        $item->quantity,

                    'price' =>
                        $unitPrice,

                    'subtotal' =>
                        (float) $unitPrice
                        * $item->quantity,
                ]);
            }

            /*
             * Dados logísticos do pedido.
             */
            $order->shipment()->create([
                'carrier' =>
                    $shippingOption['carrier']
                    ?? null,

                'service' =>
                    $shippingOption['id'],

                'status' =>
                    ShipmentStatus::PENDING,

                'shipping_cost' =>
                    $shipping,
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

    private function getCart(): Cart
    {
        $cart = Cart::query()
            ->with([
                'items.book.authors',
                'items.book.primaryImage',
            ])
            ->where(
                'user_id',
                $this->user()->id
            )
            ->first();

        if (! $cart) {
            throw ValidationException::withMessages([
                'cart' => 'Seu carrinho está vazio.',
            ]);
        }

        return $cart;
    }

    private function getAddress(
        int $addressId
    ): Address {
        return Address::query()
            ->where(
                'user_id',
                $this->user()->id
            )
            ->findOrFail($addressId);
    }

    private function calculateSubtotal(
        Cart $cart
    ): float {
        return (float) $cart->items->sum(
            function ($item) {
                $price =
                    $item->book->sale_price
                    ?? $item->book->price;

                return (float) $price
                    * $item->quantity;
            }
        );
    }

    private function validateStock(
        Cart $cart
    ): void {
        foreach ($cart->items as $item) {
            if (
                $item->quantity
                > $item->book->stock
            ) {
                throw ValidationException::withMessages([
                    'cart' =>
                        "Estoque insuficiente para {$item->book->title}.",
                ]);
            }
        }
    }

    /**
     * Temporário até integrar
     * o serviço real de frete.
     */
    private function getShippingOptions(
        Address $address,
        Cart $cart
    ): Collection {
        return collect([
            [
                'id' => 'standard',
                'name' => 'Entrega padrão',
                'carrier' => 'Transportadora',
                'price' => 14.90,
                'delivery_time' => '5 a 8',
            ],

            [
                'id' => 'express',
                'name' => 'Entrega expressa',
                'carrier' => 'Transportadora',
                'price' => 24.90,
                'delivery_time' => '2 a 4',
            ],
        ]);
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
                'shipping_service' =>
                    'A forma de entrega selecionada é inválida.',
            ]);
        }

        return $option;
    }

    private function user(): User
    {
        /** @var User $user */
        $user = Auth::user();

        return $user;
    }
}
