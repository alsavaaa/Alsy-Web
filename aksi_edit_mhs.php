<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ids = $_POST['id'];
    $nims = $_POST['nim'];
    $usernames = $_POST['username'];
    $nm_mhss = $_POST['nm_mhs'];
    $alamats = $_POST['alamat'];
    $id_kls = $_POST['id_kls'];
    $id_msys = $_POST['id_msy'];

    for ($i = 0; $i < count($ids); $i++) {
        $id = $ids[$i];
        $nim = $nims[$i];
        $username = $usernames[$i];
        $nm_mhs = $nm_mhss[$i];
        $alamat = $alamats[$i];
        $id_kl = $id_kls[$i];
        $id_msy = $id_msys[$i];

        $query = "UPDATE mahasantri 
        SET nim = '$nim', username = '$username', nm_mhs = '$nm_mhs', alamat = '$alamat', id_kls = '$id_kl', id_msy = '$id_msy' 
        WHERE nim = '$id'";

        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die('Error: ' . mysqli_error($koneksi));
        }
    }

    header('Location: mahasantri.php?page=datamahasantri');
}
?>
