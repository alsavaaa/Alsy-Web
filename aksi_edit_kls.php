<?php
include 'connection.php';  // Connect to the database

// Get the data from the form
$id_kls = $_POST['id_kls'];
$nm_kls = $_POST['nm_kls'];
$kapasitas = $_POST['kapasitas'];

// Prepare an update statement
$stmt = $koneksi->prepare("UPDATE kelas SET nm_kls = ?, kapasitas = ? WHERE id_kls = ?");
$stmt->bind_param("ssi", $nm_kls, $kapasitas, $id_kls);

// Execute the statement
if ($stmt->execute()) {
    echo "Data berhasil diupdate.";
    header('Location: mahasantri.php?page=kelas');
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$koneksi->close();
?>
