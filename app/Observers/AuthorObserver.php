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
     * Handle the Author "updating" event.
     */
    public function updating(Author $author): void
    {
        if ($author->isDirty('name')) {
            $author->slug = Str::slug($author->name);
        }
    }
}
