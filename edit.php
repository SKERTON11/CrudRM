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
    header('Location: index.php');
    exit;
}

$id = (int) $id;
$data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id'");
$d = mysqli_fetch_array($data);

if (!$d) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk Kasur</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow border-0">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Edit Produk Kasur</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="update.php">

                            <input type="hidden" name="id" value="<?= $d['id_produk'] ?>">

                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input
                                    type="text"
                                    name="nama_produk"
                                    class="form-control"
                                    value="<?= $d['nama_produk'] ?>"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input
                                    type="number"
                                    name="harga"
                                    class="form-control"
                                    value="<?= $d['harga'] ?>"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input
                                    type="number"
                                    name="stok"
                                    class="form-control"
                                    value="<?= $d['stok'] ?>"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea
                                    name="deskripsi"
                                    class="form-control"
                                    rows="3"><?= $d['deskripsi'] ?></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning">
                                    Update Data
                                </button>

                                <a href="index.php" class="btn btn-secondary">
                                    Kembali
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

</body>

</html>