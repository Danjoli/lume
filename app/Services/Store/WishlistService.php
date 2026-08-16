<?php

namespace App\Services\Store;

use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Collection;

class WishlistService
{
    public function getCurrentWishlist(): Collection
    {
        return Wishlist::query()
            ->with([
                'book.authors',
                'book.primaryImage',
            ])
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->get();
    }

    public function add(
        Book $book
    ): Wishlist {
        return Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
        ]);
    }

    public function remove(
        Book $book
    ): void {
        Wishlist::query()
            ->where(
                'user_id',
                auth()->id()
            )
            ->where(
                'book_id',
                $book->id
            )
            ->delete();
    }
}
