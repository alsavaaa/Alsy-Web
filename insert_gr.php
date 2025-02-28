<?php
include 'connection.php';

// Fetch kelas data for the dropdown
$query = "SELECT id_kls, nm_kls FROM kelas";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Display error message on query failure
}
?>

<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Insert Guru</h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Insert Data</h5>
                    <div class="ibox-content">
                        <form action="aksi_insert_gr.php" method="post">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Guru</th>
                                            <th>Kelas</th>
                                        </tr>
                                    </thead>
                                    <tbody id="guruRows">
                                        <tr>
                                            <td><input type="text" name="nm_gr[]" class="form-control" required></td>
                                            <td>
                                                <select name="id_kls[]" class="form-control" required>
                                                    <?php while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='" . $row['id_kls'] . "'>" . $row['nm_kls'] . "</option>";
                                                    } ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-default" onclick="addRow()">Add More</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="?page=guru" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>