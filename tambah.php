<?php
include 'db.php';

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

mysqli_query($koneksi, "INSERT INTO siswa VALUES ('', '$nama', '$alamat')");

header("location:index.php");
?>