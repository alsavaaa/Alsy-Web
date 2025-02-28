<!-- Page Header -->
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Add Musyrifah</h2>
    </div>
</div>
<!-- Page Content -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add New Musyrifah</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="aksi_insert_msy.php" id="multi-insert-form">
                        <div id="multi-insert-container">
                            <div class="multi-insert-row">
                                <div class="form-group">
                                    <label for="username[]">Username</label>
                                    <input type="text" class="form-control" id="username[]" name="username[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="password[]">Password</label>
                                    <input type="password" class="form-control" id="password[]" name="password[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="email[]">Email</label>
                                    <input type="email" class="form-control" id="email[]" name="email[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="nm_msy[]">Nama Musyrifah</label>
                                    <input type="text" class="form-control" id="nm_msy[]" name="nm_msy[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="kamar[]">Kamar</label>
                                    <input type="text" class="form-control" id="kamar[]" name="kamar[]">
                                </div>
                                <div class="form-group">
                                    <label for="divisi[]">Divisi</label>
                                    <input type="text" class="form-control" id="divisi[]" name="divisi[]">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" onclick="addRow()">Add Another Musyrifah</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="?page=musyrifah" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script>
    function addRow() {
        var container = document.getElementById('multi-insert-container');
        var newRow = document.createElement('div');
        newRow.className = 'multi-insert-row';
        newRow.innerHTML = `
        <div class="form-group">
        <label for="username[]">Username</label>
        <input type="text" class="form-control" id="username[]" name="username[]" required>
        </div>
        <div class="form-group">
        <label for="password[]">Password</label>
        <input type="password" class="form-control" id="password[]" name="password[]" required>
        </div>
        <div class="form-group">
        <label for="email[]">Email</label>
        <input type="email" class="form-control" id="email[]" name="email[]" required>
        </div>
        <div class="form-group">
        <label for="nm_msy[]">Nama Musyrifah</label>
        <input type="text" class="form-control" id="nm_msy[]" name="nm_msy[]" required>
        </div>
        <div class="form-group">
        <label for="kamar[]">Kamar</label>
        <input type="text" class="form-control" id="kamar[]" name="kamar[]">
        </div>
        <div class="form-group">
        <label for="divisi[]">Divisi</label>
        <input type="text" class="form-control" id="divisi[]" name="divisi[]">
        </div>
        `;
        container.appendChild(newRow);
    }
</script>
