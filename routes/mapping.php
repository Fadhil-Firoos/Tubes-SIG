<?php

use App\Http\Controllers\Map\SavePointController;
use Illuminate\Support\Facades\Route;

Route::prefix('mapping')->middleware('auth')->group(function () {
    Route::get('/', [SavePointController::class, 'index'])->name('mapping.index');
    Route::get('/create', [SavePointController::class, 'create'])->name('mapping.create');
    Route::post('/save-coordinates', [SavePointController::class, 'store'])->name('mapping.store');
    Route::get('/edit/{uuid}', [SavePointController::class, 'edit'])->name('mapping.edit');
    Route::put('/update/{uuid}', [SavePointController::class, 'update'])->name('mapping.update');
});