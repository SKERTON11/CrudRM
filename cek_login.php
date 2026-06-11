<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM admin
    WHERE username='$username'
    AND password='$password'"
);

$cek = mysqli_num_rows($data);

if ($cek > 0) {

    $_SESSION['username'] = $username;

    header("location:dashboard.php");
} else {

    echo "Username atau Password salah";
}
