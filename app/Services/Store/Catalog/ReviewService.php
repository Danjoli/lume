<?php

namespace App\Services\Store\Catalog;

use App\Enums\PaymentStatus;
use App\Models\Book;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\Reviews\ReviewCreatedNotification;
use App\Services\Admin\NotificationService;
use Illuminate\Validation\ValidationException;

class ReviewService
{
    public function __construct(private readonly NotificationService $notifications) {}

    /**
     * @param  array{rating: int, comment?: string|null}  $data
     */
    public function submit(User $user, Book $book, array $data): Review
    {
        $settings = Setting::query()->first();

        if (($settings?->reviews_require_purchase ?? true) && ! $this->hasPurchased($user, $book)) {
            throw ValidationException::withMessages([
                'review' => 'Somente clientes que compraram este livro podem avaliá-lo.',
            ]);
        }

        $review = Review::query()->updateOrCreate(
            ['user_id' => $user->id, 'book_id' => $book->id],
            [...$data, 'is_approved' => (bool) ($settings?->reviews_auto_approve ?? false)],
        );

        if (! $review->is_approved) {
            $this->notifications->notifyAdmins(new ReviewCreatedNotification($review));
        }

        return $review;
    }

    public function delete(User $user, Review $review): void
    {
        abort_unless($review->user_id === $user->id, 403);

        $review->delete();
    }

    private function hasPurchased(User $user, Book $book): bool
    {
        return OrderItem::query()
            ->where('book_id', $book->id)
            ->whereHas('order', fn ($query) => $query
                ->where('user_id', $user->id)
                ->where('payment_status', PaymentStatus::PAID))
            ->exists();
    }
}
