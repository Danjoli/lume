<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_id' => Cart::factory(),
            'book_id' => Book::factory(),
            'quantity' => fake()->numberBetween(1, 5),
        ];
    }

    /**
     * Define quantidade maior de itens.
     */
    public function multiple(): static
    {
        return $this->state(fn () => [
            'quantity' => fake()->numberBetween(2, 10),
        ]);
    }
}
