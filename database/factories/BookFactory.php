<?php

namespace Database\Factories;

use App\Enums\BookFormat;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(fake()->numberBetween(2, 5));

        $price = fake()->randomFloat(2, 30, 300);

        $salePrice = fake()->boolean(40)
            ? fake()->randomFloat(2, 20, $price)
            : null;

        return [
            // Informações básicas
            'title' => rtrim($title, '.'),
            'slug' => Str::slug($title),
            'isbn' => fake()->unique()->isbn13(),

            // Conteúdo
            'description' => fake()->paragraph(),
            'synopsis' => fake()->paragraphs(4, true),

            // Preços
            'price' => $price,
            'sale_price' => $salePrice,

            // Estoque
            'stock' => fake()->numberBetween(0, 150),

            // Informações do livro
            'pages' => fake()->numberBetween(80, 1200),
            'language' => 'Português',
            'edition' => fake()->numberBetween(1, 10).'ª edição',
            'format' => fake()->randomElement(BookFormat::cases()),
            'publication_date' => fake()->date(),

            // Frete
            'weight' => fake()->randomFloat(3, 0.100, 2.500),
            'height' => fake()->randomFloat(2, 18, 30),
            'width' => fake()->randomFloat(2, 12, 22),
            'length' => fake()->randomFloat(2, 1, 8),

            // Relacionamentos
            'publisher_id' => Publisher::factory(),

            // Status
            'is_featured' => fake()->boolean(20),
            'is_active' => true,
        ];
    }

    /**
     * Livro em destaque.
     */
    public function featured(): static
    {
        return $this->state(fn () => [
            'is_featured' => true,
        ]);
    }

    /**
     * Livro sem estoque.
     */
    public function outOfStock(): static
    {
        return $this->state(fn () => [
            'stock' => 0,
        ]);
    }

    /**
     * Livro inativo.
     */
    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }
}
