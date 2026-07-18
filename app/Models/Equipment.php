<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    // Tambahkan 2 blok kode ini di dalam class Equipment:
    
    // 1. Mengizinkan Laravel mengisi kolom-kolom ini secara massal
    protected $fillable = [
        'name', 
        'description', 
        'price_per_day', 
        'stock_quantity'
    ];

    // 2. Relasi ke detail transaksi (1 alat bisa ada di banyak detail transaksi)
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
