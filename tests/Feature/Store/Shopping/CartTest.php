<?php

namespace Tests\Feature\Store\Shopping;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_customer_can_add_a_book_to_their_cart(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create([
            'price' => 59.90,
            'sale_price' => 49.90,
            'stock' => 5,
        ]);

        $this->actingAs($user)
            ->from(route('store.books.show', $book))
            ->post(route('store.cart.add'), [
                'book_id' => $book->id,
                'quantity' => 2,
            ])
            ->assertRedirect(route('store.books.show', $book))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('carts', ['user_id' => $user->id]);
        $this->assertDatabaseHas('cart_items', [
            'book_id' => $book->id,
            'quantity' => 2,
            'unit_price' => 49.90,
        ]);
    }

    public function test_adding_the_same_book_accumulates_the_quantity_in_one_cart_item(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['stock' => 5]);

        $this->actingAs($user)->post(route('store.cart.add'), [
            'book_id' => $book->id,
            'quantity' => 2,
        ]);

        $this->post(route('store.cart.add'), [
            'book_id' => $book->id,
            'quantity' => 3,
        ])->assertSessionHasNoErrors();

        $cart = Cart::where('user_id', $user->id)->firstOrFail();

        $this->assertSame(1, $cart->items()->count());
        $this->assertSame(5, $cart->items()->firstOrFail()->quantity);
    }

    public function test_cart_rejects_quantities_greater_than_the_available_stock(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['stock' => 2]);

        $this->actingAs($user)
            ->from(route('store.books.show', $book))
            ->post(route('store.cart.add'), [
                'book_id' => $book->id,
                'quantity' => 3,
            ])
            ->assertRedirect(route('store.books.show', $book))
            ->assertSessionHasErrors('quantity');

        $this->assertDatabaseMissing('cart_items', ['book_id' => $book->id]);
    }

    public function test_customer_cannot_update_or_remove_another_customers_cart_item(): void
    {
        $owner = User::factory()->create();
        $visitor = User::factory()->create();
        $cartItem = CartItem::factory()->create([
            'cart_id' => Cart::factory()->for($owner),
            'book_id' => Book::factory()->create(['stock' => 10]),
            'quantity' => 1,
            'unit_price' => 39.90,
        ]);

        $this->actingAs($visitor)
            ->patch(route('store.cart.update', $cartItem), ['quantity' => 2])
            ->assertForbidden();

        $this->delete(route('store.cart.destroy', $cartItem))
            ->assertForbidden();

        $this->assertSame(1, $cartItem->refresh()->quantity);
        $this->assertDatabaseHas('cart_items', ['id' => $cartItem->id]);
    }

    public function test_customer_can_clear_only_their_own_cart(): void
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $cart = Cart::factory()->for($user)->create();
        $anotherCart = Cart::factory()->for($anotherUser)->create();

        CartItem::factory()->for($cart)->create(['unit_price' => 39.90]);
        CartItem::factory()->for($anotherCart)->create(['unit_price' => 49.90]);

        $this->actingAs($user)
            ->delete(route('store.cart.clear'))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertSame(0, $cart->items()->count());
        $this->assertSame(1, $anotherCart->items()->count());
    }
}
