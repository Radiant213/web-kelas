<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileSetupController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // Halaman Profil Siswa
    Route::get('/student/{id}', [DashboardController::class, 'showStudent'])->name('student.show');

    // Halaman Setup Biodata (Wajib diisi pertama kali)
    Route::get('/setup-profile', [ProfileSetupController::class, 'create'])->name('profile.setup');
    Route::post('/setup-profile', [ProfileSetupController::class, 'store'])->name('profile.store');

});

// Halaman Dashboard Utama (Public)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/siswa', function () {
    return view('siswa.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'editSimple'])->name('profile.edit.simple');
    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Halaman Nilai Siswa
    Route::get('/nilai', [\App\Http\Controllers\GradeController::class, 'index'])->name('grades.index');
});

require __DIR__ . '/auth.php';
