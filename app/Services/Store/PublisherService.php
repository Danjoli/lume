<?php

namespace App\Services\Store;

use App\Models\Publisher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class PublisherService
{
    private const PER_PAGE = 20;

    public function paginate(): LengthAwarePaginator
    {
        return Publisher::query()

            ->withCount([
                'books' => fn ($query) =>
                    $query->where(
                        'is_active',
                        true
                    ),
            ])

            ->orderBy('name')

            ->paginate(self::PER_PAGE);
    }

    public function books(
        Publisher $publisher,
        Request $request
    ): LengthAwarePaginator {
        return $publisher
            ->books()

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

            ->when(
                $request->input('sort') === 'price_asc',
                fn ($query) =>
                    $query->orderBy('price')
            )

            ->when(
                $request->input('sort') === 'price_desc',
                fn ($query) =>
                    $query->orderByDesc('price')
            )

            ->when(
                $request->input('sort') === 'newest',
                fn ($query) =>
                    $query->latest('publication_date')
            )

            ->when(
                ! $request->filled('sort'),
                fn ($query) =>
                    $query->latest()
            )

            ->paginate(self::PER_PAGE)

            ->withQueryString();
    }
}
