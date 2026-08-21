<?php

namespace App\Services\Payments;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AsaasWebhookService
{
    /**
     * @param  array<string, mixed>  $payload
     */
    public function handle(array $payload): void
    {
        $payment = is_array($payload['payment'] ?? null) ? $payload['payment'] : [];
        $order = $this->findOrder($payment);

        if (! $order) {
            return;
        }

        DB::transaction(function () use ($order, $payment, $payload): void {
            $event = (string) ($payload['event'] ?? '');
            $updates = ['gateway_status' => $payment['status'] ?? $event];

            if (in_array($event, ['PAYMENT_RECEIVED', 'PAYMENT_CONFIRMED'], true)) {
                $updates['payment_status'] = PaymentStatus::PAID;
                $updates['paid_at'] = $payment['paymentDate'] ?? now();

                if ($order->status === OrderStatus::PENDING) {
                    $updates['status'] = OrderStatus::PROCESSING;
                }
            } elseif (in_array($event, ['PAYMENT_REFUNDED', 'PAYMENT_PARTIALLY_REFUNDED'], true)) {
                $updates['payment_status'] = PaymentStatus::REFUNDED;
            } elseif (in_array($event, ['PAYMENT_DELETED', 'PAYMENT_OVERDUE', 'PAYMENT_REPROVED_BY_RISK_ANALYSIS'], true)) {
                $updates['payment_status'] = PaymentStatus::FAILED;
            }

            $order->update($updates);
        });
    }

    /**
     * @param  array<string, mixed>  $payment
     */
    private function findOrder(array $payment): ?Order
    {
        $order = Order::query()
            ->where('gateway_payment_id', $payment['id'] ?? null)
            ->first();

        if (! $order && isset($payment['externalReference'])) {
            $order = Order::query()->find($payment['externalReference']);
        }

        return $order;
    }
}
