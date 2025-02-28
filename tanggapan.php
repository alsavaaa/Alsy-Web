<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tanggapan</title>
    <!-- Include Inspinia CSS here -->
</head>
<body>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tambah Tanggapan</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="aksi_tambah_tanggapan.php">
                            <div class="form-group">
                                <label for="id_kritik">ID Kritik:</label>
                                <input type="text" name="id_kritik" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="isi_tanggapan">Isi Tanggapan:</label>
                                <textarea name="isi_tanggapan" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
