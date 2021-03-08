<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cms\AssetController;

Route::get('/', [AssetController::class, 'index']);
Route::get('/about', function() { return "ABOUT"; }); 