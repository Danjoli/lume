<?php

namespace App\Observers;

use App\Models\Book;
use Illuminate\Support\Str;

class BookObserver
{
    /**
     * Handle the Book "creating" event.
     */
    public function creating(Book $book): void
    {
        if (blank($book->slug)) {
            $book->slug = Str::slug($book->title);
        }
    }

    /**
     * Handle the Book "updating" event.
     */
    public function updating(Book $book): void
    {
        if ($book->isDirty('title')) {
            $book->slug = Str::slug($book->title);
        }
    }
}
