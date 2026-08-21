<?php

namespace App\Http\Controllers\Store\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Catalog\StoreReviewRequest;
use App\Models\Book;
use App\Models\Review;
use App\Services\Store\Catalog\ReviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(private readonly ReviewService $reviewService) {}

    public function store(StoreReviewRequest $request, Book $book): RedirectResponse
    {
        $review = $this->reviewService->submit($request->user(), $book, $request->validated());

        return back()->with('success', $review->is_approved ? 'Avaliação publicada.' : 'Avaliação enviada para moderação.');
    }

    public function destroy(Request $request, Review $review): RedirectResponse
    {
        $this->reviewService->delete($request->user(), $review);

        return back()->with('success', 'Avaliação removida.');
    }
}
