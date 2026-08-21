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
        $secrets = array_values(array_filter(
            (array) config('services.melhor_envio.webhook_secrets', []),
            fn ($secret) => is_string($secret) && $secret !== ''
        ));
        abort_if($secrets === [], 503, 'Webhook do Melhor Envio não configurado.');

        $signature = trim((string) $request->header('X-ME-Signature'));
        $signatureIsValid = collect($secrets)->contains(function (string $secret) use ($request, $signature): bool {
            $expectedSignature = base64_encode(
                hash_hmac('sha256', $request->getContent(), $secret, true)
            );

            return $signature !== '' && hash_equals($expectedSignature, $signature);
        });

        abort_unless($signatureIsValid, 401);

        $payload = $request->json()->all();
        abort_unless(is_string($payload['event'] ?? null) && is_array($payload['data'] ?? null), 422);

        $this->webhookService->handle($payload);

        return response()->json(['received' => true]);
    }
}
