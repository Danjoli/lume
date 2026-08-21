<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class EntryController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        return redirect()->route(
            auth('admin')->check() ? 'admin.dashboard' : 'admin.login'
        );
    }
}
