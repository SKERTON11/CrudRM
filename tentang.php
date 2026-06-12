<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Randu Mekar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f4ee;
            color: #1f2937;
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
        }

        .navbar-nav .nav-item {
            margin-left: 0.5rem;
        }

        .navbar-nav .nav-item:first-child {
            margin-left: 0;
        }

        .page-card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
        }

        .section-title {
            letter-spacing: 0.12em;
            font-size: 0.85rem;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">RANDU MEKAR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tentang.php">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card page-card p-4">
                        <div class="card-body">
                            <p class="section-title">Tentang Randu Mekar</p>
                            <h1 class="fw-bold">Randu Mekar — Kualitas tidur yang nyaman</h1>
                            <p class="lead text-muted mt-4">Randu Mekar adalah toko kasur, bantal, dan guling yang mengutamakan kenyamanan, kualitas bahan, dan layanan langsung dari produsen.</p>
                            <p class="text-muted">Kami membantu pelanggan mendapatkan produk tidur terbaik dengan harga kompetitif, bebas perantara, dan dukungan layanan personal di Sukoharjo dan sekitarnya. Setiap produk disesuaikan untuk rasa nyaman terbaik di setiap malam.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>