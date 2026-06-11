<?php
$koneksi = mysqli_connect("localhost", "root", "", "randumekar");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
