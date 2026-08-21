<?php

namespace App\Http\Controllers\Store\Shopping;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\Store\Shopping\WishlistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function __construct(
        private readonly WishlistService $wishlistService
    ) {}

    public function index(): View
    {
        return view('store.wishlist.index', [
            'wishlist' => $this->wishlistService->getCurrentWishlist(),
        ]);
    }

    public function store(
        Book $book
    ): RedirectResponse {
        $this->wishlistService->add($book);

        return back()->with(
            'success',
            'Livro adicionado à lista de desejos.'
        );
    }

    public function destroy(
        Book $book
    ): RedirectResponse {
        $this->wishlistService->remove($book);

        return back()->with(
            'success',
            'Livro removido da lista de desejos.'
        );
    }
}
