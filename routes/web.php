<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/map', function () {
    return view('map');
});

Route::middleware('auth')->group(function () {
    Route::middleware(['role:admin'])->name('admin.')->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/users-create', [UsersController::class, 'create'])->name('users-create');

        Route::get('/users-index', [UsersController::class, 'index'])->name('users-index');

        Route::post('/users-store', [UsersController::class, 'store'])->name('users-store');

        Route::get('/users-edit/{id}', [UsersController::class, 'edit'])->name('users-edit');

        Route::post('/users-update/{id}', [UsersController::class, 'update'])->name('users-update');

        Route::get('/users-non-active/{id}', [UsersController::class, 'nonActive'])->name('users-non-active');

        Route::get('/users-activate/{id}', [UsersController::class, 'activate'])->name('users-activate');

    });

    Route::middleware(['role:vendor'])->name('vendor.')->prefix('vendor')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });


    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
require __DIR__.'/mapping.php';
