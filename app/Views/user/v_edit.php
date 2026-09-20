<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php echo form_open_multipart('user/update/' . $user['id_user']); ?>
        <div class="card-body">
            <div class="form-group">
                <label>Nama User</label>
                <input type="text" name="nama_user" value="<?= $user['nama_user'] ?>" class="form-group form-control" placeholder="Nama User" required>
            </div>

            <div class="form-group">
                <label>E-Mail</label>
                <input type="email" name="email" value="<?= $user['email'] ?>" class="form-group form-control" placeholder="E-Mail" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" value="<?= $user['password'] ?>" class="form-group form-control" placeholder="Password" required>
            </div>

            <div class="form-group">
                <label>Ganti Foto</label>
                <div class="row">
                    <div class="col-sm-3">
                        <img src="<?= base_url('foto/' . $user['foto']) ?>" width="100px" class="img-thumbnail">
                    </div>
                    <div class="col-sm-9">
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('user') ?>" class="btn btn-success">Kembali</a>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>