<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        // 1. Tambahkan opsi 'super_admin' dan 'staff' ke ENUM, biarkan 'admin' tetap ada sementara
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'staff', 'customer', 'admin') NOT NULL DEFAULT 'customer'");
        
        // 2. Ubah data user yang memiliki role 'admin' lama menjadi 'super_admin'
        DB::table('users')->where('role', 'admin')->update(['role' => 'super_admin']);
        
        // 3. Hapus opsi 'admin' lama dari struktur ENUM secara permanen
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'staff', 'customer') NOT NULL DEFAULT 'customer'");
    }

    /**
     * Kembalikan migration (Rollback).
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'staff', 'customer', 'admin') NOT NULL DEFAULT 'customer'");
        DB::table('users')->where('role', 'super_admin')->update(['role' => 'admin']);
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'customer') NOT NULL DEFAULT 'customer'");
    }
};