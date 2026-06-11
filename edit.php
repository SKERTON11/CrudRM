<?php
include 'db.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow border-0">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Edit Data Siswa</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="update.php">

                            <input type="hidden" name="id" value="<?= $d['id'] ?>">

                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control"
                                    value="<?= $d['nama'] ?>"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea
                                    name="alamat"
                                    class="form-control"
                                    rows="3"
                                    required><?= $d['alamat'] ?></textarea>
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