<?php

use App\Http\Controllers\LaporanPrintController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\CareerPlanController;
use App\Http\Controllers\Siswa\ProfileController as SiswaProfileController;
use App\Http\Controllers\BkAssistantController;
use Illuminate\Support\Facades\Route;
use App\Models\Siswa;

// DEBUG ROUTE - Remove after testing
Route::get('/debug/siswa', function () {
    $siswas = Siswa::with('user')->get();
    
    foreach ($siswas as $siswa) {
        echo "=== Siswa ===\n";
        echo "NIS: " . $siswa->nis . "\n";
        echo "Nama: " . $siswa->nama . "\n";
        echo "User ID: " . $siswa->user_id . "\n";
        echo "User Email: " . ($siswa->user?->email ?? 'NULL') . "\n";
        echo "User Role: " . ($siswa->user?->role ?? 'NULL') . "\n";
        echo "User Password Hash: " . substr($siswa->user?->password ?? 'NULL', 0, 20) . "...\n";
        echo "is_password_changed: " . ($siswa->is_password_changed ? 'true' : 'false') . "\n";
        echo "\n";
    }
    
    echo "\n=== Test Password Verify ===\n";
    $siswa = Siswa::where('nis', '20240001')->first();
    if ($siswa && $siswa->user) {
        $testPassword = 'siswa123';
        $isValid = password_verify($testPassword, $siswa->user->password);
        echo "NIS: " . $siswa->nis . "\n";
        echo "Test Password: " . $testPassword . "\n";
        echo "Password Valid: " . ($isValid ? 'YES' : 'NO') . "\n";
        echo "Stored Hash: " . $siswa->user->password . "\n";
    } else {
        echo "Siswa tidak ditemukan!\n";
    }
});

Route::get('/', function () {
    // guests land on the public dashboard view
    if (auth()->check()) {
        return redirect(auth()->user()?->role === 'siswa' ? route('siswa.dashboard') : route('guru.dashboard'));
    }
    return redirect()->route('siswa.dashboard');
});

// The Filament panel will no longer register its own login route, we
// handle authentication via a single shared page.  The previous
// `/admin/login` redirect has been removed to avoid redirect loops.

// PUBLIC STUDENT PAGES (view-only for guests)
Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])
    ->name('siswa.dashboard');
Route::post('/bk-assistant/message', [BkAssistantController::class, 'message'])
    ->name('bk-assistant.message');
Route::get('/bk-assistant/test', [BkAssistantController::class, 'test'])
    ->name('bk-assistant.test');
Route::get('/siswa/karir', [SiswaController::class, 'karir'])
    ->name('siswa.karir');
Route::get('/siswa/belajar', [SiswaController::class, 'belajar'])
    ->name('siswa.belajar');
Route::get('/siswa/pribadi', [SiswaController::class, 'pribadi'])
    ->name('siswa.pribadi');
Route::get('/siswa/sosial', [SiswaController::class, 'sosial'])
    ->name('siswa.sosial');
// konseling GET will redirect guests itself in controller
Route::get('/siswa/konseling', [SiswaController::class, 'konseling'])
    ->name('siswa.konseling');

Route::middleware(['auth'])->group(function () {

    // SISWA PROFILE (no CheckFirstTimeLogin for these routes since they ARE the profile edit routes)
    Route::prefix('siswa/profile')->name('siswa.profile.')->group(function () {
        Route::get('/edit', [SiswaProfileController::class, 'edit'])->name('edit');
        Route::patch('/update', [SiswaProfileController::class, 'update'])->name('update');
    });

    // API Routes (before CheckFirstTimeLogin so they're accessible during profile completion)
    Route::post('/siswa/konseling', [SiswaController::class, 'storeKonseling'])
        ->name('siswa.konseling.store');
    Route::get('/api/guru/{guru}/jadwals', [SiswaController::class, 'getGuruJadwals'])
        ->name('api.guru.jadwals');
    
    // Notification Routes
    Route::post('/notifications/mark-as-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    })->name('notifications.markAsRead');

    // Apply CheckFirstTimeLogin middleware to protected siswa routes
    Route::middleware([\App\Http\Middleware\CheckFirstTimeLogin::class])->group(function () {
        // the routes below require authentication AND profile completion

        // SISWA: Rencana Karir (khusus kelas 12)
        Route::prefix('siswa/career-plan')->name('career-plan.')->group(function () {
            Route::get('/edit', [CareerPlanController::class, 'edit'])->name('edit');
            Route::patch('/update', [CareerPlanController::class, 'update'])->name('update');
            Route::post('/submit', [CareerPlanController::class, 'submit'])->name('submit');
        });
    });

    // DASHBOARD GURU
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])
        ->name('guru.dashboard');

    Route::get('/laporan/{laporan}/print', [LaporanPrintController::class, 'show'])
        ->name('laporan.print');

    // GURU: Data Siswa & Rencana Karir
    Route::prefix('guru/students')->name('guru.students.')->group(function () {
        Route::get('/career-plans', [GuruController::class, 'studentCareerPlans'])->name('career-plans');
        Route::get('/{student}/career-plan', [GuruController::class, 'viewStudentCareerPlan'])->name('career-plan.show');
    });

    // GURU: Materi CRUD (simple)
    Route::prefix('guru/materi')->name('guru.materi.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Guru\MateriController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Guru\MateriController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Guru\MateriController::class, 'store'])->name('store');
    });

});

require __DIR__.'/auth.php';

// Public materi routes
Route::get('/materi/{slug}', [\App\Http\Controllers\MateriController::class, 'show'])->name('materi.show');

// Filament: Siswa import template & import (used by Guru BK)
Route::prefix('filament')->middleware(['auth'])->group(function () {
    Route::get('/siswa/template', [\App\Http\Controllers\Filament\SiswaImportController::class, 'template'])->name('filament.siswa.template');
    Route::post('/siswa/import', [\App\Http\Controllers\Filament\SiswaImportController::class, 'import'])->name('filament.siswa.import');
});
