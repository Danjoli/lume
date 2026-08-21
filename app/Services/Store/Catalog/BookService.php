<?php

namespace App\Services\Store\Catalog;

use App\Models\Book;

class BookService
{
    public function getBookData(Book $book): array
    {
        $book->load([
            'publisher',
            'authors',
            'categories',
            'images',
            'approvedReviews.user',
        ]);

        $book->loadAvg(
            'approvedReviews as reviews_avg_rating',
            'rating'
        );

        $book->loadCount(
            'approvedReviews as reviews_count'
        );

        $book->setRelation('reviews', $book->approvedReviews);

        $relatedBooks = Book::query()

            ->with([
                'authors',
                'images',
            ])

            ->withAvg(
                'approvedReviews as reviews_avg_rating',
                'rating'
            )

            ->withCount(
                'approvedReviews as reviews_count'
            )

            ->where(
                'is_active',
                true
            )

            ->whereKeyNot(
                $book->id
            )

            ->when(
                $book->categories->isNotEmpty(),
                fn ($query) => $query->whereHas(
                    'categories',
                    fn ($query) => $query->whereIn(
                        'categories.id',
                        $book->categories->pluck('id')
                    )
                )
            )

            ->limit(5)

            ->get();

        return [
            'book' => $book,
            'relatedBooks' => $relatedBooks,
        ];
    }
}
