<?php

namespace App\Notifications;

use App\Models\NewsletterCampaign;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class NewsletterCampaignNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly NewsletterCampaign $campaign,
        private readonly NewsletterSubscriber $subscriber
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $unsubscribeUrl = URL::signedRoute(
            'store.newsletter.unsubscribe',
            [
                'subscriber' => $this->subscriber,
            ]
        );

        return (new MailMessage)
            ->subject($this->campaign->subject)
            ->greeting($this->campaign->title)
            ->line($this->campaign->content)
            ->action(
                'Visitar a Lume',
                route('store.home')
            )
            ->line(
                'Você recebeu este e-mail porque se cadastrou na newsletter da Lume.'
            )
            ->line(
                "Cancelar inscrição: {$unsubscribeUrl}"
            );
    }
}
