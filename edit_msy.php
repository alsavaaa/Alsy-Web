<?php
include 'connection.php';  // Menghubungkan ke database
$ids = $_GET['ids'];
$id_array = explode(',', $ids);

$id = $id_array[0];
$query = "SELECT m.id_msy, u.username, u.email, m.nm_msy, m.kamar, m.divisi 
FROM musyrifah m 
JOIN login u ON m.username = u.username 
WHERE m.id_msy = $id";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Display error message on query failure
}

$row = mysqli_fetch_assoc($result);
?>

<!-- Page Header -->
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Edit Musyrifah</h2>
    </div>
</div>
<!-- Page Content -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Musyrifah</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="aksi_edit_msy.php">
                        <input type="hidden" name="id_msy" value="<?php echo $row['id_msy']; ?>">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nm_msy">Nama Musyrifah</label>
                            <input type="text" class="form-control" id="nm_msy" name="nm_msy" value="<?php echo $row['nm_msy']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kamar">Kamar</label>
                            <input type="text" class="form-control" id="kamar" name="kamar" value="<?php echo $row['kamar']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="divisi">Divisi</label>
                            <input type="text" class="form-control" id="divisi" name="divisi" value="<?php echo $row['divisi']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="?page=musyrifah" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>