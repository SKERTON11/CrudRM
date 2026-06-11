<?php
include 'db.php';

$nama_produk = trim($_POST['nama_produk'] ?? '');
$harga = trim($_POST['harga'] ?? '');
$stok = trim($_POST['stok'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');

if ($nama_produk === '' || $harga === '' || $stok === '') {
    die('Nama produk, harga, dan stok harus diisi.');
}

if (!is_numeric($harga) || (int) $harga < 0) {
    die('Harga harus berupa angka positif.');
}

if (!is_numeric($stok) || (int) $stok < 0) {
    die('Stok harus berupa angka positif.');
}

$harga = (int) $harga;
$stok = (int) $stok;

$stmt = mysqli_prepare($koneksi, "INSERT INTO produk (nama_produk, harga, stok, deskripsi) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'siis', $nama_produk, $harga, $stok, $deskripsi);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Location: index.php');
exit;
