<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;

class AddressPolicy
{
    /**
     * Determina se o usuário pode visualizar sua lista de endereços.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determina se o usuário pode visualizar um endereço.
     */
    public function view(User $user, Address $address): bool
    {
        return $user->id === $address->user_id;
    }

    /**
     * Determina se o usuário pode criar um endereço.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determina se o usuário pode atualizar um endereço.
     */
    public function update(User $user, Address $address): bool
    {
        return $user->id === $address->user_id;
    }

    /**
     * Determina se o usuário pode excluir um endereço.
     */
    public function delete(User $user, Address $address): bool
    {
        return $user->id === $address->user_id;
    }

    /**
     * Determina se o usuário pode restaurar um endereço.
     */
    public function restore(User $user, Address $address): bool
    {
        return false;
    }

    /**
     * Determina se o usuário pode remover definitivamente um endereço.
     */
    public function forceDelete(User $user, Address $address): bool
    {
        return false;
    }
}
