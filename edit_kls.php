<?php
include 'connection.php';  // Connect to the database

// Get the IDs from the URL
$ids = $_GET['ids'];
$id_array = explode(',', $ids);

// Fetch data for the selected ID
$id = $id_array[0]; // assuming you only edit one item at a time
$query = "SELECT id_kls, nm_kls, kapasitas FROM kelas WHERE id_kls = $id";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Display error message on query failure
}

$row = mysqli_fetch_assoc($result);
?>

<!-- Page Header -->
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Edit Kelas</h2>
    </div>
</div>
<!-- Page Content -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Kelas</h5>
                    <div class="ibox-content">
                        <form action="aksi_edit_kls.php" method="post">
                            <input type="hidden" name="id_kls" value="<?php echo $row['id_kls']; ?>">
                            <div class="form-group">
                                <label for="nm_kls">Nama Kelas:</label>
                                <input type="text" class="form-control" id="nm_kls" name="nm_kls" value="<?php echo $row['nm_kls']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="kapasitas">Kapasitas:</label>
                                <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="<?php echo $row['kapasitas']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="?page=kelas" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>