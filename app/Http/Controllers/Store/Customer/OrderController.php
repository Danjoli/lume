<?php

namespace App\Http\Controllers\Store\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Store\Customer\OrderService;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService
    ) {
    }

    public function index(): View
    {
        return view('store.customer.orders.index', [
            'orders' => $this->orderService->paginate(),
        ]);
    }

    public function show(
        Order $order
    ): View {
        return view('store.customer.orders.show', [
            'order' => $this->orderService->find($order),
        ]);
    }
}
