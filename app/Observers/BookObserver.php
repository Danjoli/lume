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
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        //
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

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "restored" event.
     */
    public function restored(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "force deleted" event.
     */
    public function forceDeleted(Book $book): void
    {
        //
    }
}
