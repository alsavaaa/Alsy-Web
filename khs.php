<?php
include 'connection.php';  // Koneksi ke database
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
ob_start();

// Memulai session jika belum dimulai
session_start();

// Memastikan session 'username' ada dan tidak kosong
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // Jika tidak ada session 'username', Anda bisa redirect ke halaman login atau tindakan lainnya
    header("Location: login.php");
    exit();
}

// Mengambil nilai username dari session
$username = $_SESSION['username'];

// Query untuk mengambil data profil berdasarkan username
$query = "SELECT m.nim, m.nm_mhs, m.alamat, msy.kamar, msy.nm_msy, k.nm_kls, g.nm_gr
FROM mahasantri m
LEFT JOIN musyrifah msy ON m.id_msy = msy.id_msy
LEFT JOIN kelas k ON m.id_kls = k.id_kls
LEFT JOIN guru g ON k.id_kls = g.id_kls
LEFT JOIN login l ON m.username = l.username
WHERE l.username = '$username'";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Menampilkan pesan kesalahan jika query gagal
}

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nim = $row['nim'];
    $nama = $row['nm_mhs'];
    $alamat = $row['alamat'];
    $kamar = $row['kamar'];
    $namaMusyrifah = $row['nm_msy'];
    $kelas = $row['nm_kls'];
    $namaGuru = $row['nm_gr'];
} else {
    $nim = '';
    $nama = '';
    $alamat = '';
    $kamar = '';
    $namaMusyrifah = '';
    $kelas = '';
    $namaGuru = '';
}

if (empty($nim)) {
    die('Error: NIM tidak ditemukan.');
}

// Query untuk mengambil data rekap nilai berdasarkan nim
$queryRekap = "SELECT 
MAX(CASE WHEN n.jenis = 'afkar' THEN n.nilai ELSE NULL END) AS nilai_afkar,
MAX(CASE WHEN n.jenis = 'quran' THEN n.nilai ELSE NULL END) AS nilai_quran,
MAX(CASE WHEN n.jenis = 'arab' THEN n.nilai ELSE NULL END) AS nilai_arab,
MAX(CASE WHEN n.jenis = 'inggris' THEN n.nilai ELSE NULL END) AS nilai_inggris,
SUM(n.nilai) AS total,
AVG(n.nilai) AS rata,
CASE WHEN AVG(n.nilai) >= 60 THEN 'Lulus' ELSE 'Tidak Lulus' END AS status
FROM nilai n
WHERE n.nim = '$nim'";

$resultRekap = mysqli_query($koneksi, $queryRekap);

if (!$resultRekap) {
    die('Error: ' . mysqli_error($koneksi));  // Menampilkan pesan kesalahan jika query gagal
}
?>
<body>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><center>Welcome, <?php echo $nama; ?>!</center></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <!-- Menampilkan Informasi Pengguna dan Nilai -->
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Detail Profil</th>
                                        <th>Informasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>NIM:</strong></td>
                                        <td><?php echo $nim; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama:</strong></td>
                                        <td><?php echo $nama; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Alamat:</strong></td>
                                        <td><?php echo $alamat; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kamar:</strong></td>
                                        <td><?php echo $kamar; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Musyrifah:</strong></td>
                                        <td><?php echo $namaMusyrifah; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kelas:</strong></td>
                                        <td><?php echo $kelas; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Muallim/ah:</strong></td>
                                        <td><?php echo $namaGuru; ?></td>
                                    </tr>
                                    <?php
                                    if ($resultRekap && mysqli_num_rows($resultRekap) > 0) {
                                        $rowRekap = mysqli_fetch_assoc($resultRekap);
                                        $nilai_afkar = $rowRekap['nilai_afkar'];
                                        $nilai_quran = $rowRekap['nilai_quran'];
                                        $nilai_arab = $rowRekap['nilai_arab'];
                                        $nilai_inggris = $rowRekap['nilai_inggris'];
                                        $total = $rowRekap['total'];
                                        $rata = $rowRekap['rata'];
                                        $status = $rowRekap['status'];

                                        echo "<tr>";
                                        echo "<td><strong>Nilai Afkar:</strong></td><td>$nilai_afkar</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Nilai Quran:</strong></td><td>$nilai_quran</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Nilai Arab:</strong></td><td>$nilai_arab</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Nilai Inggris:</strong></td><td>$nilai_inggris</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Total Nilai:</strong></td><td>$total</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Rata-rata:</strong></td><td>$rata</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Status:</strong></td><td>$status</td>";
                                        echo "</tr>";
                                    } else {
                                        echo "<tr><td colspan='2'>Data nilai tidak ditemukan.</td></tr>";
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
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy' },
                    { extend: 'csv' },
                    { extend: 'excel', title: 'ExampleFile' },
                    { extend: 'pdf', title: 'ExampleFile' },
                    {
                        extend: 'print',
                        customize: function (win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                        }
                    }
                    ]
            });
        });
    </script>
</body>