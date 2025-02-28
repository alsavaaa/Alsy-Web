<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $isi_kritik = $_POST['isi_kritik'];

    $query = "INSERT INTO kritik (nim, isi_kritik) VALUES (?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $nim, $isi_kritik);

    if ($stmt->execute()) {
        header("Location: mahasantri.php?page=kritik_mhs");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
