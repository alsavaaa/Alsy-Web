<?php
include 'connection.php';  // Connect to the database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_nilai']) && isset($_POST['nilai'])) {
        $id_nilai = $_POST['id_nilai'];
        $nilai = $_POST['nilai'];

        // Prepare an update statement
        $stmt = $koneksi->prepare("UPDATE nilai SET nilai = ? WHERE id_nilai = ? AND jenis = 'quran'");
        $stmt->bind_param("ii", $nilai, $id_nilai);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Data berhasil diupdate.";
            header('Location: mahasantri.php?page=quran');
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
    } else {
        echo "Required data not provided.";
    }
} else {
    echo "Invalid request method.";
}

$koneksi->close();
?>
