<?php
include 'connection.php';  // Koneksi ke database
error_reporting(E_ALL^(E_NOTICE|E_WARNING));
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
?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><center> Welcome, <?php echo $nama; ?>!</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <!-- Menampilkan Informasi Pengguna -->
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Detail Profil</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        echo "<tr>";
                                        echo "<td><strong>NIM:</strong></td><td>$nim</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Nama:</strong></td><td>$nama</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Alamat:</strong></td><td>$alamat</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Kamar:</strong></td><td>$kamar</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Nama Musyrifah:</strong></td><td>$namaMusyrifah</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Kelas:</strong></td><td>$kelas</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><strong>Nama Guru:</strong></td><td>$namaGuru</td>";
                                        echo "</tr>";
                                    } else {
                                        echo "<tr><td colspan='2'>Data tidak ditemukan.</td></tr>";
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
</div>
