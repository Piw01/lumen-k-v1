<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\TransactionController;
use App\Models\Equipment;

/*
|--------------------------------------------------------------------------
| Web Routes - Lumen-K
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama / Katalog Alat (Bisa diakses Guest, Customer, maupun Admin)
Route::get('/', function () {
    $equipment = Equipment::latest()->get();
    return view('welcome', compact('equipment'));
})->name('home');

// 2. Rute Autentikasi (Khusus Guest / Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

// 3. Rute Logout (Perlu Login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 4. Rute Customer (Perlu Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/customer/rent/{equipment}', [TransactionController::class, 'create'])->name('rent.create');
    Route::post('/customer/rent/{equipment}', [TransactionController::class, 'store'])->name('rent.store');
    Route::get('/customer/history', [TransactionController::class, 'history'])->name('rent.history');
});

// 5. Rute Admin (Perlu Login & Role Admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard Admin -> URL: /admin/dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD Equipment -> URL: /admin/equipment
    Route::resource('equipment', EquipmentController::class);

    // Manajemen Transaksi Admin -> URL: /admin/transactions dan /admin/transactions/{id}/status
    Route::get('/transactions', [TransactionController::class, 'adminIndex'])->name('admin.transactions.index');
    Route::put('/transactions/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('admin.transactions.update_status');
});     