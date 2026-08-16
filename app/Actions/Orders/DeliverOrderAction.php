<?php

namespace App\Actions\Orders;

use App\Enums\OrderStatus;
use App\Exceptions\Domain\InvalidOrderStatusException;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DeliverOrderAction
{
    /**
     * Marca um pedido como entregue.
     */
    public function execute(
        Order $order
    ): Order {

        return DB::transaction(function () use ($order) {

            if ($order->status !== OrderStatus::SHIPPED) {

                throw new InvalidOrderStatusException(
                    'O pedido não pode ser entregue.'
                );

            }

            $order->update([

                'status' => OrderStatus::DELIVERED,

                'delivered_at' => now(),

            ]);

            return $order->refresh();

        });

    }
}
