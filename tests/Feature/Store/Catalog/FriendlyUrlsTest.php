<?php

namespace Tests\Feature\Store\Catalog;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FriendlyUrlsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_catalog_resources_generate_urls_with_slugs(): void
    {
        $book = Book::factory()->create();
        $author = Author::factory()->create();
        $category = Category::factory()->create();
        $publisher = Publisher::factory()->create();

        $this->assertStringEndsWith('/livros/'.$book->slug, route('store.books.show', $book));
        $this->assertStringEndsWith('/autores/'.$author->slug, route('store.authors.show', $author));
        $this->assertStringEndsWith('/categorias/'.$category->slug, route('store.categories.show', $category));
        $this->assertStringEndsWith('/editoras/'.$publisher->slug, route('store.publishers.show', $publisher));
    }

    public function test_book_details_are_resolved_by_slug(): void
    {
        $book = Book::factory()->create(['title' => 'Livro com URL Amigável']);

        $this->get(route('store.books.show', $book))
            ->assertOk()
            ->assertSee($book->title);

        $this->get('/livros/'.$book->id)->assertNotFound();
    }
}
