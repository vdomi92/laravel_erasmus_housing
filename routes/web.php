<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HousingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/housings', [HousingController::class, 'list'])->name('housings.list');
    Route::get('/housings/create', [HousingController::class, 'create'])->name('housings.create');
    Route::post('/housings', [HousingController::class, 'store'])->name('housings.store');
    Route::get('/housings/{id}', [HousingController::class, 'show'])->name('housings.show');
    Route::get('/housings/{id}/edit', [HousingController::class, 'edit'])->name('housings.edit');
    //TODO create policy to protect housing updates and deletions
    Route::patch('/housings/{id}', [HousingController::class, 'update'])->name('housings.update');
    Route::delete('/housings/{id}', [HousingController::class, 'destroy'])->name('housings.destroy');

    Route::get('/application/create/{id}', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
});

require __DIR__.'/auth.php';
