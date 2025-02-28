<?php
include 'connection.php';

// Fetch kritik and tanggapan data
$query = "
SELECT k.id_kritik, k.nim, k.isi_kritik, t.username, t.isi_tanggapan 
FROM kritik k
LEFT JOIN tanggapan t ON k.id_kritik = t.id_kritik
ORDER BY k.id_kritik DESC, t.id_tanggapan ASC
";
$result = $koneksi->query($query);
$kritik = [];

while ($row = $result->fetch_assoc()) {
    $kritik[$row['id_kritik']]['nim'] = $row['nim'];
    $kritik[$row['id_kritik']]['isi_kritik'] = $row['isi_kritik'];
    if ($row['username']) {
        $kritik[$row['id_kritik']]['tanggapan'][] = [
            'username' => $row['username'],
            'isi_tanggapan' => $row['isi_tanggapan']
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kritik dan Tanggapan</title>
    <!-- Include Inspinia CSS here -->
    <style>
        .reply-form {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Kritik dan Tanggapan</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="feed-activity-list">
                            <?php foreach ($kritik as $id_kritik => $data): ?>
                                <div class="feed-element">
                                    <div>
                                        <strong>Anonymous</strong> <!-- Display as Anonymous -->
                                        <div class="well">
                                            <?php echo htmlspecialchars($data['isi_kritik']); ?>
                                        </div>
                                        <?php if (!empty($data['tanggapan'])): ?>
                                            <?php foreach ($data['tanggapan'] as $tanggapan): ?>
                                                <div style="margin-left: 20px;">
                                                    <strong><?php echo htmlspecialchars($tanggapan['username']); ?></strong>
                                                    <div class="well">
                                                        <?php echo htmlspecialchars($tanggapan['isi_tanggapan']); ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="?page=kritik" class="btn btn-primary">Tambah Kritik</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.reply-button').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const form = document.getElementById('reply-form-' + id);
                form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>
