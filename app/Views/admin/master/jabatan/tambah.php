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
          <label for="jabatan_nama" class="col-form-label">Jabatan</label>
          <input type="text" class="form-control col-sm-4 <?= ($_validation->hasError('jabatan_nama') ? "is-invalid" : "") ?>" id="jabatan_nama" name="jabatan_nama" placeholder="Masukkan jabatan" value="<?= old('jabatan_nama') ?>">
          <div class="invalid-feedback">
            <?= $_validation->getError('jabatan_nama') ?>
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