<?php
$query = "SELECT m.nim, msy.nm_msy AS nama_msy, m.nm_mhs, m.alamat, k.nm_kls AS kelas, l.username
FROM mahasantri m
LEFT JOIN musyrifah msy ON m.id_msy = msy.id_msy
LEFT JOIN kelas k ON m.id_kls = k.id_kls
LEFT JOIN login l ON m.username = l.username
WHERE l.level = 'mahasantri'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Display error message if query fails
}?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><center> Mahasantri Mabna Fatimah Az-Zahra</h5>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <!-- Inside the form element -->
                                <!-- Data Table -->
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <!-- Table Headers -->
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>NIM</th>
                                            <th>Nama Mahasantri</th>
                                            <th>Alamat</th>
                                            <th>Kelas</th>
                                            <th>Musyrifah</th>
                                            <th>Username</th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td><input type='checkbox' class='checkbox' name='ids[]' value='" . $row['nim'] . "'></td>";
                                            echo "<td>" . $row['nim'] . "</td>";
                                            echo "<td>" . $row['nm_mhs'] . "</td>";
                                            echo "<td>" . $row['alamat'] . "</td>";
                                            echo "<td>" . $row['kelas'] . "</td>";
                                            echo "<td>" . $row['nama_msy'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <!-- Tfoot -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>