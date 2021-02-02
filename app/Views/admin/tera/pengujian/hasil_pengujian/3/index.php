<?= $this->extend('admin/template'); ?>
<?= $this->section('customcss'); ?>
<?= $this->endSection('customcss'); ?>
<?= $this->section('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <?= form_open() ?>
        <div class="form-group row">
          <label for="tera_uttp_merk" class="col-sm-2 col-form-label">Merk / Type / Nomor Seri</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_merk') ? "is-invalid" : "") ?>" id="tera_uttp_merk" name="tera_uttp_merk" placeholder="Masukkan Merk / Type / Nomor Seri" value="<?= old('tera_uttp_merk', $_tera_uttp['tera_uttp_merk']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_merk') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_uttp_merk_kendaraan" class="col-sm-2 col-form-label">Merk Kendaraan</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_merk_kendaraan') ? "is-invalid" : "") ?>" id="tera_uttp_merk_kendaraan" name="tera_uttp_merk_kendaraan" placeholder="Masukkan Merk Kendaraan" value="<?= old('tera_uttp_merk_kendaraan', $_tera_uttp['tera_uttp_merk_kendaraan']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_merk_kendaraan') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_uttp_no_polisi" class="col-sm-2 col-form-label">No. Polisi dan No. Lambung</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_no_polisi') ? "is-invalid" : "") ?>" id="tera_uttp_no_polisi" name="tera_uttp_no_polisi" placeholder="Masukkan No. Polisi dan No. Lambung" value="<?= old('tera_uttp_no_polisi', $_tera_uttp['tera_uttp_no_polisi']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_no_polisi') ?>
            </div>
          </div>
        </div>
        <button class="btn btn-primary py-2 px-3" type="submit"><i class="fas fa-fw fa-save"></i> Simpan</button>
        <a class="btn btn-secondary py-2 px-3" role="button" href="<?= $_url_back ?>"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?= form_close() ?>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<?= $this->endSection('content'); ?>
<?= $this->section('customjs'); ?>
<script>
</script>
<?= $this->endSection('customjs'); ?>