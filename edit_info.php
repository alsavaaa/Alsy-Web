<?php
include 'connection.php';

$info = null; // Initialize $info as null

if (isset($_GET['id_info'])) {
    $id_info = $_GET['id_info'];

    $query = "SELECT * FROM informasi WHERE id_info = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id_info);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $info = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan atau tidak ada data untuk ditampilkan.";
    }

    $stmt->close();
} else {
    echo "Parameter id_info tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <div class="row border-bottom white-bg dashboard-header">
        <div class="col-lg-10">
            <h2>Edit Informasi</h2>
        </div>
    </div>
</head>
<body>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Informasi</h5>
                        <div class="ibox-content">
                            <?php if ($info): ?>
                                <form method="post" enctype="multipart/form-data" action="aksi_edit_info.php">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <input type="hidden" name="id_info" value="<?php echo $info['id_info']; ?>">
                                                    <td>Judul:</td>
                                                    <td><input type="text" name="judul" value="<?php echo htmlspecialchars($info['judul']); ?>" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Isi:</td>
                                                    <td><textarea name="isi" required><?php echo htmlspecialchars($info['isi']); ?></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Keluar:</td>
                                                    <td><input type="date" name="tgl_keluar" value="<?php echo htmlspecialchars($info['tgl_keluar']); ?>" required></td>
                                                </tr>
                                                <tr>
                                                    <td>File (PDF, JPG, JPEG, PNG):</td>
                                                    <td><input type="file" name="uproposal"></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><button type="submit" class="btn btn-primary">Update</button></td>
                                                </tr>
                                            </div>
                                        </tbody>
                                    </table>
                                </form>
                            <?php else: ?>
                                <p>Informasi tidak ditemukan atau tidak ada data untuk ditampilkan.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
