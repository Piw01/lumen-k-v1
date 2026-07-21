<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipment';

    protected $fillable = [
        'name',
        'type',
        'price_per_day',
        'stock_quantity',
        'description',
        'image', // Tambahkan ini
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}