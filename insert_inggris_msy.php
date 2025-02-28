<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2>Insert Nilai Inggris</h2>
                </div>
                <div class="ibox-content">
                    <form action="aksi_insert_inggris_msy.php" method="post">
                        <div class="form-group">
                            <label for="nim">NIM:</label>
                            <select class="form-control" id="nim" name="nim" required>
                                <?php
                                // Mengambil data Mahasantri dari database untuk dropdown NIM
                                $query_mahasantri = "SELECT nim, nm_mhs FROM mahasantri";
                                $result_mahasantri = mysqli_query($koneksi, $query_mahasantri);

                                if ($result_mahasantri && mysqli_num_rows($result_mahasantri) > 0) {
                                    while ($row = mysqli_fetch_assoc($result_mahasantri)) {
                                        echo "<option value='" . $row['nim'] . "'>" . $row['nim'] . " - " . $row['nm_mhs'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Tidak ada data Mahasantri</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nilai">Nilai:</label>
                            <input type="number" class="form-control" id="nilai" name="nilai" required>
                        </div>
                        <input type="hidden" name="jenis" value="inggris">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="?page=inggris_msy" class="btn btn-secondary">Cancel</a>
                    </form>

                    <!-- Tabel untuk menampilkan data nilai Afkar -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama Mahasantri</th>
                                    <th>Jenis</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    // Ambil data nilai Afkar dari database
                                $query_inggris = "SELECT n.id_nilai, n.nim, m.nm_mhs, n.jenis, n.nilai 
                                FROM nilai n 
                                JOIN mahasantri m ON n.nim = m.nim
                                WHERE n.jenis = 'inggris'";
                                $result_inggris = mysqli_query($koneksi, $query_inggris);

                                if ($result_inggris && mysqli_num_rows($result_inggris) > 0) {
                                    while ($row = mysqli_fetch_assoc($result_inggris)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['nim'] . "</td>";
                                        echo "<td>" . $row['nm_mhs'] . "</td>";
                                        echo "<td>" . $row['jenis'] . "</td>";
                                        echo "<td>" . $row['nilai'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Tidak ada data nilai Inggris</td></tr>";
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

<!-- Include jQuery and Bootstrap JS -->
<script src="path/to/jquery.min.js"></script>
<script src="path/to/bootstrap.min.js"></script>