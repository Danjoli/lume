<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Book;

class BookPolicy
{
    /**
     * Determina se pode visualizar a listagem de livros.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->isSupport()
            || $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode visualizar um livro.
     */
    public function view(Admin $admin, Book $book): bool
    {
        return $admin->isSupport()
            || $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode criar livros.
     */
    public function create(Admin $admin): bool
    {
        return $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode atualizar livros.
     */
    public function update(Admin $admin, Book $book): bool
    {
        return $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se pode excluir livros.
     */
    public function delete(Admin $admin, Book $book): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se pode restaurar livros.
     */
    public function restore(Admin $admin, Book $book): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se pode remover definitivamente um livro.
     */
    public function forceDelete(Admin $admin, Book $book): bool
    {
        return $admin->isSuperAdmin();
    }
}
