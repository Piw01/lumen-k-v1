<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\TransactionController; // <-- SOLUSI: Import Controller Transaksi
use App\Models\Equipment; // <-- SOLUSI: Import Model Equipment agar lebih rapi

// 1. Halaman Utama Aplikasi (Welcome Page)
Route::get('/', function () {
    // Kodenya jadi lebih bersih tanpa awalan \App\Models\
    $equipment = Equipment::where('stock_quantity', '>', 0, 'and')->get();
    return view('welcome', compact('equipment'));
});

// 2. Kelompok Rute Khusus Tamu (Belum Login / Guest Middleware)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

// 3. Kelompok Rute Khusus Pengguna Terautentikasi (Sudah Login / Auth Middleware)
Route::middleware('auth')->group(function () {
    // RUTE BARU CUSTOMER: Proses Sewa Alat (Sekarang tidak akan error lagi)
    Route::get('/customer/rent/{equipment}', [TransactionController::class, 'create'])->name('rent.create');
    Route::post('/customer/rent/{equipment}', [TransactionController::class, 'store'])->name('rent.store');

    // Proses Keluar Aplikasi (Logout)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Panel Utama Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // Otomatis Mengelola Seluruh Endpoint CRUD Alat Fotografi
    Route::resource('/admin/equipment', EquipmentController::class);


    // RUTE BARU CUSTOMER: Melihat Riwayat Sewa Alat
    Route::get('/customer/history', [TransactionController::class, 'history'])->name('rent.history');
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // ... rute equipment yang sudah ada ...
    
    // Rute Manajemen Transaksi Admin
    // Rute untuk Manajemen Transaksi Admin
    Route::get('/admin/transactions', [App\Http\Controllers\TransactionController::class, 'adminIndex']);
    Route::put('/admin/transactions/{transaction}/status', [App\Http\Controllers\TransactionController::class, 'updateStatus']);
});
});