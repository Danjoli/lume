<?php

namespace App\Actions\Orders;

use App\Enums\OrderStatus;
use App\Exceptions\Domain\CannotCancelOrderException;
use App\Models\Order;
use App\Services\Payments\AsaasService;
use Illuminate\Support\Facades\DB;

class CancelOrderAction
{
    public function __construct(private readonly AsaasService $asaas) {}

    /**
     * Cancela um pedido.
     */
    public function execute(
        Order $order
    ): Order {

        if (in_array($order->status, [
            OrderStatus::DELIVERED,
            OrderStatus::CANCELLED,
        ], true)) {
            throw new CannotCancelOrderException;
        }

        if ($order->gateway === 'asaas') {
            $this->asaas->cancel($order);
        }

        return DB::transaction(function () use ($order) {

            $order->update([
                'status' => OrderStatus::CANCELLED,
                'cancelled_at' => now(),
            ]);

            return $order->refresh();
        });
    }
}
