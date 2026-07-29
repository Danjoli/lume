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
     * Handle the Publisher "created" event.
     */
    public function created(Publisher $publisher): void
    {
        //
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

    /**
     * Handle the Publisher "updated" event.
     */
    public function updated(Publisher $publisher): void
    {
        //
    }

    /**
     * Handle the Publisher "deleted" event.
     */
    public function deleted(Publisher $publisher): void
    {
        //
    }

    /**
     * Handle the Publisher "restored" event.
     */
    public function restored(Publisher $publisher): void
    {
        //
    }

    /**
     * Handle the Publisher "force deleted" event.
     */
    public function forceDeleted(Publisher $publisher): void
    {
        //
    }
}
