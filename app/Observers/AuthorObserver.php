<?php

namespace App\Observers;

use App\Models\Author;
use Illuminate\Support\Str;

class AuthorObserver
{
    /**
     * Handle the Author "creating" event.
     */
    public function creating(Author $author): void
    {
        if (blank($author->slug)) {
            $author->slug = Str::slug($author->name);
        }
    }

    /**
     * Handle the Author "created" event.
     */
    public function created(Author $author): void
    {
        //
    }

    /**
     * Handle the Author "updating" event.
     */
    public function updating(Author $author): void
    {
        if ($author->isDirty('name')) {
            $author->slug = Str::slug($author->name);
        }
    }

    /**
     * Handle the Author "updated" event.
     */
    public function updated(Author $author): void
    {
        //
    }

    /**
     * Handle the Author "deleted" event.
     */
    public function deleted(Author $author): void
    {
        //
    }

    /**
     * Handle the Author "restored" event.
     */
    public function restored(Author $author): void
    {
        //
    }

    /**
     * Handle the Author "force deleted" event.
     */
    public function forceDeleted(Author $author): void
    {
        //
    }
}
