<?php

namespace App\Http\Controllers\Store\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Envia uma nova notificação de verificação de e-mail.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(
                route('store.customer.profile.index')
            );
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with(
            'status',
            'verification-link-sent'
        );
    }
}
