<?php

namespace App\Actions\Orders;

use App\Enums\PaymentStatus;
use App\Exceptions\Domain\InvalidOrderStatusException;
use App\Models\Order;
use App\Services\Payments\AsaasService;
use Illuminate\Support\Facades\DB;

class RefundOrderAction
{
    public function __construct(private readonly AsaasService $asaas) {}

    /**
     * Reembolsa um pedido.
     */
    public function execute(
        Order $order
    ): Order {

        if ($order->payment_status !== PaymentStatus::PAID) {
            throw new InvalidOrderStatusException(
                'Somente pedidos pagos podem ser reembolsados.'
            );
        }

        if ($order->gateway === 'asaas' && $order->gateway_payment_id) {
            $this->asaas->refund($order);
        }

        return DB::transaction(function () use ($order) {

            $order->update([
                'payment_status' => PaymentStatus::REFUNDED,
                'refunded_at' => now(),
            ]);

            return $order->refresh();
        });
    }
}
