<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    // Pastikan fillable terlihat seperti ini:
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // <-- Tambahkan koma dan tulisan ini
    ];

    // Tambahkan block kode ini di paling bawah (sebelum } penutup class):
    public function transactions()
    {
        // Artinya: 1 User bisa memiliki banyak (hasMany) Transaksi
        return $this->hasMany(Transaction::class);
    }
}
