<x-layout>
    <x-slot:title>Tambah Staf Baru | Lumen-K</x-slot:title>

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3"><i class="bi bi-person-plus-fill text-warning me-2"></i>Tambah Pengguna / Staf Baru</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger border-0 py-2 small">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Role / Hak Akses</label>
                                <select name="role" class="form-select" required>
                                    <option value="staff" selected>Staf (Hanya Operasional & Transaksi)</option>
                                    <option value="super_admin">Super Admin (Akses Penuh)</option>
                                    <option value="customer">Customer (Penyewa)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary fw-bold">Batal</a>
                                <button type="submit" class="btn btn-warning fw-bold">Simpan Akun Baru</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>