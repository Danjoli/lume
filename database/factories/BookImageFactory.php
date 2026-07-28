<?php

namespace Database\Factories;

use App\Models\BookImage;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookImage>
 */
class BookImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => Book::factory(),

            'image' => fake()->imageUrl(
                width: 600,
                height: 900,
                category: 'books'
            ),

            'sort_order' => fake()->numberBetween(0, 10),

            'is_primary' => false,
        ];
    }

    /**
     * Define a imagem como principal.
     */
    public function primary(): static
    {
        return $this->state(fn () => [
            'is_primary' => true,
            'sort_order' => 0,
        ]);
    }
}
