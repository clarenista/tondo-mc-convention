<?php

use App\Http\Controllers\cms\AssetController;
use App\Http\Controllers\cms\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [UserController::class, 'loginView'])->name('login');
Route::get('/logout', [UserController::class, 'logoutUser']);
Route::post('/login', [UserController::class, 'loginUser']);

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/register', [UserController::class, 'register']);
    Route::post('/register', [UserController::class, 'storeRegistration']);
    Route::get('/users', [UserController::class, 'index']);
});

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Route::group(['as' => 'cms.', 'middleware' => ['role:sponsor']], function () {
    Route::resource('assets', AssetController::class);
    Route::resource('banner', BannerController::class);

});
