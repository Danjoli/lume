<?php

namespace Database\Factories;

use App\Models\Order;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
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

            // Status do pedido
            'status' => OrderStatus::PENDING,

            // Status do pagamento
            'payment_status' => PaymentStatus::PENDING,

            // Valores
            'subtotal' => fake()->randomFloat(2, 50, 500),

            'shipping' => fake()->randomFloat(2, 10, 80),

            'discount' => fake()->randomFloat(2, 0, 50),

            'total' => fake()->randomFloat(2, 60, 600),


            // Snapshot do endereço
            'recipient_name' => fake()->name(),

            'phone' => fake()->numerify('(##) 9####-####'),

            'street' => fake()->streetName(),

            'number' => (string) fake()->buildingNumber(),

            'complement' => fake()->optional()->secondaryAddress(),

            'neighborhood' => fake()->citySuffix(),

            'city' => fake()->city(),

            'state' => fake()->stateAbbr(),

            'cep' => fake()->postcode(),


            // Gateway de pagamento
            'gateway' => fake()->randomElement([
                'asaas',
                'mercadopago',
                'stripe',
            ]),

            'gateway_payment_id' => fake()->optional()->uuid(),

            'paid_at' => null,
        ];
    }

    /**
     * Pedido pago.
     */
    public function paid(): static
    {
        return $this->state(fn () => [
            'status' => OrderStatus::PAID,

            'payment_status' => PaymentStatus::PAID,

            'paid_at' => now(),
        ]);
    }


    /**
     * Pedido enviado.
     */
    public function shipped(): static
    {
        return $this->state(fn () => [
            'status' => OrderStatus::SHIPPED,
        ]);
    }


    /**
     * Pedido entregue.
     */
    public function delivered(): static
    {
        return $this->state(fn () => [
            'status' => OrderStatus::DELIVERED,

            'payment_status' => PaymentStatus::PAID,

            'paid_at' => now(),
        ]);
    }


    /**
     * Pedido cancelado.
     */
    public function cancelled(): static
    {
        return $this->state(fn () => [
            'status' => OrderStatus::CANCELLED,
        ]);
    }
}
