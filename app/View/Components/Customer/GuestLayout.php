<?php

namespace App\View\Components\Customer;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    public function render(): View
    {
        return view('layouts.store.guest');
    }
}
