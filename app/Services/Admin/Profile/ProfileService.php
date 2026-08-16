<?php

namespace App\Services\Admin\Profile;

use App\Actions\Profile\UpdateProfileAction;
use App\Data\Profile\ProfileData;
use App\Models\Admin;

class ProfileService
{
    public function __construct(
        private readonly UpdateProfileAction $updateProfileAction,
    ) {
    }

    /**
     * Retorna o administrador autenticado.
     */
    public function profile(): Admin
    {
        /** @var Admin $admin */
        $admin = auth('admin')->user();

        return $admin;
    }

    /**
     * Atualiza o perfil.
     */
    public function update(
        ProfileData $data
    ): Admin {

        return $this->updateProfileAction
            ->execute(
                $this->profile(),
                $data
            );

    }
}
