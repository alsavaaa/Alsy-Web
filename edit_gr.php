<?php
include 'connection.php';

// Get the IDs from the URL
$ids = $_GET['ids'];
$idArray = explode(',', $ids);

// Fetch the selected guru data
$query = "SELECT * FROM guru WHERE id_gr IN ($ids)";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));
}

// Fetch kelas data for the dropdown
$kelasQuery = "SELECT id_kls, nm_kls FROM kelas";
$kelasResult = mysqli_query($koneksi, $kelasQuery);

if (!$kelasResult) {
    die('Error: ' . mysqli_error($koneksi));
}
?>

<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Edit Guru</h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Data</h5>
                    <div class="ibox-content">
                        <form action="aksi_edit_gr.php" method="post">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Guru</th>
                                            <th>Kelas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><input type="text" name="nm_gr[]" class="form-control" value="<?php echo $row['nm_gr']; ?>" required></td>
                                                <td>
                                                    <select name="id_kls[]" class="form-control" required>
                                                        <?php
                                                        $kelasResult = mysqli_query($koneksi, $kelasQuery);
                                                        while ($kelasRow = mysqli_fetch_assoc($kelasResult)) {
                                                            $selected = ($kelasRow['id_kls'] == $row['id_kls']) ? 'selected' : '';
                                                            echo "<option value='" . $kelasRow['id_kls'] . "' $selected>" . $kelasRow['nm_kls'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <input type="hidden" name="id_gr[]" value="<?php echo $row['id_gr']; ?>">
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="?page=guru" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>