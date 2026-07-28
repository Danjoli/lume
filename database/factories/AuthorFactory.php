<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->name();

        return [
            'name' => $name,

            'slug' => Str::slug($name),

            'biography' => fake()->paragraphs(3, true),

            'photo' => fake()->optional()->imageUrl(
                width: 400,
                height: 600,
                category: 'people'
            ),

            'is_active' => true,
        ];
    }

    /**
     * Indica que o autor está inativo.
     */
    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }
}
