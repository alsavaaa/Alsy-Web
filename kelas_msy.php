<?php
include 'connection.php';  // Menghubungkan ke database

// Ambil data dari tabel kelas
$query = "SELECT id_kls, nm_kls, kapasitas FROM kelas";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Tampilkan pesan error jika kueri gagal
}
?>
<!-- Page Header -->
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Kelas Taklim</h2>
    </div>
</div>
<!-- Page Content -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Kelas Taklim</h5>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <!-- Data Table -->
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <!-- Table Headers -->
                                <thead>
                                    <tr>
                                        <th>Kelas</th>
                                        <th>Kapasitas</th>
                                    </tr>
                                </thead>
                                <!-- Table Body -->
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['nm_kls'] . "</td>";
                                        echo "<td>" . $row['kapasitas'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include necessary scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>

<script>
    // Check/Uncheck all checkboxes
    document.getElementById('checkAll').onclick = function() {
        var checkboxes = document.querySelectorAll('.checkbox');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };
</script>
</body>
</html>
