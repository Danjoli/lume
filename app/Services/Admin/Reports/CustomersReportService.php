<?php

namespace App\Services\Admin\Reports;

use App\Models\User;
use Illuminate\Support\Collection;

class CustomersReportService
{
    /**
     * Consulta base dos clientes.
     */
    private function users()
    {
        return User::query();
    }

    /**
     * Total de clientes.
     */
    public function total(): int
    {
        return $this->users()->count();
    }

    /**
     * Clientes ativos.
     */
    public function active(): int
    {
        return $this->users()

            ->where('status', 'active')

            ->count();
    }

    /**
     * Clientes inativos.
     */
    public function inactive(): int
    {
        return $this->users()

            ->where('status', 'inactive')

            ->count();
    }

    /**
     * Novos clientes.
     */
    public function newCustomers(
        int $days = 30
    ): int {

        return $this->users()

            ->where(
                'created_at',
                '>=',
                now()->subDays($days)
            )

            ->count();

    }

    /**
     * Clientes que realizaram pedidos.
     */
    public function customersWithOrders(): int
    {
        return $this->users()

            ->has('orders')

            ->count();
    }

    /**
     * Clientes sem pedidos.
     */
    public function customersWithoutOrders(): int
    {
        return $this->users()

            ->doesntHave('orders')

            ->count();
    }

    /**
     * Maiores compradores.
     */
    public function topCustomers(
        int $limit = 10
    ): Collection {

        return $this->users()

            ->withCount('orders')

            ->orderByDesc('orders_count')

            ->limit($limit)

            ->get();

    }

    /**
     * Clientes com compras recentes.
     */
    public function latestCustomers(
        int $limit = 10
    ): Collection {

        return $this->users()

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

            'active' => $this->active(),

            'inactive' => $this->inactive(),

            'new_customers' => $this->newCustomers(),

            'customers_with_orders' => $this->customersWithOrders(),

            'customers_without_orders' => $this->customersWithoutOrders(),

            'top_customers' => $this->topCustomers(),

            'latest_customers' => $this->latestCustomers(),

        ];
    }
}
