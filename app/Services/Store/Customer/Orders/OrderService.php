<?php

namespace App\Services\Store\Customer\Orders;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    /**
     * Lista os pedidos do cliente autenticado.
     */
    public function paginate(
        int $perPage = 10
    ): LengthAwarePaginator {
        return Order::query()
            ->where('user_id', Auth::id())
            ->with([
                'items.book',
                'shipment',
            ])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Retorna um pedido pertencente ao cliente autenticado.
     */
    public function find(
        Order $order
    ): Order {
        abort_if(
            $order->user_id !== Auth::id(),
            404
        );

        return $order->load([
            'items.book',
            'shipment',
        ]);
    }

    /**
     * Garante que o pedido pertence ao usuário autenticado.
     */
    private function ensureOwnership(
        Order $order
    ): void {
        abort_if(
            $order->user_id !== Auth::id(),
            404
        );
    }
}
