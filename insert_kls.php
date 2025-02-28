<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Insert New Kelas</h5>
                </div>
                <div class="ibox-content">
                    <form action="aksi_insert_kls.php" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Kelas:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nm_kls" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kapasitas:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="kapasitas" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <a href="?page=kelas" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>