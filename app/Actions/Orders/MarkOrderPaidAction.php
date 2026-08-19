<?php

namespace App\Actions\Orders;

use App\Enums\PaymentStatus;
use App\Exceptions\Domain\InvalidOrderStatusException;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class MarkOrderPaidAction
{
    /**
     * Marca um pedido como pago.
     */
    public function execute(
        Order $order
    ): Order {

        return DB::transaction(function () use ($order) {

            if ($order->payment_status === PaymentStatus::PAID) {
                throw new InvalidOrderStatusException(
                    'O pedido já foi pago.'
                );
            }

            $order->update([
                'payment_status' => PaymentStatus::PAID,
                'paid_at' => now(),
            ]);

            return $order->refresh();
        });
    }
}
