<?php
include 'connection.php';  // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ids'])) {
    // Ambil data ids yang di-post dari form
    $ids = $_POST['ids'];
    
    // Mulai transaksi
    mysqli_begin_transaction($koneksi);

    $error = false;

    // Loop untuk setiap id yang akan dihapus
    foreach ($ids as $id_msy) {
        // Hapus akun login yang terkait dari tabel login
        $delete_login_query = "DELETE FROM login WHERE username = (SELECT username FROM musyrifah WHERE id_msy = $id_msy)";
        
        // Hapus data musyrifah berdasarkan id_msy
        $delete_msy_query = "DELETE FROM musyrifah WHERE id_msy = $id_msy";


        // Eksekusi query untuk menghapus data musyrifah
        if (!mysqli_query($koneksi, $delete_msy_query)) {
            $error = true;
            echo "Error deleting musyrifah record with id_msy $id_msy: " . mysqli_error($koneksi) . "<br>";
        }

        // Eksekusi query untuk menghapus akun login
        if (!mysqli_query($koneksi, $delete_login_query)) {
            $error = true;
            echo "Error deleting login record associated with id_msy $id_msy: " . mysqli_error($koneksi) . "<br>";
        }
    }

    // Jika tidak ada error, commit transaksi
    if (!$error) {
        mysqli_commit($koneksi);
        mysqli_close($koneksi);
        header('Location: mahasantri.php?page=musyrifah');
        exit(); // Pastikan untuk menghentikan eksekusi script setelah header redirect
    } else {
        mysqli_rollback($koneksi); // Rollback jika terjadi error
    }
} else {
    // Jika tidak ada data yang di-post, arahkan kembali ke halaman musyrifah.php
    header('Location: mahasantri.php?page=musyrifah');
}

mysqli_close($koneksi);
?>
