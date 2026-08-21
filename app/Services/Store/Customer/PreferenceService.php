<?php

namespace App\Services\Store\Customer;

use App\Models\NewsletterSubscriber;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PreferenceService
{
    public function getNewsletterSubscriber(): ?NewsletterSubscriber
    {
        return NewsletterSubscriber::query()
            ->where(
                'email',
                $this->user()->email
            )
            ->first();
    }

    public function toggleNewsletter(): NewsletterSubscriber
    {
        $subscriber = NewsletterSubscriber::query()
            ->firstOrCreate(
                [
                    'email' => $this->user()->email,
                ],
                [
                    'is_active' => true,
                ]
            );

        if ($subscriber->wasRecentlyCreated) {
            return $subscriber;
        }

        $subscriber->update([
            'is_active' => ! $subscriber->is_active,
        ]);

        return $subscriber->refresh();
    }

    private function user(): User
    {
        /** @var User $user */
        $user = Auth::user();

        return $user;
    }
}
