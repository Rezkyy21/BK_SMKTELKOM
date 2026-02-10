<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // DASHBOARD SISWA
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])
        ->name('siswa.dashboard');
    
    // MENU PAGES SISWA
    Route::get('/siswa/karir', [SiswaController::class, 'karir'])
        ->name('siswa.karir');
    Route::get('/siswa/belajar', [SiswaController::class, 'belajar'])
        ->name('siswa.belajar');
    Route::get('/siswa/pribadi', [SiswaController::class, 'pribadi'])
        ->name('siswa.pribadi');
    Route::get('/siswa/sosial', [SiswaController::class, 'sosial'])
        ->name('siswa.sosial');
    Route::get('/siswa/konseling', [SiswaController::class, 'konseling'])
        ->name('siswa.konseling');
    Route::post('/siswa/konseling', [SiswaController::class, 'storeKonseling'])
        ->name('siswa.konseling.store');

    // DASHBOARD GURU
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])
        ->name('guru.dashboard');

    // GURU: Materi CRUD (simple)
    Route::prefix('guru/materi')->name('guru.materi.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Guru\MateriController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Guru\MateriController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Guru\MateriController::class, 'store'])->name('store');
    });

});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Public materi routes
Route::get('/materi/{slug}', [\App\Http\Controllers\MateriController::class, 'show'])->name('materi.show');
