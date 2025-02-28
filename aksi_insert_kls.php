<?php
include 'connection.php';

// Ambil nilai dari form
$nm_kls = $_POST['nm_kls'];
$kapasitas = $_POST['kapasitas'];

// Query untuk insert data
$query = "INSERT INTO kelas (nm_kls, kapasitas) VALUES (?, ?)";
$stmt = mysqli_prepare($koneksi, $query);

// Bind parameter ke prepared statement
mysqli_stmt_bind_param($stmt, "si", $nm_kls, $kapasitas);

// Eksekusi statement
if (mysqli_stmt_execute($stmt)) {
    // Jika berhasil
	header("Location: mahasantri.php?page=kelas");
} else {
    // Jika gagal
	header("Location: kelas.php?status=error");
}

// Tutup statement
mysqli_stmt_close($stmt);

// Tutup koneksi
mysqli_close($koneksi);
?>
