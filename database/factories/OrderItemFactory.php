<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),

            'book_id' => Book::factory(),

            // Snapshot do livro no momento da compra
            'title' => fake()->sentence(3),

            'price' => fake()->randomFloat(2, 20, 300),

            'quantity' => fake()->numberBetween(1, 5),
        ];
    }

    /**
     * Criar item baseado em um livro existente.
     */
    public function fromBook(Book $book): static
    {
        return $this->state(fn () => [
            'book_id' => $book->id,

            'title' => $book->title,

            'price' => $book->sale_price ?? $book->price,
        ]);
    }
}
