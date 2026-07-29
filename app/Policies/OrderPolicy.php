<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Determina se o usuário pode visualizar a listagem de pedidos.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determina se o usuário pode visualizar um pedido.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->id === $order->user_id;
    }

    /**
     * Determina se o usuário pode criar pedidos.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determina se o usuário pode atualizar um pedido.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->id === $order->user_id
            && $order->isPending();
    }

    /**
     * Determina se o usuário pode cancelar um pedido.
     */
    public function delete(User $user, Order $order): bool
    {
        return $user->id === $order->user_id
            && $order->isPending();
    }

    /**
     * Determina se o usuário pode restaurar um pedido.
     */
    public function restore(User $user, Order $order): bool
    {
        return false;
    }

    /**
     * Determina se o usuário pode remover definitivamente um pedido.
     */
    public function forceDelete(User $user, Order $order): bool
    {
        return false;
    }
}
