<?php

use App\Http\Controllers\Store\Content\NewsletterController;
use Illuminate\Support\Facades\Route;

Route::post('/newsletter', [NewsletterController::class, 'store'])
    ->name('store.newsletter.store');

Route::get('/newsletter/cancelar/{subscriber}', [NewsletterController::class, 'unsubscribe'])
    ->name('store.newsletter.unsubscribe')
    ->middleware('signed');
