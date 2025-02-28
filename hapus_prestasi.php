<?php
include 'connection.php';  // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ids = $_POST['ids'];
    if (!empty($ids)) {
        $id_list = implode(",", array_map('intval', $ids)); // Convert each id to integer

        // Query untuk menghapus data prestasi berdasarkan ID
        $query = "DELETE FROM prestasi WHERE id_prestasi IN ($id_list)";

        if (mysqli_query($koneksi, $query)) {
            // Redirect ke halaman prestasi dengan pesan sukses
            header("Location: mahasantri.php?page=prestasi");
            exit();
        } else {
            // Tampilkan pesan error jika query gagal
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
    } else {
        // Redirect ke halaman prestasi jika tidak ada ID yang dipilih
        header("Location: mahasantri.php?page=prestasi");
        exit();
    }
} else {
    echo "Invalid request method.";
}
?>
