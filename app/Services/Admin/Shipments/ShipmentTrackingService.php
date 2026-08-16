<?php

namespace App\Services\Admin\Shipments;

use App\Actions\Shipments\SyncShipmentTrackingAction;
use App\Enums\ShipmentStatus;
use App\Models\Shipment;

class ShipmentTrackingService
{
    public function __construct(
        private readonly SyncShipmentTrackingAction $syncShipmentTrackingAction,
    ) {
    }

    /**
     * Sincroniza o rastreamento do envio.
     */
    public function sync(
        Shipment $shipment
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Futuramente:
        | MelhorEnvioService->tracking($shipment)
        |--------------------------------------------------------------------------
        */

        // Exemplo:
        //
        // $tracking = $this->melhorEnvioService
        //     ->tracking($shipment);
        //
        // $this->updateStatus(
        //     $shipment,
        //     ShipmentStatus::from($tracking['status'])
        // );

    }

    /**
     * Atualiza o status do envio.
     */
    public function updateStatus(
        Shipment $shipment,
        ShipmentStatus $status
    ): Shipment {

        return $this->syncShipmentTrackingAction
            ->execute(
                $shipment,
                $status
            );

    }

    /**
     * Histórico do rastreamento.
     */
    public function history(
        Shipment $shipment
    ): array {

        /*
        |--------------------------------------------------------------------------
        | Futuramente:
        | MelhorEnvioService->history($shipment)
        |--------------------------------------------------------------------------
        */

        return [];

    }

    /**
     * Consulta o rastreamento.
     */
    public function tracking(
        Shipment $shipment
    ): array {

        /*
        |--------------------------------------------------------------------------
        | Futuramente:
        | MelhorEnvioService->tracking($shipment)
        |--------------------------------------------------------------------------
        */

        return [];

    }
}
