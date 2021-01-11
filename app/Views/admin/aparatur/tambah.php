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
          <label for="aparatur_nama" class="col-form-label">Nama</label>
          <input type="text" class="form-control col-sm-4 <?= ($_validation->hasError('aparatur_nama') ? "is-invalid" : "") ?>" id="aparatur_nama" name="aparatur_nama" placeholder="Masukkan nama" value="<?= old('aparatur_nama') ?>">
          <div class="invalid-feedback">
            <?= $_validation->getError('aparatur_nama') ?>
          </div>
        </div>
        <div class="form-group">
          <label for="aparatur_nip" class="col-form-label">NIP</label>
          <input type="text" data-inputmask="'mask': '99999999 999999 9 999','removeMaskOnSubmit': true" class=" form-control col-sm-4 <?= ($_validation->hasError('aparatur_nip') ? "is-invalid" : "") ?>" id="aparatur_nip" name="aparatur_nip" placeholder="Masukkan NIP" value="<?= old('aparatur_nip') ?>">
          <div class="invalid-feedback">
            <?= $_validation->getError('aparatur_nip') ?>
          </div>
        </div>
        <div class="form-group">
          <label for="aparatur_pangkat" class="col-sm-12 col-form-label">Pangkat / Golongan</label>
          <select class="col-sm-4 custom-select <?= ($_validation->hasError('aparatur_pangkat') ? "is-invalid" : "") ?>" id="aparatur_pangkat" name="aparatur_pangkat">
            <option value="">-- Pangkat / Golongan --</option>
            <?php foreach ($_pangkats as $pangkat) : ?>
              <option value="<?= $pangkat ?>" <?= (old('aparatur_pangkat') == $pangkat) ? "selected" : "" ?>><?= $pangkat ?></option>
            <?php endforeach ?>
          </select>
          <div class="invalid-feedback">
            <?= $_validation->getError('aparatur_pangkat') ?>
          </div>
        </div>
        <div class="form-group">
          <label for="jabatan_id" class="col-sm-12 col-form-label">Jabatan</label>
          <select class="col-sm-4 custom-select <?= ($_validation->hasError('jabatan_id') ? "is-invalid" : "") ?>" id="jabatan_id" name="jabatan_id">
            <option value="">-- Jabatan --</option>
            <?php foreach ($_jabatans as $jabatan) : ?>
              <option value="<?= $jabatan['jabatan_id'] ?>" <?= (old('jabatan_id') == $jabatan['jabatan_id']) ? "selected" : "" ?>><?= $jabatan['jabatan_nama'] ?></option>
            <?php endforeach ?>
          </select>
          <div class="invalid-feedback">
            <?= $_validation->getError('jabatan_id') ?>
          </div>
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
    $(":input").inputmask();
  });
</script>
<?= $this->endSection('customjs'); ?>