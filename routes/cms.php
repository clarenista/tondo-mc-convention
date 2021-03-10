<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cms\AssetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\cms\BannerController;

Route::get('/login', [UserController::class, 'loginView'])->name('login');
Route::get('/logout', [UserController::class, 'logoutUser']);
Route::post('/login', [UserController::class, 'loginUser']);

Route::middleware('auth')->group(function(){

    Route::get('/', [AssetController::class, 'home']);

    Route::get('/assets', [AssetController::class, 'index']);
    Route::get('/assets/create', [AssetController::class, 'create']);
    Route::post('/assets/store', [AssetController::class, 'store']);
    Route::get('/assets/edit/{id}', [AssetController::class, 'edit']);
    Route::post('/assets/delete/{id}', [AssetController::class, 'destroy']);
    
    // Route::get('/assets/banner', [BannerController::class, 'index']);
    // Route::get('/assets/gallery', [AssetController::class, 'manage_gallery']);
});