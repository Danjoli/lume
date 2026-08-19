<?php

namespace App\Actions\Orders;

use App\Enums\OrderStatus;
use App\Exceptions\Domain\InvalidOrderStatusException;
use App\Models\Order;

class ShipOrderAction
{
    public function execute(
        Order $order
    ): Order {
        if ($order->status !== OrderStatus::PROCESSING) {
            throw new InvalidOrderStatusException(
                'O pedido não pode ser enviado.'
            );
        }

        $order->update([
            'status' => OrderStatus::SHIPPED,
            'shipped_at' => now(),
        ]);

        return $order->refresh();
    }
}
