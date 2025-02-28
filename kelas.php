<?php
include 'connection.php';  // Connect to the database
// Retrieve data from the 'kelas' table
$query = "SELECT id_kls, nm_kls, kapasitas FROM kelas";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Display error message on query failure
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
                            <!-- Inside the form element -->
                            <form action="hapus_kls.php" method="post" id="multi-delete-form">
                                <!-- Data Table -->
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <!-- Table Headers -->
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>Kelas</th>
                                            <th>Kapasitas</th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td><input type='checkbox' class='checkbox' name='ids[]' value='" . $row['id_kls'] . "'></td>";
                                            echo "<td>" . $row['nm_kls'] . "</td>";
                                            echo "<td>" . $row['kapasitas'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6" class="text-right">
                                                <button type="button" class="btn btn-danger btn-table" onclick="multiDelete()">Delete</button>
                                                <button type="button" class="btn btn-warning btn-table" onclick="editSelectedRow()">Edit</button>
                                                <a href="?page=insert_kls" class="btn btn-primary btn-table">Add</a>
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