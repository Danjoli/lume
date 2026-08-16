<?php

namespace App\Actions\Users;

use App\Models\User;

class DeleteUserAction
{
    /**
     * Remove um usuário.
     */
    public function execute(User $user): void
    {
        $user->delete();
    }
}
