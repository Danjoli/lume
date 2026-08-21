<?php

namespace App\Services\Admin\Settings;

use App\Data\Settings\SettingData;
use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SettingService
{
    public function get(): Setting
    {
        return Setting::firstOrCreate(
            [],
            [
                'store_name' => 'Lume',
                'currency' => 'BRL',
                'minimum_order_amount' => 0,
                'low_stock_threshold' => 5,
                'reviews_require_purchase' => true,
                'reviews_auto_approve' => false,
            ]
        );
    }

    public function update(
        Setting $setting,
        SettingData $data,
        ?UploadedFile $logo = null,
        ?UploadedFile $favicon = null,
    ): Setting {
        $setting->update(
            $data->toArray()
        );

        if ($logo) {
            $setting->logo = $this->storeImage(
                $logo,
                $setting->logo,
                'settings/logo'
            );
        }

        if ($favicon) {
            $setting->favicon = $this->storeImage(
                $favicon,
                $setting->favicon,
                'settings/favicon'
            );
        }

        if ($setting->isDirty([
            'logo',
            'favicon',
        ])) {
            $setting->save();
        }

        return $setting->refresh();
    }

    private function storeImage(
        UploadedFile $file,
        ?string $currentPath,
        string $directory
    ): string {
        if ($currentPath) {
            Storage::disk('public')->delete($currentPath);
        }

        return $file->store(
            $directory,
            'public'
        );
    }
}
