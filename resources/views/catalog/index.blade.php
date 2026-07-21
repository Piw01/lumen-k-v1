<x-layout>
    <x-slot:title>Katalog Lengkap Alat | Lumen-K</x-slot:title>

    <div class="container mt-4 mb-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
            <div>
                <h2 class="fw-bold m-0"><i class="bi bi-grid-3x3-gap-fill text-warning me-2"></i>Katalog Lengkap Alat</h2>
                <p class="text-muted m-0">Menampilkan {{ $equipments->total() }} alat fotografi & videografi siap sewa</p>
            </div>
        </div>

        <!-- Form Filter & Pencarian Cerdas -->
        <div class="card border-0 shadow-sm p-3 mb-4 bg-light rounded-3">
            <form action="{{ route('catalog.index') }}" method="GET" class="row g-3 align-items-center">
                <!-- Input Cari -->
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Cari nama kamera, lensa, gimbal..." value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Filter Kategori -->
                <div class="col-md-3">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="all">-- Semua Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort By (Mengikuti Referensi image_d44a45.png) -->
                <div class="col-md-3">
                    <select name="sort" class="form-select fw-semibold" onchange="this.form.submit()">
                        <option value="recommended" {{ request('sort') == 'recommended' ? 'selected' : '' }}>Sort by: Recommended</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price (low to high)</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price (high to low)</option>
                        <option value="name_az" {{ request('sort') == 'name_az' ? 'selected' : '' }}>Name A-Z</option>
                        <option value="name_za" {{ request('sort') == 'name_za' ? 'selected' : '' }}>Name Z-A</option>
                    </select>
                </div>

                <div class="col-md-1 d-grid">
                    <button type="submit" class="btn btn-warning fw-bold"><i class="bi bi-funnel-fill"></i></button>
                </div>
            </form>
        </div>

        <!-- Grid Katalog (20 Alat per Halaman) -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            @forelse($equipments as $item)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 card-hover">
                        <!-- Gambar Produk (Klikable ke Detail Produk) -->
                        <a href="{{ route('catalog.show', $item->id) }}" class="text-decoration-none">
                            <div class="bg-white rounded-top d-flex align-items-center justify-content-center p-3" style="height: 200px;">
                                <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/600x400?text=' . urlencode($item->name) }}" 
                                     class="card-img-top h-100 w-100" 
                                     alt="{{ $item->name }}" 
                                     style="object-fit: contain;">
                            </div>
                        </a>

                        <div class="card-body d-flex flex-column p-3">
                            <span class="badge bg-secondary-subtle text-dark align-self-start mb-2" style="font-size: 0.75rem;">{{ $item->type ?? 'Alat' }}</span>
                            
                            <!-- Judul Klikable -->
                            <a href="{{ route('catalog.show', $item->id) }}" class="text-decoration-none text-dark">
                                <h6 class="card-title fw-bold mb-1 hover-primary text-truncate">{{ $item->name }}</h6>
                            </a>

                            <div class="mt-auto pt-2 border-top">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">Rp {{ number_format($item->price_per_day, 0, ',', '.') }}<small class="text-muted fs-7">/hr</small></span>
                                    <small class="text-muted">Stok: {{ $item->stock_quantity }}</small>
                                </div>

                                <a href="{{ route('catalog.show', $item->id) }}" class="btn btn-warning btn-sm w-100 fw-bold">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-emoji-frown text-muted display-1 d-block mb-3"></i>
                    <h5 class="text-muted fw-bold">Tidak ada alat yang sesuai dengan pencarian Anda.</h5>
                    <a href="{{ route('catalog.index') }}" class="btn btn-outline-warning btn-sm mt-2">Reset Filter</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination 20 Item per Halaman -->
        <div class="d-flex justify-content-center mt-5">
            {{ $equipments->links('pagination::bootstrap-5') }}
        </div>
    </div>
</x-layout>