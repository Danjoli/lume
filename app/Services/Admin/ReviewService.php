<?php

namespace App\Services\Admin;

use App\Actions\Reviews\ApproveReviewAction;
use App\Models\Review;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ReviewService
{
    /**
     * Quantidade de registros por página.
     */
    private const PER_PAGE = 10;

    public function __construct(
        private readonly ApproveReviewAction $approveReviewAction,
    ) {
    }

    /**
     * Lista paginada das avaliações.
     */
    public function paginate(
        Request $request
    ): LengthAwarePaginator {
        return Review::query()

            ->with([
                'user',
                'book',
            ])

            ->when(
                $request->filled('search'),
                function ($query) use ($request) {

                    $query->where(
                        function ($query) use ($request) {

                            $query
                                ->where(
                                    'comment',
                                    'like',
                                    "%{$request->search}%"
                                )

                                ->orWhereHas(
                                    'user',
                                    function ($query) use ($request) {

                                        $query->where(
                                            'name',
                                            'like',
                                            "%{$request->search}%"
                                        );
                                    }
                                )

                                ->orWhereHas(
                                    'book',
                                    function ($query) use ($request) {

                                        $query->where(
                                            'title',
                                            'like',
                                            "%{$request->search}%"
                                        );
                                    }
                                );
                        }
                    );
                }
            )

            ->when(
                $request->filled('approved'),
                fn ($query) => $query->where(
                    'is_approved',
                    $request->boolean('approved')
                )
            )

            ->latest()

            ->paginate(self::PER_PAGE)

            ->withQueryString();
    }

    /**
     * Retorna uma avaliação.
     */
    public function find(
        Review $review
    ): Review {
        return $review->load([
            'user',
            'book',
        ]);
    }

    /**
     * Aprova uma avaliação.
     */
    public function approve(
        Review $review
    ): Review {
        return $this->approveReviewAction
            ->execute($review);
    }

    /**
     * Reprova uma avaliação.
     */
    public function reject(
        Review $review
    ): Review {
        $review->reject();

        return $review->refresh();
    }

    /**
     * Remove uma avaliação.
     */
    public function destroy(
        Review $review
    ): void {
        $review->delete();
    }
}
