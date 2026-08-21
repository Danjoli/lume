<?php

namespace Tests\Feature\Webhooks;

use App\Enums\ShipmentStatus;
use App\Models\Shipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class MelhorEnvioWebhookTest extends TestCase
{
    use RefreshDatabase;

    private const SECRET = 'melhor-envio-secret-for-tests-123456';

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('services.melhor_envio.client_secret', self::SECRET);
    }

    public function test_rejects_an_invalid_signature(): void
    {
        $this->postJson(route('webhooks.melhor-envio'), $this->payload(), [
            'X-ME-Signature' => 'invalid-signature',
        ])->assertUnauthorized();
    }

    public function test_updates_a_shipment_from_a_valid_event(): void
    {
        $shipment = Shipment::factory()->create([
            'melhor_envio_order_id' => 'label-123',
            'melhor_envio_protocol' => 'ORD-2026-123',
        ]);

        $payload = $this->payload();

        $this->send($payload)->assertOk()->assertJson(['received' => true]);

        $shipment->refresh();

        $this->assertSame(ShipmentStatus::DELIVERED, $shipment->status);
        $this->assertSame('BR123456789', $shipment->tracking_code);
        $this->assertSame('https://tracking.example/BR123456789', $shipment->tracking_url);
        $this->assertNotNull($shipment->shipped_at);
        $this->assertNotNull($shipment->delivered_at);
        $this->assertCount(1, $shipment->tracking_history);
    }

    public function test_ignores_a_duplicated_event_and_does_not_regress_status(): void
    {
        $shipment = Shipment::factory()->delivered()->create([
            'melhor_envio_order_id' => 'label-123',
            'tracking_history' => [],
        ]);

        $deliveredPayload = $this->payload();
        $this->send($deliveredPayload)->assertOk();
        $this->send($deliveredPayload)->assertOk();

        $oldPayload = $this->payload('order.pending', 'pending');
        $this->send($oldPayload)->assertOk();

        $shipment->refresh();

        $this->assertSame(ShipmentStatus::DELIVERED, $shipment->status);
        $this->assertCount(2, $shipment->tracking_history);
    }

    /**
     * @return array<string, mixed>
     */
    private function payload(string $event = 'order.delivered', string $status = 'delivered'): array
    {
        return [
            'event' => $event,
            'data' => [
                'id' => 'label-123',
                'protocol' => 'ORD-2026-123',
                'status' => $status,
                'tracking' => 'BR123456789',
                'tracking_url' => 'https://tracking.example/BR123456789',
                'posted_at' => '2026-08-20T10:00:00+00:00',
                'delivered_at' => '2026-08-21T10:00:00+00:00',
            ],
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function send(array $payload): TestResponse
    {
        $json = json_encode($payload, JSON_UNESCAPED_SLASHES);
        $signature = base64_encode(hash_hmac('sha256', $json, self::SECRET, true));

        return $this->call('POST', route('webhooks.melhor-envio'), [], [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_X_ME_SIGNATURE' => $signature,
        ], $json);
    }
}
