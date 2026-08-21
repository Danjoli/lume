<?php

namespace App\Services\Admin\Orders;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\ShipmentStatus;
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class OrderService
{
    /**
     * Dados da tela de listagem.
     */
    public function getIndexData(Request $request): array
    {
        return [
            'orders' => $this->paginate($request),
            'statuses' => OrderStatus::cases(),
            'paymentStatuses' => PaymentStatus::cases(),
            'shipmentStatuses' => ShipmentStatus::cases(),
        ];
    }

    /**
     * Quantidade de registros por página.
     */
    private const PER_PAGE = 15;

    /**
     * Lista paginada dos pedidos.
     */
    public function paginate(
        Request $request
    ): LengthAwarePaginator {

        return Order::query()

            ->with([
                'user',
            ])

            ->withCount([
                'items',
            ])

            ->when(
                $request->filled('search'),
                function ($query) use ($request) {

                    $query->where(function ($query) use ($request) {
                        $query
                            ->where('id', $request->search)
                            ->orWhere(
                                'recipient_name',
                                'like',
                                '%'.$request->string('search').'%'
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
                $request->filled('payment_status'),
                fn ($query) => $query->where(
                    'payment_status',
                    $request->payment_status
                )
            )

            ->latest()
            ->paginate(self::PER_PAGE)
            ->withQueryString();
    }

    /**
     * Retorna um pedido.
     */
    public function find(
        Order $order
    ): Order {

        return $order->load([
            'user',
            'items.book',
            'shipment',
        ]);
    }
}
