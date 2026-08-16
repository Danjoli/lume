<?php

namespace App\Http\Controllers\Admin\Shipments;

use App\Data\Shipments\ShipmentData;
use App\Exceptions\Domain\CannotGenerateLabelException;
use App\Exceptions\Domain\CannotPurchaseShipmentException;
use App\Exceptions\Domain\InvalidShipmentStatusException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Shipments\UpdateShipmentRequest;
use App\Models\Shipment;
use App\Services\Admin\Shipments\ShipmentService;
use App\Services\Admin\Shipments\ShipmentTrackingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShipmentController extends Controller
{
    public function __construct(
        private readonly ShipmentService $shipmentService,
        private readonly ShipmentTrackingService $trackingService,
    ) {
    }

    /**
     * Lista os envios.
     */
    public function index(Request $request): View
    {
        return view('admin.shipments.index', [

            'shipments' => $this->shipmentService
                ->paginate($request),

        ]);
    }

    /**
     * Exibe um envio.
     */
    public function show(
        Shipment $shipment
    ): View {

        return view('admin.shipments.show', [

            'shipment' => $this->shipmentService
                ->find($shipment),

        ]);

    }

    /**
     * Atualiza um envio.
     */
    public function update(
        UpdateShipmentRequest $request,
        Shipment $shipment
    ): RedirectResponse {

        $this->shipmentService->update(

            $shipment,

            ShipmentData::fromRequest($request)

        );

        return back()->with(
            'success',
            'Envio atualizado com sucesso.'
        );

    }

    /**
     * Gera a etiqueta.
     */
    public function generateLabel(
        Shipment $shipment
    ): RedirectResponse {

        try {

            $this->shipmentService
                ->generateLabel($shipment);

            return back()->with(
                'success',
                'Etiqueta gerada com sucesso.'
            );

        } catch (
            CannotGenerateLabelException $exception
        ) {

            return back()->with(
                'error',
                $exception->getMessage()
            );

        }

    }

    /**
     * Compra a etiqueta.
     */
    public function purchaseLabel(
        Shipment $shipment
    ): RedirectResponse {

        try {

            $this->shipmentService
                ->purchaseLabel($shipment);

            return back()->with(
                'success',
                'Etiqueta comprada com sucesso.'
            );

        } catch (
            CannotPurchaseShipmentException |
            InvalidShipmentStatusException $exception
        ) {

            return back()->with(
                'error',
                $exception->getMessage()
            );

        }

    }

    /**
     * Sincroniza o rastreamento.
     */
    public function tracking(
        Shipment $shipment
    ): RedirectResponse {

        $this->trackingService
            ->sync($shipment);

        return back()->with(
            'success',
            'Rastreamento atualizado.'
        );

    }

    /**
     * Cancela o envio.
     */
    public function cancel(
        Shipment $shipment
    ): RedirectResponse {

        try {

            $this->shipmentService
                ->cancel($shipment);

            return back()->with(
                'success',
                'Envio cancelado.'
            );

        } catch (
            InvalidShipmentStatusException $exception
        ) {

            return back()->with(
                'error',
                $exception->getMessage()
            );

        }

    }
}
