<x-layout>
    <x-slot:title>Edit Alat | Lumen-K</x-slot:title>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center mb-3">
                    <a href="{{ route('equipment.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                        &larr; Kembali
                    </a>
                    <h2 class="fw-bold m-0">Edit Detail Alat Fotografi</h2>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form action="{{ route('equipment.update', $equipment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Alat / Kamera</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $equipment->name) }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kategori / Tipe</label>
                                    <input type="text" name="type" class="form-control" value="{{ old('type', $equipment->type) }}" required placeholder="Kamera / Lensa / Lighting">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Harga Sewa per Hari (Rp)</label>
                                    <input type="number" name="price_per_day" class="form-control" value="{{ old('price_per_day', (int)$equipment->price_per_day) }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Jumlah Stok</label>
                                    <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', $equipment->stock_quantity) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Ganti Foto Alat (Opsional)</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <!-- Preview Foto Produk Saat Ini -->
                            @if($equipment->image)
                                <div class="mb-3">
                                    <label class="form-label fw-semibold d-block">Foto Saat Ini:</label>
                                    <div class="p-2 border rounded bg-light d-inline-block">
                                        <img src="{{ asset('storage/' . $equipment->image) }}" alt="{{ $equipment->name }}" style="max-height: 120px; object-fit: contain;">
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi Alat</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description', $equipment->description) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 mt-3">
                                <i class="bi bi-check-circle me-1"></i>Perbarui Data Alat
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>