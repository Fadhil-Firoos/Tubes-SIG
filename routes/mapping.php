<?php

use App\Http\Controllers\Map\SavePointController;
use Illuminate\Support\Facades\Route;

Route::prefix('mapping')->group(function () {
    // Route::get('/', function () {
    //     return view('mapping.index');
    // })->name('mapping.index');
    Route::get('/create', [SavePointController::class, 'create'])->name('mapping.create');
    Route::post('/save-coordinates', [SavePointController::class, 'store'])->name('mapping.store');
});