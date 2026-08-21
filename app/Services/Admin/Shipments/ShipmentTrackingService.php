<?php

namespace App\Services\Admin\Shipments;

use App\Actions\Shipments\SyncShipmentTrackingAction;
use App\Enums\ShipmentStatus;
use App\Models\Shipment;
use App\Services\Store\Shipping\MelhorEnvioService;

class ShipmentTrackingService
{
    public function __construct(
        private readonly SyncShipmentTrackingAction $syncShipmentTrackingAction,
        private readonly MelhorEnvioService $melhorEnvioService,
    ) {}

    /**
     * Sincroniza o rastreamento do envio.
     */
    public function sync(
        Shipment $shipment
    ): void {

        if (! $shipment->melhor_envio_order_id) {
            return;
        }
        $tracking = $this->melhorEnvioService->tracking($shipment);
        $status = match (strtolower((string) ($tracking['status'] ?? ''))) {
            'posted', 'in_transit' => ShipmentStatus::SHIPPED,
            'delivered' => ShipmentStatus::DELIVERED,
            'returned' => ShipmentStatus::RETURNED,
            'canceled', 'cancelled' => ShipmentStatus::CANCELLED,
            default => $shipment->status,
        };
        $shipment->update([
            'tracking_code' => $tracking['tracking'] ?? $shipment->tracking_code,
            'tracking_url' => $tracking['tracking_url'] ?? $shipment->tracking_url,
            'tracking_history' => is_array($tracking['events'] ?? null) ? $tracking['events'] : [$tracking],
        ]);
        if ($status !== $shipment->status) {
            $this->updateStatus($shipment, $status);
        }

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

        return $shipment->tracking_history ?? [];

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

        return $shipment->melhor_envio_order_id ? $this->melhorEnvioService->tracking($shipment) : [];

    }
}
