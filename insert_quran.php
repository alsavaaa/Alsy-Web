<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2>Insert Nilai Quran</h2>
                </div>
                <div class="ibox-content">
                    <form action="aksi_insert_quran.php" method="post">
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
                        <input type="hidden" name="jenis" value="quran">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="?page=quran" class="btn btn-secondary">Cancel</a>
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
                                $query_quran = "SELECT n.id_nilai, n.nim, m.nm_mhs, n.jenis, n.nilai 
                                FROM nilai n 
                                JOIN mahasantri m ON n.nim = m.nim
                                WHERE n.jenis = 'quran'";
                                $result_quran = mysqli_query($koneksi, $query_quran);

                                if ($result_quran && mysqli_num_rows($result_quran) > 0) {
                                    while ($row = mysqli_fetch_assoc($result_quran)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['nim'] . "</td>";
                                        echo "<td>" . $row['nm_mhs'] . "</td>";
                                        echo "<td>" . $row['jenis'] . "</td>";
                                        echo "<td>" . $row['nilai'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Tidak ada data nilai Quran</td></tr>";
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