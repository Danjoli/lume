<?php

namespace App\Http\Controllers\Store\Customer\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Customer\Account\DeleteAccountRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Exibe a página de exclusão da conta.
     */
    public function delete(): View
    {
        return view('store.customer.account.delete');
    }

    /**
     * Exclui a conta do usuário autenticado.
     */
    public function destroy(
        DeleteAccountRequest $request
    ): RedirectResponse {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('store.home')
            ->with(
                'success',
                'Sua conta foi excluída com sucesso.'
            );
    }
}
