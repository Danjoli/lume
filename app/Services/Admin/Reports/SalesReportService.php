<?php

namespace App\Services\Admin\Reports;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SalesReportService
{
    /**
     * Receita total.
     */
    public function totalRevenue(): float
    {
        return (float) Order::query()

            ->where('status', OrderStatus::PAID)

            ->sum('total');
    }

    /**
     * Quantidade de pedidos pagos.
     */
    public function totalOrders(): int
    {
        return Order::query()

            ->where('status', OrderStatus::PAID)

            ->count();
    }

    /**
     * Ticket médio.
     */
    public function averageTicket(): float
    {
        return (float) (

            Order::query()

                ->where('status', OrderStatus::PAID)

                ->avg('total')

            ?? 0

        );
    }

    /**
     * Valor total de descontos.
     */
    public function totalDiscount(): float
    {
        return (float) Order::query()

            ->where('status', OrderStatus::PAID)

            ->sum('discount');
    }

    /**
     * Valor total do frete.
     */
    public function totalShipping(): float
    {
        return (float) Order::query()

            ->where('status', OrderStatus::PAID)

            ->sum('shipping');
    }

    /**
     * Receita por mês.
     */
    public function revenueByMonth(): Collection
    {
        return Order::query()

            ->selectRaw('

                YEAR(created_at) as year,

                MONTH(created_at) as month,

                SUM(total) as revenue

            ')

            ->where('status', OrderStatus::PAID)

            ->groupByRaw('YEAR(created_at), MONTH(created_at)')

            ->orderByRaw('YEAR(created_at), MONTH(created_at)')

            ->get();
    }

    /**
     * Receita por dia.
     */
    public function revenueByDay(): Collection
    {
        return Order::query()

            ->selectRaw('

                DATE(created_at) as day,

                SUM(total) as revenue

            ')

            ->where('status', OrderStatus::PAID)

            ->groupBy(DB::raw('DATE(created_at)'))

            ->orderBy('day')

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

            'revenue' => $this->totalRevenue(),

            'orders' => $this->totalOrders(),

            'average_ticket' => $this->averageTicket(),

            'discount' => $this->totalDiscount(),

            'shipping' => $this->totalShipping(),

            'monthly' => $this->revenueByMonth(),

            'daily' => $this->revenueByDay(),

        ];
    }
}
