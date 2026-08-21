<?php

use App\Http\Controllers\Admin\Newsletter\NewsletterCampaignController;
use App\Http\Controllers\Admin\Newsletter\NewsletterSubscriberController;
use Illuminate\Support\Facades\Route;

Route::prefix('newsletter')
    ->name('newsletter.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Newsletter / Inscritos
        |--------------------------------------------------------------------------
        */

        Route::get('/', [
            NewsletterSubscriberController::class,
            'index',
        ])->name('index');

        /*
        |--------------------------------------------------------------------------
        | Campanhas
        |--------------------------------------------------------------------------
        */

        Route::get('/campanhas/nova', [
            NewsletterCampaignController::class,
            'create',
        ])->name('create');

        Route::post('/campanhas', [
            NewsletterCampaignController::class,
            'store',
        ])->name('store');

        Route::get('/campanhas/{campaign}', [
            NewsletterCampaignController::class,
            'show',
        ])->name('show');

        Route::get('/campanhas/{campaign}/editar', [
            NewsletterCampaignController::class,
            'edit',
        ])->name('edit');

        Route::put('/campanhas/{campaign}', [
            NewsletterCampaignController::class,
            'update',
        ])->name('update');

        Route::patch('/campanhas/{campaign}/enviar', [
            NewsletterCampaignController::class,
            'send',
        ])->name('send');
    });
