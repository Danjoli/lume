<?php

namespace App\Services\Admin\Shipments;

use App\Actions\Shipments\CancelShipmentAction;
use App\Actions\Shipments\DeliverShipmentAction;
use App\Actions\Shipments\GenerateLabelAction;
use App\Actions\Shipments\PurchaseLabelAction;
use App\Actions\Shipments\ReturnShipmentAction;
use App\Actions\Shipments\ShipShipmentAction;
use App\Data\Shipments\ShipmentData;
use App\Models\Shipment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ShipmentService
{
    /**
     * Quantidade de registros por página.
     */
    private const PER_PAGE = 15;

    public function __construct(
        private readonly GenerateLabelAction $generateLabelAction,
        private readonly PurchaseLabelAction $purchaseLabelAction,
        private readonly ShipShipmentAction $shipShipmentAction,
        private readonly DeliverShipmentAction $deliverShipmentAction,
        private readonly ReturnShipmentAction $returnShipmentAction,
        private readonly CancelShipmentAction $cancelShipmentAction,
    ) {}

    /**
     * Lista paginada dos envios.
     */
    public function paginate(
        Request $request
    ): LengthAwarePaginator {

        return Shipment::query()

            ->with([
                'order.user',
            ])

            ->when(
                $request->filled('search'),
                function ($query) use ($request) {

                    $query->where(function ($query) use ($request) {

                        $query

                            ->where(
                                'tracking_code',
                                'like',
                                '%'.$request->string('search').'%'
                            )

                            ->orWhere(
                                'carrier',
                                'like',
                                '%'.$request->string('search').'%'
                            )

                            ->orWhere(
                                'service',
                                'like',
                                '%'.$request->string('search').'%'
                            )

                            ->orWhereHas('order', fn ($orderQuery) => $orderQuery
                                ->where('number', 'like', '%'.$request->string('search').'%')
                                ->orWhereHas('user', fn ($userQuery) => $userQuery
                                    ->where('name', 'like', '%'.$request->string('search').'%'))
                            );

                    });

                }
            )

            ->when(
                $request->filled('status'),
                fn ($query) => $query->where(
                    'status',
                    $request->status
                )
            )

            ->when(
                $request->filled('carrier'),
                fn ($query) => $query->where('carrier', $request->string('carrier'))
            )

            ->latest()

            ->paginate(self::PER_PAGE)

            ->withQueryString();

    }

    /**
     * Transportadoras disponíveis nos envios cadastrados.
     *
     * @return Collection<int, string>
     */
    public function carriers(): Collection
    {
        return Shipment::query()
            ->whereNotNull('carrier')
            ->where('carrier', '!=', '')
            ->distinct()
            ->orderBy('carrier')
            ->pluck('carrier');
    }

    /**
     * Retorna um envio.
     */
    public function find(
        Shipment $shipment
    ): Shipment {

        return $shipment->load([

            'order.user',

            'order.items.book',

        ]);

    }

    /**
     * Atualiza um envio.
     */
    public function update(
        Shipment $shipment,
        ShipmentData $data
    ): Shipment {
        $shipment->update(
            $data->toArray()
        );

        return $shipment->refresh();
    }

    /**
     * Gera a etiqueta.
     */
    public function generateLabel(
        Shipment $shipment
    ): Shipment {

        return $this->generateLabelAction
            ->execute($shipment);

    }

    /**
     * Compra a etiqueta.
     */
    public function purchaseLabel(
        Shipment $shipment
    ): Shipment {

        return $this->purchaseLabelAction
            ->execute($shipment);

    }

    /**
     * Marca como enviado.
     */
    public function ship(
        Shipment $shipment
    ): Shipment {

        return $this->shipShipmentAction
            ->execute($shipment);

    }

    /**
     * Marca como entregue.
     */
    public function deliver(
        Shipment $shipment
    ): Shipment {

        return $this->deliverShipmentAction
            ->execute($shipment);

    }

    /**
     * Marca como devolvido.
     */
    public function return(
        Shipment $shipment
    ): Shipment {

        return $this->returnShipmentAction
            ->execute($shipment);

    }

    /**
     * Cancela o envio.
     */
    public function cancel(
        Shipment $shipment
    ): Shipment {

        return $this->cancelShipmentAction
            ->execute($shipment);

    }
}
