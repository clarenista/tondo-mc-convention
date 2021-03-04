<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return "API Routes";
});

Route::get('test', function () {
    return "Success!";
});

Route::post('/login', [HomeController::class, 'login']);
Route::middleware('auth:api')->post('/registration', [UserController::class, 'storeRegistration']);
Route::middleware('auth:api')->get('/users', [UserController::class, 'allUsers']);
