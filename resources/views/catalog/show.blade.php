<x-layout>
    <x-slot:title>{{ $equipment->name }} | Detail Alat Lumen-K</x-slot:title>

    <div class="container mt-4 mb-5">
        <!-- Breadcrumb Navigasi -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}" class="text-decoration-none text-muted">Katalog Alat</a></li>
                <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">{{ $equipment->name }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Sisi Kiri: Foto Utama & Pratinjau -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm bg-light p-4 rounded-4 text-center">
                    <img src="{{ $equipment->image ? asset('storage/' . $equipment->image) : 'https://via.placeholder.com/600x400?text=' . urlencode($equipment->name) }}" 
                         alt="{{ $equipment->name }}" 
                         class="img-fluid rounded" 
                         style="max-height: 380px; object-fit: contain;">
                </div>
            </div>

            <!-- Sisi Kanan: Detail Informasi Ala Zenon Rental -->
            <div class="col-md-6">
                <span class="badge bg-warning text-dark fw-bold mb-2 px-3 py-2 fs-7">{{ $equipment->type ?? 'Fotografi & Videografi' }}</span>
                <h2 class="fw-bold text-dark display-6 mb-2">{{ $equipment->name }}</h2>
                
                <div class="d-flex align-items-center gap-3 mb-3">
                    <h3 class="fw-bold text-success m-0">Rp {{ number_format($equipment->price_per_day, 0, ',', '.') }} <span class="fs-6 text-muted font-normal">/ hari</span></h3>
                    <span class="badge {{ $equipment->stock_quantity > 0 ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                        {{ $equipment->stock_quantity > 0 ? 'Tersedia (' . $equipment->stock_quantity . ' Unit)' : 'Stok Habis' }}
                    </span>
                </div>

                <hr class="my-4">

                <!-- Accordion Detail Included & Specs -->
                <div class="accordion accordion-flush mb-4" id="zenonAccordion">
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold text-dark bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#included">
                                <i class="bi bi-box-seam me-2 text-warning"></i>KELENGKAPAN (INCLUDED)
                            </button>
                        </h2>
                        <div id="included" class="accordion-collapse collapse show" data-bs-parent="#zenonAccordion">
                            <div class="accordion-body text-muted small">
                                <ul>
                                    <li>1x Unit Utama {{ $equipment->name }}</li>
                                    <li>1x Baterai Original / Power Adapter</li>
                                    <li>1x Charger & Kabel Power</li>
                                    <li>1x Tas / Pouch Pelindung Spesifik</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-dark bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#specs">
                                <i class="bi bi-cpu me-2 text-warning"></i>SPESIFIKASI DUS & RINGKASAN
                            </button>
                        </h2>
                        <div id="specs" class="accordion-collapse collapse" data-bs-parent="#zenonAccordion">
                            <div class="accordion-body text-muted small">
                                <p>{{ $equipment->description ?? 'Alat ini dirawat berkala dan diuji sebelum diserahkan kepada penyewa.' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-dark bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#location">
                                <i class="bi bi-geo-alt me-2 text-warning"></i>LOKASI & SYARAT SEWA
                            </button>
                        </h2>
                        <div id="location" class="accordion-collapse collapse" data-bs-parent="#zenonAccordion">
                            <div class="accordion-body text-muted small">
                                <p class="mb-1"><strong>Store Utama:</strong> Bandung, Ciamis, Subang</p>
                                <p class="m-0"><strong>Syarat:</strong> KTP Asli + SIM / Kartu Mahasiswa aktif yang masih berlaku.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Action -->
                <!-- Tombol Action -->
                <div class="d-grid gap-2">
                    @if(Auth::check() && in_array(Auth::user()->role, ['super_admin', 'staff']))
                        <!-- Tampilan Khusus Akun Admin -->
                        <div class="alert alert-info border-0 shadow-sm d-flex align-items-center mb-2">
                            <i class="bi bi-shield-lock-fill fs-3 me-3 text-info"></i>
                            <div>
                                <strong>Mode Administrator</strong><br>
                                <small class="text-muted">Anda login sebagai Admin. Akun admin tidak dapat menyewa alat, namun Anda dapat mengedit data alat ini.</small>
                            </div>
                        </div>

                        <a href="{{ route('equipment.edit', $equipment->id) }}" class="btn btn-primary btn-lg fw-bold shadow-sm py-3">
                            <i class="bi bi-pencil-square me-2"></i>Edit Data Alat Ini
                        </a>
                    @else
                        <!-- Tampilan Khusus Customer / Guest -->
                        @if($equipment->stock_quantity > 0)
                            <a href="{{ route('rent.create', $equipment->id) }}" class="btn btn-warning btn-lg fw-bold shadow-sm py-3">
                                <i class="bi bi-cart-plus-fill me-2"></i>Sewa Alat Sekarang
                            </a>
                        @else
                            <button class="btn btn-secondary btn-lg fw-bold py-3" disabled>Stok Sedang Habis</button>
                        @endif
                    @endif

                    <a href="{{ route('catalog.index') }}" class="btn btn-outline-dark fw-bold">
                        &larr; Kembali ke Katalog
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>