<?php

namespace App\Notifications\Shipments;

use App\Models\Shipment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ShipmentFailedNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly Shipment $shipment
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
            'type' => 'shipment_failed',

            'title' => 'Problema no envio',

            'message' => sprintf(
                'O envio do pedido #%d apresentou um problema.',
                $this->shipment->order_id
            ),

            'url' => route(
                'admin.shipments.show',
                $this->shipment
            ),

            'shipment_id' => $this->shipment->id,
        ];
    }
}
