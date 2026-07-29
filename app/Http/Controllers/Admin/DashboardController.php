<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Exibe o dashboard administrativo.
     */
    public function __invoke()
    {
        return view('admin.dashboard');
    }
}
