<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <!-- Logo Brand -->
        <a class="navbar-brand fw-bold text-warning" href="/">
            <i class="bi bi-camera-reels-fill me-2"></i>Lumen-K
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Tautan Katalog Alat (Dapat diakses siapapun ke Halaman Utama) -->
                <li class="nav-item">
                    <a class="nav-link" href="/">Katalog Alat</a>
                </li>

                @auth
                    <!-- Tautan Khusus Customer -->
                    @if(Auth::user()->role === 'customer')
                        <li class="nav-item">
                            <a class="nav-link" href="/customer/history">Riwayat Sewa</a>
                        </li>
                    @endif

                    <!-- Tautan Khusus Admin -->
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-bold" href="/admin/dashboard">Dashboard Admin</a>
                        </li>
                    @endif

                    <!-- Dropdown Profile & Logout -->
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle text-warning fw-semibold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                            <li>
                                <form action="/logout" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-warning btn-sm px-3" href="/login">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>