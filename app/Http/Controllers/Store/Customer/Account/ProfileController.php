<?php

namespace App\Http\Controllers\Store\Customer\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Customer\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Exibe a página principal da conta.
     */
    public function index(Request $request): View
    {
        return view('store.customer.profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Exibe o formulário de edição do perfil.
     */
    public function edit(Request $request): View
    {
        return view('store.customer.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Atualiza os dados do perfil.
     */
    public function update(
        UpdateProfileRequest $request
    ): RedirectResponse {
        $user = $request->user();

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return back()->with(
            'success',
            'Dados pessoais atualizados com sucesso.'
        );
    }
}
