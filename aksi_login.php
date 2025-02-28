<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM login WHERE username = '$username'";
	$result = mysqli_query($koneksi, $query);

	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);

		if (password_verify($password, $row['password'])) {
			$_SESSION['id_user'] = $row['id_user'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['level'] = $row['level'];

			if ($row['level'] === 'admin') {
				error_log("Redirecting to mahasantri.php");
				header('Location: mahasantri.php');
				exit;
			} elseif ($row['level'] === 'musyrifah') {
				error_log("Redirecting to homemsy.php");
				header('Location: homemsy.php');
				exit;
			} elseif ($row['level'] === 'mahasantri') {
				error_log("Redirecting to homemhs.php");
				header('Location: homemhs.php');
				exit;
			}
		} else {
			$error = "Password salah!";
		}
	} else {
		$error = "Username tidak ditemukan!";
	}
}
?>