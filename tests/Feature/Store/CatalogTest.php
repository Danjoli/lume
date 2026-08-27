<?php

namespace Tests\Feature\Store;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_hides_inactive_books_and_filters_by_search_term(): void
    {
        $matchingBook = Book::factory()->create(['title' => 'Laravel para Livrarias']);
        $otherBook = Book::factory()->create(['title' => 'Outro título']);
        $inactiveBook = Book::factory()->inactive()->create(['title' => 'Livro indisponível']);

        $this->get(route('store.catalog.index', ['search' => 'Laravel']))
            ->assertOk()
            ->assertSee($matchingBook->title)
            ->assertDontSee($otherBook->title)
            ->assertDontSee($inactiveBook->title);
    }

    public function test_catalog_filters_books_by_category_and_author(): void
    {
        $category = Category::factory()->create();
        $author = Author::factory()->create(['name' => 'Autora da Lume']);
        $matchingBook = Book::factory()->create(['title' => 'Livro selecionado']);
        $matchingBook->categories()->attach($category);
        $matchingBook->authors()->attach($author);
        $otherBook = Book::factory()->create(['title' => 'Livro fora do filtro']);

        $this->get(route('store.catalog.index', [
            'category' => $category->id,
            'author' => $author->id,
        ]))
            ->assertOk()
            ->assertSee($matchingBook->title)
            ->assertDontSee($otherBook->title);
    }

    public function test_catalog_can_limit_results_to_books_in_stock_and_on_sale(): void
    {
        $matchingBook = Book::factory()->create([
            'title' => 'Livro em promoção',
            'price' => 80,
            'sale_price' => 60,
            'stock' => 2,
        ]);
        $fullPriceBook = Book::factory()->create(['title' => 'Livro sem desconto', 'stock' => 2]);
        $outOfStockBook = Book::factory()->create([
            'title' => 'Livro sem estoque',
            'price' => 80,
            'sale_price' => 60,
            'stock' => 0,
        ]);

        $this->get(route('store.catalog.index', [
            'in_stock' => 1,
            'promotion' => 1,
        ]))
            ->assertOk()
            ->assertSee($matchingBook->title)
            ->assertDontSee($fullPriceBook->title)
            ->assertDontSee($outOfStockBook->title);
    }
}
