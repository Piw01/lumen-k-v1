<x-layout>
    <x-slot:title>Tambah Alat | Lumen-K</x-slot:title>
    <x-navbar></x-navbar>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white fw-bold">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Alat Fotografi Baru
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('equipment.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Alat</label>
                                <input type="text" name="name" class="form-class form-control" required placeholder="Contoh: Sony Alpha A7 III">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kategori / Tipe</label>
                                    <input type="text" name="type" class="form-control" required placeholder="Kamera / Lensa / Lighting">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Harga Sewa per Hari (Rp)</label>
                                    <input type="number" name="price_per_day" class="form-control" required placeholder="250000">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Jumlah Stok</label>
                                    <input type="number" name="stock_quantity" class="form-control" required placeholder="5">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Foto Alat</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Keterangan singkat spesifikasi atau kondisi alat..."></textarea>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('equipment.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-warning fw-bold px-4">Simpan Alat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>