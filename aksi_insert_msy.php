<?php
include 'connection.php';  // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usernames = $_POST['username'];
	$passwords = $_POST['password'];
	$emails = $_POST['email'];
	$nm_msies = $_POST['nm_msy'];
	$kamars = $_POST['kamar'];
	$divisis = $_POST['divisi'];

	for ($i = 0; $i < count($usernames); $i++) {
		$username = mysqli_real_escape_string($koneksi, $usernames[$i]);
		$password = password_hash(mysqli_real_escape_string($koneksi, $passwords[$i]), PASSWORD_BCRYPT);
		$email = mysqli_real_escape_string($koneksi, $emails[$i]);
		$nm_msy = mysqli_real_escape_string($koneksi, $nm_msies[$i]);
		$kamar = mysqli_real_escape_string($koneksi, $kamars[$i]);
		$divisi = mysqli_real_escape_string($koneksi, $divisis[$i]);

        // Insert into login table
		$query_login = "INSERT INTO login (username, password, email, level) VALUES ('$username', '$password', '$email', 'musyrifah')";
		if (mysqli_query($koneksi, $query_login)) {
            // Insert into musyrifah table
			$query_musyrifah = "INSERT INTO musyrifah (username, nm_msy, kamar, divisi) VALUES ('$username', '$nm_msy', '$kamar', '$divisi')";
			if (!mysqli_query($koneksi, $query_musyrifah)) {
				echo "Error: " . $query_musyrifah . "<br>" . mysqli_error($koneksi);
			}
		} else {
			echo "Error: " . $query_login . "<br>" . mysqli_error($koneksi);
		}
	}

	mysqli_close($koneksi);
	header('Location: mahasantri.php?page=musyrifah');
	exit();
} else {
	header('Location: musyrifah.php');
	exit();
}
?>
