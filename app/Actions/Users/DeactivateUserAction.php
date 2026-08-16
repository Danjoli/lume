<?php

namespace App\Actions\Users;

use App\Enums\UserStatus;
use App\Models\User;

class DeactivateUserAction
{
    public function execute(User $user): User
    {
        $user->update([
            'status' => UserStatus::INACTIVE,
        ]);

        return $user->refresh();
    }
}
