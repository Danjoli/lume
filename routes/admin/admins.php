<?php

use App\Http\Controllers\Admin\Admins\AdminController;
use Illuminate\Support\Facades\Route;

Route::resource('admins', AdminController::class);
