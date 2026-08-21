<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Services\Store\Shipping\MelhorEnvioTokenService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class MelhorEnvioOAuthController extends Controller
{
    public function __construct(private readonly MelhorEnvioTokenService $tokens) {}

    public function connect(Request $request): RedirectResponse
    {
        $state = Str::random(64);
        $request->session()->put('melhor_envio_oauth_state', $state);

        try {
            return redirect()->away($this->tokens->authorizationUrl($state));
        } catch (Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function callback(Request $request): RedirectResponse
    {
        $expectedState = (string) $request->session()->pull('melhor_envio_oauth_state');
        $state = (string) $request->query('state');

        if ($expectedState === '' || $state === '' || ! hash_equals($expectedState, $state)) {
            return redirect()->route('admin.settings.edit')->with('error', 'Não foi possível validar a autorização do Melhor Envio.');
        }

        $code = (string) $request->query('code');
        if ($code === '') {
            return redirect()->route('admin.settings.edit')->with('error', 'O Melhor Envio não retornou o código de autorização.');
        }

        try {
            $this->tokens->exchange($code);

            return redirect()->route('admin.settings.edit')->with('success', 'Conta do Melhor Envio conectada com sucesso.');
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('admin.settings.edit')->with('error', 'Não foi possível concluir a conexão com o Melhor Envio. Verifique as credenciais e tente novamente.');
        }
    }

    public function disconnect(): RedirectResponse
    {
        $this->tokens->disconnect();

        return redirect()->route('admin.settings.edit')->with('success', 'Conta do Melhor Envio desconectada.');
    }
}
