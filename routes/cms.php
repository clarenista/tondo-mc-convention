<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cms\BannerController;
use App\Http\Controllers\Cms\BoothController;
use App\Http\Controllers\Cms\ContactController;
use App\Http\Controllers\Cms\EventController as CmsEventController;
use App\Http\Controllers\Cms\EventManagementController;
use App\Http\Controllers\Cms\ExternalLinkController;
use App\Http\Controllers\Cms\ProgramController;
use App\Http\Controllers\Cms\QuestionController;
use App\Http\Controllers\Cms\QuestionnaireController;
use App\Http\Controllers\Cms\Sponsor\AssetController as SponsorAssetController;
use App\Http\Controllers\Cms\Sponsor\EventController;
use App\Http\Controllers\Cms\Sponsor\MessageController;
use App\Http\Controllers\Cms\Sponsor\VisitorController;
use App\Http\Controllers\Cms\StandeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => ['role:admin']], function () {

// });

// Route::group(['as' => 'cms.', 'middleware' => ['role:sponsor']], function () {

// });

Route::name('cms.')->group(function () {
    Route::view('/booth', 'booth');
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');

    Route::get('/logout', [AuthController::class, 'logoutUser']);
    Route::post('/login', [AuthController::class, 'loginUser']);

    Route::get('/', [HomeController::class, 'index'])->middleware('auth');

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('guests', UserController::class);
        Route::resource('booths', BoothController::class);
        Route::resource('standees', StandeeController::class);
        Route::resource('questionnaires', QuestionnaireController::class);

        Route::post('booths/{id}/hotspots', [BoothController::class, 'storeHotspot'])->name('hotspotStore');
        Route::post('booths/{id}/destroyHotspot', [BoothController::class, 'destroyHotspot'])->name('hotspotDestroy');

        Route::get('event-management', [EventManagementController::class, 'index'])->name('event-management.index');
        Route::put('events/update', [CmsEventController::class, 'update'])->name('event.update');
        Route::put('events/broadcast', [CmsEventController::class, 'broadcast'])->name('event.broadcast');
        Route::put('programs/update', [ProgramController::class, 'update'])->name('program.update');
    });

    Route::middleware(['role:sponsor'])->group(function () {

        Route::name('sponsor.')->group(function () {
            Route::resource('assets', SponsorAssetController::class);
            Route::resource('links', ExternalLinkController::class);
            Route::resource('contacts', ContactController::class);
            Route::get('events', [EventController::class, 'index'])->name('events.index');
            Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
            Route::get('visitors', [VisitorController::class, 'index'])->name('visitors.index');
            Route::resource('contacts', ContactController::class);
        });
        Route::resource('banners', BannerController::class);
    });

    Route::resource('questions', QuestionController::class);
});
