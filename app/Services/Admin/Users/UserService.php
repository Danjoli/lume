<?php

namespace App\Services\Admin\Users;

use App\Data\Users\UserData;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UserService
{
    private const PER_PAGE = 10;

    /**
     * Lista paginada dos usuários.
     */
    public function paginate(
        Request $request
    ): LengthAwarePaginator {
        return User::query()

            ->when(
                $request->filled('search'),
                fn ($query) => $query->where(
                    function ($query) use ($request) {
                        $query
                            ->where(
                                'name',
                                'like',
                                '%'.$request->string('search').'%'
                            )
                            ->orWhere(
                                'email',
                                'like',
                                '%'.$request->string('search').'%'
                            );
                    }
                )
            )

            ->latest()

            ->paginate(self::PER_PAGE)

            ->withQueryString();
    }

    /**
     * Retorna os dados de um usuário.
     */
    public function find(
        User $user
    ): User {
        return $user;
    }

    /**
     * Cadastra um usuário.
     */
    public function store(
        UserData $data
    ): User {
        return User::create(
            $data->toArray()
        );
    }

    /**
     * Atualiza um usuário.
     */
    public function update(
        User $user,
        UserData $data
    ): User {
        $user->update(
            $data->toArray()
        );

        return $user->refresh();
    }

    /**
     * Remove um usuário.
     */
    public function destroy(
        User $user
    ): void {
        $user->delete();
    }

    /**
     * Ativa um usuário.
     */
    public function activate(
        User $user
    ): User {
        $user->update([
            'status' => UserStatus::ACTIVE,
        ]);

        return $user->refresh();
    }

    /**
     * Desativa um usuário.
     */
    public function deactivate(
        User $user
    ): User {
        $user->update([
            'status' => UserStatus::INACTIVE,
        ]);

        return $user->refresh();
    }

    /**
     * Bloqueia um usuário.
     */
    public function block(
        User $user
    ): User {
        $user->update([
            'status' => UserStatus::BLOCKED,
        ]);

        return $user->refresh();
    }
}
