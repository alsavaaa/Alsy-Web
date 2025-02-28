<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kritik</title>
    <!-- Include Inspinia CSS here -->
</head>
<body>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tambah Kritik</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="aksi_tambah_kritik.php">
                            <div class="form-group">
                                <label for="nim">NIM:</label>
                                <input type="text" name="nim" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="isi_kritik">Isi Kritik:</label>
                                <textarea name="isi_kritik" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <a href="?page=kritik_mhs" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
