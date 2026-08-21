<?php

namespace App\Services\Admin\Newsletter;

use App\Models\NewsletterSubscriber;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class NewsletterSubscriberService
{
    public function paginate(
        int $perPage = 20
    ): LengthAwarePaginator {
        return NewsletterSubscriber::query()
            ->latest('subscribed_at')
            ->paginate($perPage);
    }

    public function getStats(): array
    {
        return [
            'total' => NewsletterSubscriber::count(),

            'active' => NewsletterSubscriber::where(
                'is_active',
                true
            )->count(),

            'inactive' => NewsletterSubscriber::where(
                'is_active',
                false
            )->count(),
        ];
    }
}
