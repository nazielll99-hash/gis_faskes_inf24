<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">

      <?php echo form_open() ?>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>nama wilayah</label>
            <input name="nama_wilayah" class="form-control">
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label>warna wilayah</label>
            <input name="warna" class="form-control my-colorpicker1">
          </div>
        </div>

        <div class="form-group">
          <label>GeoJSON</label>
          <textarea name="geojson" class="form-control" cols="125" rows="10"></textarea>
        </div>

        <button class="btn btn-primary" type="submit">simpan</button>
        <a href="<?= base_url('wilayah') ?>" class="btn btn-success btn-flat">kembali</a>



        <?php echo form_close() ?>
      </div>
    </div>
  </div>

  <script>
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
  </script>