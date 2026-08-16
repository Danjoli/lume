<?php

namespace App\Services\Admin\Reports;

use App\Models\Book;
use Illuminate\Support\Collection;

class BooksReportService
{
    /**
     * Consulta base dos livros.
     */
    private function books()
    {
        return Book::query();
    }

    /**
     * Total de livros.
     */
    public function total(): int
    {
        return $this->books()->count();
    }

    /**
     * Livros ativos.
     */
    public function active(): int
    {
        return $this->books()

            ->where('is_active', true)

            ->count();
    }

    /**
     * Livros inativos.
     */
    public function inactive(): int
    {
        return $this->books()

            ->where('is_active', false)

            ->count();
    }

    /**
     * Livros sem estoque.
     */
    public function outOfStock(): int
    {
        return $this->books()

            ->where('stock', 0)

            ->count();
    }

    /**
     * Livros com estoque baixo.
     */
    public function lowStock(
        int $limit = 5
    ): int {

        return $this->books()

            ->where('stock', '>', 0)

            ->where('stock', '<=', $limit)

            ->count();

    }

    /**
     * Livros mais vendidos.
     */
    public function bestSellers(
        int $limit = 10
    ): Collection {

        return $this->books()

            ->withCount('orderItems')

            ->orderByDesc('order_items_count')

            ->limit($limit)

            ->get();

    }

    /**
     * Livros mais avaliados.
     */
    public function mostReviewed(
        int $limit = 10
    ): Collection {

        return $this->books()

            ->withCount('reviews')

            ->orderByDesc('reviews_count')

            ->limit($limit)

            ->get();

    }

    /**
     * Livros nunca vendidos.
     */
    public function neverSold(
        int $limit = 10
    ): Collection {

        return $this->books()

            ->doesntHave('orderItems')

            ->limit($limit)

            ->get();

    }

    /**
     * Livros com estoque baixo.
     */
    public function lowStockBooks(
        int $limit = 10,
        int $stock = 5
    ): Collection {

        return $this->books()

            ->where('stock', '>', 0)

            ->where('stock', '<=', $stock)

            ->orderBy('stock')

            ->limit($limit)

            ->get();

    }

    /**
     * Livros sem estoque.
     */
    public function outOfStockBooks(
        int $limit = 10
    ): Collection {

        return $this->books()

            ->where('stock', 0)

            ->limit($limit)

            ->get();

    }

    /**
     * Resumo geral.
     *
     * @return array<string,mixed>
     */
    public function summary(): array
    {
        return [

            'total' => $this->total(),

            'active' => $this->active(),

            'inactive' => $this->inactive(),

            'out_of_stock' => $this->outOfStock(),

            'low_stock' => $this->lowStock(),

            'best_sellers' => $this->bestSellers(),

            'most_reviewed' => $this->mostReviewed(),

            'never_sold' => $this->neverSold(),

            'low_stock_books' => $this->lowStockBooks(),

            'out_of_stock_books' => $this->outOfStockBooks(),

        ];
    }
}
