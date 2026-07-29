<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determina se o usuário pode visualizar a listagem.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determina se o usuário pode visualizar um usuário.
     */
    public function view(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Determina se o usuário pode criar novos usuários.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determina se o usuário pode atualizar um usuário.
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Determina se o usuário pode excluir sua conta.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Determina se o usuário pode restaurar sua conta.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determina se o usuário pode remover definitivamente sua conta.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
