<?php

namespace App\Actions\Users;

use App\Data\Users\UserData;
use App\Models\User;

class UpdateUserAction
{
    /**
     * Atualiza um usuário.
     */
    public function execute(
        User $user,
        UserData $data
    ): User {

        $user->update(
            $data->toArray()
        );

        return $user->refresh();

    }
}
