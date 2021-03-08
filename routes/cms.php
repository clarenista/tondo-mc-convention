<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cms\AssetController;

Route::get('/', [AssetController::class, 'home']);
Route::get('/assets', [AssetController::class, 'index']);