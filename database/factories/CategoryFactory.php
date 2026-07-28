<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(
            nb: fake()->numberBetween(1, 3),
            asText: true
        );

        return [
            'name' => ucfirst($name),

            'slug' => Str::slug($name),

            'description' => fake()->paragraph(),

            'parent_id' => null,

            'is_active' => true,
        ];
    }

    /**
     * Marca a categoria como inativa.
     */
    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }

    /**
     * Define uma categoria pai.
     */
    public function childOf(int $parentId): static
    {
        return $this->state(fn () => [
            'parent_id' => $parentId,
        ]);
    }
}
