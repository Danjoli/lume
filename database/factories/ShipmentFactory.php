<?php

namespace Database\Factories;

use App\Enums\ShipmentStatus;
use App\Models\Order;
use App\Models\Shipment;
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

            ...fake()->randomElement([
                ['carrier' => 'Correios', 'service' => '1'],
                ['carrier' => 'Correios', 'service' => '2'],
                ['carrier' => 'Jadlog', 'service' => '3'],
                ['carrier' => 'Jadlog', 'service' => '4'],
            ]),

            'tracking_code' => fake()->optional()->bothify('BR###########'),
            'status' => ShipmentStatus::PENDING,
            'shipping_cost' => fake()->randomFloat(2, 10, 100),
            'delivery_min_days' => fake()->numberBetween(2, 5),
            'delivery_max_days' => fake()->numberBetween(6, 12),
            'shipped_at' => null,
            'delivered_at' => null,
        ];
    }

    public function pending(): static
    {
        return $this->state(fn () => [
            'status' => ShipmentStatus::PENDING,
            'tracking_code' => null,
            'melhor_envio_order_id' => null,
            'melhor_envio_protocol' => null,
            'label_url' => null,
            'tracking_url' => null,
            'tracking_history' => null,
            'shipped_at' => null,
            'delivered_at' => null,
        ]);
    }

    public function preparing(): static
    {
        return $this->state(fn () => [
            'status' => ShipmentStatus::PREPARING,
            'carrier' => 'Melhor Envio',
            'melhor_envio_order_id' => fake()->uuid(),
            'melhor_envio_protocol' => fake()->bothify('ME-########'),
        ]);
    }

    /**
     * Pedido enviado.
     */
    public function shipped(): static
    {
        return $this->state(fn () => [
            'status' => ShipmentStatus::SHIPPED,
            'tracking_code' => fake()->bothify('BR###########'),
            'melhor_envio_order_id' => fake()->uuid(),
            'melhor_envio_protocol' => fake()->bothify('ME-########'),
            'label_url' => 'https://sandbox.melhorenvio.com.br/etiqueta/'.fake()->uuid(),
            'tracking_url' => 'https://sandbox.melhorenvio.com.br/rastreio/'.fake()->bothify('BR###########'),
            'tracking_history' => [
                ['status' => 'posted', 'description' => 'Objeto postado na transportadora.', 'date' => now()->toIso8601String()],
            ],
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
            'tracking_history' => [
                ['status' => 'posted', 'description' => 'Objeto postado na transportadora.', 'date' => now()->subDays(5)->toIso8601String()],
                ['status' => 'delivered', 'description' => 'Entrega realizada ao destinatário.', 'date' => now()->toIso8601String()],
            ],
        ]);
    }

    public function returned(): static
    {
        return $this->delivered()->state(fn () => [
            'status' => ShipmentStatus::RETURNED,
            'tracking_history' => [
                ['status' => 'returned', 'description' => 'Objeto devolvido ao remetente.', 'date' => now()->toIso8601String()],
            ],
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn () => [
            'status' => ShipmentStatus::CANCELLED,
            'tracking_code' => null,
            'shipped_at' => null,
            'delivered_at' => null,
        ]);
    }
}
