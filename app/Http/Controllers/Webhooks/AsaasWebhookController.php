<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Services\Payments\AsaasWebhookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AsaasWebhookController extends Controller
{
    public function __construct(private readonly AsaasWebhookService $webhookService) {}

    public function __invoke(Request $request): JsonResponse
    {
        $expected = (string) config('services.asaas.webhook_token');
        $received = (string) $request->header('asaas-access-token');
        abort_if($expected === '' || ! hash_equals($expected, $received), 401);

        $this->webhookService->handle($request->all());

        return response()->json(['received' => true]);
    }
}
