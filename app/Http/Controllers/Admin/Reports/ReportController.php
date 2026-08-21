<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Services\Admin\Reports\ReportService;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __construct(
        private readonly ReportService $reportService,
    ) {}

    /**
     * Dashboard de relatórios.
     */
    public function dashboard(): View
    {
        return view('admin.reports.dashboard', [

            'stats' => $this->reportService->dashboard(),

        ]);
    }

    /**
     * Relatório de vendas.
     */
    public function sales(): View
    {
        return view('admin.reports.sales', [

            'report' => $this->reportService->sales(),

        ]);
    }

    /**
     * Relatório de pedidos.
     */
    public function orders(): View
    {
        return view('admin.reports.orders', [

            'report' => $this->reportService->orders(),

        ]);
    }

    /**
     * Relatório de livros.
     */
    public function books(): View
    {
        return view('admin.reports.books', [

            'report' => $this->reportService->books(),

        ]);
    }

    /**
     * Relatório de clientes.
     */
    public function customers(): View
    {
        return view('admin.reports.customers', [

            'report' => $this->reportService->customers(),

        ]);
    }

    /**
     * Relatório financeiro.
     */
    public function finance(): View
    {
        return view('admin.reports.finance', [

            'report' => $this->reportService->finance(),

        ]);
    }
}
