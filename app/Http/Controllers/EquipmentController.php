<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::orderBy('created_at', 'desc')->get();
        return view('admin.equipment.index', compact('equipment'));
    }

    public function create()
    {
        return view('admin.equipment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'type'           => 'required|string|max:100',
            'price_per_day'  => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('equipments', 'public');
        }

        Equipment::create([
            'name'           => $request->name,
            'type'           => $request->type,
            'price_per_day'  => $request->price_per_day,
            'stock_quantity' => $request->stock_quantity,
            'description'    => $request->description,
            'image'          => $imagePath,
        ]);

        return redirect()->route('equipment.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function edit(Equipment $equipment)
    {
        return view('admin.equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'type'           => 'required|string|max:100',
            'price_per_day'  => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $equipment->image;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($equipment->image && Storage::disk('public')->exists($equipment->image)) {
                Storage::disk('public')->delete($equipment->image);
            }
            $imagePath = $request->file('image')->store('equipments', 'public');
        }

        $equipment->update([
            'name'           => $request->name,
            'type'           => $request->type,
            'price_per_day'  => $request->price_per_day,
            'stock_quantity' => $request->stock_quantity,
            'description'    => $request->description,
            'image'          => $imagePath,
        ]);

        return redirect()->route('equipment.index')->with('success', 'Data alat berhasil diperbarui!');
    }

    public function destroy(Equipment $equipment)
    {
        if ($equipment->image && Storage::disk('public')->exists($equipment->image)) {
            Storage::disk('public')->delete($equipment->image);
        }

        Equipment::destroy($equipment->id);

        return redirect()->route('equipment.index')->with('success', 'Alat berhasil dihapus!');
    }

    /**
     * Menampilkan Halaman Katalog Lengkap dengan Pencarian & Filter Cerdas
     */
    public function publicCatalog(Request $request)
    {
        $query = Equipment::query();

        // 1. Pencarian Cerdas (Nama, Deskripsi, atau Tipe)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        // 2. Filter Kategori / Tipe Alat
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('type', $request->category);
        }

        // 3. Urutkan / Smart Sorting
        switch ($request->get('sort')) {
            case 'newest':
                $query->latest();
                break;
            case 'price_low':
                $query->orderBy('price_per_day', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price_per_day', 'desc');
                break;
            case 'name_az':
                $query->orderBy('name', 'asc');
                break;
            case 'name_za':
                $query->orderBy('name', 'desc');
                break;
            case 'recommended':
            default:
                $query->orderBy('stock_quantity', 'desc')->latest();
                break;
        }

        // Pagination 20 item per halaman
        $equipments = $query->paginate(20)->withQueryString();

        // Ambil daftar kategori unik dari database
        $categories = Equipment::select('type')->whereNotNull('type')->distinct()->pluck('type');

        return view('catalog.index', compact('equipments', 'categories'));
    }

    /**
     * Menampilkan Detail Produk (Gaya Zenon Rental)
     */
    public function publicShow(Equipment $equipment)
    {
        return view('catalog.show', compact('equipment'));
    }
}