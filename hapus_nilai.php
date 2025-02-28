<?php
include 'connection.php';  // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ids = $_POST['ids'];
    if (!empty($ids)) {
        $id_list = implode(",", $ids);
        $query = "DELETE FROM nilai WHERE id_nilai IN ($id_list)";
        if (mysqli_query($koneksi, $query)) {
            header("Location: nilai.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
    }
} else {
    header("Location: nilai.php");
    exit();
}
?>
