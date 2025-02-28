<?php
include 'connection.php';  // Menghubungkan ke database

// Ambil data dari tabel Nilai dan Mahasantri untuk Mahasantri bernama "Afkar"
$query = "SELECT n.id_nilai, n.nim, m.nm_mhs, n.jenis, n.nilai 
FROM nilai n 
JOIN mahasantri m ON n.nim = m.nim
WHERE n.jenis = 'quran'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Tampilkan pesan error jika kueri gagal
}
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Nilai Quran</h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Basic Data Tables example with responsive plugin</h5>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <form action="hapus_quran.php" method="post" id="multi-delete-form">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>NIM</th>
                                            <th>Nama Mahasantri</th>
                                            <th>Jenis</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td><input type='checkbox' class='checkbox' name='ids[]' value='" . $row['id_nilai'] . "'></td>";
                                            echo "<td>" . $row['nim'] . "</td>";
                                            echo "<td>" . $row['nm_mhs'] . "</td>";
                                            echo "<td>" . $row['jenis'] . "</td>";
                                            echo "<td>" . $row['nilai'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" class="text-right">
                                                <button type="button" class="btn btn-danger btn-table" onclick="multiDelete()">Delete</button>
                                                <button type="button" class="btn btn-warning btn-table" onclick="editSelectedRow()">Edit</button>
                                                <a href="mahasantri.php?page=insert_quran" class="btn btn-primary btn-table">Add</a>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
