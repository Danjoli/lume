<?php

namespace App\Notifications\Orders;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PaymentFailedNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly Order $order
    ) {}

    public function via(object $notifiable): array
    {
        return [
            'database',
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'payment_failed',

            'title' => 'Falha no pagamento',

            'message' => sprintf(
                'O pagamento do pedido #%d não foi aprovado.',
                $this->order->id
            ),

            'url' => route(
                'admin.orders.show',
                $this->order
            ),

            'order_id' => $this->order->id,
        ];
    }
}
