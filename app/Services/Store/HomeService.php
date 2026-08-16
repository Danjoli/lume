<?php

namespace App\Services\Store;

use App\Models\Book;
use App\Models\Category;

class HomeService
{
    public function getHomeData(): array
    {
        return [
            'categories' => $this->getCategories(),
            'bestSellers' => $this->getBestSellers(),
            'newReleases' => $this->getNewReleases(),
            'promotions' => $this->getPromotions(),
        ];
    }

    private function getCategories()
    {
        return Category::query()
            ->whereNull('parent_id')
            ->orderBy('name')
            ->limit(9)
            ->get();
    }

    private function getBestSellers()
    {
        return Book::query()
            ->with([
                'publisher',
                'authors',
                'images',
            ])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->withSum('orderItems', 'quantity')
            ->where('is_active', true)
            ->orderByDesc('order_items_sum_quantity')
            ->limit(5)
            ->get();
    }

    private function getNewReleases()
    {
        return Book::query()
            ->with([
                'publisher',
                'authors',
                'images',
            ])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('is_active', true)
            ->latest('publication_date')
            ->limit(5)
            ->get();
    }

    private function getPromotions()
    {
        return Book::query()
            ->with([
                'publisher',
                'authors',
                'images',
            ])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('is_active', true)
            ->whereNotNull('sale_price')
            ->whereColumn('sale_price', '<', 'price')
            ->orderBy('sale_price')
            ->limit(5)
            ->get();
    }
}
