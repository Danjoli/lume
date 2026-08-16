<?php

namespace App\Services\Admin\Reports;

class ReportService
{
    public function __construct(
        private readonly DashboardReportService $dashboardReportService,
        private readonly SalesReportService $salesReportService,
        private readonly OrdersReportService $ordersReportService,
        private readonly BooksReportService $booksReportService,
        private readonly CustomersReportService $customersReportService,
        private readonly FinanceReportService $financeReportService,
    ) {
    }

    /**
     * Dashboard de relatórios.
     *
     * @return array<string, mixed>
     */
    public function dashboard(): array
    {
        return $this->dashboardReportService->getStats();
    }

    /**
     * Relatório de vendas.
     *
     * @return array<string, mixed>
     */
    public function sales(): array
    {
        return $this->salesReportService->summary();
    }

    /**
     * Relatório de pedidos.
     *
     * @return array<string, mixed>
     */
    public function orders(): array
    {
        return $this->ordersReportService->summary();
    }

    /**
     * Relatório de livros.
     *
     * @return array<string, mixed>
     */
    public function books(): array
    {
        return $this->booksReportService->summary();
    }

    /**
     * Relatório de clientes.
     *
     * @return array<string, mixed>
     */
    public function customers(): array
    {
        return $this->customersReportService->summary();
    }

    /**
     * Relatório financeiro.
     *
     * @return array<string, mixed>
     */
    public function finance(): array
    {
        return $this->financeReportService->summary();
    }
}
