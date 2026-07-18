<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <!-- Logo Lumen-K diarahkan ke halaman utama (/) -->
        <a class="navbar-brand fw-bold" href="/">
            <i class="bi bi-camera-reels-fill me-2 text-warning"></i>Lumen-K
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="#">Katalog Alat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Riwayat Sewa</a>
                </li>
                
                <!-- JIKA PENGGUNA SUDAH LOGIN -->
                @auth
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle text-warning fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-menu-item dropdown-item fw-bold text-danger" href="/admin/dashboard">Dashboard Admin</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <!-- Form Logout aman menggunakan metode POST -->
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <!-- JIKA PENGGUNA BELUM LOGIN (TAMU) -->
                @endguest
                @guest
                    <li class="nav-item ms-lg-3">
                        <!-- Link href diubah dari # menjadi /login -->
                        <a href="/login" class="btn btn-outline-warning btn-sm">Login</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>