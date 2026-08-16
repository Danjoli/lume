<?php

namespace App\Actions\Shipments;

use App\Enums\ShipmentStatus;
use App\Exceptions\Domain\InvalidShipmentStatusException;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;

class DeliverShipmentAction
{
    /**
     * Marca o envio como entregue.
     */
    public function execute(
        Shipment $shipment
    ): Shipment {

        if ($shipment->status !== ShipmentStatus::SHIPPED) {

            throw new InvalidShipmentStatusException(
                'O envio não pode ser marcado como entregue.'
            );

        }

        return DB::transaction(function () use ($shipment) {

            $shipment->update([

                'status' => ShipmentStatus::DELIVERED,

                'delivered_at' => now(),

            ]);

            return $shipment->refresh();

        });

    }
}
