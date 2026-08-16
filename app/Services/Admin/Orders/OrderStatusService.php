<?php

namespace App\Services\Admin\Orders;

use App\Actions\Orders\CancelOrderAction;
use App\Actions\Orders\DeliverOrderAction;
use App\Actions\Orders\MarkOrderPaidAction;
use App\Actions\Orders\ProcessOrderAction;
use App\Actions\Orders\RefundOrderAction;
use App\Actions\Orders\ShipOrderAction;
use App\Models\Order;

class OrderStatusService
{
    public function __construct(
        private readonly MarkOrderPaidAction $markOrderPaidAction,
        private readonly ProcessOrderAction $processOrderAction,
        private readonly ShipOrderAction $shipOrderAction,
        private readonly DeliverOrderAction $deliverOrderAction,
        private readonly CancelOrderAction $cancelOrderAction,
        private readonly RefundOrderAction $refundOrderAction,
    ) {
    }

    /**
     * Marca o pedido como pago.
     */
    public function markAsPaid(
        Order $order
    ): Order {

        return $this->markOrderPaidAction
            ->execute($order);

    }

    /**
     * Coloca o pedido em processamento.
     */
    public function process(
        Order $order
    ): Order {

        return $this->processOrderAction
            ->execute($order);

    }

    /**
     * Marca o pedido como enviado.
     */
    public function ship(
        Order $order
    ): Order {

        return $this->shipOrderAction
            ->execute($order);

    }

    /**
     * Marca o pedido como entregue.
     */
    public function deliver(
        Order $order
    ): Order {

        return $this->deliverOrderAction
            ->execute($order);

    }

    /**
     * Cancela o pedido.
     */
    public function cancel(
        Order $order
    ): Order {

        return $this->cancelOrderAction
            ->execute($order);

    }

    /**
     * Reembolsa o pedido.
     */
    public function refund(
        Order $order
    ): Order {

        return $this->refundOrderAction
            ->execute($order);

    }
}
