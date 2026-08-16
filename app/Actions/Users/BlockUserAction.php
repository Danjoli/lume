<?php

namespace App\Actions\Users;

use App\Enums\UserStatus;
use App\Models\User;

class BlockUserAction
{
    public function execute(User $user): User
    {
        $user->update([
            'status' => UserStatus::BLOCKED,
        ]);

        return $user->refresh();
    }
}
