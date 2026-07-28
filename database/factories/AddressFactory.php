<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
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

            'label' => fake()->randomElement([
                'Casa',
                'Trabalho',
                'Apartamento',
                'Outro',
            ]),

            'recipient_name' => fake()->name(),

            'phone' => fake()->cellphoneNumber(),

            'street' => fake()->streetName(),

            'number' => (string) fake()->buildingNumber(),

            'complement' => fake()->optional()->secondaryAddress(),

            'neighborhood' => fake()->citySuffix(),

            'city' => fake()->city(),

            'state' => fake()->stateAbbr(),

            'cep' => fake()->postcode(),
            
            'is_default' => false,
        ];
    }

    /**
     * Define este endereço como padrão.
     */
    public function default(): static
    {
        return $this->state(fn () => [
            'is_default' => true,
        ]);
    }
}
