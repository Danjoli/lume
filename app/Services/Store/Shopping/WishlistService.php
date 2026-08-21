<?php

namespace App\Services\Store\Shopping;

use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class WishlistService
{
    /**
     * Retorna a wishlist do usuário autenticado.
     */
    public function getCurrentWishlist(): Collection
    {
        return Wishlist::query()
            ->with([
                'book.authors',
                'book.images',
            ])
            ->where(
                'user_id',
                Auth::id()
            )
            ->latest()
            ->get();
    }

    /**
     * Adiciona um livro à wishlist.
     */
    public function add(
        Book $book
    ): Wishlist {
        return Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
        ]);
    }

    /**
     * Remove um livro da wishlist.
     */
    public function remove(
        Book $book
    ): void {
        Wishlist::query()
            ->where(
                'user_id',
                Auth::id()
            )
            ->where(
                'book_id',
                $book->id
            )
            ->delete();
    }
}
