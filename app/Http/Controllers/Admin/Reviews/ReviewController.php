<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Exceptions\Domain\CannotApproveReviewException;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Services\Admin\Reviews\ReviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function __construct(
        private readonly ReviewService $reviewService,
    ) {}

    /**
     * Exibe a listagem das avaliações.
     */
    public function index(Request $request): View
    {
        return view('admin.reviews.index', [

            'reviews' => $this->reviewService->paginate($request),

        ]);
    }

    /**
     * Exibe uma avaliação.
     */
    public function show(
        Review $review
    ): View {

        return view('admin.reviews.show', [

            'review' => $this->reviewService->find($review),

        ]);

    }

    /**
     * Aprova uma avaliação.
     */
    public function approve(
        Review $review
    ): RedirectResponse {

        try {

            $this->reviewService->approve($review);

            return back()->with(
                'success',
                'Avaliação aprovada com sucesso.'
            );

        } catch (CannotApproveReviewException $exception) {

            return back()->with(
                'error',
                $exception->getMessage()
            );

        }

    }

    /**
     * Reprova uma avaliação.
     */
    public function reject(
        Review $review
    ): RedirectResponse {

        $this->reviewService->reject($review);

        return back()->with(
            'success',
            'Avaliação reprovada.'
        );

    }

    /**
     * Remove uma avaliação.
     */
    public function destroy(
        Review $review
    ): RedirectResponse {

        $this->reviewService->destroy($review);

        return redirect()

            ->route('admin.reviews.index')

            ->with(
                'success',
                'Avaliação removida com sucesso.'
            );

    }
}
