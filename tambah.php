<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}

include 'db.php';

// Jika form disubmit (POST), proses penyimpanan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = trim(isset($_POST['nama_produk']) ? $_POST['nama_produk'] : '');
    $harga = trim(isset($_POST['harga']) ? $_POST['harga'] : '');
    $stok = trim(isset($_POST['stok']) ? $_POST['stok'] : '');
    $deskripsi = trim(isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '');
    $gambar = isset($_FILES['gambar']) ? $_FILES['gambar'] : null;
    $gambarNama = null;

    if ($nama_produk === '' || $harga === '' || $stok === '') {
        die('Nama produk, harga, dan stok harus diisi.');
    }

    if (!is_numeric($harga) || (int) $harga < 0) {
        die('Harga harus berupa angka positif.');
    }

    if (!is_numeric($stok) || (int) $stok < 0) {
        die('Stok harus berupa angka positif.');
    }

    if ($gambar && $gambar['error'] !== UPLOAD_ERR_NO_FILE) {
        $ekstensi = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
        $boleh = array('glb', 'gltf', 'jpg', 'jpeg', 'png', 'webp');

        if (!in_array($ekstensi, $boleh, true)) {
            die('Format file tidak didukung. Gunakan .glb, .gltf, .jpg, .jpeg, .png, atau .webp.');
        }

        $gambarNama = uniqid('media_', true) . '.' . $ekstensi;
        $uploadDir = __DIR__ . '/uploads';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $tujuan = $uploadDir . '/' . $gambarNama;

        if (!is_uploaded_file($gambar['tmp_name']) || !move_uploaded_file($gambar['tmp_name'], $tujuan)) {
            die('Gagal mengunggah file. Pastikan folder uploads tersedia dan file telah dipilih.');
        }
    }

    $harga = (int) $harga;
    $stok = (int) $stok;

    $stmt = mysqli_prepare($koneksi, "INSERT INTO produk (nama_produk, harga, stok, deskripsi, gambar) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'siiss', $nama_produk, $harga, $stok, $deskripsi, $gambarNama);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: produk.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Produk - Randu Mekar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f4ee; color: #1f2937; }
        .navbar-custom { background: rgba(255,255,255,0.95); backdrop-filter: blur(12px); }
        .page-card { border-radius: 1rem; box-shadow: 0 18px 40px rgba(15,23,42,0.06); }
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
                    <li class="nav-item"><a class="nav-link" href="beranda.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="produk.php">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak</a></li>
                    <li class="nav-item"><a class="btn btn-danger" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card page-card">
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
                                <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Model 3D / Gambar</label>
                                <input type="file" name="gambar" class="form-control" accept=".glb,.gltf,image/*">
                                <div class="form-text">Unggah .glb/.gltf atau gambar untuk produk.</div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </form>
                        <div class="mt-3 text-end">
                            <a href="produk.php" class="btn btn-link">Kembali ke Daftar Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
