<x-layout>
    <x-slot:title>Edit Alat | Admin Lumen-K</x-slot:title>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('equipment.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <h2 class="fw-bold text-dark mb-0">Edit Detail Alat Fotografi</h2>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <!-- Action form mengarah ke route update dengan ID alat -->
                    <form action="{{ route('equipment.update', $equipment->id) }}" method="POST">
                        @csrf 
                        @method('PUT') <!-- WAJIB DI LARAVEL: Mengubah metode POST menjadi PUT untuk proses Update -->

                        <!-- Input Nama Alat -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Alat / Kamera</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $equipment->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Deskripsi -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="description">Deskripsi Alat</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ old('description', $equipment->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Input Harga Sewa -->
                            <div class="col-md-6 mb-3">
                                <label for="price_per_day" class="form-label fw-semibold">Harga Sewa per Hari (Rp)</label>
                                <input type="number" name="price_per_day" class="form-control @error('price_per_day') is-invalid @enderror" id="price_per_day" value="{{ old('price_per_day', intval($equipment->price_per_day)) }}" required>
                                @error('price_per_day')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Jumlah Stok -->
                            <div class="col-md-6 mb-3">
                                <label for="stock_quantity" class="form-label fw-semibold">Jumlah Stok</label>
                                <input type="number" name="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" value="{{ old('stock_quantity', $equipment->stock_quantity) }}" required>
                                @error('stock_quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold mt-3 py-2.5 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> Perbarui Data Alat
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>