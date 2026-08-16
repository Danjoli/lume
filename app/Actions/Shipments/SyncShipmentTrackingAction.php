<?php

namespace App\Actions\Shipments;

use App\Enums\ShipmentStatus;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;

class SyncShipmentTrackingAction
{
    /**
     * Sincroniza o status do envio.
     */
    public function execute(
        Shipment $shipment,
        ShipmentStatus $status
    ): Shipment {

        return DB::transaction(function () use (
            $shipment,
            $status
        ) {

            $shipment->update([

                'status' => $status,

                'shipped_at' => $status === ShipmentStatus::SHIPPED
                    ? now()
                    : $shipment->shipped_at,

                'delivered_at' => $status === ShipmentStatus::DELIVERED
                    ? now()
                    : $shipment->delivered_at,

            ]);

            return $shipment->refresh();

        });

    }
}
