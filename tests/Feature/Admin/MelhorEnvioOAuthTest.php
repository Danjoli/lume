<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\IntegrationCredential;
use App\Services\Store\Shipping\MelhorEnvioTokenService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class MelhorEnvioOAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('services.melhor_envio.environment', 'sandbox');
        config()->set('services.melhor_envio.oauth_url', 'https://sandbox.melhorenvio.test');
        config()->set('services.melhor_envio.client_id', 'client-id');
        config()->set('services.melhor_envio.client_secret', 'client-secret');
        config()->set('services.melhor_envio.scopes', 'shipping-calculate shipping-generate');
    }

    public function test_admin_can_start_authorization_and_exchange_code_for_encrypted_tokens(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admin')
            ->get(route('admin.settings.melhor-envio.connect'));

        $response->assertRedirectContains('https://sandbox.melhorenvio.test/oauth/authorize');
        $state = session('melhor_envio_oauth_state');

        Http::fake([
            'sandbox.melhorenvio.test/oauth/token' => Http::response([
                'access_token' => 'access-token-value',
                'refresh_token' => 'refresh-token-value',
                'expires_in' => 2592000,
            ]),
        ]);

        $this->withSession(['melhor_envio_oauth_state' => $state])
            ->get(route('admin.settings.melhor-envio.callback', ['code' => 'authorization-code', 'state' => $state]))
            ->assertRedirect(route('admin.settings.edit'))
            ->assertSessionHas('success');

        $connection = IntegrationCredential::firstOrFail();
        $this->assertSame('access-token-value', $connection->access_token);
        $this->assertNotSame('access-token-value', DB::table('integration_credentials')->value('access_token'));
    }

    public function test_expired_access_token_is_refreshed_automatically(): void
    {
        IntegrationCredential::create([
            'provider' => 'melhor_envio',
            'environment' => 'sandbox',
            'access_token' => 'expired-token',
            'refresh_token' => 'valid-refresh-token',
            'expires_at' => now()->subMinute(),
        ]);

        Http::fake([
            'sandbox.melhorenvio.test/oauth/token' => Http::response([
                'access_token' => 'renewed-token',
                'refresh_token' => 'renewed-refresh-token',
                'expires_in' => 2592000,
            ]),
        ]);

        $this->assertSame('renewed-token', app(MelhorEnvioTokenService::class)->accessToken());
        $this->assertSame('renewed-refresh-token', IntegrationCredential::firstOrFail()->refresh_token);
    }

    public function test_smoke_test_command_refuses_to_run_against_production(): void
    {
        config()->set('services.melhor_envio.environment', 'production');

        $this->artisan('melhor-envio:smoke-test')
            ->expectsOutput('Este comando só pode ser executado com MELHOR_ENVIO_ENVIRONMENT=sandbox.')
            ->assertFailed();
    }
}
