<?php

use App\Http\Controllers\Webhooks\AsaasWebhookController;
use App\Http\Controllers\Webhooks\MelhorEnvioWebhookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Webhooks externos
|--------------------------------------------------------------------------
|
| Estes endpoints permanecem no grupo web porque recebem chamadas de
| provedores externos. A validação de assinatura é responsabilidade dos
| respectivos controllers/services; as exceções de CSRF ficam centralizadas
| em bootstrap/app.php.
|
*/

Route::post('/webhooks/asaas', AsaasWebhookController::class)
    ->middleware('throttle:60,1')
    ->name('webhooks.asaas');

Route::post('/webhooks/melhor-envio', MelhorEnvioWebhookController::class)
    ->middleware('throttle:60,1')
    ->name('webhooks.melhor-envio');
