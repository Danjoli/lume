<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Exceptions\Domain\CannotCancelOrderException;
use App\Exceptions\Domain\InvalidOrderStatusException;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Admin\Orders\OrderService;
use App\Services\Admin\Orders\OrderStatusService;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
        private readonly OrderStatusService $orderStatusService,
    ) {}

    /**
     * Exibe a listagem dos pedidos.
     */
    public function index(Request $request): View
    {
        return view(
            'admin.orders.index',
            $this->orderService->getIndexData($request)
        );
    }

    /**
     * Exibe os detalhes do pedido.
     */
    public function show(Order $order): View
    {
        return view('admin.orders.show', [
            'order' => $this->orderService->find($order),
        ]);
    }

    /**
     * Marca o pedido como pago.
     */
    public function markAsPaid(Order $order): RedirectResponse
    {
        return $this->transition(
            fn () => $this->orderStatusService->markAsPaid($order),
            'Pagamento confirmado com sucesso.',
        );
    }

    /**
     * Coloca o pedido em processamento.
     */
    public function process(Order $order): RedirectResponse
    {
        return $this->transition(
            fn () => $this->orderStatusService->process($order),
            'Pedido colocado em processamento.',
        );
    }

    /**
     * Marca o pedido como enviado.
     */
    public function ship(Order $order): RedirectResponse
    {
        return $this->transition(
            fn () => $this->orderStatusService->ship($order),
            'Pedido enviado com sucesso.',
        );
    }

    /**
     * Marca o pedido como entregue.
     */
    public function deliver(Order $order): RedirectResponse
    {
        return $this->transition(
            fn () => $this->orderStatusService->deliver($order),
            'Pedido entregue com sucesso.',
        );
    }

    /**
     * Cancela o pedido.
     */
    public function cancel(Order $order): RedirectResponse
    {
        return $this->transition(
            fn () => $this->orderStatusService->cancel($order),
            'Pedido cancelado com sucesso.',
        );
    }

    /**
     * Reembolsa o pagamento.
     */
    public function refund(Order $order): RedirectResponse
    {
        return $this->transition(
            fn () => $this->orderStatusService->refund($order),
            'Pagamento reembolsado com sucesso.',
        );
    }

    private function transition(Closure $transition, string $successMessage): RedirectResponse
    {
        try {
            $transition();

            return back()->with('success', $successMessage);
        } catch (CannotCancelOrderException|InvalidOrderStatusException $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
