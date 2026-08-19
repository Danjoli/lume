<?php

namespace App\Actions\Orders;

use App\Enums\OrderStatus;
use App\Exceptions\Domain\CannotCancelOrderException;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CancelOrderAction
{
    /**
     * Cancela um pedido.
     */
    public function execute(
        Order $order
    ): Order {

        return DB::transaction(function () use ($order) {

            if (in_array($order->status, [
                OrderStatus::DELIVERED,
                OrderStatus::CANCELLED,
            ], true)) {

                throw new CannotCancelOrderException();
            }

            $order->update([
                'status' => OrderStatus::CANCELLED,
                'cancelled_at' => now(),
            ]);

            return $order->refresh();
        });
    }
}
