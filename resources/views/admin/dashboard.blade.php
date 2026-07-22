<x-layout>
    <x-slot:title>Dashboard Admin | Lumen-K</x-slot:title>

    <div class="container mt-4 mb-5">
        <!-- Alert Selamat Datang Dinamis -->
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4">
            <i class="bi bi-check-circle-fill fs-3 me-3"></i>
            <div>
                <h5 class="alert-heading mb-1 fw-bold">Login Berhasil!</h5>
                <span>Selamat datang di Panel Kendali Utama. Anda masuk sebagai  :
                    <strong class="text-uppercase badge bg-dark fs-6">{{ str_replace('_', ' ', auth()->user()->role) }}</strong>.
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Kartu 1: Total Alat -->
            <div class="col-md-4">
                <div class="card bg-primary text-white border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <small class="text-white-50 text-uppercase fw-bold">Total Alat (Katalog)</small>
                        <h2 class="display-5 fw-bold my-2">{{ \App\Models\Equipment::count() }} Alat</h2>
                        <a href="{{ route('equipment.index') }}" class="text-white text-decoration-none fw-semibold">
                            Kelola Alat CRUD &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kartu 2: Transaksi -->
            <div class="col-md-4">
                <div class="card bg-warning text-dark border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <small class="text-dark-50 text-uppercase fw-bold">Transaksi Aktif</small>
                        <h2 class="display-5 fw-bold my-2">{{ \App\Models\Transaction::count() }} Transaksi</h2>
                        <a href="{{ route('admin.transactions.index') }}" class="text-dark text-decoration-none fw-semibold">
                            Lihat Semua Transaksi &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kartu 3: Kelola Pengguna & Staf (Khusus Super Admin) -->
            @if(auth()->user()->role === 'super_admin')
            <div class="col-md-4">
                <div class="card bg-dark text-white border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <small class="text-white-50 text-uppercase fw-bold">Manajemen Tim & Akun</small>
                        <h2 class="display-5 fw-bold my-2">{{ \App\Models\User::count() }} Pengguna</h2>
                        <a href="{{ route('users.index') }}" class="text-warning text-decoration-none fw-semibold">
                            Kelola Pengguna / Staf &rarr;
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-layout>