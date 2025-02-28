<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Insert Mahasantri</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="aksi_insert_mhs.php">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama Mahasantri</th>
                                        <th>Alamat</th>
                                        <th>Kelas</th>
                                        <th>Musyrifah</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Example row, you can use JavaScript to add more rows dynamically -->
                                    <tr>
                                        <td><input type="text" name="nim[]" class="form-control" required></td>
                                        <td><input type="text" name="nm_mhs[]" class="form-control" required></td>
                                        <td><input type="text" name="alamat[]" class="form-control"></td>
                                        <td>
                                            <select name="id_kls[]" class="form-control">
                                                <?php echo getClassOptions(); ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="id_msy[]" class="form-control">
                                                <?php echo getMusyrifahOptions(); ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="username[]" class="form-control" required></td>
                                        <td><input type="email" name="email[]" class="form-control" required></td>
                                        <td><input type="password" name="password[]" class="form-control" required></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="mahasantri.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php
    // Function to get options for Kelas dropdown
function getClassOptions()
{
    include 'connection.php';
    $query = "SELECT * FROM kelas";
    $result = mysqli_query($koneksi, $query);
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='" . $row['id_kls'] . "'>" . $row['nm_kls'] . "</option>";
    }
    return $options;
}

    // Function to get options for Musyrifah dropdown
function getMusyrifahOptions()
{
    include 'connection.php';
    $query = "SELECT * FROM musyrifah";
    $result = mysqli_query($koneksi, $query);
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='" . $row['id_msy'] . "'>" . $row['nm_msy'] . "</option>";
    }
    return $options;
}
?>
</body>

</html>