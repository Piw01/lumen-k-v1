<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Lumen-K - Penyewaan Alat Foto & Video' }}</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .card-hover { transition: transform 0.2s ease, shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-4px); }
        .hover-primary:hover { color: #ffc107 !important; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-white">

    <!-- Memanggil Komponen Navbar -->
    <x-navbar />

    <!-- Konten Utama Aplikasi -->
    <main class="flex-grow-1    ">
        {{ $slot }}
    </main>

<footer class="bg-dark text-white pt-5 pb-3 border-top border-secondary mt-5">
        <div class="container">
            <div class="row g-4 mb-4">
                <!-- Kolom 1: Branding -->
                <div class="col-md-4">
                    <h4 class="fw-bold text-warning mb-3"><i class="bi bi-camera-reels-fill me-2"></i>Lumen-K</h4>
                    <p class="text-white-50 small pe-md-3">
                        <strong>Lumen-K — Lebih dari Sekadar Rental.</strong><br>
                        Hadir untuk para kreator, videografer, dan fotografer. Kamera & lensa terbaik, layanan cepat tanpa drama. Bayar instan, ambil alat, langsung berkarya.
                    </p>
                </div>

                <!-- Kolom 2: Navigasi Cepat -->
                <div class="col-md-2">
                    <h6 class="fw-bold text-white mb-3">Layanan</h6>
                    <ul class="list-unstyled text-white-50 small">
                        <li class="mb-2"><a href="{{ route('catalog.index') }}" class="text-white-50 text-decoration-none hover-primary">Katalog Kamera</a></li>
                        <li class="mb-2"><a href="{{ route('catalog.index') }}?category=Lensa" class="text-white-50 text-decoration-none hover-primary">Sewa Lensa</a></li>
                        <li class="mb-2"><a href="{{ route('catalog.index') }}?category=Lighting" class="text-white-50 text-decoration-none hover-primary">Lighting & Audio</a></li>
                        <li class="mb-2"><a href="{{ route('catalog.index') }}?category=Drone" class="text-white-50 text-decoration-none hover-primary">Drone Aerial</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Syarat & Ketentuan -->
                <div class="col-md-3">
                    <h6 class="fw-bold text-white mb-3">Informasi & Bantuan</h6>
                    <ul class="list-unstyled text-white-50 small">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-primary">Cara Sewa Alat</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-primary">Syarat & Ketentuan</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-primary">Kebijakan Privasi</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-primary">Tanya Jawab (FAQ)</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Kontak & Lokasi Toko -->
                <div class="col-md-3">
                    <h6 class="fw-bold text-white mb-3">Hubungi Store</h6>
                    <p class="text-white-50 small mb-1"><i class="bi bi-whatsapp me-2 text-success"></i>WA 24 Jam: <strong>0813-6779-8300</strong></p>
                    <p class="text-white-50 small mb-1"><i class="bi bi-envelope me-2 text-warning"></i>support@lumenk.com</p>
                    <p class="text-white-50 small"><i class="bi bi-geo-alt me-2 text-danger"></i>Bandung, Ciamis, & Subang</p>
                </div>
            </div>

            <hr class="border-secondary">

            <!-- Bottom Bar -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-white-50 small py-2">
                <p class="m-0">&copy; 2026 Lumen-K | Dunia Kreatif Tidak Sendirian. Kami Ada untuk Membantu Karyamu Bersinar!</p>
                <div class="d-flex gap-3 mt-2 mt-md-0">
                    <a href="#" class="text-white-50 hover-primary fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white-50 hover-primary fs-5"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="text-white-50 hover-primary fs-5"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>