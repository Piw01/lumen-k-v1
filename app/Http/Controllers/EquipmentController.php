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
}