<?php
session_start();
include 'db.php';

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
    <title>Data Produk Kasur</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    <style>
        body {
            background: #f4f1eb;
            color: #111827;
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(16px);
        }

        .navbar-nav .nav-item {
            margin-left: 0.75rem;
        }

        .navbar-nav .nav-item:first-child {
            margin-left: 0;
        }

        .page-card {
            border: none;
            border-radius: 1.75rem;
            box-shadow: 0 24px 80px rgba(15, 23, 42, 0.08);
        }

        .page-card .card-header {
            border-radius: 1.75rem 1.75rem 0 0;
        }

        .product-card {
            border: none;
            border-radius: 1.5rem;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 50px rgba(15, 23, 42, 0.12);
        }

        .product-card .preview-box,
        .product-card model-viewer,
        .product-card img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            background: #f8f4ee;
        }

        .product-card .card-body {
            padding: 1.4rem 1.3rem;
        }

        .product-card .card-footer {
            background: #ffffff;
            border-top: 1px solid #eef1f4;
        }

        .product-card .text-muted {
            color: #6b7280 !important;
        }

        .tag-chip {
            display: inline-flex;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            background: #eff7f0;
            color: #115e40;
        }

        .preview-label {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(255,255,255,0.92);
            color: #111827;
            border-radius: 9999px;
            padding: 0.35rem 0.75rem;
            font-size: 0.75rem;
            box-shadow: 0 10px 20px rgba(15,23,42,0.08);
        }

        .product-preview-modal .modal-content {
            border-radius: 1.5rem;
            overflow: hidden;
            border: none;
        }

        .product-preview-modal .modal-header {
            border-bottom: none;
        }

        .product-preview-modal .modal-body {
            padding: 0;
        }

        .preview-actions {
            gap: 0.75rem;
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
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="produk.php">Produk</a>
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

    <div class="container py-5">
        <div class="card page-card">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Daftar Produk</h5>
                    <small class="text-white-50">Lihat produk yang tersedia dan kelola data produk di sini.</small>
                </div>
                <a href="tambah.php" class="btn btn-primary">Tambah Produk</a>
            </div>
            <div class="card-body">
                <?php
                $data = mysqli_query($koneksi, "SELECT * FROM produk");
                if (mysqli_num_rows($data) === 0) {
                ?>
                    <div class="alert alert-info mb-0">Belum ada produk. Silakan tambahkan produk terlebih dahulu.</div>
                <?php
                } else {
                ?>
                    <div class="row g-4">
                        <?php while ($d = mysqli_fetch_array($data)): ?>
                            <?php
                                $media = $d['gambar'];
                                $localPath = $media ? __DIR__ . '/uploads/' . $media : '';
                                $ext = $media ? strtolower(pathinfo($media, PATHINFO_EXTENSION)) : '';
                                $isModel = in_array($ext, array('glb', 'gltf'), true);
                                if ($media && is_file($localPath)) {
                                    $thumb = 'uploads/' . rawurlencode($media);
                                } else {
                                    $thumb = 'https://via.placeholder.com/450x300?text=' . urlencode($d['nama_produk']);
                                }
                                $previewType = $isModel ? 'model' : 'image';
                            ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card product-card h-100">
                                    <div class="position-relative">
                                        <?php if ($isModel && $media && is_file($localPath)): ?>
                                            <model-viewer src="<?= $thumb ?>" alt="<?= htmlspecialchars($d['nama_produk']) ?>" auto-rotate camera-controls shadow-intensity="1" style="height:260px; width:100%;"></model-viewer>
                                            <div class="preview-label">3D Model</div>
                                        <?php else: ?>
                                            <img src="<?= $thumb ?>" alt="<?= htmlspecialchars($d['nama_produk']) ?>" class="img-fluid">
                                            <?php if ($ext === 'glb' || $ext === 'gltf'): ?>
                                                <div class="preview-label">3D Model</div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <span class="tag-chip">Rp <?= number_format($d['harga'], 0, ',', '.') ?></span>
                                            </div>
                                            <small class="text-muted">Stok <?= htmlspecialchars($d['stok']) ?></small>
                                        </div>
                                        <h5 class="fw-bold mb-2"><?= htmlspecialchars($d['nama_produk']) ?></h5>
                                        <p class="text-muted mb-3"><?= htmlspecialchars($d['deskripsi'] ?: 'Deskripsi singkat belum ditambahkan') ?></p>
                                        <div class="d-flex flex-wrap align-items-center gap-2 preview-actions">
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="openPreview('<?= htmlspecialchars($d['nama_produk'], ENT_QUOTES) ?>', '<?= $thumb ?>', '<?= $previewType ?>')">Preview</button>
                                            <a href="edit.php?id=<?= $d['id_produk'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="hapus.php?id=<?= $d['id_produk'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="modal fade product-preview-modal" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="previewModalLabel">Preview Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="previewContent" class="w-100"></div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openPreview(title, src, type) {
            var content = document.getElementById('previewContent');
            content.innerHTML = '';
            if (type === 'model') {
                content.innerHTML = '<model-viewer src="' + src + '" alt="' + title + '" auto-rotate camera-controls shadow-intensity="1" style="width:100%;min-height:520px;"></model-viewer>';
            } else {
                content.innerHTML = '<img src="' + src + '" alt="' + title + '" class="img-fluid rounded-4" style="width:100%;max-height:520px;object-fit:cover;">';
            }
            var previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
            previewModal.show();
        }
    </script>
</div>
</div>
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>