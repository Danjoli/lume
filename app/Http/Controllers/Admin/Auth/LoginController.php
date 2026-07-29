<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Exibe a tela de login do administrador.
     */
    public function create()
    {
        return view('admin.auth.login');
    }


    /**
     * Realiza o login do administrador.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
            ],
        ]);


        if (Auth::guard('admin')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()
                ->route('admin.dashboard');
        }


        return back()
            ->withErrors([
                'email' => 'Credenciais inválidas.',
            ])
            ->onlyInput('email');
    }
}
