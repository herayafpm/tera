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
          <label for="tera_uttp_merk" class="col-sm-3 col-form-label">Merk</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_merk') ? "is-invalid" : "") ?>" id="tera_uttp_merk" name="tera_uttp_merk" placeholder="Masukkan Merk" value="<?= old('tera_uttp_merk', $_tera_uttp['tera_uttp_merk']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_merk') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_uttp_tipe" class="col-sm-3 col-form-label">Type</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_tipe') ? "is-invalid" : "") ?>" id="tera_uttp_tipe" name="tera_uttp_tipe" placeholder="Masukkan Type" value="<?= old('tera_uttp_tipe', $_tera_uttp['tera_uttp_tipe']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_tipe') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_uttp_no_seri" class="col-sm-3 col-form-label">Nomor Seri</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_no_seri') ? "is-invalid" : "") ?>" id="tera_uttp_no_seri" name="tera_uttp_no_seri" placeholder="Masukkan Nomor Seri" value="<?= old('tera_uttp_no_seri', $_tera_uttp['tera_uttp_no_seri']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_no_seri') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_uttp_buatan" class="col-sm-3 col-form-label">Buatan</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_buatan') ? "is-invalid" : "") ?>" id="tera_uttp_buatan" name="tera_uttp_buatan" placeholder="Masukkan Buatan" value="<?= old('tera_uttp_buatan', $_tera_uttp['tera_uttp_buatan']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_buatan') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_uttp_keterangan" class="col-sm-3 col-form-label">Keterangan / Media (Opsional)</label>
          <div class="col-sm-9">
            <textarea class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_keterangan') ? "is-invalid" : "") ?>" id="tera_uttp_keterangan" rows="4" name="tera_uttp_keterangan" placeholder="Masukkan Keterangan / Media (Opsional)"><?= old('tera_uttp_keterangan', $_tera_uttp['tera_uttp_keterangan']) ?></textarea>
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_keterangan') ?>
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