<x-layout>
    <x-slot:title>Form Sewa Alat | Lumen-K</x-slot:title>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="fw-bold text-dark mb-4">Konfirmasi Penyewaan Alat</h3>
            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4 bg-light rounded">
                    <h5 class="fw-bold text-dark mb-1">{{ $equipment->name }}</h5>
                    <p class="text-success fw-bold mb-0">Rp {{ number_format($equipment->price_per_day, 0, ',', '.') }} / Hari</p>
                    <small class="text-muted d-block mt-2">Maksimal unit disewa: {{ $equipment->stock_quantity }} Unit</small>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="/customer/rent/{{ $equipment->id }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="start_date" class="form-label fw-semibold">Tanggal Mulai Sewa</label>
                            <input type="date" name="start_date" class="form-control" id="start_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label fw-semibold">Tanggal Selesai Sewa</label>
                            <input type="date" name="end_date" class="form-control" id="end_date" required>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-semibold">Jumlah Unit</label>
                            <input type="number" name="quantity" class="form-control" id="quantity" min="1" max="{{ $equipment->stock_quantity }}" value="1" required>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 fw-bold py-2.5 shadow-sm">
                            <i class="bi bi-wallet2 me-1"></i> Ajukan Sewa Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>