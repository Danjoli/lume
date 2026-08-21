<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Wishlist;
use App\Observers\AuthorObserver;
use App\Observers\BookObserver;
use App\Observers\CategoryObserver;
use App\Observers\PublisherObserver;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Password::defaults(fn () => Password::min(12)->mixedCase()->letters()->numbers()->symbols());
        ResetPassword::createUrlUsing(function ($notifiable, string $token) {
            $route = $notifiable instanceof Admin ? 'admin.password.reset' : 'password.reset';

            return url(route($route, ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()], false));
        });

        Book::observe(BookObserver::class);
        Author::observe(AuthorObserver::class);
        Publisher::observe(PublisherObserver::class);
        Category::observe(CategoryObserver::class);

        /*
        |--------------------------------------------------------------------------
        | Estado do carrinho e wishlist nos cards
        |--------------------------------------------------------------------------
        */
        View::composer([
            'components.store.books.card',
            'components.store.books.horizontal-card',
        ], function ($view) {
            $cartBookIds = collect();
            $wishlistBookIds = collect();

            if (Auth::check()) {
                $userId = Auth::id();

                $cart = Cart::with('items:id,cart_id,book_id')
                    ->where('user_id', $userId)
                    ->first();

                if ($cart) {
                    $cartBookIds = $cart->items
                        ->pluck('book_id')
                        ->map(fn ($id) => (int) $id);
                }

                $wishlistBookIds = Wishlist::query()
                    ->where('user_id', $userId)
                    ->pluck('book_id')
                    ->map(fn ($id) => (int) $id);
            }

            $view->with([
                'cartBookIds' => $cartBookIds,
                'wishlistBookIds' => $wishlistBookIds,
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Contador do carrinho no header
        |--------------------------------------------------------------------------
        */
        View::composer('layouts.store._partials.header', function ($view) {
            $cartCount = 0;

            if (Auth::check()) {
                $cartCount = (int) Cart::where('user_id', Auth::id())
                    ->withSum('items', 'quantity')
                    ->value('items_sum_quantity');
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
