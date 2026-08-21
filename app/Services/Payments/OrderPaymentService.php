<?php

namespace App\Services\Payments;

use App\Models\Order;
use Throwable;

class OrderPaymentService
{
    public function __construct(private readonly AsaasService $asaas) {}

    public function ensureCharge(Order $order): Order
    {
        if ($order->gateway_payment_id || ! $order->isPaymentPending()) {
            return $order;
        }

        try {
            return $this->asaas->createCharge($order);
        } catch (Throwable $exception) {
            $this->recordFailure($order, $exception);

            return $order->refresh();
        }
    }

    public function retry(Order $order): Order
    {
        try {
            return $this->asaas->createCharge($order);
        } catch (Throwable $exception) {
            $this->recordFailure($order, $exception);

            throw $exception;
        }
    }

    private function recordFailure(Order $order, Throwable $exception): void
    {
        report($exception);
        $order->update(['gateway_error' => $exception->getMessage()]);
    }
}
