<?php

namespace App\Services\Admin;

use App\Data\Profile\ProfileData;
use App\Models\Admin;

class ProfileService
{
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
     * Atualiza o perfil do administrador.
     */
    public function update(
        ProfileData $data
    ): Admin {
        $admin = $this->profile();

        $admin->update(
            $data->toArray()
        );

        return $admin->refresh();
    }
}
