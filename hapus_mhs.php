<?php
include 'connection.php';  // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ids'])) {
    $ids = $_POST['ids'];

    // Begin transaction
    mysqli_begin_transaction($koneksi);

    try {
        // Escape each ID to prevent SQL injection
        $escaped_ids = array_map(function($id) use ($koneksi) {
            return mysqli_real_escape_string($koneksi, $id);
        }, $ids);

        // Convert array of IDs to comma-separated string
        $id_list = implode(',', $escaped_ids);

        // Delete related records from the nilai table
        $delete_nilai_query = "DELETE FROM nilai WHERE nim IN ($id_list)";
        if (!mysqli_query($koneksi, $delete_nilai_query)) {
            throw new Exception('Error deleting data from nilai: ' . mysqli_error($koneksi));
        }

        // Delete records from the mahasantri table
        $delete_mahasantri_query = "DELETE FROM mahasantri WHERE nim IN ($id_list)";
        if (!mysqli_query($koneksi, $delete_mahasantri_query)) {
            throw new Exception('Error deleting data from mahasantri: ' . mysqli_error($koneksi));
        }

        // Commit the transaction
        mysqli_commit($koneksi);

        // Redirect back to mahasantri.php after successful deletion
        header("Location: mahasantri.php?page=datamahasantri");
        exit(); // Ensure no further code execution

    } catch (Exception $e) {
        // Rollback the transaction if any error occurs
        mysqli_rollback($koneksi);
        die($e->getMessage());
    }
} else {
    // Redirect to mahasantri.php if accessed directly without POST data
    header("Location: mahasantri.php?page=datamahasantri");
    exit();
}

// Close the database connection
mysqli_close($koneksi);
?>
