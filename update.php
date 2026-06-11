<?php
include 'db.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

mysqli_query($koneksi, "UPDATE siswa SET nama='$nama', alamat='$alamat' WHERE id='$id'");

header("location:index.php");
?>