<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Order;
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
        $subtotal = fake()->randomFloat(2, 50, 500);
        $shipping = fake()->randomFloat(2, 10, 80);
        $discount = fake()->randomFloat(2, 0, 50);

        $total = max(
            0,
            $subtotal + $shipping - $discount
        );

        return [
            'user_id' => User::factory(),

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => OrderStatus::PENDING,

            'payment_status' => PaymentStatus::PENDING,

            'payment_method' => fake()->randomElement(
                PaymentMethod::cases()
            ),

            /*
            |--------------------------------------------------------------------------
            | Valores
            |--------------------------------------------------------------------------
            */

            'subtotal' => $subtotal,

            'shipping' => $shipping,

            'discount' => $discount,

            'total' => $total,

            /*
            |--------------------------------------------------------------------------
            | Dados do cliente
            |--------------------------------------------------------------------------
            */

            'cpf' => fake()->numerify('###.###.###-##'),

            /*
            |--------------------------------------------------------------------------
            | Snapshot do endereço
            |--------------------------------------------------------------------------
            */

            'recipient_name' => fake()->name(),

            'phone' => fake()->numerify('(##) 9####-####'),

            'street' => fake()->streetName(),

            'number' => (string) fake()->buildingNumber(),

            'complement' => fake()
                ->optional()
                ->secondaryAddress(),

            'neighborhood' => fake()->citySuffix(),

            'city' => fake()->city(),

            'state' => fake()->stateAbbr(),

            'cep' => fake()->postcode(),

            /*
            |--------------------------------------------------------------------------
            | Gateway de pagamento
            |--------------------------------------------------------------------------
            */

            'gateway' => fake()->randomElement([
                'asaas',
                'mercadopago',
                'stripe',
            ]),

            'gateway_payment_id' => fake()
                ->optional()
                ->uuid(),

            'paid_at' => null,
        ];
    }

    /**
     * Pedido pago e aguardando processamento.
     */
    public function paid(): static
    {
        return $this->state(fn () => [
            'status' => OrderStatus::PROCESSING,

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

            'payment_status' => PaymentStatus::PAID,

            'paid_at' => now(),
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
