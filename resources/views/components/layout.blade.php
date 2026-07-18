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
</head>
<body class="bg-light">

    <!-- Memanggil Komponen Navbar -->
    <x-navbar />

    <!-- Konten Utama Aplikasi -->
    <main class="container my-5">
        {{ $slot }}
    </main>

    <footer class="text-center py-4 text-muted border-top bg-white mt-auto">
        <p class="mb-0">&copy; 2026 Lumen-K - UAS Pemrograman Web 2 UTB.</p>
    </footer>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>