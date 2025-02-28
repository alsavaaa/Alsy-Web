<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kritik = $_POST['id_kritik'];
    $username = $_POST['username'];
    $isi_tanggapan = $_POST['isi_tanggapan'];
    $username = 'admin'; // Set to 'admin'

    $query = "INSERT INTO tanggapan (id_kritik, username, isi_tanggapan) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("iss", $id_kritik, $username, $isi_tanggapan);

    if ($stmt->execute()) {
        header("Location: mahasantri.php?page=view_kritik_tanggap");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
