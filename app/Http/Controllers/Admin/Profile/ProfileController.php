<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Data\Profile\ProfileData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use App\Services\Admin\Profile\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        private readonly ProfileService $profileService,
    ) {
    }

    /**
     * Exibe a página do perfil.
     */
    public function edit(): View
    {
        return view('admin.profile.edit', [

            'admin' => $this->profileService
                ->profile(),

        ]);
    }

    /**
     * Atualiza o perfil.
     */
    public function update(
        UpdateProfileRequest $request
    ): RedirectResponse {

        $this->profileService
            ->update(
                ProfileData::fromRequest($request)
            );

        return redirect()

            ->route('admin.profile.edit')

            ->with(
                'success',
                'Perfil atualizado com sucesso.'
            );

    }
}
