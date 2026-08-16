<?php

namespace App\Actions\Users;

use App\Data\Users\UserData;
use App\Models\User;

class CreateUserAction
{
    /**
     * Cria um novo usuário.
     */
    public function execute(
        UserData $data
    ): User {

        return User::create(
            $data->toArray()
        );

    }
}
