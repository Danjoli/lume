<?php

namespace App\Services\Store\Catalog;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryService
{
    private const PER_PAGE = 20;

    public function all(): Collection
    {
        return Category::query()

            ->withCount([
                'books' => fn ($query) => $query->where(
                    'is_active',
                    true
                ),
            ])

            ->whereNull('parent_id')

            ->orderBy('name')

            ->get();
    }

    public function books(
        Category $category,
        Request $request
    ): LengthAwarePaginator {
        return $category
            ->books()

            ->with([
                'authors',
                'publisher',
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
                fn ($query) => $query->orderBy('price')
            )

            ->when(
                $request->input('sort') === 'price_desc',
                fn ($query) => $query->orderByDesc('price')
            )

            ->when(
                $request->input('sort') === 'newest',
                fn ($query) => $query->latest('publication_date')
            )

            ->when(
                ! $request->filled('sort'),
                fn ($query) => $query->latest()
            )

            ->paginate(self::PER_PAGE)

            ->withQueryString();
    }
}
