<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_info'])) {
    $id_info = $_POST['id_info'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tgl_keluar = $_POST['tgl_keluar'];

    mysqli_begin_transaction($koneksi);

    try {
        // Check if a new file is uploaded
        if (isset($_FILES['uproposal']) && $_FILES['uproposal']['error'] == UPLOAD_ERR_OK) {
            $nama_file = $_FILES['uproposal']['name'];
            $ukuran_file = $_FILES['uproposal']['size'];
            $tipe_file = $_FILES['uproposal']['type'];
            $tmp_file = $_FILES['uproposal']['tmp_name'];
            $target_dir = "dokumen/";

            $allowed_types = ["application/pdf", "image/jpeg", "image/png"];
            if (in_array($tipe_file, $allowed_types) && $ukuran_file <= 1000000) { // 1 MB (in bytes)
                $target_file = $target_dir . basename($nama_file);
                if (move_uploaded_file($tmp_file, $target_file)) {
                    // Update the record with new file
                    $query = "UPDATE informasi SET judul = ?, isi = ?, tgl_keluar = ?, file = ?, type = ?, size = ? WHERE id_info = ?";
                    $stmt = $koneksi->prepare($query);
                    $stmt->bind_param("ssssssi", $judul, $isi, $tgl_keluar, $nama_file, $tipe_file, $ukuran_file, $id_info);
                } else {
                    throw new Exception('File Gagal terupload');
                }
            } else {
                throw new Exception('File harus PDF, JPG, JPEG, atau PNG dan tidak lebih dari 2 MB');
            }
        } else {
            // Update the record without changing the file
            $query = "UPDATE informasi SET judul = ?, isi = ?, tgl_keluar = ? WHERE id_info = ?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("sssi", $judul, $isi, $tgl_keluar, $id_info);
        }

        if (!$stmt->execute()) {
            throw new Exception('Data Gagal Diupdate: ' . $stmt->error);
        }

        mysqli_commit($koneksi);

        header("Location: mahasantri.php?page=layouts");
        exit;
    } catch (Exception $e) {
        mysqli_rollback($koneksi);
        echo "<script>alert('".$e->getMessage()."');history.go(-1);</script>";
    }

    if (isset($stmt)) {
        $stmt->close();
    }
} else {
    header("Location: mahasantri.php?page=layouts");
    exit();
}
?>
