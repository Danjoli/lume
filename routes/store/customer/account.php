<?php

use App\Http\Controllers\Store\Customer\Account\AccountController;
use Illuminate\Support\Facades\Route;

Route::get('/excluir-conta', [AccountController::class, 'delete'])->name('account.delete');
Route::delete('/excluir-conta', [AccountController::class, 'destroy'])->name('account.destroy');
