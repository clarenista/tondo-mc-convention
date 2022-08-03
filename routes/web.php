<?php

use App\Http\Controllers\Api\v1\EventController;
use App\Http\Controllers\FortuneWheelController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function(){
//     return view('layouts.app');
// });

// Route::view('/email-preview', 'email.reminder-1-week');
Route::get('/api/v1/event', [EventController::class, 'get'])->middleware([]);

Route::get('/meeting-hall', function () {
    return view('app.plugins.zoom');
});
Route::get('/pb', function () {
    return view('photobooth');
});

// Route::get('/registration', [AuthController::class, 'guest_registration'])->name('guest_registration');
// Route::post('/registration', [AuthController::class, 'save_guest_registration'])->name('save_guest_registration');
Route::get('/sponsor/{id}/fortune-wheel/token/{token}', [FortuneWheelController::class, 'index']);
Route::get('{any}', function () {
    return view('layouts.app');
})->where('any', '^(?!storage).*$');
