<x-layout>
    <x-slot:title>Tambah Alat Baru | Admin Lumen-K</x-slot:title>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('equipment.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <h2 class="fw-bold text-dark mb-0">Tambah Alat Fotografi Baru</h2>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <form action="{{ route('equipment.store') }}" method="POST">
                        @csrf <!-- Pengaman Token CSRF Laravel -->

                        <!-- Input Nama Alat -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Alat / Kamera</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Contoh: Sony Alpha a7 IV" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Deskripsi -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Deskripsi Alat</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="4" placeholder="Jelaskan spesifikasi singkat alat di sini...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Input Harga Sewa -->
                            <div class="col-md-6 mb-3">
                                <label for="price_per_day" class="form-label fw-semibold">Harga Sewa per Hari (Rp)</label>
                                <input type="number" name="price_per_day" class="form-control @error('price_per_day') is-invalid @enderror" id="price_per_day" placeholder="Contoh: 350000" value="{{ old('price_per_day') }}" required>
                                @error('price_per_day')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Jumlah Stok -->
                            <div class="col-md-6 mb-3">
                                <label for="stock_quantity" class="form-label fw-semibold">Jumlah Stok Awal</label>
                                <input type="number" name="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" placeholder="Contoh: 5" value="{{ old('stock_quantity') }}" required>
                                @error('stock_quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 fw-bold mt-3 py-2.5 shadow-sm">
                            <i class="bi bi-plus-circle me-1"></i> Simpan Alat ke Database
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>