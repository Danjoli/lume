<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Services\Store\Shipping\MelhorEnvioWebhookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MelhorEnvioWebhookController extends Controller
{
    public function __construct(private readonly MelhorEnvioWebhookService $webhookService) {}

    public function __invoke(Request $request): JsonResponse
    {
        $secret = (string) config('services.melhor_envio.client_secret');
        abort_if($secret === '', 503, 'Webhook do Melhor Envio não configurado.');

        $signature = (string) $request->header('X-ME-Signature');
        $expectedSignature = base64_encode(
            hash_hmac('sha256', $request->getContent(), $secret, true)
        );

        abort_if($signature === '' || ! hash_equals($expectedSignature, $signature), 401);

        $payload = $request->json()->all();
        abort_unless(is_string($payload['event'] ?? null) && is_array($payload['data'] ?? null), 422);

        $this->webhookService->handle($payload);

        return response()->json(['received' => true]);
    }
}
