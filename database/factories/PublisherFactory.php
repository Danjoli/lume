<?php

namespace Database\Factories;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Publisher>
 */
class PublisherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->company();

        return [
            'name' => $name,

            'slug' => Str::slug($name),

            'description' => fake()->paragraph(),

            'website' => fake()->url(),

            'logo' => fake()->optional()->imageUrl(
                width: 300,
                height: 300,
                category: 'business'
            ),

            'is_active' => true,
        ];
    }

    /**
     * Indica que a editora está inativa.
     */
    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }
}
