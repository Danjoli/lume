<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Data\Settings\SettingData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\UpdateSettingRequest;
use App\Services\Admin\Settings\SettingService;
use App\Services\Store\Shipping\MelhorEnvioTokenService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct(
        private readonly SettingService $settingService,
        private readonly MelhorEnvioTokenService $melhorEnvioTokens,
    ) {}

    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => $this->settingService->get(),
            'melhorEnvioConnection' => $this->melhorEnvioTokens->connection(),
        ]);
    }

    public function update(
        UpdateSettingRequest $request
    ): RedirectResponse {
        $setting = $this->settingService->get();

        $this->settingService->update(
            $setting,
            SettingData::fromRequest($request),
            $request->file('logo'),
            $request->file('favicon'),
        );

        return redirect()
            ->route('admin.settings.edit')
            ->with(
                'success',
                'Configurações atualizadas com sucesso.'
            );
    }
}
