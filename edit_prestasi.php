<?php
include 'connection.php';  // Menghubungkan ke database

// Mendapatkan ID dari URL
$ids = $_GET['ids'];
$id_array = explode(',', $ids);

// Mengambil data untuk ID yang dipilih
$id = $id_array[0]; // Mengasumsikan hanya mengedit satu item pada satu waktu
$query = "SELECT id_prestasi, nim, prestasi FROM prestasi WHERE id_prestasi = '$id'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Menampilkan pesan kesalahan jika query gagal
}

$row = mysqli_fetch_assoc($result);

// Query untuk mendapatkan data Mahasantri untuk dropdown NIM
$query_mahasantri = "SELECT nim, nm_mhs FROM mahasantri";
$result_mahasantri = mysqli_query($koneksi, $query_mahasantri);
?>

<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Edit Prestasi Mahasantri</h2>
    </div>
</div>
<!-- Page Content -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Prestasi</h5>
                    <div class="ibox-content">
                        <form action="aksi_edit_prestasi.php" method="post">
                            <input type="hidden" name="id_prestasi" value="<?php echo $row['id_prestasi']; ?>">
                            <div class="form-group">
                                <label for="nim">NIM:</label>
                                <select class="form-control" id="nim" name="nim" required>
                                    <?php
                                    if ($result_mahasantri && mysqli_num_rows($result_mahasantri) > 0) {
                                        while ($mahasantri = mysqli_fetch_assoc($result_mahasantri)) {
                                            $selected = ($mahasantri['nim'] == $row['nim']) ? 'selected' : '';
                                            echo "<option value='" . $mahasantri['nim'] . "' $selected>" . $mahasantri['nim'] . " - " . $mahasantri['nm_mhs'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>Tidak ada data Mahasantri</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="prestasi">Prestasi:</label>
                                <input type="text" class="form-control" id="prestasi" name="prestasi" value="<?php echo $row['prestasi']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="?page=prestasi" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
