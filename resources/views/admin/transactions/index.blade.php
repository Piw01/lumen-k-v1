<x-layout>
    <x-navbar></x-navbar>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold"><i class="bi bi-clipboard-data text-warning"></i> Kelola Transaksi Penyewaan</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>No. Transaksi</th>
                                <th>Peminjam</th>
                                <th>Tanggal Sewa</th>
                                <th>Total Bayar</th>
                                <th>Status Saat Ini</th>
                                <th>Aksi (Ubah Status)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $trx)
                                <tr>
                                    <td class="fw-bold">#TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $trx->user->name }}</td>
                                    <td>
                                        <small>Mulai: {{ \Carbon\Carbon::parse($trx->start_date)->format('d M Y') }}</small><br>
                                        <small>Selesai: {{ \Carbon\Carbon::parse($trx->end_date)->format('d M Y') }}</small>
                                    </td>
                                    <td class="fw-bold text-success">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @if($trx->status == 'pending') <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($trx->status == 'active') <span class="badge bg-primary">Active</span>
                                        @elseif($trx->status == 'completed') <span class="badge bg-success">Completed</span>
                                        @else <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.transactions.update_status', $trx->id) }}" method="POST" class="d-flex gap-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm" {{ in_array($trx->status, ['completed', 'cancelled']) ? 'disabled' : '' }}>
                                                <option value="pending" {{ $trx->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                                <option value="active" {{ $trx->status == 'active' ? 'selected' : '' }}>Active (Disewa)</option>
                                                <option value="completed" {{ $trx->status == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                                                <option value="cancelled" {{ $trx->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
                                            </select>
                                            
                                            @if(!in_array($trx->status, ['completed', 'cancelled']))
                                                <button type="submit" class="btn btn-sm btn-warning fw-bold">Update</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada data transaksi masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>