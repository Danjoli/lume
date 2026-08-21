<?php

namespace App\Jobs;

use App\Models\NewsletterCampaign;
use App\Models\NewsletterSubscriber;
use App\Notifications\NewsletterCampaignNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class SendNewsletterCampaign implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public NewsletterCampaign $campaign
    ) {}

    public function handle(): void
    {
        $this->campaign->update([
            'status' => 'sending',
        ]);

        NewsletterSubscriber::query()
            ->where('is_active', true)
            ->chunkById(
                100,
                function ($subscribers) {
                    foreach ($subscribers as $subscriber) {
                        Notification::route(
                            'mail',
                            $subscriber->email
                        )->notify(
                            new NewsletterCampaignNotification(
                                $this->campaign,
                                $subscriber
                            )
                        );
                    }
                }
            );

        $this->campaign->update([
            'status' => 'sent',
            'sent_at' => now(),
        ]);
    }
}
