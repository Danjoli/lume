<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Exibe a tela de login do administrador.
     */
    public function create()
    {
        return view('admin.auth.login');
    }

    /**
     * Realiza o login do administrador.
     */
    public function store(Request $request)
    {
        $key = Str::lower((string) $request->input('email')).'|'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages(['email' => 'Muitas tentativas. Tente novamente em '.RateLimiter::availableIn($key).' segundos.']);
        }
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
            ],
        ], [
            'email.required' => 'Informe seu e-mail administrativo.',
            'email.email' => 'Informe um endereço de e-mail válido.',
            'password.required' => 'Informe sua senha.',
        ]);

        if (Auth::guard('admin')->attempt([...$credentials, 'is_active' => true])) {

            RateLimiter::clear($key);

            $request->session()->regenerate();

            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login administrativo realizado com sucesso.');
        }

        RateLimiter::hit($key, 60);

        return back()
            ->withErrors([
                'email' => 'E-mail ou senha incorretos, ou esta conta administrativa está inativa.',
            ])
            ->onlyInput('email');
    }
}
