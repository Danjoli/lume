<?php

namespace App\Services\Store\Content;

use App\Models\NewsletterSubscriber;

class NewsletterService
{
    public function subscribe(
        string $email
    ): NewsletterSubscriber {
        $subscriber = NewsletterSubscriber::query()
            ->firstOrNew([
                'email' => $email,
            ]);

        $subscriber->fill([
            'is_active' => true,
            'subscribed_at' => $subscriber->subscribed_at ?? now(),
            'unsubscribed_at' => null,
        ]);

        $subscriber->save();

        return $subscriber;
    }

    public function unsubscribe(
        NewsletterSubscriber $subscriber
    ): NewsletterSubscriber {
        $subscriber->update([
            'is_active' => false,
            'unsubscribed_at' => now(),
        ]);

        return $subscriber->refresh();
    }
}
