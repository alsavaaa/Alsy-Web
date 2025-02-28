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
$query = "SELECT m.nim, m.nm_mhs, m.alamat, msy.kamar, msy.nm_msy, k.nm_kls, l.username
FROM mahasantri m
LEFT JOIN musyrifah msy ON m.id_msy = msy.id_msy
LEFT JOIN kelas k ON m.id_kls = k.id_kls
LEFT JOIN login l ON m.username = l.username
WHERE l.username = '$username'";

$result = mysqli_query($koneksi, $query);

// Set the default page
$page = isset($_GET['page']) ? $_GET['page'] : 'datamhs';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMFAZA</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .btn-table {
            width: 70px;
            padding: 2px 5px;
            font-size: 12px;
            margin: 0 3px;
        }

        .table-responsive {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <!-- User Profile -->
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span>
                                <img alt="image" class="img-circle" src="faza no bg.png" style="width: 50px; height: 50px;" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs">
                                        <strong class="font-bold">Fatimah Az-Zahra</strong>
                                    </span>
                                    <span class="text-muted text-xs block">Ma'had Sunan Ampel Al-'Aly</span>
                                </span>
                            </a>
                        </div>
                    </li>
                    <!-- Menu Items -->
                    <li>
                        <a href="homemhs.php"><i class="fa fa-th-large"></i> <span class="nav-label">Profil</span></a>
                    </li>
                    <li>
                        <a href="?page=khs"><i class="fa fa-desktop"></i> <span class="nav-label">Kartu Hasil Studi</span></a>
                    </li>
                    <li>
                        <a href="?page=prestasi_mhs"><i class="fa fa-diamond"></i> <span class="nav-label">Prestasi</span></a>
                    </li>
                    <li>
                        <a href="?page=layouts_msy"><i class="fa fa-desktop"></i> <span class="nav-label">Informasi</span></a>
                    </li>
                    <li>
                        <a href="?page=kritik_mhs"><i class="fa fa-envelope"></i> <span class="nav-label">Kritik & Tanggapan</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Page Content -->
        <div id="page-wrapper" class="gray-bg">
            <!-- Top Navigation -->
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Hai! Welcome to SIMFAZA</span>
                        </li>
                        <li>
                            <a href="login.php">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Page Header -->
            <?php
            $file = "$page.php";
            if (file_exists($file) && strlen($page) <= 30) {
                include($file);
            } else {
                include("datamhs.php");
            }
            ?>

            <!-- Include necessary scripts -->
            <script src="js/jquery-3.1.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
            <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

            <script src="js/plugins/dataTables/datatables.min.js"></script>

            <!-- Custom and plugin javascript -->
            <script src="js/inspinia.js"></script>
            <script src="js/plugins/pace/pace.min.js"></script>

            <!-- Toastr -->
            <script src="js/plugins/toastr/toastr.min.js"></script>

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

                                    $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                                }
                            }
                            ]

                    });

                });
            </script>

        </div>
    </body>

    </html>
