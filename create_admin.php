<?php
include 'connection.php';
// Menggunakan password_hash untuk mengenkripsi password
$password_plain = 'admin123';
$hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);

// SQL untuk memasukkan data admin
$sql = "INSERT INTO login (username, password, email, level) VALUES ('admin', '$hashed_password', 'admin@example.com', 'admin')";

if ($koneksi->query($sql) === TRUE) {
    echo "Data admin berhasil dimasukkan!";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

// Menutup koneksi
$koneksi->close();
?>