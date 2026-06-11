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

$id = trim($_GET['id'] ?? '');

if ($id === '' || !ctype_digit($id)) {
    die('ID produk tidak valid.');
}

$id = (int) $id;

$stmt = mysqli_prepare($koneksi, "DELETE FROM produk WHERE id_produk = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Location: index.php');
exit;
