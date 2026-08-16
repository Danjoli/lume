<?php

namespace App\Actions\Profile;

use App\Data\Profile\ProfileData;
use App\Models\Admin;

class UpdateProfileAction
{
    /**
     * Atualiza o perfil do administrador.
     */
    public function execute(
        Admin $admin,
        ProfileData $data
    ): Admin {

        $admin->update(

            $data->toArray()

        );

        return $admin->refresh();

    }
}
