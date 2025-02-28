<?php
include 'connection.php';  // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_msy = $_POST['id_msy'];
    $nm_msy = mysqli_real_escape_string($koneksi, $_POST['nm_msy']);
    $kamar = mysqli_real_escape_string($koneksi, $_POST['kamar']);
    $divisi = mysqli_real_escape_string($koneksi, $_POST['divisi']);

    // Update query
    $query = "UPDATE musyrifah SET nm_msy = '$nm_msy', kamar = '$kamar', divisi = '$divisi' WHERE id_msy = $id_msy";

    if (mysqli_query($koneksi, $query)) {
        mysqli_close($koneksi);
        header('Location: mahasantri.php?page=musyrifah');
        exit(); // Pastikan untuk menghentikan eksekusi script setelah header redirect
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
} else {
    // Jika request method bukan POST, arahkan kembali ke halaman edit dengan id_msy
    $id_msy = $_GET['id_msy']; // Ambil id_msy dari query string
    header('Location: edit_msy.php?id_msy=' . $id_msy);
}

mysqli_close($koneksi);
?>
