<?php

use App\Http\Controllers\Admin\Publishers\PublisherController;
use Illuminate\Support\Facades\Route;

Route::resource('publishers', PublisherController::class);
