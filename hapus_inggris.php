<?php
// Include your database connection file
include 'connection.php';

// Check if IDs are set and validate them
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ids'])) {
    $ids = $_POST['ids'];

    // Begin transaction
    mysqli_begin_transaction($koneksi);

    $error = false;

    // Loop through each ID to be deleted
    foreach ($ids as $id_nilai) {
        // Escape the ID to prevent SQL injection
        $escaped_id_nilai = mysqli_real_escape_string($koneksi, $id_nilai);

        // Delete query for the nilai table
        $delete_nilai_query = "DELETE FROM nilai WHERE id_nilai = '$escaped_id_nilai'";

        // Execute the query to delete nilai data
        if (!mysqli_query($koneksi, $delete_nilai_query)) {
            $error = true;
            echo "Error deleting nilai record with id_nilai $escaped_id_nilai: " . mysqli_error($koneksi) . "<br>";
        }
    }

    // If no error, commit the transaction
    if (!$error) {
        mysqli_commit($koneksi);
        mysqli_close($koneksi);
        header('Location: mahasantri.php?page=inggris');
        exit(); // Ensure to stop script execution after header redirect
    } else {
        mysqli_rollback($koneksi); // Rollback if there was an error
    }
} else {
    // If no data was posted, redirect back to the afkar page
    header('Location: mahasantri.php?page=inggris');
    exit();
}

mysqli_close($koneksi);
?>
