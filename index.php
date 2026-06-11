<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}

include 'db.php';
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
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="row">
            <div class="col-lg-4">

                <!-- Form Tambah -->
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Tambah Produk</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="tambah.php" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Model 3D / Gambar</label>
                                <input type="file" name="gambar" class="form-control" accept=".glb,.gltf,image/*">
                                <div class="form-text">Unggah file .glb, .gltf, atau gambar untuk produk.</div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Simpan Data
                            </button>

                        </form>
                    </div>
                </div>

            </div>

            <div class="col-lg-8">

                <!-- Data Produk -->
                <div class="card shadow border-0">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Data Produk</h5>
                    </div>

                    <div class="card-body">
                        <div class="row g-4">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM produk");

                            if (mysqli_num_rows($data) === 0) {
                            ?>
                                <div class="col-12">
                                    <div class="alert alert-info mb-0">Belum ada produk. Silakan tambah produk terlebih dahulu.</div>
                                </div>
                            <?php
                            }

                            while ($d = mysqli_fetch_array($data)) {
                            ?>
                                <div class="col-md-6 col-xl-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-header bg-light text-center">
                                            <strong><?= htmlspecialchars($d['nama_produk']) ?></strong>
                                        </div>
                                        <?php
                                        $mediaFile = $d['gambar'];
                                        $isModel = $mediaFile && preg_match('/\.(glb|gltf)$/i', $mediaFile);
                                        ?>
                                        <?php if ($isModel): ?>
                                            <model-viewer
                                                src="uploads/<?= htmlspecialchars($mediaFile) ?>"
                                                alt="<?= htmlspecialchars($d['nama_produk']) ?>"
                                                camera-controls
                                                auto-rotate
                                                shadow-intensity="1"
                                                style="width: 100%; height: 280px; background: #f8fafc;">
                                            </model-viewer>
                                        <?php else: ?>
                                            <img src="<?= $mediaFile ? 'uploads/' . htmlspecialchars($mediaFile) : 'https://via.placeholder.com/600x400?text=' . urlencode($d['nama_produk']) ?>" class="card-img-top" alt="<?= htmlspecialchars($d['nama_produk']) ?>">
                                        <?php endif; ?>
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-text text-truncate"><?= htmlspecialchars($d['deskripsi'] ?: 'Tidak ada deskripsi') ?></p>

                                            <table class="table table-borderless mb-3">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-muted py-1">Stok</td>
                                                        <td class="text-end py-1"><?= htmlspecialchars($d['stok']) ?> pcs</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="mt-auto d-flex flex-column gap-2">
                                                <div>
                                                    <div class="fw-bold">Rp <?= number_format($d['harga'], 0, ',', '.') ?></div>
                                                </div>

                                                <div class="d-flex gap-2">
                                                    <a href="edit.php?id=<?= $d['id_produk'] ?>" class="btn btn-warning btn-sm flex-grow-1">Kelola Produk</a>
                                                    <a href="hapus.php?id=<?= $d['id_produk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</body>

</html>