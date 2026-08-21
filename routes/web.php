<?php

use App\Http\Controllers\Webhooks\AsaasWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/webhooks/asaas', AsaasWebhookController::class)
    ->name('webhooks.asaas');

require __DIR__.'/admin/routes.php';

require __DIR__.'/store/routes.php';
