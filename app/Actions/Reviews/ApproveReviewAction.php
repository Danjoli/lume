<?php

namespace App\Actions\Reviews;

use App\Exceptions\Domain\CannotApproveReviewException;
use App\Models\Review;

class ApproveReviewAction
{
    /**
     * Aprova uma avaliação.
     */
    public function execute(
        Review $review
    ): Review {

        if ($review->isApproved()) {

            throw new CannotApproveReviewException(
                'Esta avaliação já está aprovada.'
            );

        }

        $review->approve();

        return $review->refresh();

    }
}
