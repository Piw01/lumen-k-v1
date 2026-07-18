<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\TransactionController;


// 1. Halaman Utama Aplikasi (Welcome Page)
Route::get('/', function () {
    // Mengambil semua alat yang stoknya lebih dari 0
    $equipment = \App\Models\Equipment::query()->where('stock_quantity', '>', 0)->get();
    return view('welcome', compact('equipment'));
});

// 2. Kelompok Rute Khusus Tamu (Belum Login / Guest Middleware)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

// 3. Kelompok Rute Khusus Pengguna Terautentikasi (Sudah Login / Auth Middleware)
Route::middleware('auth')->group(function () {
    // Proses Keluar Aplikasi (Logout)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Panel Utama Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // Otomatis Mengelola Seluruh Endpoint CRUD Alat Fotografi
    // (Mencakup: index, create, store, show, edit, update, destroy)
    Route::resource('/admin/equipment', EquipmentController::class);

    // RUTE BARU CUSTOMER: Proses Sewa Alat
    Route::get('/customer/rent/{equipment}', [TransactionController::class, 'create'])->name('rent.create');
    Route::post('/customer/rent/{equipment}', [TransactionController::class, 'store'])->name('rent.store');
});