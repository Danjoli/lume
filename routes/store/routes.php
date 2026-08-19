<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Autenticação
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Área pública
|--------------------------------------------------------------------------
*/

require __DIR__ . '/home.php';
require __DIR__ . '/catalog.php';
require __DIR__ . '/categories.php';
require __DIR__ . '/authors.php';
require __DIR__ . '/publishers.php';
require __DIR__ . '/pages.php';

/*
|--------------------------------------------------------------------------
| Área autenticada
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->group(function () {

        require __DIR__ . '/checkout.php';
        require __DIR__ . '/wishlist.php';
        require __DIR__ . '/customer.php';
        require __DIR__ . '/cart.php';
    });
