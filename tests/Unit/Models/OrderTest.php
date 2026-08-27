<?php

namespace Tests\Unit\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_pending_paid_order_can_be_processed(): void
    {
        $order = new Order([
            'status' => OrderStatus::PENDING,
            'payment_status' => PaymentStatus::PAID,
        ]);

        $this->assertTrue($order->canBeProcessed());
        $this->assertFalse($order->canBeShipped());
    }

    public function test_delivered_order_cannot_be_cancelled_and_paid_order_can_be_refunded(): void
    {
        $order = new Order([
            'status' => OrderStatus::DELIVERED,
            'payment_status' => PaymentStatus::PAID,
        ]);

        $this->assertFalse($order->canBeCancelled());
        $this->assertTrue($order->canBeRefunded());
    }
}
