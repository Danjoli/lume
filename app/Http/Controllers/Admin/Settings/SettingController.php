<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Data\Settings\SettingData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\UpdateSettingRequest;
use App\Services\Admin\Settings\SettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct(
        private readonly SettingService $settingService,
    ) {
    }

    /**
     * Exibe as configurações da loja.
     */
    public function index(): View
    {
        return view('admin.settings.index', [
            'settings' => $this->settingService->get(),
        ]);
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => $this->settingService->get(),
        ]);
    }

    /**
     * Atualiza as configurações.
     */
    public function update(
        UpdateSettingRequest $request
    ): RedirectResponse {
        $setting = $this->settingService->get();

        $this->settingService->update(
            $setting,
            SettingData::fromRequest($request)
        );

        return redirect()
            ->route('admin.settings.edit')
            ->with(
                'success',
                'Configurações atualizadas com sucesso.'
            );
    }
}
