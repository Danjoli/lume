<?php

namespace App\Observers;

use App\Models\Publisher;
use Illuminate\Support\Str;

class PublisherObserver
{
    /**
     * Handle the Publisher "creating" event.
     */
    public function creating(Publisher $publisher): void
    {
        if (blank($publisher->slug)) {
            $publisher->slug = Str::slug($publisher->name);
        }
    }

    /**
     * Handle the Publisher "updating" event.
     */
    public function updating(Publisher $publisher): void
    {
        if ($publisher->isDirty('name')) {
            $publisher->slug = Str::slug($publisher->name);
        }
    }
}
