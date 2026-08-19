<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookImage>
 */
class BookImageFactory extends Factory
{
    /**
     * Define o estado padrão da factory.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            'books/1984.png',
            'books/dom-casmurro.png',
            'books/habitos-atomicos.png',
            'books/pai-rico-pai-pobre.png',
            'books/pequeno-principe.png',
        ];

        return [
            'book_id' => Book::factory(),

            'image' => fake()->randomElement($images),

            'sort_order' => fake()->numberBetween(1, 10),

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
