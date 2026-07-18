<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // 1. Menampilkan Form Penyewaan
    public function create(Equipment $equipment)
    {
        return view('customer.rent', compact('equipment'));
    }

    // 2. Memproses Penyimpanan Transaksi & Potong Stok
    public function store(Request $request, Equipment $equipment)
    {
        // Validasi data input sewa
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'quantity' => 'required|integer|min:1|max:' . $equipment->stock_quantity,
        ]);

        // Hitung selisih hari sewa
        $start = new \DateTime($request->start_date);
        $end = new \DateTime($request->end_date);
        $days = $end->diff($start)->days;
        if ($days == 0) $days = 1;

        // Hitung total harga
        $totalPrice = $equipment->price_per_day * $days * $request->quantity;

        // Menggunakan Database Transaction demi keamanan data (ACID)
        DB::transaction(function () use ($request, $equipment, $totalPrice) {
            // A. Simpan ke tabel transactions
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'status' => 'pending', // Status awal sewa
            ]);

            // B. Simpan ke tabel transaction_details
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'equipment_id' => $equipment->id,
                'quantity' => $request->quantity,
                'subtotal' => $totalPrice,
            ]);

            // C. POTONG STOK ALAT: Mengurangi stok kamera di database
            $equipment->stock_quantity -= $request->quantity;
            $equipment->save();    
        });

        return redirect('/')->with('success', 'Pesanan sewa berhasil dibuat! Silakan tunggu konfirmasi admin.');
    }
}