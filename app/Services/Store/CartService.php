<?php

namespace App\Services\Store;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartService
{
    public function getCurrentCart(): ?Cart
    {
        if (! Auth::check()) {
            return null;
        }

        return Cart::query()
            ->with([
                'items.book.authors',
                'items.book.primaryImage',
            ])
            ->where('user_id', Auth::id())
            ->first();
    }

    public function getOrCreateCart(): Cart
    {
        return Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);
    }

    public function add(
        int $bookId,
        int $quantity
    ): CartItem {
        $book = Book::query()
            ->where('is_active', true)
            ->findOrFail($bookId);

        if ($book->stock < $quantity) {
            throw ValidationException::withMessages([
                'quantity' => 'Quantidade indisponível em estoque.',
            ]);
        }

        $cart = $this->getOrCreateCart();

        $item = $cart->items()
            ->where('book_id', $book->id)
            ->first();

        if ($item) {
            $newQuantity = $item->quantity + $quantity;

            if ($newQuantity > $book->stock) {
                throw ValidationException::withMessages([
                    'quantity' => 'Quantidade indisponível em estoque.',
                ]);
            }

            $item->update([
                'quantity' => $newQuantity,
            ]);

            return $item->refresh();
        }

        return $cart->items()->create([
            'book_id' => $book->id,
            'quantity' => $quantity,
            'unit_price' => $book->sale_price ?? $book->price,
        ]);
    }

    public function update(
        CartItem $cartItem,
        int $quantity
    ): CartItem {
        $this->ensureOwnership($cartItem);

        $book = $cartItem->book;

        if ($quantity > $book->stock) {
            throw ValidationException::withMessages([
                'quantity' => 'Quantidade indisponível em estoque.',
            ]);
        }

        $cartItem->update([
            'quantity' => $quantity,
        ]);

        return $cartItem->refresh();
    }

    public function remove(
        CartItem $cartItem
    ): void {
        $this->ensureOwnership($cartItem);

        $cartItem->delete();
    }

    public function clear(): void
    {
        $cart = $this->getCurrentCart();

        if (! $cart) {
            return;
        }

        $cart->items()->delete();
    }

    private function ensureOwnership(
        CartItem $cartItem
    ): void {
        $cartItem->loadMissing('cart');

        abort_unless(
            $cartItem->cart->user_id === Auth::id(),
            403
        );
    }
}
