<x-layout>
    <x-slot:title>Kelola Alat | Admin Lumen-K</x-slot:title>
    
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark"><i class="bi bi-camera me-2 text-warning"></i>Daftar Alat Fotografi</h2>
            <!-- Tombol Tambah Alat (Nanti kita fungsikan di tahap Create) -->
            <a href="{{ route('equipment.create') }}" class="btn btn-warning fw-bold shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Alat Baru
            </a>
        </div>

        <!-- Notifikasi Sukses Jika Berhasil Menghapus -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">No</th>
                                <th>Nama Alat</th>
                                <th>Deskripsi</th>
                                <th>Harga / Hari</th>
                                <th>Stok</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($equipment as $index => $item)
                                <tr>
                                    <td class="ps-4 fw-semibold text-muted">{{ $index + 1 }}</td>
                                    <td class="fw-bold text-dark">{{ $item->name }}</td>
                                    <td class="text-muted text-truncate" style="max-width: 300px;">{{ $item->description }}</td>
                                    <td class="fw-semibold text-success">Rp {{ number_format($item->price_per_day, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $item->stock_quantity > 2 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-2.5 py-2">
                                            {{ $item->stock_quantity }} Unit
                                        </span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('equipment.edit', $item->id) }}" class="btn btn-outline-primary btn-sm px-2.5">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <!-- Form & Tombol Hapus (DELETE) -->
                                            <form action="/admin/equipment/{{ $item->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
                                                @csrf
                                                @method('DELETE') <!-- Wajib untuk metode Delete di Laravel -->
                                                <button type="submit" class="btn btn-outline-danger btn-sm px-2.5">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-camera-video-off display-6 d-block mb-3 text-black-50"></i>
                                        Belum ada data alat fotografi yang terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>