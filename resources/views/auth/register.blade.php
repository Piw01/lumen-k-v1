<x-layout>
    <x-slot:title>Daftar Akun | Lumen-K</x-slot:title>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-1"><i class="bi bi-person-plus-fill text-warning me-2"></i>Daftar Akun</h2>
                            <p class="text-muted">Buat akun untuk mulai menyewa alat fotografi & videografi.</p>
                        </div>

                        <!-- Tampilkan Error Validasi Jika Ada -->
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 py-2 small">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                    <input type="text" name="name" class="form-control border-start-0" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control border-start-0" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                                    <input type="password" name="password" class="form-control border-start-0" placeholder="Minimal 8 karakter" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock-fill text-muted"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control border-start-0" placeholder="Ulangi password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning w-100 fw-bold py-2 mb-3 shadow-sm">
                                Daftar Sekarang
                            </button>

                            <p class="text-center text-muted mb-0 small">
                                Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-dark hover-primary">Masuk di sini</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>