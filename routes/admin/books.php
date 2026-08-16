<?php

use App\Http\Controllers\Admin\Books\BookController;
use Illuminate\Support\Facades\Route;

Route::resource('books', BookController::class);
