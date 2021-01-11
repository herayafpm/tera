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
          <label for="jenis_uttp_nama" class="col-form-label">Jenis</label>
          <input type="text" class="form-control col-sm-4 <?= ($_validation->hasError('jenis_uttp_nama') ? "is-invalid" : "") ?>" id="jenis_uttp_nama" name="jenis_uttp_nama" placeholder="Masukkan nama jenis" value="<?= old('jenis_uttp_nama', $_jenis_uttp['jenis_uttp_nama']) ?>">
          <div class="invalid-feedback">
            <?= $_validation->getError('jenis_uttp_nama') ?>
          </div>
        </div>
        <div class="form-group">
          <label for="jenis_uttp_tipe_id" class="col-sm-12 col-form-label">Tipe</label>
          <select class="col-sm-4 custom-select <?= ($_validation->hasError('jenis_uttp_tipe_id') ? "is-invalid" : "") ?>" id="jenis_uttp_tipe_id" name="jenis_uttp_tipe_id">
            <option value="">-- Tipe --</option>
            <?php foreach ($_jenis_uttp_tipes as $jenis_uttp_tipe) : ?>
              <option value="<?= $jenis_uttp_tipe['jenis_uttp_tipe_id'] ?>" <?= (old('jenis_uttp_tipe_id', $_jenis_uttp['jenis_uttp_tipe_id']) == $jenis_uttp_tipe['jenis_uttp_tipe_id']) ? "selected" : "" ?>><?= $jenis_uttp_tipe['jenis_uttp_tipe_nama'] ?></option>
            <?php endforeach ?>
          </select>
          <div class="invalid-feedback">
            <?= $_validation->getError('jenis_uttp_tipe_id') ?>
          </div>
          <p class="text-info">* Boleh dilewati</p>
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" name="jenis_uttp_tempat_pakai" id="jenis_uttp_tempat_pakai" <?= (old('jenis_uttp_tempat_pakai', $_jenis_uttp['jenis_uttp_tempat_pakai']) == 1) ? "checked" : "" ?>>
            <label class="form-check-label" for="jenis_uttp_tempat_pakai">
              Bisa di tempat pakai?
            </label>
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
<?= $this->endSection('customjs'); ?>