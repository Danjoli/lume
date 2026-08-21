<?php

namespace App\Http\Controllers\Store\Customer\Preferences;

use App\Http\Controllers\Controller;
use App\Services\Store\Customer\PreferenceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PreferenceController extends Controller
{
    public function __construct(
        private readonly PreferenceService $preferenceService
    ) {}

    public function index(): View
    {
        return view('store.customer.preferences.index', [
            'newsletterSubscriber' => $this->preferenceService->getNewsletterSubscriber(),
        ]);
    }

    public function updateNewsletter(): RedirectResponse
    {
        $this->preferenceService->toggleNewsletter();

        return back()->with(
            'success',
            'Preferência de newsletter atualizada com sucesso.'
        );
    }
}
