<?php

namespace App\Services\Admin\Reports;

use App\Enums\OrderStatus;
use App\Models\Order;

class FinanceReportService
{
    /**
     * Consulta base dos pedidos pagos.
     */
    private function paidOrders()
    {
        return Order::query()

            ->where('status', OrderStatus::PAID);
    }

    /**
     * Receita bruta.
     */
    public function grossRevenue(): float
    {
        return (float) $this->paidOrders()

            ->sum('subtotal');
    }

    /**
     * Receita líquida.
     */
    public function netRevenue(): float
    {
        return (float) $this->paidOrders()

            ->sum('total');
    }

    /**
     * Total de descontos.
     */
    public function totalDiscount(): float
    {
        return (float) $this->paidOrders()

            ->sum('discount');
    }

    /**
     * Total arrecadado com fretes.
     */
    public function totalShipping(): float
    {
        return (float) $this->paidOrders()

            ->sum('shipping');
    }

    /**
     * Total de pedidos pagos.
     */
    public function totalOrders(): int
    {
        return $this->paidOrders()

            ->count();
    }

    /**
     * Ticket médio.
     */
    public function averageTicket(): float
    {
        return (float) (

            $this->paidOrders()

                ->avg('total')

            ?? 0

        );
    }

    /**
     * Receita após descontos.
     */
    public function revenueAfterDiscount(): float
    {
        return $this->grossRevenue()

            - $this->totalDiscount();
    }

    /**
     * Resumo financeiro.
     *
     * @return array<string,mixed>
     */
    public function summary(): array
    {
        return [

            'gross_revenue' => $this->grossRevenue(),

            'net_revenue' => $this->netRevenue(),

            'discount' => $this->totalDiscount(),

            'shipping' => $this->totalShipping(),

            'orders' => $this->totalOrders(),

            'average_ticket' => $this->averageTicket(),

            'revenue_after_discount' => $this->revenueAfterDiscount(),

        ];
    }
}
