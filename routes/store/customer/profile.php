<?php

use App\Http\Controllers\Store\Customer\Account\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');
