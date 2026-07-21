<x-layout>
    <x-slot:title>Lumen-K | Rental Kamera & Alat Videografi</x-slot:title>

    <div class="container mt-4 mb-5">
        <!-- Banner Hero -->
        <div class="p-5 mb-5 bg-dark text-white rounded-4 shadow-sm position-relative overflow-hidden">
            <div class="py-4 text-center">
                <h1 class="display-4 fw-bold text-warning mb-2">Cari Alat Kamera Terbaik untuk Projekmu</h1>
                <p class="fs-5 text-white-50 max-w-20 mx-auto">Penyewaan kamera, lensa, lighting, & stabilizer profesional dengan harga terjangkau.</p>
                <a href="{{ route('catalog.index') }}" class="btn btn-warning btn-lg fw-bold px-4 mt-3 shadow">
                    <i class="bi bi-search me-2"></i>Jelajahi Semua Katalog
                </a>
            </div>
        </div>

        <!-- Section: Paling Sering Disewa -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold m-0 text-dark"><i class="bi bi-fire text-danger me-2"></i>Paling Banyak Disewa</h3>
                <small class="text-muted">Pilihan favorit para kreator & videografer minggu ini</small>
            </div>
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-dark btn-sm fw-bold">
                Lihat Semua (50+ Alat) &rarr;
            </a>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($equipment as $item)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 card-hover">
                        <!-- Gambar Klikable ke Detail -->
                        <a href="{{ route('catalog.show', $item->id) }}" class="text-decoration-none">
                            <div class="bg-light rounded-top d-flex align-items-center justify-content-center p-3" style="height: 220px;">
                                <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/600x400?text=' . urlencode($item->name) }}" 
                                     class="card-img-top h-100 w-100" 
                                     alt="{{ $item->name }}" 
                                     style="object-fit: contain;">
                            </div>
                        </a>
                        
                        <div class="card-body d-flex flex-column">
                            <a href="{{ route('catalog.show', $item->id) }}" class="text-decoration-none text-dark">
                                <h5 class="card-title fw-bold mb-1 hover-primary">{{ $item->name }}</h5>
                            </a>
                            <span class="badge bg-success-subtle text-success mb-3 align-self-start">Tersedia: {{ $item->stock_quantity }} Unit</span>
                            
                            <p class="card-text text-muted small flex-grow-1">{{ Str::limit($item->description ?? 'Tidak ada deskripsi spesifikasi.', 80) }}</p>
                            
                            <div class="border-top pt-3 mt-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted d-block">Harga Sewa:</small>
                                    <span class="fw-bold text-success fs-5">Rp {{ number_format($item->price_per_day, 0, ',', '.') }}</span><small class="text-muted">/hari</small>
                                </div>

                                <a href="{{ route('catalog.show', $item->id) }}" class="btn btn-dark btn-sm fw-bold">
                                    Detail Alat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Belum ada data alat terpopuler.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>