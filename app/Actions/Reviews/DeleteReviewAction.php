<?php

namespace App\Actions\Reviews;

use App\Models\Review;

class DeleteReviewAction
{
    /**
     * Remove uma avaliação.
     */
    public function execute(
        Review $review
    ): void {

        $review->delete();

    }
}
