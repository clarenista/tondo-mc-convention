<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cms\BannerController;
use App\Http\Controllers\Cms\BoothController;
use App\Http\Controllers\Cms\ChatController;
use App\Http\Controllers\Cms\ContactController;
use App\Http\Controllers\Cms\EventController as CmsEventController;
use App\Http\Controllers\Cms\EventManagementController;
use App\Http\Controllers\Cms\ExternalLinkController;
use App\Http\Controllers\Cms\GuestController;
use App\Http\Controllers\Cms\ProgramController;
use App\Http\Controllers\Cms\QuestionController;
use App\Http\Controllers\Cms\QuestionnaireController;
use App\Http\Controllers\Cms\Sponsor\AssetController as SponsorAssetController;
use App\Http\Controllers\Cms\Sponsor\EventController;
use App\Http\Controllers\Cms\Sponsor\MessageController;
use App\Http\Controllers\Cms\Sponsor\QuestionnaireController as SponsorQuestionnaireController;
use App\Http\Controllers\Cms\Sponsor\VisitorController;
use App\Http\Controllers\Cms\Sponsor\WheelController;
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
        Route::get('sync-users', [UserController::class, 'syncUsers'])->name('syncUsers');
        Route::resource('guests', GuestController::class);
        Route::resource('booths', BoothController::class);
        Route::resource('standees', StandeeController::class);
        Route::resource('questionnaires', QuestionnaireController::class);
        Route::post('booths/{id}/hotspots', [BoothController::class, 'storeHotspot'])->name('hotspotStore');
        Route::post('booths/{id}/destroyHotspot', [BoothController::class, 'destroyHotspot'])->name('hotspotDestroy');
        Route::get('event-management', [EventManagementController::class, 'index'])->name('event-management.index');
        Route::put('events/update', [CmsEventController::class, 'update'])->name('event.update');
        Route::put('events/broadcast', [CmsEventController::class, 'broadcast'])->name('event.broadcast');
        Route::put('programs/update', [ProgramController::class, 'update'])->name('program.update');
        Route::get('/POZXIUQWEIUOASKLJ/DB',  [EventManagementController::class, 'downloadDb']);
    });
    Route::middleware(['role:sponsor'])->group(function () {
        Route::name('sponsor.')->prefix('sponsor')->group(function () {
            Route::resource('assets', SponsorAssetController::class);
            Route::resource('links', ExternalLinkController::class);
            Route::resource('contacts', ContactController::class);
            Route::resource('wheels', WheelController::class);
            Route::name('events.')->prefix('events')->group(function () {
                Route::get('', [EventController::class, 'index'])->name('index');
                Route::get('export/spreadsheet', [EventController::class, 'exportToSpreadsheet'])->name('export.spreadsheet');
            });
            Route::name('messages.')->prefix('messages')->group(function () {
                Route::get('', [MessageController::class, 'index'])->name('index');
                Route::get('export/spreadsheet', [MessageController::class, 'exportToSpreadsheet'])->name('export.spreadsheet');
            });
            Route::name('visitors.')->prefix('visitors')->group(function () {
                Route::get('', [VisitorController::class, 'index'])->name('index');
                Route::get('export/spreadsheet', [VisitorController::class, 'exportToSpreadsheet'])->name('export.spreadsheet');
            });
            Route::name('questionnaires.')->prefix('questionnaires')->group(function () {
                Route::get('', [SponsorQuestionnaireController::class, 'index'])->name('index');
                Route::get('export/spreadsheet', [SponsorQuestionnaireController::class, 'exportToSpreadsheet'])->name('export.spreadsheet');
                Route::post('update/quick/{questionnaire}', [QuestionnaireController::class, 'quickUpdate'])->name('quick.update');
            });

            Route::name('chat.')->prefix('chat')->group(function () {
                Route::get('', [ChatController::class, 'index'])->name('index');
                Route::get('/guest/{guest}', [ChatController::class, 'guest'])->name('guest');

                Route::get('/guest/{guest}/chat', [ChatController::class, 'guestChat'])->name('guest.chat');

                Route::post('/guest/{guest}', [ChatController::class, 'guestMessage'])->name('guest.message');
                // Route::get('export/spreadsheet', [ChatController::class, 'index'])->name('chat.index');
                // Route::post('update/quick/{questionnaire}', [QuestionnaireController::class, 'quickUpdate'])->name('quick.update');
            });
        });
        Route::resource('banners', BannerController::class);
    });
    Route::resource('questions', QuestionController::class);
});
