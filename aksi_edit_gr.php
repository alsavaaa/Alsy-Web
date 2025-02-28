<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_gr = $_POST['id_gr'];
    $nm_gr = $_POST['nm_gr'];
    $id_kls = $_POST['id_kls'];

    foreach ($id_gr as $index => $id) {
        $name = $nm_gr[$index];
        $kelas_id = $id_kls[$index];
        $query = "UPDATE guru SET nm_gr='$name', id_kls='$kelas_id' WHERE id_gr='$id'";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die('Error: ' . mysqli_error($koneksi));
        }
    }
    header("Location: mahasantri.php?page=guru");
    exit();
}
?>
