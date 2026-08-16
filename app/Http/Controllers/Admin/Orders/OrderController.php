<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Exceptions\Domain\CannotCancelOrderException;
use App\Exceptions\Domain\InvalidOrderStatusException;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Admin\Orders\OrderService;
use App\Services\Admin\Orders\OrderStatusService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
        private readonly OrderStatusService $orderStatusService,
    ) {
    }

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
        try {

            $this->orderStatusService->markAsPaid($order);

            return back()->with(
                'success',
                'Pagamento confirmado com sucesso.'
            );

        } catch (InvalidOrderStatusException $exception) {

            return back()->with(
                'error',
                $exception->getMessage()
            );

        }
    }

    /**
     * Coloca o pedido em processamento.
     */
    public function process(Order $order): RedirectResponse
    {
        try {

            $this->orderStatusService->process($order);

            return back()->with(
                'success',
                'Pedido colocado em processamento.'
            );

        } catch (InvalidOrderStatusException $exception) {

            return back()->with(
                'error',
                $exception->getMessage()
            );

        }
    }

    /**
     * Marca o pedido como enviado.
     */
    public function ship(Order $order): RedirectResponse
    {
        try {

            $this->orderStatusService->ship($order);

            return back()->with(
                'success',
                'Pedido enviado com sucesso.'
            );

        } catch (InvalidOrderStatusException $exception) {

            return back()->with(
                'error',
                $exception->getMessage()
            );

        }
    }

    /**
     * Marca o pedido como entregue.
     */
    public function deliver(Order $order): RedirectResponse
    {
        try {

            $this->orderStatusService->deliver($order);

            return back()->with(
                'success',
                'Pedido entregue com sucesso.'
            );

        } catch (InvalidOrderStatusException $exception) {

            return back()->with(
                'error',
                $exception->getMessage()
            );

        }
    }

    /**
     * Cancela o pedido.
     */
    public function cancel(Order $order): RedirectResponse
    {
        try {

            $this->orderStatusService->cancel($order);

            return back()->with(
                'success',
                'Pedido cancelado com sucesso.'
            );

        } catch (
            CannotCancelOrderException |
            InvalidOrderStatusException $exception
        ) {

            return back()->with(
                'error',
                $exception->getMessage()
            );

        }
    }

    /**
     * Reembolsa o pagamento.
     */
    public function refund(Order $order): RedirectResponse
    {
        try {

            $this->orderStatusService->refund($order);

            return back()->with(
                'success',
                'Pagamento reembolsado com sucesso.'
            );

        } catch (InvalidOrderStatusException $exception) {

            return back()->with(
                'error',
                $exception->getMessage()
            );

        }
    }
}
