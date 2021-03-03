<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return "API Routes";
});

Route::get('test', function () {
    return "Success!";
});

Route::post('/login', [HomeController::class, 'login']);
