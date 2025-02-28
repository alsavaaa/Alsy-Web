<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $nm_mhs = $_POST['nm_mhs'];
    $alamat = $_POST['alamat'];
    $id_kls = $_POST['id_kls'];
    $id_msy = $_POST['id_msy'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $num_records = count($nim);

    $koneksi->begin_transaction();

    try {
        for ($i = 0; $i < $num_records; $i++) {
            $hashed_password = password_hash($password[$i], PASSWORD_BCRYPT);

            // Insert into login table first
            $query_login = "INSERT INTO login (username, password, email, level) VALUES (?, ?, ?, 'mahasantri')";
            $stmt_login = $koneksi->prepare($query_login);
            $stmt_login->bind_param('sss', $username[$i], $hashed_password, $email[$i]);
            $stmt_login->execute();

            // Insert into mahasantri table
            $query_mahasantri = "INSERT INTO mahasantri (nim, nm_mhs, alamat, id_kls, id_msy, username) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_mahasantri = $koneksi->prepare($query_mahasantri);
            $stmt_mahasantri->bind_param('sssiss', $nim[$i], $nm_mhs[$i], $alamat[$i], $id_kls[$i], $id_msy[$i], $username[$i]);
            $stmt_mahasantri->execute();
        }

        $koneksi->commit();
        header("Location: mahasantri.php?page=datamahasantri");
        exit();
    } catch (Exception $e) {
        $koneksi->rollback();
        echo "Failed to insert records: " . $e->getMessage();
    }
}
?>
