<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Cart\StoreCartItemRequest;
use App\Http\Requests\Store\Cart\UpdateCartItemRequest;
use App\Models\CartItem;
use App\Services\Store\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService
    ) {
    }

    public function index(): View
    {
        return view('store.cart.index', [
            'cart' => $this->cartService->getCurrentCart(),
        ]);
    }

    public function store(
        StoreCartItemRequest $request
    ): RedirectResponse {
        $this->cartService->add(
            $request->integer('book_id'),
            $request->integer('quantity')
        );

        return redirect()
            ->route('store.cart.index')
            ->with(
                'success',
                'Livro adicionado ao carrinho.'
            );
    }

    public function update(
        UpdateCartItemRequest $request,
        CartItem $cartItem
    ): RedirectResponse {
        $this->cartService->update(
            $cartItem,
            $request->integer('quantity')
        );

        return back()->with(
            'success',
            'Carrinho atualizado.'
        );
    }

    public function destroy(
        CartItem $cartItem
    ): RedirectResponse {
        $this->cartService->remove($cartItem);

        return back()->with(
            'success',
            'Item removido do carrinho.'
        );
    }

    public function clear(): RedirectResponse
    {
        $this->cartService->clear();

        return back()->with(
            'success',
            'Carrinho esvaziado.'
        );
    }
}
