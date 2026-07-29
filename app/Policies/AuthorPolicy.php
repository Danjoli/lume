<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Author;

class AuthorPolicy
{
    /**
     * Determina se pode visualizar a listagem de autores.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->isSupport()
            || $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode visualizar um autor.
     */
    public function view(Admin $admin, Author $author): bool
    {
        return $admin->isSupport()
            || $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode criar autores.
     */
    public function create(Admin $admin): bool
    {
        return $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode atualizar autores.
     */
    public function update(Admin $admin, Author $author): bool
    {
        return $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode excluir autores.
     */
    public function delete(Admin $admin, Author $author): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se pode restaurar autores.
     */
    public function restore(Admin $admin, Author $author): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se pode remover definitivamente um autor.
     */
    public function forceDelete(Admin $admin, Author $author): bool
    {
        return $admin->isSuperAdmin();
    }
}
