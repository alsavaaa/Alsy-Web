<?php
include 'connection.php';  // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data dari form
    $id_prestasi = mysqli_real_escape_string($koneksi, $_POST['id_prestasi']);
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $prestasi = mysqli_real_escape_string($koneksi, $_POST['prestasi']);

    // Query untuk memperbarui data prestasi
    $stmt = $koneksi->prepare("UPDATE prestasi SET nim = ?, prestasi = ? WHERE id_prestasi = ?");
    $stmt->bind_param("ssi", $nim, $prestasi, $id_prestasi);

    if ($stmt->execute()) {
        echo "Data berhasil diupdate.";
        header('Location: mahasantri.php?page=prestasi');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
} else {
    echo "Invalid request method.";
}

$koneksi->close();
?>
