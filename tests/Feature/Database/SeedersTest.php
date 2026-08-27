<?php

namespace Tests\Feature\Database;

use App\Models\Book;
use App\Models\CartItem;
use App\Models\User;
use Database\Seeders\CatalogSeeder;
use Database\Seeders\CustomerSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeedersTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_seeder_distributes_books_between_publishers_and_assigns_a_primary_image(): void
    {
        $this->seed(CatalogSeeder::class);

        $books = Book::query()->with('images')->get();

        $this->assertCount(100, $books);
        $this->assertGreaterThan(1, $books->pluck('publisher_id')->unique()->count());
        $this->assertTrue($books->every(
            fn (Book $book) => $book->images->contains('is_primary', true)
        ));
    }

    public function test_customer_seeder_can_be_run_twice_without_duplicate_cart_or_wishlist_records(): void
    {
        $user = User::factory()->create();
        Book::factory()->count(5)->create();

        $this->seed(CustomerSeeder::class);
        $this->seed(CustomerSeeder::class);

        $this->assertSame(1, $user->cart()->count());
        $this->assertSame(
            CartItem::query()->where('cart_id', $user->cart->id)->count(),
            CartItem::query()
                ->where('cart_id', $user->cart->id)
                ->distinct('book_id')
                ->count('book_id'),
        );
        $this->assertSame(
            $user->wishlistBooks()->count(),
            $user->wishlistBooks()->distinct('books.id')->count('books.id'),
        );
    }
}
