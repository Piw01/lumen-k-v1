<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-warning fs-4" href="{{ route('home') }}">
            <i class="bi bi-camera-reels-fill me-2"></i>Lumen-K
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active text-warning fw-bold' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('catalog.*') ? 'active text-warning fw-bold' : '' }}" href="{{ route('catalog.index') }}">
                        <i class="bi bi-grid-fill me-1"></i>Katalog Alat
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                @auth
                    @if(in_array(auth()->user()->role, ['super_admin', 'staff']))
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-warning btn-sm fw-bold">Dashboard Admin</a>
                    @else
                        <a href="{{ route('rent.history') }}" class="btn btn-outline-light btn-sm">Riwayat Sewa</a>
                    @endif

                    <div class="dropdown">
                        <button class="btn btn-warning btn-sm dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-bold"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-warning btn-sm fw-bold px-3">Masuk / Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>