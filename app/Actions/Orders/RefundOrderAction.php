<?php

namespace App\Actions\Orders;

use App\Enums\PaymentStatus;
use App\Exceptions\Domain\InvalidOrderStatusException;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class RefundOrderAction
{
    /**
     * Reembolsa um pedido.
     */
    public function execute(
        Order $order
    ): Order {

        return DB::transaction(function () use ($order) {

            if ($order->payment_status !== PaymentStatus::PAID) {

                throw new InvalidOrderStatusException(
                    'Somente pedidos pagos podem ser reembolsados.'
                );

            }

            $order->update([

                'payment_status' => PaymentStatus::REFUNDED,

                'refunded_at' => now(),

            ]);

            return $order->refresh();

        });

    }
}
