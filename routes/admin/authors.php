<?php

use App\Http\Controllers\Admin\Authors\AuthorController;
use Illuminate\Support\Facades\Route;

Route::resource('authors', AuthorController::class);
