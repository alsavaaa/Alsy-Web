<?php
include 'connection.php';  // Koneksi ke database

// Query untuk mengambil data prestasi mahasantri
$query = "SELECT p.id_prestasi, m.nim, m.nm_mhs, p.prestasi 
FROM prestasi p 
LEFT JOIN mahasantri m ON p.nim = m.nim";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi)); // Menampilkan pesan kesalahan jika query gagal
}
?>
<!-- Page Header -->
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Prestasi Mahasantri</h2>
    </div>
</div>
<!-- Page Content -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Prestasi</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <form action="hapus_prestasi.php" method="post" id="multi-delete-form">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll"></th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Prestasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td><input type='checkbox' class='checkbox' name='ids[]' value='" . $row['id_prestasi'] . "'></td>";
                                        echo "<td>" . $row['nim'] . "</td>";
                                        echo "<td>" . $row['nm_mhs'] . "</td>";
                                        echo "<td>" . $row['prestasi'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>