<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cms\AssetController;
use App\Http\Controllers\UserController;

Route::get('/login', [UserController::class, 'loginView'])->name('login');
Route::get('/logout', [UserController::class, 'logoutUser']);
Route::post('/login', [UserController::class, 'loginUser']);

Route::middleware('auth')->group(function(){

    Route::get('/', [AssetController::class, 'home']);
    Route::get('/assets', [AssetController::class, 'index']);
    
    Route::get('/assets/banner', [AssetController::class, 'manage_banner']);
    Route::get('/assets/gallery', [AssetController::class, 'manage_gallery']);
});