<?php

namespace Database\Factories;

use App\Models\Shipment;
use App\Enums\ShipmentStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shipment>
 */
class ShipmentFactory extends Factory
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

            'carrier' => fake()->randomElement([
                'Correios',
                'Jadlog',
                'Melhor Envio',
            ]),

            'service' => fake()->randomElement([
                'PAC',
                'SEDEX',
                'Express',
                'Standard',
            ]),

            'tracking_code' => fake()->optional()->bothify('BR###########'),
            'status' => ShipmentStatus::PENDING,
            'shipping_cost' => fake()->randomFloat(2, 10, 100),
            'shipped_at' => null,
            'delivered_at' => null,
        ];
    }

    /**
     * Pedido enviado.
     */
    public function shipped(): static
    {
        return $this->state(fn () => [
            'status' => ShipmentStatus::SHIPPED,
            'tracking_code' => fake()->bothify('BR###########'),
            'shipped_at' => now(),
        ]);
    }

    /**
     * Pedido entregue.
     */
    public function delivered(): static
    {
        return $this->state(fn () => [
            'status' => ShipmentStatus::DELIVERED,
            'tracking_code' => fake()->bothify('BR###########'),
            'shipped_at' => now()->subDays(5),
            'delivered_at' => now(),
        ]);
    }
}
