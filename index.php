<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk Kasur</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="row">
            <div class="col-lg-4">

                <!-- Form Tambah -->
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Tambah Produk Kasur</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="tambah.php">

                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Simpan Data
                            </button>

                        </form>
                    </div>
                </div>

            </div>

            <div class="col-lg-8">

                <!-- Tabel Data -->
                <div class="card shadow border-0">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Data Produk Kasur</h5>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM produk");

                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $d['nama_produk'] ?></td>
                                            <td>Rp <?= number_format($d['harga']) ?></td>
                                            <td><?= $d['stok'] ?></td>
                                            <td><?= $d['deskripsi'] ?></td>
                                            <td>
                                                <a href="edit.php?id=<?= $d['id_produk'] ?>"
                                                    class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>

                                                <a href="hapus.php?id=<?= $d['id_produk'] ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

</body>

</html>