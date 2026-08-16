<?php

namespace App\Services\Admin\Settings;

use App\Actions\Settings\UpdateSettingAction;
use App\Data\Settings\SettingData;
use App\Models\Setting;

class SettingService
{
    public function __construct(
        private readonly UpdateSettingAction $updateSettingAction,
    ) {
    }

    /**
     * Retorna as configurações da loja.
     */
    public function get(): Setting
    {
        return Setting::firstOrFail();
    }

    /**
     * Atualiza as configurações.
     */
    public function update(Setting $setting, SettingData $data): Setting
    {
        return $this->updateSettingAction
            ->execute(
                $setting,
                $data
            );
    }
}
