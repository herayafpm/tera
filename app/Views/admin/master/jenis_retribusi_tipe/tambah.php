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
          <label for="jenis_retribusi_tipe_nama" class="col-form-label">Nama Tipe</label>
          <input type="text" class="form-control col-sm-4 <?= ($_validation->hasError('jenis_retribusi_tipe_nama') ? "is-invalid" : "") ?>" id="jenis_retribusi_tipe_nama" name="jenis_retribusi_tipe_nama" placeholder="Masukkan nama tipe" value="<?= old('jenis_retribusi_tipe_nama') ?>">
          <div class="invalid-feedback">
            <?= $_validation->getError('jenis_retribusi_tipe_nama') ?>
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