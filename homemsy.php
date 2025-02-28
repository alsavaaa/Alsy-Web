<?php
include 'connection.php';  // Connect to the database
error_reporting(E_ALL^(E_NOTICE|E_WARNING));
ob_start();
$page=htmlentities($_GET['page']);
// Retrieve data from the Mahasantri table
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
                        <a href="homemsy.php"><i class="fa fa-th-large"></i> <span class="nav-label">Menu</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="?page=musyrifah_msy">Musyrifah</a></li>
                            <li><a href="?page=mahasantri_msy">Mahasantri</a></li>
                            <li><a href="?page=guru_msy">Muallim/ah</a></li>
                            <li><a href="?page=kelas_msy">Kelas</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Nilai</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="?page=afkar_msy">Taklim Afkar</a></li>
                            <li><a href="?page=quran_msy">Taklim Quran</a></li>
                            <li><a href="?page=arab_msy">Bahasa Arab</a></li>
                            <li><a href="?page=inggris_msy">Bahasa Inggris</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="?page=layouts_msy"><i class="fa fa-desktop"></i> <span class="nav-label">Informasi</span></a>
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
                            <span class="m-r-sm text-muted welcome-message">Hai Kakak! Welcome to SIMFAZA</span>
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
            <!-- <div class="row border-bottom white-bg dashboard-header">
                <div class="col-lg-10">
                    <h2>Mahasantri</h2>
                </div>
            </div> -->
            <!-- Page Content -->
            <?php
            $file="$page.php";
            $cek=strlen($page);
            if($cek>30||!file_exists($file)||empty($page)){
                include("datamsy.php");
            } else {
                include($file);
            }?>

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
                function editSelectedRow() {
                    var selectedCheckboxes = document.querySelectorAll('.checkbox:checked');
                    if (selectedCheckboxes.length === 0) {
                        toastr.warning('Please select at least one row to edit.');
                        return;
                    }
                    var ids = [];
                    selectedCheckboxes.forEach(function (checkbox) {
                        ids.push(checkbox.value);
                    });

                    var idString = ids.join(',');

                    var currentPage = window.location.href.split('?')[1] || '';

                    var updatePage;
                    if (currentPage === 'page=datamsy'){
                        updatePage = 'homemsy.php?page=edit_mhs';
                    } else if (currentPage === 'page=musyrifah'){
                        updatePage = 'homemsy.php?page=edit_msy';
                    } else if (currentPage === 'page=guru'){
                        updatePage = 'homemsy.php?page=edit_gr';
                    } else if (currentPage === 'page=kelas'){
                        updatePage = 'homemsy.php?page=edit_kls';
                    } else if (currentPage === 'page=afkar_msy'){
                        updatePage = 'homemsy.php?page=edit_afkar_msy';
                    } else if (currentPage === 'page=quran_msy'){
                        updatePage = 'homemsy.php?page=edit_quran_msy';
                    } else if (currentPage === 'page=arab_msy'){
                        updatePage = 'homemsy.php?page=edit_arab_msy';
                    } else if (currentPage === 'page=inggris_msy'){
                        updatePage = 'homemsy.php?page=edit_inggris_msy';
                    }else {
                        alert = ('Halaman tidak dikenal');
                    }

                    window.location.href = updatePage + '&ids=' + idString;
                }

                // Function to submit the form for multi-delete
                function multiDelete() {
                    if (confirm('Are you sure you want to delete selected rows?')) {
                        document.getElementById('multi-delete-form').submit();
                    }
                }

                // Check/Uncheck all checkboxes
                document.getElementById('checkAll').onclick = function() {
                    var checkboxes = document.querySelectorAll('.checkbox');
                    for (var checkbox of checkboxes) {
                        checkbox.checked = this.checked;
                    }
                };
                $(document).ready(function(){
                    $('.dataTables-example').DataTable({
                        pageLength: 25,
                        responsive: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [
                            { extend: 'copy'},
                            {extend: 'csv'},
                            {extend: 'excel', title: 'ExampleFile'},
                            {extend: 'pdf', title: 'ExampleFile'},

                            {extend: 'print',
                            customize: function (win){
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
        </body>

        </html>
