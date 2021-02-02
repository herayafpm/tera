<?= $this->extend('admin/template'); ?>
<?= $this->section('customcss'); ?>
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?= $this->endSection('customcss'); ?>
<?= $this->section('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <?= form_open() ?>
        <div class="form-group row">
          <label for="tera_ssrd_uang" class="col-sm-2 col-form-label">Uang</label>
          <div class="col-sm-4">
            <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_ssrd_uang') ? "is-invalid" : "") ?>" id="tera_ssrd_uang" name="tera_ssrd_uang" placeholder="Masukkan Nominal Uang" value="<?= old('tera_ssrd_uang') ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_ssrd_uang') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_ssrd_terbilang" class="col-md-2 col-form-label">Uang Terbilang</label>
          <div class="col-md-8">
            <textarea class="form-control form-control-sm <?= ($_validation->hasError('tera_ssrd_terbilang') ? "is-invalid" : "") ?>" id="tera_ssrd_terbilang" rows="3" name="tera_ssrd_terbilang" placeholder="Masukkan uang terbilang"><?= old('tera_ssrd_terbilang') ?></textarea>
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_ssrd_terbilang') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_ssrd_bank" class="col-sm-2 col-form-label">Bank</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_ssrd_bank') ? "is-invalid" : "") ?>" id="tera_ssrd_bank" name="tera_ssrd_bank" placeholder="Masukkan Nama Bank" value="<?= old('tera_ssrd_bank') ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_ssrd_bank') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_ssrd_no_rek" class="col-sm-2 col-form-label">No Rekening</label>
          <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_ssrd_no_rek') ? "is-invalid" : "") ?>" id="tera_ssrd_no_rek" name="tera_ssrd_no_rek" placeholder="Masukkan No Rekening" value="<?= old('tera_ssrd_no_rek') ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_ssrd_no_rek') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_ssrd_kd_rek" class="col-sm-2 col-form-label">Kode Rekening</label>
          <div class="col-sm-10">
            <input type="text" class=" form-control form-control-sm <?= ($_validation->hasError('tera_ssrd_kd_rek') ? "is-invalid" : "") ?>" id="tera_ssrd_kd_rek" name="tera_ssrd_kd_rek" placeholder="Masukkan Kode Rekening" value="<?= old('tera_ssrd_kd_rek', "000000000000000000") ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_ssrd_kd_rek') ?>
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
<script src="<?= base_url('assets/vendor') ?>/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
  $(document).ready(function() {
    $('#tera_ssrd_kd_rek').inputmask('string', {
      'alias': 'numeric',
      'mask': '99.99.99.99.99.99.99.99.99'
    })
    $(".money").inputmask('integer', {
      'removeMaskOnSubmit': true,
      'alias': 'numeric',
      'groupSeparator': '.',
      'autoGroup': true,
      'digitsOptional': false,
      'allowMinus': false,
      'placeholder': '0'
    });
  });
</script>
<?= $this->endSection('customjs'); ?>