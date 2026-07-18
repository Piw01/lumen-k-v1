<x-layout>
    <x-slot:title>Riwayat Sewa Saya | Lumen-K</x-slot:title>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="fw-bold text-dark mb-4"><i class="bi bi-clock-history me-2 text-warning"></i>Riwayat Penyewaan Anda</h3>

            @forelse($transactions as $trx)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                        <div>
                            <span class="small text-white-50 d-block">NO. TRANSAKSI</span>
                            <span class="fw-bold text-warning">#TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="text-end">
                            <span class="small text-white-50 d-block">STATUS</span>
                            @if($trx->status === 'pending')
                                <span class="badge bg-warning text-dark px-3 py-1.5 fw-bold text-uppercase">Pending</span>
                            @elseif($trx->status === 'active')
                                <span class="badge bg-primary px-3 py-1.5 fw-bold text-uppercase">Active (Diberikan)</span>
                            @elseif($trx->status === 'completed')
                                <span class="badge bg-success px-3 py-1.5 fw-bold text-uppercase">Completed</span>
                            @else
                                <span class="badge bg-danger px-3 py-1.5 fw-bold text-uppercase">Cancelled</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <small class="text-muted d-block">Tanggal Mulai:</small>
                                <span class="fw-semibold text-dark"><i class="bi bi-calendar-event me-1"></i>{{ \Carbon\Carbon::parse($trx->start_date)->format('d M Y') }}</span>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Tanggal Selesai:</small>
                                <span class="fw-semibold text-dark"><i class="bi bi-calendar-check me-1"></i>{{ \Carbon\Carbon::parse($trx->end_date)->format('d M Y') }}</span>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <small class="text-muted d-block">Total Pembayaran:</small>
                                <span class="fw-bold text-success fs-5">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="table-responsive bg-light rounded p-2 border-top">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="small text-muted text-uppercase">
                                    <tr>
                                        <th>Item Alat</th>
                                        <th class="text-center">Jumlah Unit</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trx->transactionDetails as $detail)
                                        <tr>
                                            <td class="fw-bold text-dark">
                                                <i class="bi bi-camera me-2 text-secondary"></i>{{ $detail->equipment->name ?? 'Alat Dihapus' }}
                                            </td>
                                            <td class="text-center fw-semibold">{{ $detail->quantity }} Unit</td>
                                            <td class="text-end fw-bold text-dark">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card shadow-sm border-0 text-center py-5">
                    <div class="card-body text-muted">
                        <i class="bi bi-folder-x display-3 d-block mb-3 text-black-50"></i>
                        <p class="fs-5 mb-0">Anda belum pernah melakukan transaksi penyewaan alat.</p>
                        <a href="/" class="btn btn-warning fw-bold mt-3">Mulai Sewa Sekarang</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>