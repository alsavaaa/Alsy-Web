<?php
include 'connection.php';  // Menghubungkan ke database

// Ambil data dari tabel Musyrifah
$query = "SELECT m.id_msy, u.username, u.email, m.nm_msy, m.kamar, m.divisi 
FROM musyrifah m 
JOIN login u ON m.username = u.username";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Tampilkan pesan error jika kueri gagal
}
?>

<!-- Page Header -->
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Musyrifah</h2>
    </div>
</div>
<!-- Page Content -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Musyrifah Mabna Fatimah Az-Zahra</h5>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <!-- Inside the form element -->
                            <form action="hapus_msy.php" method="post" id="multi-delete-form">
                                <!-- Data Table -->
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <!-- Table Headers -->
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>Username</th>
                                            <th>Nama Musyrifah</th>
                                            <th>Kamar</th>
                                            <th>Divisi</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td><input type='checkbox' class='checkbox' name='ids[]' value='" . $row['id_msy'] . "'></td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['nm_msy'] . "</td>";
                                            echo "<td>" . $row['kamar'] . "</td>";
                                            echo "<td>" . $row['divisi'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6" class="text-right">
                                                <button type="button" class="btn btn-danger btn-table" onclick="multiDelete()">Delete</button>
                                                <button type="button" class="btn btn-warning btn-table" onclick="editSelectedRow()">Edit</button>
                                                <a href="?page=insert_msy" class="btn btn-primary btn-table">Add</a>
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