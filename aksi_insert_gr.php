<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nm_gr = $_POST['nm_gr'];
    $id_kls = $_POST['id_kls'];

    foreach ($nm_gr as $index => $name) {
        $kelas_id = $id_kls[$index];
        $query = "INSERT INTO guru (nm_gr, id_kls) VALUES ('$name', '$kelas_id')";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die('Error: ' . mysqli_error($koneksi));
        }
    }
    header("Location: mahasantri.php?page=guru");
    exit();
}
?>
