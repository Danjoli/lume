<?php

namespace App\Notifications\Reviews;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReviewCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly Review $review
    ) {}

    public function via(object $notifiable): array
    {
        return [
            'database',
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'review_created',

            'title' => 'Nova avaliação',

            'message' => 'Uma nova avaliação está aguardando análise.',

            'url' => route(
                'admin.reviews.show',
                $this->review
            ),

            'review_id' => $this->review->id,
        ];
    }
}
