<?php
include 'db.php';

$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC");
$produk_unggulan = mysqli_fetch_all($produk, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Randu Mekar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f8f4ee;
            color: #1f2937;
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
        }

        .navbar-nav .nav-item {
            margin-left: 0.5rem;
        }

        .navbar-nav .nav-item:first-child {
            margin-left: 0;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.1em;
        }

        .hero {
            min-height: 80vh;
            background: linear-gradient(180deg, #f8f4ee 0%, #f3ece5 100%);
        }

        .hero-img {
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 30px 90px rgba(15, 23, 42, 0.12);
        }

        .hero-img img {
            width: 100%;
            height: auto;
            display: block;
        }

        .feature-card {
            border: none;
            border-radius: 1.5rem;
            background: white;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
            padding: 1.75rem;
            min-height: 240px;
        }

        .feature-card h5 {
            font-weight: 700;
        }

        .testimoni-card {
            border: none;
            border-radius: 1.75rem;
            background: white;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
            padding: 1.75rem;
            min-height: 200px;
        }

        .product-card {
            border: none;
            border-radius: 1.5rem;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 26px 55px rgba(15, 23, 42, 0.12);
        }

        .product-card .product-image {
            width: 100%;
            min-height: 260px;
            max-height: 280px;
            object-fit: cover;
            display: block;
            background: #f8f4ee;
        }

        .product-card .card-body {
            padding: 1.4rem;
        }

        .product-card .badge {
            font-size: 0.78rem;
            letter-spacing: 0.05em;
        }

        .product-card .model-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(255,255,255,0.92);
            color: #0f5132;
            border-radius: 9999px;
            padding: 0.35rem 0.75rem;
            font-size: 0.78rem;
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08);
        }

        .product-card .card-footer {
            background: transparent;
            border-top: none;
            padding: 0 1.4rem 1.4rem;
        }

        .section-title {
            letter-spacing: 0.12em;
            font-size: 0.85rem;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }

        .contact-panel {
            border-radius: 2rem;
            background: #ffffff;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
            padding: 2rem;
        }

        .contact-panel .icon-box {
            width: 64px;
            height: 64px;
            border-radius: 1.25rem;
            display: grid;
            place-items: center;
            background: #f0f9ff;
            color: #2563eb;
            font-size: 1.5rem;
        }

        .nav-link.active {
            color: #111827 !important;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="beranda.php">RANDU MEKAR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang.php">Tentang</a>
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

    <section class="hero py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="hero-img mx-auto mb-4" style="max-width: 900px;">
                        <img src="assets/img/Gambar utama.png" alt="Randu Mekar" loading="lazy">
                    </div>
                    <h1 class="display-5 fw-bold">Randu Mekar</h1>
                    <p class="lead text-muted mx-auto" style="max-width: 700px;">Toko kasur, bantal, dan guling berkualitas yang siap memberi kenyamanan tidur terbaik dengan harga langsung dari produsen.</p>
                    <div class="mt-4">
                        <a href="produk.php" class="btn btn-primary btn-lg me-3">Lihat Produk</a>
                        <a href="kontak.php" class="btn btn-outline-dark btn-lg">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <p class="section-title">Produk Unggulan Toko Randu Mekar</p>
                <h2 class="fw-bold">Temukan produk tidur terbaik kami</h2>
            </div>
            <div class="row g-4">
                <?php if (!empty($produk_unggulan)): ?>
                    <?php foreach (array_slice($produk_unggulan, 0, 3) as $item): ?>
                        <?php
                            $media = isset($item['gambar']) ? $item['gambar'] : '';
                            $localPath = $media ? __DIR__ . '/uploads/' . $media : '';
                            $ext = $media ? strtolower(pathinfo($media, PATHINFO_EXTENSION)) : '';
                            $isModel = in_array($ext, array('glb', 'gltf'), true);
                            if ($media && is_file($localPath)) {
                                $thumb = 'uploads/' . rawurlencode($media);
                            } else {
                                $thumb = 'https://via.placeholder.com/550x350?text=' . urlencode($item['nama_produk']);
                            }
                        ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="card product-card">
                                <div class="position-relative">
                                    <img src="<?= $thumb ?>" alt="<?= htmlspecialchars($item['nama_produk']) ?>" class="product-image">
                                    <?php if ($isModel): ?>
                                        <span class="model-badge">3D Model</span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <span class="badge bg-success mb-3">Produk Terbaik</span>
                                    <h5 class="card-title fw-bold"><?= htmlspecialchars($item['nama_produk']) ?></h5>
                                    <p class="text-muted mb-3">Rp <?= number_format($item['harga'], 0, ',', '.') ?> · <?= htmlspecialchars($item['stok']) ?> stok</p>
                                    <p class="text-muted small"><?= nl2br(htmlspecialchars(substr($item['deskripsi'], 0, 120))) ?><?= strlen($item['deskripsi']) > 120 ? '...' : '' ?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <a href="produk.php" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
                                    <span class="fw-bold text-primary">Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada produk tersedia. Tambahkan produk terlebih dahulu di halaman kelola.</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <p class="section-title">Mengapa Memilih Kami?</p>
                <h2 class="fw-bold">Keunggulan Randu Mekar</h2>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="mb-3 fs-1">🚚</div>
                        <h5>Gratis Ongkir</h5>
                        <p class="text-muted">Gratis ongkir untuk domisili Sukoharjo dan sekitarnya, tanpa syarat ribet.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="mb-3 fs-1">🏆</div>
                        <h5>Berkualitas</h5>
                        <p class="text-muted">Produk tidur premium dengan bahan kapuk pilihan dan finishing rapi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="mb-3 fs-1">💰</div>
                        <h5>Harga Pabrik</h5>
                        <p class="text-muted">Tanpa perantara, harga langsung dari produsen untuk hemat maksimal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <p class="section-title">Apa Kata Pelanggan?</p>
                <h2 class="fw-bold">Ulasan Pelanggan</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimoni-card">
                        <h5 class="fw-bold">Anonim 1 <span class="text-warning">★★★★★</span></h5>
                        <p class="text-muted">"Kasur kapuknya empuk banget, tidur jadi lebih nyenyak. Pengiriman juga cepat!"</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimoni-card">
                        <h5 class="fw-bold">Anonim 2 <span class="text-warning">★★★★★</span></h5>
                        <p class="text-muted">"Bantal dan gulingnya nyaman, anak-anak suka. Pelayanan ramah dan responsif."</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimoni-card">
                        <h5 class="fw-bold">Anonim 3 <span class="text-warning">★★★★★</span></h5>
                        <p class="text-muted">"Pelayanan ramah dan pengantaran cepat. Produk berkualitas sesuai foto."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center contact-panel">
                <div class="col-md-6 d-flex align-items-center gap-3 mb-4 mb-md-0">
                    <div class="icon-box">📞</div>
                    <div>
                        <h5 class="fw-bold mb-1">Tertarik mencoba produk kami?</h5>
                        <p class="text-muted mb-0">Konsultasi produk dan harga gratis. Hubungi kami sekarang untuk informasi lebih lengkap.</p>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="tel:+6287752287106" class="btn btn-primary btn-lg">Hubungi: 087752287106</a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>