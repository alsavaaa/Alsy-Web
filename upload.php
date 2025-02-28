<?php
include 'connection.php';

// Proses simpan data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['uproposal'])) {
    // File properties
	$nama_file = $_FILES['uproposal']['name'];
	$ukuran_file = $_FILES['uproposal']['size'];
	$tipe_file = $_FILES['uproposal']['type'];
	$tmp_file = $_FILES['uproposal']['tmp_name'];
	$target_dir = "dokumen/";

    // Data tambahan
	$judul = $_POST['judul'];
	$isi = $_POST['isi'];
	$tgl_keluar = $_POST['tgl_keluar'];

    // Check file type and size
	if ($tipe_file == "application/pdf") {
		$mime_type = mime_content_type($tmp_file);
		echo "MIME Type: $mime_type<br>";
        if ($ukuran_file <= 2000000) { // 2 MB (in bytes)
            // Upload file
        	$target_file = $target_dir . basename($nama_file);
        	if (move_uploaded_file($tmp_file, $target_file)) {
                // Insert into database
        		$query = "INSERT INTO informasi (judul, isi, tgl_keluar, file, type, size) VALUES (?, ?, ?, ?, ?, ?)";
        		$stmt = $koneksi->prepare($query);
        		$stmt->bind_param("sssssi", $judul, $isi, $tgl_keluar, $nama_file, $tipe_file, $ukuran_file);

        		if ($stmt->execute()) {
        			header("Location: mahasantri.php?page=layouts");
        			exit;
        		} else {
        			echo "<script>alert('File Gagal Masuk Database');history.go(-1);</script>";
        		}

        		$stmt->close();
        	} else {
        		echo "<script>alert('File Gagal terupload');history.go(-1);</script>";
        	}
        } else {
        	echo "<script>alert('Ukuran File lebih dari 2 MB');history.go(-1);</script>";
        }
    } else {
    	echo "<script>alert('File Bukan berekstensi PDF');history.go(-1);</script>";
    }
}
?>
