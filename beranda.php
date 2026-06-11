<?php
include 'db.php';

$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Randu Mekar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f7fb;
            color: #1f2937;
        }

        .hero {
            min-height: 70vh;
            background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
            color: white;
            display: flex;
            align-items: center;
        }

        .hero h1 {
            font-size: clamp(2.5rem, 4vw, 4rem);
        }

        .product-card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 24px 50px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            background: white;
        }

        .product-card .card-header {
            background: #eef2ff;
            font-weight: 700;
            color: #3730a3;
            border-bottom: none;
        }

        .product-card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        .product-card table {
            margin-bottom: 0;
        }

        .product-card .price-label {
            font-size: 0.95rem;
            color: #6b7280;
        }

        .product-card .price-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
        }

        .contact-widget {
            position: fixed;
            right: 1.25rem;
            bottom: 1.25rem;
            z-index: 1000;
            background: #16a34a;
            color: white;
            border-radius: 1.25rem;
            padding: 0.9rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            box-shadow: 0 24px 40px rgba(15, 23, 42, 0.18);
            text-decoration: none;
        }

        .contact-widget:hover {
            transform: translateY(-2px);
            transition: transform 0.2s ease;
            text-decoration: none;
            color: white;
        }

        .contact-widget .icon {
            width: 46px;
            height: 46px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <section class="hero">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="badge bg-white text-primary mb-3">Beranda Randu Mekar</span>
                    <h1 class="mb-4">Toko Kasur Randu Mekar</h1>
                    <p class="lead mb-4">Beranda kelola produk kami menampilkan setiap produk dari tabel <strong>produk</strong> dalam satu kartu. Pilih produk untuk kelola stok, harga, dan deskripsi secara mudah.</p>
                    <a href="#produk" class="btn btn-light btn-lg text-primary">Lihat Kelola Produk</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="produk">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Kelola Produk</h2>
                    <p class="text-muted mb-0">Setiap produk berada dalam tabel produk dan ditampilkan secara terpisah dalam kartu produk.</p>
                </div>
            </div>

            <div class="row g-4">
                <?php if (mysqli_num_rows($produk) > 0): ?>
                    <?php while ($item = mysqli_fetch_assoc($produk)): ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="card product-card">
                                <div class="card-header text-center">
                                    <?= htmlspecialchars($item['nama_produk']) ?>
                                </div>
                                <img src="https://via.placeholder.com/600x400?text=<?= urlencode($item['nama_produk']) ?>" alt="<?= htmlspecialchars($item['nama_produk']) ?>" class="card-img-top">
                                <div class="card-body">
                                    <table class="table table-borderless mb-3">
                                        <tbody>
                                            <tr>
                                                <td class="price-label">Harga Real sebelum dikelola kembali</td>
                                                <td class="text-end price-value">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="price-label">Stok</td>
                                                <td class="text-end"><?= htmlspecialchars($item['stok']) ?> pcs</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                        <a href="edit.php?id=<?= $item['id_produk'] ?>" class="btn btn-primary flex-grow-1">Kelola Produk</a>
                                        <span class="badge bg-success">Produk</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada produk dalam tabel produk. Tambahkan produk terlebih dahulu di halaman kelola.</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container text-center">
            <h3 class="fw-bold mb-3">Tertarik dengan produk kami?</h3>
            <p class="mb-4 text-muted">Kami siap membantu Anda memilih produk terbaik dengan layanan cepat, gratis ongkir, dan harga hemat.</p>
            <a href="tel:+6281234567890" class="btn btn-primary btn-lg">Hubungi Sekarang</a>
        </div>
    </section>

    <a href="tel:+6281234567890" class="contact-widget">
        <div class="icon">📞</div>
        <div>
            <div class="small">Hubungi kami</div>
            <strong>0812-3456-7890</strong>
        </div>
    </a>
</body>

</html>