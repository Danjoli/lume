<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Checkout\StoreCheckoutRequest;
use App\Models\Order;
use App\Services\Store\CheckoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly CheckoutService $checkoutService
    ) {
    }

    /**
     * Exibe o checkout.
     */
    public function index(): View
    {
        return view(
            'store.checkout.index',
            $this->checkoutService->getCheckoutData()
        );
    }

    /**
     * Finaliza o checkout e cria o pedido.
     */
    public function store(
        StoreCheckoutRequest $request
    ): RedirectResponse {
        $order = $this->checkoutService->checkout(
            $request->validated()
        );

        return redirect()
            ->route('store.checkout.success', $order);
    }

    /**
     * Página exibida após criação do pedido.
     */
    public function success(
        Order $order
    ): View {
        abort_unless(
            $order->user_id === Auth::id(),
            403
        );

        return view('store.checkout.success', [
            'order' => $order->load([
                'items.book',
            ]),
        ]);
    }
}
