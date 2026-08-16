<?php

namespace App\Services\Store;

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
            'reviews.user',
        ]);

        $book->loadAvg(
            'reviews',
            'rating'
        );

        $book->loadCount(
            'reviews'
        );

        $relatedBooks = Book::query()

            ->with([
                'authors',
                'primaryImage',
            ])

            ->withAvg(
                'reviews',
                'rating'
            )

            ->withCount(
                'reviews'
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
