<?php

namespace App\Services\Store\Checkout;

use App\Models\Address;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CheckoutContext
{
    public function user(): User
    {
        /** @var User $user */
        $user = Auth::user();

        return $user;
    }

    public function cart(): Cart
    {
        $cart = Cart::query()
            ->with(['items.book.authors', 'items.book.primaryImage'])
            ->whereBelongsTo($this->user())
            ->first();

        if (! $cart) {
            throw ValidationException::withMessages(['cart' => 'Seu carrinho está vazio.']);
        }

        return $cart;
    }

    public function address(int $addressId): Address
    {
        return $this->user()->addresses()->findOrFail($addressId);
    }

    public function subtotal(Cart $cart): float
    {
        return (float) $cart->items->sum(fn ($item) => (float) ($item->book->sale_price ?? $item->book->price) * $item->quantity);
    }

    public function validateStock(Cart $cart): void
    {
        foreach ($cart->items as $item) {
            if ($item->quantity > $item->book->stock) {
                throw ValidationException::withMessages(['cart' => "Estoque insuficiente para {$item->book->title}."]);
            }
        }
    }
}
