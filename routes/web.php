<?php

use App\Http\Controllers\Webhooks\AsaasWebhookController;
use App\Http\Controllers\Webhooks\MelhorEnvioWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/webhooks/asaas', AsaasWebhookController::class)
    ->name('webhooks.asaas');

Route::post('/webhooks/melhor-envio', MelhorEnvioWebhookController::class)
    ->name('webhooks.melhor-envio');

require __DIR__.'/admin/routes.php';

require __DIR__.'/store/routes.php';
