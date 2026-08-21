<?php

namespace App\Http\Controllers\Store\Shopping;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Payments\OrderPaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Throwable;

class PaymentController extends Controller
{
    public function __construct(private readonly OrderPaymentService $paymentService) {}

    public function show(Order $order): View
    {
        abort_unless($order->user_id === Auth::id(), 403);

        $order = $this->paymentService->ensureCharge($order);

        return view('store.checkout.payment', ['order' => $order->refresh()->load('shipment')]);
    }

    public function retry(Order $order): RedirectResponse
    {
        abort_unless($order->user_id === Auth::id(), 403);

        try {
            $this->paymentService->retry($order);

            return back()->with('success', 'Cobrança gerada com sucesso.');
        } catch (Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
