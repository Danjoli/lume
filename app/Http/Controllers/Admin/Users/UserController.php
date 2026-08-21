<?php

namespace App\Http\Controllers\Admin\Users;

use App\Data\Users\UserData;
use App\Exceptions\Domain\CannotDeactivateUserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\User;
use App\Services\Admin\Users\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ) {}

    /**
     * Exibe a listagem dos usuários.
     */
    public function index(Request $request): View
    {
        return view('admin.users.index', [
            'users' => $this->userService->paginate($request),
        ]);
    }

    /**
     * Exibe os detalhes do usuário.
     */
    public function show(User $user): View
    {
        return view('admin.users.show', [
            'user' => $this->userService->find($user),
        ]);
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Atualiza o usuário.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->userService->update(
            $user,
            UserData::fromRequest($request)

        );

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Usuário atualizado com sucesso.'
            );
    }

    /**
     * Remove um usuário.
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->userService->destroy($user);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Usuário excluído com sucesso.'
            );
    }

    /**
     * Ativa um usuário.
     */
    public function activate(User $user): RedirectResponse
    {
        $this->userService->activate($user);

        return back()->with(
            'success',
            'Usuário ativado com sucesso.'
        );
    }

    /**
     * Desativa um usuário.
     */
    public function deactivate(User $user): RedirectResponse
    {
        try {
            $this->userService->deactivate($user);

            return back()->with(
                'success',
                'Usuário desativado com sucesso.'
            );
        } catch (CannotDeactivateUserException $exception) {
            return back()->with(
                'error',
                $exception->getMessage()
            );
        }
    }

    /**
     * Bloqueia um usuário.
     */
    public function block(User $user): RedirectResponse
    {
        $this->userService->block($user);

        return back()->with(
            'success',
            'Usuário bloqueado com sucesso.'
        );
    }
}
