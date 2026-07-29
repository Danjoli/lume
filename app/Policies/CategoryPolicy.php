<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Category;

class CategoryPolicy
{
    /**
     * Determina se pode visualizar a listagem de categorias.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->isSupport()
            || $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode visualizar uma categoria.
     */
    public function view(Admin $admin, Category $category): bool
    {
        return $admin->isSupport()
            || $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode criar categorias.
     */
    public function create(Admin $admin): bool
    {
        return $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode atualizar categorias.
     */
    public function update(Admin $admin, Category $category): bool
    {
        return $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode excluir categorias.
     */
    public function delete(Admin $admin, Category $category): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se pode restaurar categorias.
     */
    public function restore(Admin $admin, Category $category): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se pode remover definitivamente uma categoria.
     */
    public function forceDelete(Admin $admin, Category $category): bool
    {
        return $admin->isSuperAdmin();
    }
}
