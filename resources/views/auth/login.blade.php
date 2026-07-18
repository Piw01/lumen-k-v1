<x-layout>
    <x-slot:title>Login | Lumen-K</x-slot:title>

    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <h3 class="text-center fw-bold mb-4">Login Lumen-K</h3>

                    <!-- Menampilkan pesan error jika gagal login -->
                    @error('email')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    <form action="/login" method="POST">
                        @csrf <!-- Wajib ada untuk keamanan form di Laravel -->
                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="nama@email.com" required autofocus value="{{ old('email') }}">
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-warning w-100 fw-bold">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>