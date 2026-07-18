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

    /**
     * Remove the specified resource from storage. (DELETE)
     */
    public function destroy(Equipment $equipment)
    {
        // Menghapus data alat dari database
        $equipment->delete();

        // Kembali ke halaman daftar alat dengan pesan sukses
        return redirect()->route('equipment.index')->with('success', 'Alat fotografi berhasil dihapus!');
    }
}