<?php
include 'connection.php';  // Connect to the database

// Fetch logged-in user's information (replace with your authentication logic)
$username = "admin";  // Example username (replace with actual logic to fetch username)

// Query to fetch the user's academic results
$query = "SELECT m.nim, m.nm_mhs, m.kamar, msy.nm_msy, k.nm_kls, g.nm_guru
FROM mahasantri m
LEFT JOIN musyrifah msy ON m.id_msy = msy.id_msy
LEFT JOIN kelas k ON m.nm_kls = k.nm_kls
LEFT JOIN guru g ON m.nm_guru = g.nm_guru
WHERE m.username = '$username'";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Handle query error
}
$row = mysqli_fetch_assoc($result);  // Fetch the user's academic data
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags and CSS links -->
</head>
<body>
    <!-- Your HTML structure for the page -->
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Kartu Hasil Studi</h2>
        </div>
        <div class="col-lg-2">
            <!-- Additional content if needed -->
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Kamar</th>
                                        <th>Nama Musyrifah</th>
                                        <th>Kelas</th>
                                        <th>Nama Guru</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row['nim']; ?></td>
                                        <td><?php echo $row['nm_mhs']; ?></td>
                                        <td><?php echo $row['kamar']; ?></td>
                                        <td><?php echo $row['nm_msy']; ?></td>
                                        <td><?php echo $row['nm_kls']; ?></td>
                                        <td><?php echo $row['nm_guru']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include necessary scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Other scripts as per your requirement -->
</body>
</html>
