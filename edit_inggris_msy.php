<?php
include 'connection.php';  // Connect to the database

// Get the ID from the URL
$ids = $_GET['ids'];
$id_array = explode(',', $ids);

// Fetch data for the selected ID
$id = $id_array[0]; // assuming you only edit one item at a time
$query = "SELECT id_nilai, nim, nilai FROM nilai WHERE id_nilai = '$id' AND jenis = 'inggris'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Display error message on query failure
}

$row = mysqli_fetch_assoc($result);
?>

<!-- Page Header -->
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Edit Nilai Inggris</h2>
    </div>
</div>
<!-- Page Content -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Nilai Inggris</h5>
                    <div class="ibox-content">
                        <form action="aksi_edit_inggris_msy.php" method="post">
                            <input type="hidden" name="id_nilai" value="<?php echo $row['id_nilai']; ?>">
                            <div class="form-group">
                                <label for="nim">NIM:</label>
                                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $row['nim']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nilai">Nilai:</label>
                                <input type="number" class="form-control" id="nilai" name="nilai" value="<?php echo $row['nilai']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="?page=inggris_msy" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
