<?php

namespace App\Actions\Orders;

use App\Enums\OrderStatus;
use App\Exceptions\Domain\InvalidOrderStatusException;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ShipOrderAction
{
    /**
     * Marca um pedido como enviado.
     */
    public function execute(
        Order $order
    ): Order {

        return DB::transaction(function () use ($order) {

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

        });

    }
}
