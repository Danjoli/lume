<?php

use App\Http\Controllers\Store\Customer\Account\SecurityController;
use Illuminate\Support\Facades\Route;

Route::get('/seguranca', [SecurityController::class, 'edit'])->name('security.edit');
Route::patch('/seguranca', [SecurityController::class, 'update'])->name('security.update');
