<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\DynamicResourcePageController;
use App\Http\Controllers\GlobalNotificationController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SERC\CasualtyController;
use App\Http\Controllers\SERC\CasualtyGroupController;
use App\Http\Controllers\SERC\SERCController;
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
    Route::post('/season/{season}/results', [SeasonController::class, 'resultsHandler'])->middleware('can:admin.seasons.manage')->name('admin.season.results');
    Route::post('/season/{season}/{comp}/results', [SeasonController::class, 'saveSeasonCompetitionResults'])->middleware('can:admin.seasons.manage')->name('admin.season.competition.results');
    Route::post('/seasons/create', [SeasonController::class, 'create'])->middleware('can:admin.seasons.manage')->name('admin.seasons.create.post');
    Route::delete('/seasons/delete', [SeasonController::class, 'delete'])->middleware('can:admin.seasons.delete')->name('admin.seasons.delete');

    // COMPETITIONS

    Route::get('/competitions', [AdminController::class, 'viewCompetitions'])->middleware('can:admin.competitions')->name('admin.competitions');
    Route::get('/competition/{competition}', [AdminController::class, 'viewCompetition'])->middleware('can:admin.competitions')->name('admin.competition.view');

    Route::post('/competition/{competition}/edit', [CompetitionController::class, 'adminUpdate'])->middleware('can:admin.competitions.manage')->name('admin.competition.edit');

    Route::Get('/competition/create/{season}', [AdminController::class, 'viewCompetitionCreate'])->middleware('can:admin.competitions.manage')->name('admin.competition.create');
    Route::post('/competition/create', [CompetitionController::class, 'create'])->middleware('can:admin.competitions.manage')->name('admin.competition.create.post');

    Route::delete('/competitions/delete', [CompetitionController::class, 'delete'])->middleware('can:admin.competitions.delete')->name('admin.competitions.delete');

    // UNIVERSITIES

    Route::get('/universities', [AdminController::class, 'viewUniversities'])->middleware('can:admin.universities')->name('admin.universities');
    Route::get('/universities/create', [AdminController::class, 'viewUniversityCreate'])->middleware('can:admin.universities.manage')->name('admin.universities.create');
    Route::post('/universities/create', [UniversityController::class, 'create'])->middleware('can:admin.universities.manage')->name('admin.universities.create.post');
    Route::get('/university/{university}', [AdminController::class, 'viewUniversity'])->middleware('can:admin.universities')->name('admin.university.view');

    Route::post('/university/{university}/edit', [UniversityController::class, 'update'])->middleware('can:admin.universities.manage')->name('admin.university.edit');
    Route::delete('/university/delete', [UniversityController::class, 'delete'])->middleware('can:admin.universities.delete')->name('admin.universities.delete');



    // USERS

    Route::get('/users', [AdminController::class, 'viewUsers'])->middleware('can:admin.users')->name('admin.users');
    Route::get('/user/{user}', [AdminController::class, 'viewUser'])->middleware('can:admin.users')->name('admin.user');
    Route::get('/users/create', [AdminController::class, 'viewUserCreate'])->middleware('can:admin.users.manage')->name('admin.users.create');
    Route::post('/users/create', [UserController::class, 'createUser'])->middleware('can:admin.users.manage')->name('admin.users.create.post');
    Route::post('/users/edit', [UserController::class, 'editUser'])->middleware('can:admin.users.manage')->name('admin.users.edit');

    Route::get('/resources', [AdminController::class, 'viewResources'])->middleware('can:admin.resources')->name('admin.resources');
    Route::post('/resources/upload', [DynamicResourcePageController::class, 'adminUpload'])->middleware('can:admin.resources.manage')->name('admin.resource.upload');
    Route::delete('/resources/delete', [ResourceController::class, 'delete'])->middleware('can:admin.resources.manage')->name('admin.resource.delete');
    Route::post('/resources/section', [DynamicResourcePageController::class, 'createNewSection'])->middleware('can:admin.resources.manage')->name('admin.resources.section.create');
    Route::delete('/resources/section', [DynamicResourcePageController::class, 'deleteSection'])->middleware('can:admin.resources.manage')->name('admin.resources.section.delete');
    Route::post('/resources/page', [DynamicResourcePageController::class, 'createNewPage'])->middleware('can:admin.resources.manage')->name('admin.resources.page.create');
    Route::delete('/resources/page', [DynamicResourcePageController::class, 'deletePage'])->middleware('can:admin.resources.manage')->name('admin.resources.page.delete');
    Route::get('/resources/{resourcePage}', [AdminController::class, 'viewResourcePage'])->middleware('can:admin.resources')->name('admin.resources.page.view');

    Route::get('/resources/resource/{resource}', [ResourceController::class, 'editResource'])->middleware('can:admin.resources.manage')->name('admin.resources.edit');
    Route::post('/resources/resource/{resource}', [ResourceController::class, 'editResourcePost'])->middleware('can:admin.resources.manage')->name('admin.resources.editPost');
    Route::post('/resources/resource/{resource}/re-upload', [ResourceController::class, 'reupload'])->middleware('can:admin.resources.manage')->name('admin.resource.re-upload');
    Route::post('/resources/resource/{resource}/move', [DynamicResourcePageController::class, 'move'])->middleware('can:admin.resources.manage')->name('admin.resource.move');


    Route::post('/resources/{page}/changeOrder', [DynamicResourcePageController::class, 'changePageOrder'])->name('admin.resources.page.changeOrder');
    Route::post('/resources/section/{section}/changeOrder', [DynamicResourcePageController::class, 'changeSectionOrder'])->name('admin.resources.section.changeOrder');
    Route::post('/resources/resource/{resource}/changeOrder', [DynamicResourcePageController::class, 'changeResourceOrder'])->name('admin.resources.resource.changeOrder');

    Route::post('/global-notifications/banner', [GlobalNotificationController::class, 'updateBannerNotification'])->name('globalnotifs.banner');


    Route::prefix('sercs')->middleware('can:admin.sercs')->group(function () {
        Route::prefix('casualties')->group(function () {

            Route::prefix('groups')->group(function () {
                Route::get('', [CasualtyGroupController::class, 'index'])->name('admin.sercs.casualties.groups');
                Route::get('add', [CasualtyGroupController::class, 'add'])->name('admin.sercs.casualties.groups.add');
                Route::post('add', [CasualtyGroupController::class, 'store'])->name('admin.sercs.casualties.groups.store');
                Route::get('{group}', [CasualtyGroupController::class, 'show'])->name('admin.sercs.casualties.groups.show');
                Route::post('{group}', [CasualtyGroupController::class, 'update'])->name('admin.sercs.casualties.groups.update');
                Route::delete('{group}', [CasualtyGroupController::class, 'delete'])->name('admin.sercs.casualties.groups.delete');
            });

            Route::get('', [CasualtyController::class, 'index'])->name('admin.sercs.casualties');
            Route::get('add', [CasualtyController::class, 'add'])->name('admin.sercs.casualties.add');
            Route::post('add', [CasualtyController::class, 'store'])->name('admin.sercs.casualties.store');
            Route::get('{casualty}', [CasualtyController::class, 'show'])->name('admin.sercs.casualties.show');
            Route::post('{casualty}', [CasualtyController::class, 'update'])->name('admin.sercs.casualties.update');
            Route::delete('{casualty}', [CasualtyController::class, 'delete'])->name('admin.sercs.casualties.delete');

            Route::post('{casualty}/images', [CasualtyController::class, 'addImage'])->name('admin.sercs.casualties.images.add');
            Route::delete('{casualty}/images', [CasualtyController::class, 'deleteImage'])->name('admin.sercs.casualties.images.delete');
        });

        Route::get('', [SERCController::class, 'index'])->name('admin.sercs');
        Route::get('serc-tags', [SERCController::class, 'tags'])->name('admin.sercs.tags');
        Route::get('tags', [SERCController::class, 'listTags'])->name('admin.sercs.tags.list');
        Route::get('tags/{tag}', [SERCController::class, 'getTag'])->name('admin.sercs.tags.get');


        Route::post('tags/{tag}', [SERCController::class, 'updateTag'])->middleware('can:admin.sercs.manage')->name('admin.sercs.tags.update');
        Route::delete('tags/{tag}', [SERCController::class, 'deleteTag'])->middleware('can:admin.sercs.delete')->name('admin.sercs.tags.delete');

        Route::get('add', [SERCController::class, 'add'])->middleware('can:admin.sercs.manage')->name('admin.sercs.add');
        Route::post('add', [SERCController::class, 'store'])->middleware('can:admin.sercs.manage')->name('admin.sercs.store');

        Route::post('resources/{serc}', [SERCController::class, 'deleteResource'])->middleware('can:admin.sercs.delete')->name('admin.sercs.resource.delete');

        Route::get('{serc}', [SERCController::class, 'show'])->name('admin.sercs.show');
        Route::post('{serc}', [SERCController::class, 'update'])->middleware('can:admin.sercs.manage')->name('admin.sercs.update');
        Route::delete('{serc}', [SERCController::class, 'delete'])->middleware('can:admin.sercs.delete')->name('admin.sercs.delete');
    });
});
