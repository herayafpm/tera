<?= $this->extend('admin/template'); ?>
<?= $this->section('customcss'); ?>
<?= $this->endSection('customcss'); ?>
<?= $this->section('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <?= form_open() ?>
        <div class="form-group">
          <label for="jenis_retribusi_nama" class="col-form-label">Nama Retribusi</label>
          <input type="text" class="form-control col-sm-4 <?= ($_validation->hasError('jenis_retribusi_nama') ? "is-invalid" : "") ?>" id="jenis_retribusi_nama" name="jenis_retribusi_nama" placeholder="Masukkan nama jenis" value="<?= old('jenis_retribusi_nama') ?>">
          <div class="invalid-feedback">
            <?= $_validation->getError('jenis_retribusi_nama') ?>
          </div>
        </div>
        <div class="form-group">
          <label for="jenis_retribusi_tipe_id" class="col-sm-12 col-form-label">Tipe</label>
          <select class="col-sm-4 custom-select <?= ($_validation->hasError('jenis_retribusi_tipe_id') ? "is-invalid" : "") ?>" id="jenis_retribusi_tipe_id" name="jenis_retribusi_tipe_id">
            <option value="">-- Tipe --</option>
            <?php foreach ($_jenis_retribusi_tipes as $jenis_retribusi_tipe) : ?>
              <option value="<?= $jenis_retribusi_tipe['jenis_retribusi_tipe_id'] ?>" <?= (old('jenis_retribusi_tipe_id') == $jenis_retribusi_tipe['jenis_retribusi_tipe_id']) ? "selected" : "" ?>><?= $jenis_retribusi_tipe['jenis_retribusi_tipe_nama'] ?></option>
            <?php endforeach ?>
          </select>
          <div class="invalid-feedback">
            <?= $_validation->getError('jenis_retribusi_tipe_id') ?>
          </div>
        </div>
        <div class="form-group">
          <?php foreach ($_jenis_teras as $jenis_tera) : ?>
            <div class="row">
              <?php foreach ($_jenis_tempats as $jenis_tempat) : ?>
                <div class="col-md-4">
                  <label for="">Tarif <?= $jenis_tera['jenis_tera_nama'] ?> <?= $jenis_tempat['jenis_tempat_nama'] ?></label>
                  <input type="text" class="form-control jenis_retribusi_tarif" name="jenis_retribusi_tarif-<?= $jenis_tera['jenis_tera_id'] ?>-<?= $jenis_tempat['jenis_tempat_id'] ?>" placeholder="Masukkan Tarif" value="<?= old("jenis_retribusi_tarif-" . $jenis_tera['jenis_tera_id'] . "-" . $jenis_tempat['jenis_tempat_id']) ?>">
                  <p class="text-info">* kosongi jika tidak ada</p>
                </div>
              <?php endforeach ?>
            </div>
          <?php endforeach ?>
        </div>
        <button class="btn btn-primary py-2 px-3" type="submit">Simpan</button>
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
    $(".jenis_retribusi_tarif").inputmask('integer', {
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