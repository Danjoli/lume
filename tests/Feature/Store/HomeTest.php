<?php

namespace Tests\Feature\Store;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_displays_only_active_books_in_its_product_sections(): void
    {
        $activeBook = Book::factory()->create([
            'title' => 'Livro disponível na home',
            'price' => 70,
            'sale_price' => 50,
            'publication_date' => now(),
        ]);
        $inactiveBook = Book::factory()->inactive()->create([
            'title' => 'Livro inativo na home',
            'price' => 70,
            'sale_price' => 50,
            'publication_date' => now()->addDay(),
        ]);

        $this->get(route('store.home'))
            ->assertOk()
            ->assertSee($activeBook->title)
            ->assertDontSee($inactiveBook->title)
            ->assertViewHas('bestSellers', fn (Collection $books) => $books->contains($activeBook))
            ->assertViewHas('newReleases', fn (Collection $books) => $books->contains($activeBook))
            ->assertViewHas('promotions', fn (Collection $books) => $books->contains($activeBook));
    }

    public function test_homepage_only_lists_top_level_categories(): void
    {
        $parentCategory = Category::factory()->create(['name' => 'Categoria principal']);
        $childCategory = Category::factory()->create([
            'name' => 'Categoria filha',
            'parent_id' => $parentCategory->id,
        ]);

        $this->get(route('store.home'))
            ->assertOk()
            ->assertSee($parentCategory->name)
            ->assertDontSee($childCategory->name)
            ->assertViewHas('categories', fn (Collection $categories) => $categories->contains($parentCategory))
            ->assertViewHas('categories', fn (Collection $categories) => ! $categories->contains($childCategory));
    }
}
