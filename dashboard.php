<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>

    <h2>Dashboard Admin</h2>

    <p>Selamat datang,
        <?= $_SESSION['username']; ?>
    </p>

    <a href="index.php" class="btn btn-primary">
        Kelola Produk
    </a>

    <a href="logout.php">Logout</a>

</body>

</html>