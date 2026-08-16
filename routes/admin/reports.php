<?php

use App\Http\Controllers\Admin\Reports\ReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('reports')
    ->name('reports.')
    ->group(function () {

        Route::get('/reports', [ReportController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/sales',[ReportController::class, 'sales'])
            ->name('sales');

        Route::get('/orders', [ReportController::class, 'orders'])
            ->name('orders');

        Route::get('/books', [ReportController::class, 'books'])
            ->name('books');

        Route::get('/customers', [ReportController::class, 'customers'])
            ->name('customers');

        Route::get('/finance', [ReportController::class, 'finance'])
            ->name('finance');
    });
