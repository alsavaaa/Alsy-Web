<?php
include 'connection.php';  // Koneksi ke database

// Query untuk mengambil data Mahasantri dari database
$query_mahasantri = "SELECT nim, nm_mhs FROM mahasantri";
$result_mahasantri = mysqli_query($koneksi, $query_mahasantri);

if (!$result_mahasantri) {
    die('Error: ' . mysqli_error($koneksi)); // Menampilkan pesan kesalahan jika query gagal
}
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tambah Prestasi</h5>
                </div>
                <div class="ibox-content">
                    <form action="aksi_insert_prestasi.php" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="nim">NIM:</label>
                            <select class="form-control" id="nim" name="nim" required>
                                <?php
                                if ($result_mahasantri && mysqli_num_rows($result_mahasantri) > 0) {
                                    while ($row = mysqli_fetch_assoc($result_mahasantri)) {
                                        echo "<option value='" . $row['nim'] . "'>" . $row['nim'] . " - " . $row['nm_mhs'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Tidak ada data Mahasantri</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prestasi">Prestasi:</label>
                            <input type="text" name="prestasi" id="prestasi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a href="mahasantri.php?page=prestasi" class="btn btn-white">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
