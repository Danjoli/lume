<?php

namespace App\Services\Store;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class CatalogService
{
    private const PER_PAGE = 20;

    public function getCatalogData(Request $request): array
    {
        return [
            'books' => $this->paginate($request),

            'categories' => Category::query()
                ->orderBy('name')
                ->get(),

            'authors' => Author::query()
                ->orderBy('name')
                ->get(),

            'publishers' => Publisher::query()
                ->orderBy('name')
                ->get(),
        ];
    }

    private function paginate(Request $request)
    {
        return Book::query()

            ->with([
                'authors',
                'publisher',
                'images',
            ])

            ->withAvg('reviews', 'rating')

            ->withCount('reviews')

            ->where('is_active', true)

            ->when(
                $request->filled('search'),
                function ($query) use ($request) {

                    $search = $request->string('search')->toString();

                    $query->where(function ($query) use ($search) {

                        $query
                            ->where(
                                'title',
                                'like',
                                '%' . $search . '%'
                            )

                            ->orWhere(
                                'isbn',
                                'like',
                                '%' . $search . '%'
                            )

                            ->orWhereHas(
                                'authors',
                                fn ($query) => $query->where(
                                    'name',
                                    'like',
                                    '%' . $search . '%'
                                )
                            );

                    });
                }
            )

            ->when(
                $request->filled('category'),
                fn ($query) => $query->whereHas(
                    'categories',
                    fn ($query) => $query->where(
                        'categories.id',
                        $request->integer('category')
                    )
                )
            )

            ->when(
                $request->filled('author'),
                fn ($query) => $query->whereHas(
                    'authors',
                    fn ($query) => $query->where(
                        'authors.id',
                        $request->integer('author')
                    )
                )
            )

            ->when(
                $request->filled('publisher'),
                fn ($query) => $query->where(
                    'publisher_id',
                    $request->integer('publisher')
                )
            )

            ->when(
                $request->filled('min_price'),
                fn ($query) => $query->where(
                    'price',
                    '>=',
                    $request->decimal('min_price')
                )
            )

            ->when(
                $request->filled('max_price'),
                fn ($query) => $query->where(
                    'price',
                    '<=',
                    $request->decimal('max_price')
                )
            )

            ->when(
                $request->boolean('in_stock'),
                fn ($query) => $query->where('stock', '>', 0)
            )

            ->when(
                $request->boolean('promotion'),
                fn ($query) => $query
                    ->whereNotNull('sale_price')
                    ->whereColumn('sale_price', '<', 'price')
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
