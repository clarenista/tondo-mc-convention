<?php

use App\Http\Controllers\Cms\AssetController;
use App\Http\Controllers\Cms\BannerController;
use App\Http\Controllers\Cms\BoothController;
use App\Http\Controllers\Cms\Sponsor\AssetController as SponsorAssetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::group(['middleware' => ['role:admin']], function () {

// });


// Route::group(['as' => 'cms.', 'middleware' => ['role:sponsor']], function () {

// });

Route::name('cms.')->group(function () {

    Route::view('/booth', 'booth');
    Route::get('/login', [UserController::class, 'loginView'])->name('login');

    Route::get('/logout', [UserController::class, 'logoutUser']);
    Route::post('/login', [UserController::class, 'loginUser']);

    Route::get('/', [HomeController::class, 'index'])->middleware('auth');

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('guests', UserController::class);
        Route::resource('booths', BoothController::class);
    });

    Route::middleware(['role:sponsor'])->group(function () {

        Route::name('sponsor.')->group(function () {
            Route::resource('assets', SponsorAssetController::class);
        });
        Route::resource('banners', BannerController::class);
    });

});
