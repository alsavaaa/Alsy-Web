<?php
include 'connection.php';  // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $prestasi = mysqli_real_escape_string($koneksi, $_POST['prestasi']);

    // Validasi data yang diterima
    if (!empty($nim) && !empty($prestasi)) {
        // Query untuk menyimpan data ke tabel prestasi
        $query = "INSERT INTO prestasi (nim, prestasi) VALUES ('$nim', '$prestasi')";
        
        if (mysqli_query($koneksi, $query)) {
            // Redirect ke halaman prestasi dengan pesan sukses
            header("Location: mahasantri.php?page=prestasi&status=sukses");
        } else {
            // Redirect ke halaman prestasi dengan pesan error
            header("Location: mahasantri.php?page=prestasi&status=error");
        }
    } else {
        // Redirect ke halaman prestasi dengan pesan error
        header("Location: mahasantri.php?page=prestasi&status=error");
    }
} else {
    // Redirect ke halaman prestasi jika metode request tidak valid
    header("Location: mahasantri.php?page=prestasi");
}
?>
