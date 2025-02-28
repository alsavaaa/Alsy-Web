<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ids = $_POST['ids'];

    foreach ($ids as $id) {
        $query = "DELETE FROM guru WHERE id_gr='$id'";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die('Error: ' . mysqli_error($koneksi));
        }
    }
    header("Location: mahasantri.php?page=guru");
    exit();
}
?>
