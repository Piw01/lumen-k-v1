<x-layout>
    <x-slot:title>Admin Dashboard | Lumen-K</x-slot:title>

    <div class="row">
        <div class="col-12">
            <div class="alert alert-success shadow-sm border-0" role="alert">
                <h4 class="alert-heading fw-bold"><i class="bi bi-shield-check me-2"></i>Login Berhasil!</h4>
                <p class="mb-0">Selamat datang di Panel Kendali Utama Sistem Lumen-K. Anda masuk sebagai <strong>Admin</strong>.</p>
            </div>
        </div>
    </div>

    <!-- Statistik Singkat Ringkasan CRUD (Syarat #4) -->
    <div class="row mt-4 g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body p-4">
                    <h6 class="text-uppercase fw-semibold text-white-50">Total Alat (Katalog)</h6>
                    <h2 class="display-6 fw-bold my-2">4 Alat</h2>
                    <a href="/admin/equipment" class="text-white-50 text-decoration-none small">Kelola Alat CRUD <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-warning text-dark">
                <div class="card-body p-4">
                    <h6 class="text-uppercase fw-semibold text-dark-50">Transaksi Aktif</h6>
                    <h2 class="display-6 fw-bold my-2">0 Transaksi</h2>
                    <a href=" " class="text-dark-50 text-decoration-none small text-dark">Lihat Semua Transaksi <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</x-layout>