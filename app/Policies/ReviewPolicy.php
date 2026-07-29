<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Determina se o usuário pode visualizar a listagem.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determina se o usuário pode visualizar uma avaliação.
     */
    public function view(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }

    /**
     * Determina se o usuário pode criar avaliações.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determina se o usuário pode atualizar uma avaliação.
     */
    public function update(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }

    /**
     * Determina se o usuário pode excluir uma avaliação.
     */
    public function delete(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }

    /**
     * Determina se o usuário pode restaurar uma avaliação.
     */
    public function restore(User $user, Review $review): bool
    {
        return false;
    }

    /**
     * Determina se o usuário pode remover definitivamente uma avaliação.
     */
    public function forceDelete(User $user, Review $review): bool
    {
        return false;
    }
}
