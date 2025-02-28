<?php
include 'connection.php';

// Proses simpan data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['uproposal'])) {
    // File properties
	$nama_file = $_FILES['uproposal']['name'];
	$ukuran_file = $_FILES['uproposal']['size'];
	$tipe_file = $_FILES['uproposal']['type'];
	$tmp_file = $_FILES['uproposal']['tmp_name'];
	$target_dir = "uploads/";

    // Retrieve form data
	$judul = $_POST['judul'];
	$isi = $_POST['isi'];
	$tgl_keluar = $_POST['tgl_keluar'];

    // Upload file
	$target_file = $target_dir . basename($nama_file);
	$uploadOk = 1;
	$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}

    // Check file size
	if ($_FILES["uproposal"]["size"] > 2097152) {
		echo "Sorry, your file is too large. Max size is 2MB.";
		$uploadOk = 0;
	}

    // Allow certain file formats
	$allowedTypes = ["jpg", "jpeg", "png", "gif", "pdf"];
	if (!in_array($fileType, $allowedTypes)) {
		echo "Sorry, only JPG, JPEG, PNG, GIF & PDF files are allowed.";
		$uploadOk = 0;
	}

    // Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file and insert data into database
	} else {
		if (move_uploaded_file($tmp_file, $target_file)) {
            // Insert into database
			$query = "INSERT INTO informasi (judul, isi, tgl_keluar, file, type, size) VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = $koneksi->prepare($query);
			$stmt->bind_param("sssssi", $judul, $isi, $tgl_keluar, $nama_file, $fileType, $ukuran_file);

			if ($stmt->execute()) {
				echo "Record inserted successfully";
			} else {
				echo "Error: " . $stmt->error;
			}

			$stmt->close();
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
?>

<!-- Page Header -->
<div class="row border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Form Upload</h2>
	</div>
</div>

<!-- Page Content -->
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<div class="ibox-content">
						<form method="POST" enctype="multipart/form-data" action="upload.php">
							<div class="table-responsive">
								<!-- Inside the form element -->
								<!-- Data Table -->
								<table class="table table-striped table-bordered table-hover">
									<!-- Table Body -->
									<tbody>
										<tr>
											<td>Judul</td>
											<td><input type="text" name="judul" class="form-control" required></td>
										</tr>
										<tr>
											<td>Isi</td>
											<td><textarea name="isi" class="form-control" required></textarea></td>
										</tr>
										<tr>
											<td>Tanggal Keluar</td>
											<td><input type="date" name="tgl_keluar" class="form-control" required></td>
										</tr>
										<tr>
											<td>File Upload</td>
											<td><input type="file" name="uproposal" class="form-control" required></td>
										</tr>
										<tr>
											<td></td>
											<td><button class="btn btn-primary" type="submit">Save</button></td>
										</tr>
									</tbody>
								</table>
							</form>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
