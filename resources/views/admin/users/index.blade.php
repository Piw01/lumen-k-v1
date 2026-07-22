<x-layout>
    <x-slot:title>Kelola Pengguna | Lumen-K</x-slot:title>

    <div class="container mt-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Manajemen Pengguna & Staf</h3>
                <p class="text-muted mb-0">Daftar semua akun pengguna sistem Lumen-K.</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-warning fw-bold shadow-sm">
                <i class="bi bi-person-plus-fill me-1"></i> Tambah Staf / Pengguna
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-3">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-3">{{ session('error') }}</div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role / Hak Akses</th>
                                <th>Tanggal Terdaftar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $u)
                            <tr>
                                <td class="ps-4">{{ $users->firstItem() + $index }}</td>
                                <td class="fw-bold">{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>
                                    @if($u->role === 'super_admin')
                                        <span class="badge bg-danger">SUPER ADMIN</span>
                                    @elseif($u->role === 'staff')
                                        <span class="badge bg-primary">STAF</span>
                                    @else
                                        <span class="badge bg-secondary">CUSTOMER</span>
                                    @endif
                                </td>
                                <td>{{ $u->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    @if($u->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash-fill"></i> Hapus
                                        </button>
                                    </form>
                                    @else
                                        <span class="text-muted small fs-7">Akun Anda</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</x-layout>