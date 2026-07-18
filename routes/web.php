<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipmentController; // <-- BARIS BARU: Import Controller Alat

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Routes untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

// Routes untuk user yang sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // RUTE BARU: Mengatur CRUD data alat fotografi otomatis untuk Admin
    Route::resource('/admin/equipment', EquipmentController::class);
});