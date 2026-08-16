<?php

namespace App\Actions\Reviews;

use App\Models\Review;

class RejectReviewAction
{
    /**
     * Reprova uma avaliação.
     */
    public function execute(
        Review $review
    ): Review {

        $review->reject();

        return $review->refresh();

    }
}
