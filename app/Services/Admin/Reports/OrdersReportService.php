<?php

namespace App\Services\Admin\Reports;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Collection;

class OrdersReportService
{
    /**
     * Consulta base dos pedidos.
     */
    private function orders()
    {
        return Order::query();
    }

    /**
     * Total de pedidos.
     */
    public function total(): int
    {
        return $this->orders()->count();
    }

    /**
     * Pedidos pendentes.
     */
    public function pending(): int
    {
        return $this->orders()

            ->where('status', OrderStatus::PENDING)

            ->count();
    }

    /**
     * Pedidos em processamento.
     */
    public function processing(): int
    {
        return $this->orders()

            ->where('status', OrderStatus::PROCESSING)

            ->count();
    }

    /**
     * Pedidos pagos.
     */
    public function paid(): int
    {
        return $this->orders()

            ->where('status', OrderStatus::PAID)

            ->count();
    }

    /**
     * Pedidos enviados.
     */
    public function shipped(): int
    {
        return $this->orders()

            ->where('status', OrderStatus::SHIPPED)

            ->count();
    }

    /**
     * Pedidos entregues.
     */
    public function delivered(): int
    {
        return $this->orders()

            ->where('status', OrderStatus::DELIVERED)

            ->count();
    }

    /**
     * Pedidos cancelados.
     */
    public function cancelled(): int
    {
        return $this->orders()

            ->where('status', OrderStatus::CANCELLED)

            ->count();
    }

    /**
     * Pedidos reembolsados.
     */
    public function refunded(): int
    {
        return $this->orders()

            ->where('status', OrderStatus::REFUNDED)

            ->count();
    }

    /**
     * Pedidos por mês.
     */
    public function ordersByMonth(): Collection
    {
        return $this->orders()

            ->selectRaw('

                YEAR(created_at) as year,

                MONTH(created_at) as month,

                COUNT(*) as total

            ')

            ->groupByRaw('YEAR(created_at), MONTH(created_at)')

            ->orderByRaw('YEAR(created_at), MONTH(created_at)')

            ->get();
    }

    /**
     * Últimos pedidos.
     */
    public function latest(int $limit = 10): Collection
    {
        return $this->orders()

            ->with('user')

            ->latest()

            ->limit($limit)

            ->get();
    }

    /**
     * Resumo geral.
     *
     * @return array<string,mixed>
     */
    public function summary(): array
    {
        return [

            'total' => $this->total(),

            'pending' => $this->pending(),

            'processing' => $this->processing(),

            'paid' => $this->paid(),

            'shipped' => $this->shipped(),

            'delivered' => $this->delivered(),

            'cancelled' => $this->cancelled(),

            'refunded' => $this->refunded(),

            'monthly' => $this->ordersByMonth(),

            'latest' => $this->latest(),

        ];
    }
}
