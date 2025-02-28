<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Papan Informasi</h2>
        <ol class="breadcrumb">
            <a href="?page=formupload" class="btn btn-primary btn-table">Add</a>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">
                    <h2><span class="text-navy">PAPAN INFORMASI</span></h2>
                    <h2><span>Mabna Fatimah Az-Zahra</span></h2>
                    <p>Temukan informasi seputar mabna disini.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <form action="hapus_info.php" method="post" id="multi-delete-form">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Isi</th>
                                        <th>Tanggal Keluar</th>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "connection.php";
                                    $query = "SELECT * FROM informasi";
                                    $result = $koneksi->query($query);
                                    $no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $id_info = $row['id_info'];
                                        $judul = $row['judul'];
                                        $isi = $row['isi'];
                                        $tgl_keluar = $row['tgl_keluar'];
                                        $file = $row['file'];
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $judul; ?></td>
                                            <td><?php echo $isi; ?></td>
                                            <td><?php echo $tgl_keluar; ?></td>
                                            <td><a href="dokumen/<?php echo $file; ?>" target="_blank"><?php echo $file; ?></a></td>
                                            <td>
                                                <a href="mahasantri.php?page=edit_info&id_info=<?php echo $row['id_info']; ?>" class="btn btn-primary btn-table">Edit</a>
                                                <a href="hapus_info.php?id_info=<?php echo $row['id_info']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
