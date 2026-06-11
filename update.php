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

$id = trim($_POST['id'] ?? '');
$nama_produk = trim($_POST['nama_produk'] ?? '');
$harga = trim($_POST['harga'] ?? '');
$stok = trim($_POST['stok'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$gambar = $_FILES['gambar'] ?? null;
$gambarNama = null;

if ($id === '' || !ctype_digit($id)) {
    die('ID produk tidak valid.');
}

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

$id = (int) $id;
$harga = (int) $harga;
$stok = (int) $stok;

if ($gambarNama) {
    $stmt = mysqli_prepare($koneksi, "UPDATE produk SET nama_produk = ?, harga = ?, stok = ?, deskripsi = ?, gambar = ? WHERE id_produk = ?");
    mysqli_stmt_bind_param($stmt, 'siissi', $nama_produk, $harga, $stok, $deskripsi, $gambarNama, $id);
} else {
    $stmt = mysqli_prepare($koneksi, "UPDATE produk SET nama_produk = ?, harga = ?, stok = ?, deskripsi = ? WHERE id_produk = ?");
    mysqli_stmt_bind_param($stmt, 'siisi', $nama_produk, $harga, $stok, $deskripsi, $id);
}

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Location: index.php');
exit;
