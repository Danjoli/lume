<?php

namespace App\Notifications\Orders;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
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
            'type' => 'order_created',

            'title' => 'Novo pedido',

            'message' => sprintf(
                'O pedido #%d foi realizado por %s.',
                $this->order->id,
                $this->order->recipient_name
            ),

            'url' => route(
                'admin.orders.show',
                $this->order
            ),

            'order_id' => $this->order->id,
        ];
    }
}
