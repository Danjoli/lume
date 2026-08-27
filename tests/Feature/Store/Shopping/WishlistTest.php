<?php

namespace Tests\Feature\Store\Shopping;

use App\Models\Book;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WishlistTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_customer_can_add_and_remove_a_book_from_their_wishlist(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $this->actingAs($user)
            ->post(route('store.wishlist.store', $book))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('wishlists', [
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);

        $this->delete(route('store.wishlist.destroy', $book))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('wishlists', [
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);
    }

    public function test_adding_the_same_book_to_the_wishlist_is_idempotent(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $this->actingAs($user)->post(route('store.wishlist.store', $book));
        $this->post(route('store.wishlist.store', $book));

        $this->assertSame(1, Wishlist::query()
            ->where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->count());
    }

    public function test_customer_can_only_remove_books_from_their_own_wishlist(): void
    {
        $owner = User::factory()->create();
        $visitor = User::factory()->create();
        $book = Book::factory()->create();

        Wishlist::factory()->create([
            'user_id' => $owner->id,
            'book_id' => $book->id,
        ]);

        $this->actingAs($visitor)
            ->delete(route('store.wishlist.destroy', $book))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('wishlists', [
            'user_id' => $owner->id,
            'book_id' => $book->id,
        ]);
    }

    public function test_wishlist_routes_require_authentication(): void
    {
        $book = Book::factory()->create();

        $this->get(route('store.wishlist.index'))
            ->assertRedirect(route('login'));

        $this->post(route('store.wishlist.store', $book))
            ->assertRedirect(route('login'));
    }
}
