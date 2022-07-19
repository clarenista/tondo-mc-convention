<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\HomeController;

Route::post('login', [HomeController::class, 'login']);
Route::post('/registration', [UserController::class, 'storeRegistration']);
Route::post('password-remind', [HomeController::class, 'passwordRemind']);
Route::post('reset-password/{key}', [HomeController::class, 'resetPassword']);
