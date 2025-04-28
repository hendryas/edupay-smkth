<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BillingTypeController;
use App\Http\Controllers\Admin\OrangTuaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationSchoolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('ortu.dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [RegistrationSchoolController::class, 'index'])->name('pendaftaran.index');
});

// ---- FROM HERE ----
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('kelola-orang-tua', OrangTuaController::class);
    Route::resource('users', UserController::class);
    Route::resource('billing-types', BillingTypeController::class);
});

require __DIR__.'/auth.php';
