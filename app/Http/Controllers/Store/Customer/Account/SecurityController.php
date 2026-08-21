<?php

namespace App\Http\Controllers\Store\Customer\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Customer\Account\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SecurityController extends Controller
{
    /**
     * Exibe a página de segurança da conta.
     */
    public function edit(): View
    {
        return view('store.customer.security.edit');
    }

    /**
     * Atualiza a senha do usuário.
     */
    public function update(
        UpdatePasswordRequest $request
    ): RedirectResponse {
        $request->user()->update([
            'password' => $request->validated('password'),
        ]);

        return back()->with(
            'success',
            'Senha atualizada com sucesso.'
        );
    }
}
