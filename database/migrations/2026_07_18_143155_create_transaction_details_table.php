<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade'); // Relasi ke tabel transactions
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade'); // Relasi ke tabel equipments
            $table->integer('quantity'); // Jumlah alat yang disewa
            $table->decimal('subtotal', 12, 2); // Harga per hari * kuantitas * durasi
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
