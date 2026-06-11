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

$id = (int) $id;
$harga = (int) $harga;
$stok = (int) $stok;

$stmt = mysqli_prepare($koneksi, "UPDATE produk SET nama_produk = ?, harga = ?, stok = ?, deskripsi = ? WHERE id_produk = ?");
mysqli_stmt_bind_param($stmt, 'siisi', $nama_produk, $harga, $stok, $deskripsi, $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Location: index.php');
exit;
