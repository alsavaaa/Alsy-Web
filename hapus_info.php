<?php
include 'connection.php';

if (isset($_GET['id_info'])) {
    $id_info = $_GET['id_info'];

    mysqli_begin_transaction($koneksi);

    try {
        // Fetch the current data to delete the file if exists
        $query = "SELECT file FROM informasi WHERE id_info = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("i", $id_info);
        $stmt->execute();
        $result = $stmt->get_result();
        $info = $result->fetch_assoc();
        $stmt->close();

        if ($info) {
            $file_path = 'dokumen/' . $info['file'];
            if (file_exists($file_path)) {
                unlink($file_path); // Delete the file
            }

            $query = "DELETE FROM informasi WHERE id_info = ?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("i", $id_info);

            if (!$stmt->execute()) {
                throw new Exception('Data Gagal Dihapus: ' . $stmt->error);
            }

            mysqli_commit($koneksi);

            header("Location: mahasantri.php?page=layouts");
            exit;
        } else {
            throw new Exception('Informasi tidak ditemukan');
        }
    } catch (Exception $e) {
        mysqli_rollback($koneksi);
        echo "<script>alert('".$e->getMessage()."');history.go(-1);</script>";
    }

    $stmt->close();
} else {
    // Redirect to mahasantri.php if accessed directly without an ID
    header("Location: mahasantri.php?page=layouts");
    exit();
}

// Close the database connection
mysqli_close($koneksi);
?>
