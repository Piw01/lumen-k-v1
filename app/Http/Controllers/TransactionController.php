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
        // Block jika user yang login adalah Admin
        if (in_array(auth()->user()->role, ['super_admin', 'staff'])) {
            return redirect()->route('catalog.show', $equipment->id)
                             ->with('error', 'Administrator tidak diperbolehkan melakukan transaksi sewa.');
        }
        return view('customer.rent', compact('equipment'));
    }

    // 2. Memproses Penyimpanan Transaksi & Potong Stok
    public function store(Request $request, Equipment $equipment)
    {
        // Block jika user yang login adalah Admin
        if (auth()->user()->role === 'admin') {
            return redirect()->route('catalog.show', $equipment->id)
                             ->with('error', 'Administrator tidak diperbolehkan melakukan transaksi sewa.');
        }
        // Validasi data input sewa
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'quantity' => "required|integer|min:1|max:{$equipment->stock_quantity}",
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $quantity = $request->input('quantity');

        // Hitung selisih hari sewa
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        $days = $end->diff($start)->days;
        if ($days === 0) {
            $days = 1;
        }

        // Hitung total harga
        $totalPrice = $equipment->price_per_day * $days * $quantity;

        // Menggunakan Database Transaction demi keamanan data (ACID)
        DB::transaction(function () use ($startDate, $endDate, $quantity, $equipment, $totalPrice) {
            // A. Simpan ke tabel transactions (Sudah ditambahkan start_date & end_date)
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_price' => $totalPrice,
                'status' => 'pending', 
            ]);

            // B. Simpan ke tabel transaction_details
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'equipment_id' => $equipment->id,
                'quantity' => $quantity,
                'subtotal' => $totalPrice,
            ]);

            // C. POTONG STOK ALAT: Mengurangi stok kamera di database
            $equipment->stock_quantity -= $quantity;
            $equipment->save();
        });

        return redirect('/')->with('success', 'Pesanan sewa berhasil dibuat! Silakan tunggu konfirmasi admin.');
    }
    /**
     * Menampilkan riwayat transaksi sewa milik customer yang sedang login.
     */
    public function history()
    {
        // Mengambil transaksi milik user yang login, diurutkan dari yang paling baru
        // Menggunakan eager loading 'transactionDetails.equipment' agar query efisien
        $transactions = Transaction::where('user_id', '=', Auth::id())
            ->with('transactionDetails.equipment')
            ->latest()
            ->get();

        return view('customer.history', compact('transactions'));
    }
    /**
     * Menampilkan daftar semua transaksi untuk Admin.
     */
    public function adminIndex()
    {
        // Mengambil semua transaksi beserta data user dan detail alat
        $transactions = Transaction::with(['user', 'transactionDetails.equipment'])
                        ->latest()
                        ->get();
                        
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Memperbarui status transaksi dan mengembalikan stok jika selesai/dibatalkan.
     */
    public function updateStatus(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:pending,active,completed,cancelled'
        ]);

        $status = $request->input('status');

        // Cek jika status diubah menjadi "completed" atau "cancelled"
        // dan status sebelumnya BUKAN completed/cancelled (mencegah stok bertambah berulang kali)
        if (\in_array($status, ['completed', 'cancelled']) && !\in_array($transaction->status, ['completed', 'cancelled'])) {
            // Kembalikan stok alat
            foreach ($transaction->transactionDetails as $detail) {
                $equipment = $detail->equipment;
                $equipment->stock_quantity += $detail->quantity;
                $equipment->save();
            }
        }

        // Perbarui status transaksi
        $transaction->update(['status' => $status]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui!');
    }
}