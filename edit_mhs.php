<?php
include 'connection.php';  // Include your database connection file

$ids = $_GET['ids'];
$id_array = explode(',', $ids);

$musyrifah_query = "SELECT id_msy, nm_msy FROM musyrifah";
$musyrifah_result = mysqli_query($koneksi, $musyrifah_query);

$kelas_query = "SELECT id_kls, nm_kls FROM kelas";
$kelas_result = mysqli_query($koneksi, $kelas_query);

$mahasantri_query = "SELECT * FROM mahasantri WHERE nim IN ('" . implode("','", $id_array) . "')";
    $mahasantri_result = mysqli_query($koneksi, $mahasantri_query);

    $mahasantri_data = [];
    while ($row = mysqli_fetch_assoc($mahasantri_result)) {
        $mahasantri_data[] = $row;
    }
    ?>

    <!-- Page Header -->
    <div class="row border-bottom white-bg dashboard-header">
        <div class="col-lg-10">
            <h2>Edit Mahasantri</h2>
        </div>
    </div>
    <!-- Page Content -->
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Form to edit multiple Mahasantri</h5>
                        <div class="ibox-content">
                            <form method="post" action="aksi_edit_mhs.php">
                                <table class="table table-bordered" id="editTable">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Username</th>
                                            <th>Nama Mahasantri</th>
                                            <th>Alamat</th>
                                            <th>Nama Kelas</th>
                                            <th>Nama Musyrifah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($mahasantri_data as $data) { ?>
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="id[]" value="<?= $data['nim'] ?>">
                                                    <input type="text" name="nim[]" class="form-control" value="<?= $data['nim'] ?>" required>
                                                </td>
                                                <td><input type="text" name="username[]" class="form-control" value="<?= $data['username'] ?>" required></td>
                                                <td><input type="text" name="nm_mhs[]" class="form-control" value="<?= $data['nm_mhs'] ?>" required></td>
                                                <td><input type="text" name="alamat[]" class="form-control" value="<?= $data['alamat'] ?>" required></td>
                                                <td>
                                                    <select name="id_kls[]" class="form-control" required>
                                                        <?php
                                                    mysqli_data_seek($kelas_result, 0); // Reset result pointer to the start
                                                    while ($kelas = mysqli_fetch_assoc($kelas_result)) {
                                                        $selected = $kelas['id_kls'] == $data['id_kls'] ? 'selected' : '';
                                                        echo "<option value='{$kelas['id_kls']}' $selected>{$kelas['nm_kls']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="id_msy[]" class="form-control" required>
                                                    <?php
                                                    mysqli_data_seek($musyrifah_result, 0); // Reset result pointer to the start
                                                    while ($musyrifah = mysqli_fetch_assoc($musyrifah_result)) {
                                                        $selected = $musyrifah['id_msy'] == $data['id_msy'] ? 'selected' : '';
                                                        echo "<option value='{$musyrifah['id_msy']}' $selected>{$musyrifah['nm_msy']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="?page=datamahasantri" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
