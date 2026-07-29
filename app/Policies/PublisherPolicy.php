<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Publisher;

class PublisherPolicy
{
    /**
     * Determina se pode visualizar a listagem de editoras.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->isSupport()
            || $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode visualizar uma editora.
     */
    public function view(Admin $admin, Publisher $publisher): bool
    {
        return $admin->isSupport()
            || $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode criar editoras.
     */
    public function create(Admin $admin): bool
    {
        return $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode atualizar editoras.
     */
    public function update(Admin $admin, Publisher $publisher): bool
    {
        return $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode excluir editoras.
     */
    public function delete(Admin $admin, Publisher $publisher): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se pode restaurar editoras.
     */
    public function restore(Admin $admin, Publisher $publisher): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se pode remover definitivamente uma editora.
     */
    public function forceDelete(Admin $admin, Publisher $publisher): bool
    {
        return $admin->isSuperAdmin();
    }
}
