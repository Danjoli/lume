<?php

use Illuminate\Support\Facades\Route;

Route::prefix('minha-conta')->name('store.customer.')->group(function () {
    require __DIR__.'/customer/profile.php';
    require __DIR__.'/customer/security.php';
    require __DIR__.'/customer/account.php';
    require __DIR__.'/customer/addresses.php';
    require __DIR__.'/customer/orders.php';
    require __DIR__.'/customer/preferences.php';
});
