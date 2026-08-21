<?php

namespace App\Http\Controllers\Store\Shopping;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Cart\StoreCartItemRequest;
use App\Http\Requests\Store\Cart\ToggleCartItemRequest;
use App\Http\Requests\Store\Cart\UpdateCartItemRequest;
use App\Models\CartItem;
use App\Services\Store\Shopping\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService
    ) {}

    public function index(): View
    {
        return view('store.cart.index', [
            'cart' => $this->cartService->getCurrentCart(),
        ]);
    }

    public function add(
        StoreCartItemRequest $request
    ): RedirectResponse {
        $this->cartService->add(
            $request->integer('book_id'),
            $request->integer('quantity')
        );

        return back()->with(
            'success',
            'Livro adicionado ao carrinho.'
        );
    }

    public function toggle(
        ToggleCartItemRequest $request
    ): RedirectResponse {
        $added = $this->cartService->toggle(
            $request->integer('book_id')
        );

        return back()->with(
            'success',
            $added
                ? 'Livro adicionado ao carrinho.'
                : 'Livro removido do carrinho.'
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
