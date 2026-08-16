<?php

namespace App\Services\Store;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutService
{
    public function getCheckoutData(): array
    {
        $cart = $this->getCart();

        return [
            'cart' => $cart,

            'addresses' => auth()
                ->user()
                ->addresses()
                ->orderByDesc('is_default')
                ->latest()
                ->get(),
        ];
    }

    /**
     * Cria o pedido a partir do carrinho.
     */
    public function checkout(
        int $addressId
    ): Order {
        $cart = $this->getCart();

        if ($cart->items->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => 'Seu carrinho está vazio.',
            ]);
        }

        $address = Address::query()
            ->where('user_id', auth()->id())
            ->findOrFail($addressId);

        $this->validateStock($cart);

        return DB::transaction(function () use (
            $cart,
            $address
        ) {

            $subtotal = $this->calculateSubtotal($cart);

            /*
             * Por enquanto o frete fica zerado.
             * Depois conectamos ao serviço de frete.
             */
            $shipping = 0;

            $discount = 0;

            $total =
                $subtotal
                + $shipping
                - $discount;

            $order = Order::create([
                'user_id' => auth()->id(),

                'status' => 'pending',

                'payment_status' => 'pending',

                'subtotal' => $subtotal,

                'shipping' => $shipping,

                'discount' => $discount,

                'total' => $total,

                /*
                 * Snapshot do endereço.
                 */
                'recipient_name' =>
                    $address->recipient_name,

                'phone' =>
                    $address->phone,

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
                        $unitPrice
                        * $item->quantity,
                ]);
            }

            /*
             * Depois de criar o pedido,
             * esvaziamos o carrinho.
             */
            $cart->items()->delete();

            return $order->refresh();
        });
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
                auth()->id()
            )
            ->first();

        if (! $cart) {
            throw ValidationException::withMessages([
                'cart' => 'Seu carrinho está vazio.',
            ]);
        }

        return $cart;
    }

    private function calculateSubtotal(
        Cart $cart
    ): float {
        return (float) $cart->items->sum(
            function ($item) {

                $price =
                    $item->book->sale_price
                    ?? $item->book->price;

                return $price
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
}
