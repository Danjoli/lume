<?php

namespace App\Services\Admin\Reports;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

class DashboardReportService
{
    /**
     * Retorna os indicadores do dashboard.
     *
     * @return array<string, mixed>
     */
    public function getStats(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Cadastros
            |--------------------------------------------------------------------------
            */

            'admins' => Admin::count(),

            'users' => User::count(),

            'authors' => Author::count(),

            'categories' => Category::count(),

            'books' => Book::count(),

            /*
            |--------------------------------------------------------------------------
            | Pedidos
            |--------------------------------------------------------------------------
            */

            'orders' => Order::count(),

            'pending_orders' => Order::where(
                'status',
                'pending'
            )->count(),

            'processing_orders' => Order::where(
                'status',
                'processing'
            )->count(),

            'paid_orders' => Order::where(
                'status',
                'paid'
            )->count(),

            'shipped_orders' => Order::where(
                'status',
                'shipped'
            )->count(),

            'delivered_orders' => Order::where(
                'status',
                'delivered'
            )->count(),

            'cancelled_orders' => Order::where(
                'status',
                'cancelled'
            )->count(),

            /*
            |--------------------------------------------------------------------------
            | Financeiro
            |--------------------------------------------------------------------------
            */

            'revenue' => Order::where(
                'status',
                'paid'
            )->sum('total'),

            'average_ticket' => Order::where(
                'status',
                'paid'
            )->avg('total') ?? 0,

            /*
            |--------------------------------------------------------------------------
            | Estoque
            |--------------------------------------------------------------------------
            */

            'out_of_stock' => Book::where(
                'stock',
                0
            )->count(),

            'low_stock' => Book::where(
                'stock',
                '>',
                0
            )
                ->where(
                    'stock',
                    '<=',
                    5
                )
                ->count(),

        ];
    }
}
