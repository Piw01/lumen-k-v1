<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentApiController extends Controller
{
    // GET /api/v1/equipment -> Menampilkan seluruh daftar alat beserta URL gambarnya
    public function index()
    {
        $equipment = Equipment::all()->map(function ($item) {
            return [
                'id'             => $item->id,
                'name'           => $item->name,
                'type'           => $item->type,
                'price_per_day'  => (int) $item->price_per_day,
                'stock_quantity' => (int) $item->stock_quantity,
                'is_available'   => $item->stock_quantity > 0,
                'description'    => $item->description,
                'image_url'      => $item->image ? asset('storage/' . $item->image) : null,
            ];
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Data katalog alat berhasil diambil',
            'count'   => $equipment->count(),
            'data'    => $equipment,
        ], 200);
    }

    // GET /api/v1/equipment/{id} -> Detail spesifik satu alat
    public function show($id)
    {
        $equipment = Equipment::find($id, ['*']);

        if (!$equipment) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data alat tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Detail alat berhasil ditemukan',
            'data'    => [
                'id'             => $equipment->id,
                'name'           => $equipment->name,
                'type'           => $equipment->type,
                'price_per_day'  => (int) $equipment->price_per_day,
                'stock_quantity' => (int) $equipment->stock_quantity,
                'is_available'   => $equipment->stock_quantity > 0,
                'description'    => $equipment->description,
                'image_url'      => $equipment->image ? asset('storage/' . $equipment->image) : null,
            ],
        ], 200);
    }
}