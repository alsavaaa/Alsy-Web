<?php
include 'connection.php';  // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $jenis = $_POST['jenis'];
    $nilai = $_POST['nilai'];

    $query = "INSERT INTO nilai (nim, jenis, nilai) VALUES ('$nim', '$jenis', '$nilai')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Setelah berhasil, kembali ke halaman utama
        header('Location: homemsy.php?page=afkar_msy');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($koneksi);
    }
}
?>
