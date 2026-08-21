<?php

namespace Database\Factories;

use App\Enums\AdminRole;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('Lume@2026!Admin'),
            'remember_token' => Str::random(10),
            'role' => fake()->randomElement([
                AdminRole::SUPPORT,
                AdminRole::ADMIN,
                AdminRole::SUPERADMIN,
            ]),
            'is_active' => true,
            'last_login_at' => fake()->optional()->dateTime(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Estados
    |--------------------------------------------------------------------------
    */

    public function superAdmin(): static
    {
        return $this->state(fn () => [
            'role' => AdminRole::SUPERADMIN,
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn () => [
            'role' => AdminRole::ADMIN,
        ]);
    }

    public function support(): static
    {
        return $this->state(fn () => [
            'role' => AdminRole::SUPPORT,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }

    public function deleted(): static
    {
        return $this->state(fn () => [
            'deleted_at' => Carbon::now(),
        ]);
    }
}
