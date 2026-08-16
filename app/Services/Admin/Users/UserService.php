<?php

namespace App\Services\Admin\Users;

use App\Actions\Users\ActivateUserAction;
use App\Actions\Users\BlockUserAction;
use App\Actions\Users\CreateUserAction;
use App\Actions\Users\DeactivateUserAction;
use App\Actions\Users\DeleteUserAction;
use App\Actions\Users\UpdateUserAction;
use App\Data\Users\UserData;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UserService
{
    private const PER_PAGE = 10;

    public function __construct(
        private readonly CreateUserAction $createUserAction,
        private readonly UpdateUserAction $updateUserAction,
        private readonly DeleteUserAction $deleteUserAction,
        private readonly ActivateUserAction $activateUserAction,
        private readonly DeactivateUserAction $deactivateUserAction,
        private readonly BlockUserAction $blockUserAction,
    ) {
    }

    /**
     * Lista paginada dos usuários.
     */
    public function paginate(Request $request): LengthAwarePaginator
    {
        return User::query()

            ->when(
                $request->filled('search'),
                fn ($query) => $query->where(function ($query) use ($request) {
                    $query
                        ->where(
                            'name',
                            'like',
                            '%' . $request->string('search') . '%'
                        )
                        ->orWhere(
                            'email',
                            'like',
                            '%' . $request->string('search') . '%'
                        );
                })
            )

            ->latest()

            ->paginate(self::PER_PAGE)

            ->withQueryString();
    }

    /**
     * Retorna os dados de um usuário.
     */
    public function find(User $user): User
    {
        return $user;
    }

    /**
     * Cadastra um usuário.
     */
    public function store(UserData $data): User
    {
        return $this->createUserAction->execute($data);
    }

    /**
     * Atualiza um usuário.
     */
    public function update(User $user, UserData $data): User
    {
        return $this->updateUserAction->execute($user, $data);
    }

    /**
     * Remove um usuário.
     */
    public function destroy(User $user): void
    {
        $this->deleteUserAction
            ->execute($user);
    }

    /**
     * Ativa um usuário.
     */
    public function activate(User $user): User
    {
        return $this->activateUserAction->execute($user);
    }

    /**
     * Desativa um usuário.
     */
    public function deactivate(User $user): User
    {
        return $this->deactivateUserAction->execute($user);
    }

    /**
     * Bloqueia um usuário.
     */
    public function block(User $user): User
    {
        return $this->blockUserAction->execute($user);
    }
}
