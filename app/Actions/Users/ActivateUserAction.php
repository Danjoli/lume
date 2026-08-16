<?php

namespace App\Actions\Users;

use App\Enums\UserStatus;
use App\Models\User;

class ActivateUserAction
{
    public function execute(User $user): User
    {
        $user->update([
            'status' => UserStatus::ACTIVE,
        ]);

        return $user->refresh();
    }
}
