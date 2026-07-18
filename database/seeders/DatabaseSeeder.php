<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Equipment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==========================================
        // 1. MEMBUAT DATA PENGGUNA (Syarat #6 & #9)
        // ==========================================
        
        // Membuat 1 Akun khusus Admin
        User::create([
            'name' => 'Administrator Lumen-K',
            'email' => 'admin@lumenk.com',
            'password' => Hash::make('password'), // Password di-enkripsi demi keamanan
            'role' => 'admin',
        ]);

        // Membuat 1 Akun khusus Pelanggan/Customer
        User::create([
            'name' => 'Lutfi Customer',
            'email' => 'pi@lumenk.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // ==========================================
        // 2. MEMBUAT DATA ALAT FOTOGRAFI & VIDEOGRAFI
        // ==========================================
        
        Equipment::create([
            'name' => 'Sony Alpha a7 IV (Body Only)',
            'description' => 'Kamera Mirrorless Full-Frame 33MP, performa luar biasa untuk foto dan video 4K.',
            'price_per_day' => 350000.00,
            'stock_quantity' => 4,
        ]);

        Equipment::create([
            'name' => 'Canon EOS R5 (Body Only)',
            'description' => 'Kamera Mirrorless Flagship 45MP dengan kemampuan rekam video internal hingga 8K.',
            'price_per_day' => 500000.00,
            'stock_quantity' => 2,
        ]);

        Equipment::create([
            'name' => 'Sony FE 24-70mm f/2.8 GM II',
            'description' => 'Lensa zoom standar premium generasi kedua, sangat tajam dan berbobot ringan.',
            'price_per_day' => 200000.00,
            'stock_quantity' => 3,
        ]);

        Equipment::create([
            'name' => 'DJI RS 3 Pro Gimbal Stabilizer',
            'description' => 'Gimbal stabilizer 3-axis profesional untuk kamera sinema dan mirrorless berat.',
            'price_per_day' => 150000.00,
            'stock_quantity' => 5,
        ]);
    }
}