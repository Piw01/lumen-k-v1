<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource. (READ)
     */
    public function index()
    {
        // Mengambil semua data alat dari database MySQL
        $equipment = Equipment::all();
        
        // Mengirim data alat ke halaman view admin
        return view('admin.equipment.index', compact('equipment'));
    }

    public function create()
    {
        // Menampilkan halaman formulir tambah alat
        return view('admin.equipment.create');
    }


    public function store(Request $request)
    {
        // 1. Validasi inputan dari formulir agar data wajib diisi dan sesuai tipe data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_day' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        // 2. Simpan data yang sudah lolos validasi ke tabel 'equipment' di MySQL
        Equipment::create($validated);

        // 3. Alihkan halaman kembali ke daftar alat dengan membawa notifikasi sukses
        return redirect()->route('equipment.index')->with('success', 'Alat fotografi baru berhasil ditambahkan!');
    }

    public function edit(Equipment $equipment)
    {
        // Menampilkan halaman form edit sambil melempar data alat yang dipilih berdasarkan ID
        return view('admin.equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        // 1. Validasi data yang diubah oleh admin
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_day' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        // 2. Perbarui data lama di MySQL dengan data baru yang valid
        $equipment->update($validated);

        // 3. Kembali ke tabel utama dengan pesan sukses
        return redirect()->route('equipment.index')->with('success', 'Detail alat fotografi berhasil diperbarui!');
    }
    
    /**
     * Remove the specified resource from storage. (DELETE)
     */
    public function destroy($id)
    {
        // Menghapus data alat dari database berdasarkan id
        Equipment::destroy($id);

        // Kembali ke halaman daftar alat dengan pesan sukses
        return redirect()->route('equipment.index')->with('success', 'Alat fotografi berhasil dihapus!');
    }
}