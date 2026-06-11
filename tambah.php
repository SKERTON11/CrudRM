<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}

include 'db.php';
?>

<?php
include 'db.php';

$nama_produk = trim($_POST['nama_produk'] ?? '');
$harga = trim($_POST['harga'] ?? '');
$stok = trim($_POST['stok'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$gambar = $_FILES['gambar'] ?? null;
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
    $boleh = ['glb', 'gltf', 'jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($ekstensi, $boleh, true)) {
        die('Format file tidak didukung. Gunakan .glb, .gltf, .jpg, .jpeg, .png, atau .webp.');
    }

    $gambarNama = uniqid('media_', true) . '.' . $ekstensi;
    $tujuan = __DIR__ . '/uploads/' . $gambarNama;

    if (!move_uploaded_file($gambar['tmp_name'], $tujuan)) {
        die('Gagal mengunggah file.');
    }
}

$harga = (int) $harga;
$stok = (int) $stok;

$stmt = mysqli_prepare($koneksi, "INSERT INTO produk (nama_produk, harga, stok, deskripsi, gambar) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'siiss', $nama_produk, $harga, $stok, $deskripsi, $gambarNama);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Location: index.php');
exit;
