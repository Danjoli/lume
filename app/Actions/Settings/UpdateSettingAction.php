<?php

namespace App\Actions\Settings;

use App\Data\Settings\SettingData;
use App\Models\Setting;

class UpdateSettingAction
{
    /**
     * Atualiza as configurações da loja.
     */
    public function execute(
        Setting $setting,
        SettingData $data
    ): Setting {

        $setting->update(
            $data->toArray()
        );

        return $setting->refresh();

    }
}
