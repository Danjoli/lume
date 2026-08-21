<?php

use App\Http\Controllers\Store\Content\ContactController;
use App\Http\Controllers\Store\Content\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/sobre-a-lume', [PageController::class, 'about'])
    ->name('store.pages.about');

Route::get('/contato', [PageController::class, 'contact'])
    ->name('store.pages.contact');

Route::get('/politica-de-privacidade', [PageController::class, 'privacy'])
    ->name('store.pages.privacy');

Route::get('/termos-de-uso', [PageController::class, 'terms'])
    ->name('store.pages.terms');

Route::get('/ajuda', [PageController::class, 'help'])
    ->name('store.pages.help');

Route::get('/entregas', [PageController::class, 'shipping'])
    ->name('store.pages.shipping');

Route::get('/trocas-e-devolucoes', [PageController::class, 'returns'])
    ->name('store.pages.returns');

Route::get('/formas-de-pagamento', [PageController::class, 'payments'])
    ->name('store.pages.payments');

Route::post('/contato', [ContactController::class, 'store'])
    ->name('store.pages.contact.store');
