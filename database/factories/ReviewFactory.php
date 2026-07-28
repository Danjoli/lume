<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'book_id' => Book::factory(),

            'rating' => fake()->numberBetween(1, 5),

            'comment' => fake()->paragraph(),

            'is_approved' => false,
        ];
    }

    /**
     * Define uma avaliação aprovada.
     */
    public function approved(): static
    {
        return $this->state(fn () => [
            'is_approved' => true,
        ]);
    }

    /**
     * Define uma avaliação positiva.
     */
    public function positive(): static
    {
        return $this->state(fn () => [
            'rating' => fake()->numberBetween(4, 5),
            'is_approved' => true,
        ]);
    }

    /**
     * Define uma avaliação negativa.
     */
    public function negative(): static
    {
        return $this->state(fn () => [
            'rating' => fake()->numberBetween(1, 2),
            'is_approved' => true,
        ]);
    }
}
