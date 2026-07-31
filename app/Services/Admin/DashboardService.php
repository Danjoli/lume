<?php

namespace App\Services\Admin;

use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    public function getDashboardData(): array
    {
        return [
            'stats' => $this->getStats(),
            'ordersChart' => $this->getOrdersChart(),
            'ordersStatus' => $this->getOrdersStatus(),
            'recentOrders' => $this->getRecentOrders(),
            'bestSellingBooks' => $this->getBestSellingBooks(),
        ];
    }

    private function getStats(): array
    {
        return [
            'books' => Book::query()->count(),
            'booksThisMonth' => $this->countThisMonth(Book::class),

            'orders' => Order::query()->count(),
            'ordersThisMonth' => $this->countThisMonth(Order::class),

            'users' => User::query()->count(),
            'usersThisMonth' => $this->countThisMonth(User::class),

            'revenue' => Order::query()
                ->where('status', 'paid')
                ->sum('total'),

            'revenueChange' => $this->formatChange(
                $this->calculateRevenueChange()
            ),
        ];
    }

    private function getOrdersChart(): array
    {
        $chart = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::today()->subDays($i);

            $chart[] = [
                'label' => $date->format('d/m'),

                'value' => Order::query()
                    ->whereDate('created_at', $date)
                    ->count(),
            ];
        }

        return $chart;
    }

    private function getOrdersStatus(): array
    {
        $statuses = [

            [
                'label' => 'Pendentes',
                'status' => 'pending',
                'color' => '#FBBF24',
                'tailwind' => 'bg-yellow-400',
            ],

            [
                'label' => 'Pagos',
                'status' => 'paid',
                'color' => '#3B82F6',
                'tailwind' => 'bg-blue-500',
            ],

            [
                'label' => 'Enviados',
                'status' => 'shipped',
                'color' => '#22C55E',
                'tailwind' => 'bg-green-500',
            ],

            [
                'label' => 'Cancelados',
                'status' => 'cancelled',
                'color' => '#EF4444',
                'tailwind' => 'bg-red-500',
            ],

        ];

        return collect($statuses)
            ->map(function ($item) {

                $item['value'] = Order::query()
                    ->where('status', $item['status'])
                    ->count();

                unset($item['status']);

                return $item;
            })
            ->toArray();
    }

    private function getRecentOrders(): Collection
    {
        return Order::query()
            ->with('user')
            ->latest()
            ->take(5)
            ->get();
    }

    private function getBestSellingBooks(): Collection
    {
        return Book::query()
            ->with([
                'authors',
                'images',
            ])
            ->withSum('orderItems', 'quantity')
            ->orderByDesc('order_items_sum_quantity')
            ->take(5)
            ->get()
            ->each(function ($book) {
                $book->sales = $book->order_items_sum_quantity ?? 0;
            });
    }

    /**
     * Quantidade de registros criados no mês atual.
     */
    private function countThisMonth(string $model): int
    {
        return $model::query()
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();
    }

    /**
     * Calcula o crescimento percentual do faturamento
     * comparando o mês atual com o mês anterior.
     */
    private function calculateRevenueChange(): float
    {
        $now = Carbon::now();

        $currentRevenue = Order::query()
            ->where('status', 'paid')
            ->whereBetween('created_at', [
                $now->copy()->startOfMonth(),
                $now->copy()->endOfMonth(),
            ])
            ->sum('total');

        $lastRevenue = Order::query()
            ->where('status', 'paid')
            ->whereBetween('created_at', [
                $now->copy()->subMonth()->startOfMonth(),
                $now->copy()->subMonth()->endOfMonth(),
            ])
            ->sum('total');

        if ($lastRevenue == 0) {
            return $currentRevenue > 0 ? 100.0 : 0.0;
        }

        return round(
            (($currentRevenue - $lastRevenue) / $lastRevenue) * 100,
            1
        );
    }

    /**
     * Define se o crescimento foi positivo ou negativo.
     */
    private function formatChange(float $value): array
    {
        return [
            'value' => $value,
            'type' => $value >= 0 ? 'positive' : 'negative',
        ];
    }
}
