<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id', 
        'equipment_id', 
        'quantity', 
        'subtotal'
    ];

    // Relasi ke Transaction (Detail ini MILIK 1 nota transaksi tertentu)
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // Relasi ke Equipment (Detail ini MERUJUK pada 1 spesifik alat)
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
