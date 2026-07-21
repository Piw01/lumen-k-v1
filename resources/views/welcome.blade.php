<x-layout>
    <x-slot:title>Katalog Penyewaan | Lumen-K</x-slot:title>
    

    <div class="container mt-4 mb-5">
        <!-- Banner Selamat Datang -->
        <div class="p-5 mb-5 bg-dark text-white rounded-3 shadow-sm position-relative overflow-hidden">
            <div class="py-3 text-center">
                <h1 class="display-5 fw-bold text-warning">Cari Alat Kamera Terbaik untuk Projekmu</h1>
                <p class="fs-5 text-white-50">Penyewaan alat fotografi dan videografi profesional dengan harga terjangkau.</p>
            </div>
        </div>

        <h3 class="fw-bold mb-4 text-dark"><i class="bi bi-camera2 me-2 text-warning"></i>Katalog Alat Tersedia</h3>

        <!-- Grid Kartu Alat -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($equipment as $item)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 card-hover">
                        <!-- Pembungkus Gambar: Menggunakan object-fit: contain agar gambar utuh presisi -->
                        <div class="bg-light rounded-top d-flex align-items-center justify-content-center p-2" style="height: 220px; overflow: hidden;">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/600x400?text=' . urlencode($item->name) }}" 
                                 class="card-img-top h-100 w-100" 
                                 alt="{{ $item->name }}" 
                                 style="object-fit: contain;">
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark mb-1">{{ $item->name }}</h5>
                            <span class="badge bg-success-subtle text-success mb-3 align-self-start">Tersedia: {{ $item->stock_quantity }} Unit</span>
                            
                            <p class="card-text text-muted small flex-grow-1">{{ $item->description ?? 'Tidak ada deskripsi spesifikasi.' }}</p>
                            
                            <div class="border-top pt-3 mt-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted d-block">Harga Sewa:</small>
                                    <span class="fw-bold text-success fs-5">Rp {{ number_format($item->price_per_day, 0, ',', '.') }}</span><small class="text-muted">/hari</small>
                                </div>

                                @if(!Auth::check() || Auth::user()->role !== 'admin')
                                    <a href="{{ route('rent.create', $item->id) }}" class="btn btn-warning btn-sm fw-bold">
                                        <i class="bi bi-cart-plus me-1"></i>Sewa
                                    </a>
                                @else
                                    <span class="badge bg-secondary">Mode Admin</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Belum ada alat yang tersedia di katalog.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>