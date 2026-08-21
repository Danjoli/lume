<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Shipment;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    public function run(): void
    {
        $scenarios = ['pending', 'preparing', 'shipped', 'delivered', 'returned', 'cancelled'];

        $shipments = Shipment::query()
            ->with('order')
            ->oldest()
            ->limit(count($scenarios))
            ->get();

        foreach ($scenarios as $position => $scenario) {
            $shipment = $shipments->get($position);

            if (! $shipment) {
                break;
            }

            $sample = Shipment::factory()
                ->{$scenario}()
                ->make();

            $shipment->update($sample->only([
                'carrier', 'service', 'tracking_code', 'melhor_envio_order_id',
                'melhor_envio_protocol', 'label_url', 'tracking_url', 'status',
                'shipping_cost', 'delivery_min_days', 'delivery_max_days',
                'tracking_history', 'shipped_at', 'delivered_at',
            ]));

            $shipment->order->update($this->orderState($scenario));
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function orderState(string $scenario): array
    {
        return match ($scenario) {
            'pending' => ['status' => OrderStatus::PENDING, 'payment_status' => PaymentStatus::PENDING],
            'shipped' => ['status' => OrderStatus::SHIPPED, 'payment_status' => PaymentStatus::PAID, 'paid_at' => now()],
            'delivered', 'returned' => ['status' => OrderStatus::DELIVERED, 'payment_status' => PaymentStatus::PAID, 'paid_at' => now()],
            'cancelled' => ['status' => OrderStatus::CANCELLED],
            default => ['status' => OrderStatus::PROCESSING, 'payment_status' => PaymentStatus::PAID, 'paid_at' => now()],
        };
    }
}
