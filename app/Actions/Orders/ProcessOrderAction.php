<?php

namespace App\Actions\Orders;

use App\Enums\OrderStatus;
use App\Exceptions\Domain\InvalidOrderStatusException;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ProcessOrderAction
{
    /**
     * Coloca um pedido em processamento.
     */
    public function execute(
        Order $order
    ): Order {

        return DB::transaction(function () use ($order) {

            if ($order->status !== OrderStatus::PENDING) {
                throw new InvalidOrderStatusException(
                    'O pedido não pode ser processado.'
                );
            }

            $order->update([
                'status' => OrderStatus::PROCESSING,
            ]);

            return $order->refresh();
        });
    }
}
