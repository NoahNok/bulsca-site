<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'bpadmin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('season', 'LeagueCrudController');
    Route::crud('university', 'UniversityCrudController');
    Route::crud('league-competition', 'CompetitionCrudController');
    Route::crud('season-uni', 'SeasonUniCrudController');
    Route::crud('competition-uni-place', 'CompetitionUniPlaceCrudController');
}); // this should be the absolute last line of this file