<?php

namespace App\Services\Store\Shipping;

use App\Models\IntegrationCredential;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class MelhorEnvioTokenService
{
    public function connection(): ?IntegrationCredential
    {
        return IntegrationCredential::query()
            ->where('provider', 'melhor_envio')
            ->where('environment', $this->environment())
            ->first();
    }

    public function authorizationUrl(string $state): string
    {
        $this->ensureApplicationCredentials();

        return rtrim((string) config('services.melhor_envio.oauth_url'), '/').'/oauth/authorize?'.http_build_query([
            'client_id' => config('services.melhor_envio.client_id'),
            'redirect_uri' => route('admin.settings.melhor-envio.callback'),
            'response_type' => 'code',
            'state' => $state,
            'scope' => config('services.melhor_envio.scopes'),
        ], '', '&', PHP_QUERY_RFC3986);
    }

    public function exchange(string $code): IntegrationCredential
    {
        $response = $this->oauthClient()->post('/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.melhor_envio.client_id'),
            'client_secret' => config('services.melhor_envio.client_secret'),
            'redirect_uri' => route('admin.settings.melhor-envio.callback'),
            'code' => $code,
        ]);

        return $this->storeResponse($response->throw()->json());
    }

    public function accessToken(): string
    {
        $connection = $this->connection();

        if (! $connection) {
            throw new RuntimeException('Conecte a conta do Melhor Envio em Administração > Configurações.');
        }

        if ($connection->expires_at?->isBefore(now()->addMinutes(5))) {
            $connection = $this->refresh($connection);
        }

        return $connection->access_token;
    }

    public function disconnect(): void
    {
        $this->connection()?->delete();
    }

    private function refresh(IntegrationCredential $connection): IntegrationCredential
    {
        if (! $connection->refresh_token) {
            throw new RuntimeException('A conexão do Melhor Envio expirou. Autorize o aplicativo novamente.');
        }

        $response = $this->oauthClient()->post('/oauth/token', [
            'grant_type' => 'refresh_token',
            'client_id' => config('services.melhor_envio.client_id'),
            'client_secret' => config('services.melhor_envio.client_secret'),
            'refresh_token' => $connection->refresh_token,
        ]);

        return $this->storeResponse($response->throw()->json(), $connection);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function storeResponse(array $payload, ?IntegrationCredential $connection = null): IntegrationCredential
    {
        $accessToken = $payload['access_token'] ?? null;

        if (! is_string($accessToken) || $accessToken === '') {
            throw new RuntimeException('O Melhor Envio não retornou um token de acesso válido.');
        }

        $connection ??= new IntegrationCredential;
        $connection->fill([
            'provider' => 'melhor_envio',
            'environment' => $this->environment(),
            'access_token' => $accessToken,
            'refresh_token' => $payload['refresh_token'] ?? $connection->refresh_token,
            'expires_at' => now()->addSeconds(max(60, (int) ($payload['expires_in'] ?? 2592000))),
        ])->save();

        return $connection->refresh();
    }

    private function oauthClient(): PendingRequest
    {
        $this->ensureApplicationCredentials();

        return Http::baseUrl(rtrim((string) config('services.melhor_envio.oauth_url'), '/'))
            ->asForm()
            ->acceptJson()
            ->withHeaders(['User-Agent' => config('services.melhor_envio.user_agent')])
            ->timeout(30);
    }

    private function ensureApplicationCredentials(): void
    {
        if (! config('services.melhor_envio.client_id') || ! config('services.melhor_envio.client_secret')) {
            throw new RuntimeException('Configure o Client ID e o Client Secret do Melhor Envio no .env.');
        }
    }

    private function environment(): string
    {
        return (string) config('services.melhor_envio.environment', 'sandbox');
    }
}
