<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 
        'start_date', 
        'end_date', 
        'total_price', 
        'status'
    ];

    // Relasi ke User (Nota transaksi ini MILIK 1 user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }


    // Relasi ke Detail Transaksi (1 Nota punya BANYAK detail barang sewaan)
    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
    
}
