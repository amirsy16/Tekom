<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/tower-locations', [MapController::class, 'towerLocations'])->name('api.tower-locations');
