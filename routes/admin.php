<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\DynamicResourcePageController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'can:admin'], 'prefix' => 'admin'], function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin');

    // SEASONS 

    Route::get('/seasons', [AdminController::class, 'viewSeasons'])->middleware('can:admin.seasons')->name('admin.seasons');
    Route::get('/seasons/create', [AdminController::class, 'viewSeasonCreate'])->middleware('can:admin.seasons.manage')->name('admin.seasons.create');
    Route::get('/season/{season}', [AdminController::class, 'viewSeason'])->middleware('can:admin.seasons')->name('admin.season.view');

    Route::post('/season/{season}/edit', [SeasonController::class, 'update'])->middleware('can:admin.seasons.manage')->name('admin.season.edit');
    Route::post('/seasons/create', [SeasonController::class, 'create'])->middleware('can:admin.seasons.manage')->name('admin.seasons.create.post');
    Route::delete('/seasons/delete', [SeasonController::class, 'delete'])->middleware('can:admin.seasons.delete')->name('admin.seasons.delete');

    // COMPETITIONS

    Route::get('/competitions', [AdminController::class, 'viewCompetitions'])->name('admin.competitions');
    Route::get('/competition/{competition}', [AdminController::class, 'viewCompetition'])->name('admin.competition.view');

    Route::post('/competition/{competition}/edit', [CompetitionController::class, 'update'])->name('admin.competition.edit');

    // UNIVERSITIES

    Route::get('/universities', [AdminController::class, 'viewUniversities'])->name('admin.universities');
    Route::get('/university/{university}', [AdminController::class, 'viewUniversity'])->name('admin.university.view');

    Route::post('/university/{university}/edit', [UniversityController::class, 'update'])->name('admin.university.edit');

    // USERS

    Route::get('/users', [AdminController::class, 'viewUsers'])->name('admin.users');
    Route::get('/users/create', [AdminController::class, 'viewUserCreate'])->name('admin.users.create');
    Route::post('/users/create', [UserController::class, 'createUser'])->name('admin.users.create.post');

    Route::get('/resources', [AdminController::class, 'viewResources'])->name('admin.resources');
    Route::post('/resources/upload', [DynamicResourcePageController::class, 'adminUpload'])->name('admin.resource.upload');
    Route::delete('/resources/delete', [ResourceController::class, 'delete'])->name('admin.resource.delete');
    Route::post('/resources/section', [DynamicResourcePageController::class, 'createNewSection'])->name('admin.resources.section.create');
    Route::delete('/resources/section', [DynamicResourcePageController::class, 'deleteSection'])->name('admin.resources.section.delete');
    Route::post('/resources/page', [DynamicResourcePageController::class, 'createNewPage'])->name('admin.resources.page.create');
    Route::delete('/resources/page', [DynamicResourcePageController::class, 'deletePage'])->name('admin.resources.page.delete');
    Route::get('/resources/{resourcePage}', [AdminController::class, 'viewResourcePage'])->name('admin.resources.page.view');
});
