<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>

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
                        <h5 class="mb-0">Tambah Data Siswa</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="tambah.php">

                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required></textarea>
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
                        <h5 class="mb-0">Data Siswa</h5>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="70">No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th width="180">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM siswa");

                                    while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $d['nama'] ?></td>
                                            <td><?= $d['alamat'] ?></td>
                                            <td>
                                                <a href="edit.php?id=<?= $d['id'] ?>"
                                                    class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>

                                                <a href="hapus.php?id=<?= $d['id'] ?>"
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