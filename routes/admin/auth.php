<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest.admin')->group(function () {

    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store');

    Route::get('/esqueci-minha-senha', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/esqueci-minha-senha', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/redefinir-senha/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/redefinir-senha', [NewPasswordController::class, 'store'])->name('password.update');

});

Route::post('/logout', [LogoutController::class, 'store'])
    ->middleware('admin')
    ->name('logout');
