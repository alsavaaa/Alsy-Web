<?php
include 'connection.php';  // Connect to the database

// Ambil nilai ids yang dipilih dari form
$ids = $_POST['ids'];

// Jika tidak ada yang dipilih
if (empty($ids)) {
    echo "Please select at least one row to delete.";
    exit;
}

// Ubah nilai $ids menjadi string yang dipisahkan oleh koma
$id_string = implode(',', $ids);

// Query untuk menghapus data
$query = "DELETE FROM kelas WHERE id_kls IN ($id_string)";
$result = mysqli_query($koneksi, $query);

if ($result) {
    header("Location: mahasantri.php?page=kelas");
} else {
    header("Location: mahasantri.php?page=kelas");
}

// Tutup koneksi
mysqli_close($koneksi);
?>
