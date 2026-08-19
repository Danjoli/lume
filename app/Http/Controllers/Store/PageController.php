<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('store.pages.about');
    }

    public function contact(): View
    {
        return view('store.pages.contact');
    }

    public function privacy(): View
    {
        return view('store.pages.privacy');
    }

    public function terms(): View
    {
        return view('store.pages.terms');
    }

    public function help(): View
    {
        return view('store.pages.help');
    }

    public function shipping(): View
    {
        return view('store.pages.shipping');
    }

    public function returns(): View
    {
        return view('store.pages.returns');
    }

    public function payments(): View
    {
        return view('store.pages.payments');
    }
}
