<?php
include 'connection.php';  // Connect to the database

// Retrieve data from the 'guru' table and join with 'kelas' table to get 'nm_kls'
$query = "SELECT guru.id_gr, guru.nm_gr, kelas.nm_kls 
FROM guru 
LEFT JOIN kelas ON guru.id_kls = kelas.id_kls";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));  // Display error message on query failure
}
?>
<!-- Page Header -->
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Muallim/ah</h2>
    </div>
</div>
<!-- Page Content -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Muallim-Muallimah Mabna Fatimah Az-Zahra</h5>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <!-- Inside the form element -->
                            <form action="hapus_gr.php" method="post" id="multi-delete-form">
                                <!-- Data Table -->
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <!-- Table Headers -->
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>Nama Muallim/ah</th>
                                            <th>Kelas</th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td><input type='checkbox' class='checkbox' name='ids[]' value='" . $row['id_gr'] . "'></td>";
                                            echo "<td>" . $row['nm_gr'] . "</td>";
                                            echo "<td>" . $row['nm_kls'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6" class="text-right">
                                                <button type="button" class="btn btn-danger btn-table" onclick="multiDelete()">Delete</button>
                                                <button type="button" class="btn btn-warning btn-table" onclick="editSelectedRow()">Edit</button>
                                                <a href="?page=insert_gr" class="btn btn-primary btn-table">Add</a>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include necessary scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

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
        selectedCheckboxes.forEach(function(checkbox) {
            ids.push(checkbox.value);
        });
                    var idString = ids.join(','); // Menggabungkan ID menjadi string terpisah dengan koma
                    window.location.href = 'edit_gr.php?ids=' + idString;
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
            </script>
        </body>

        </html>
