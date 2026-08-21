<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        private DashboardService $dashboardService
    ) {}

    public function __invoke()
    {
        return view(
            'admin.dashboard.index',
            $this->dashboardService->getDashboardData()
        );
    }
}
