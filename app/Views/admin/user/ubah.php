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
          <label for="user_nama" class="col-form-label">Nama</label>
          <input type="text" class="form-control col-sm-4 <?= ($_validation->hasError('user_nama') ? "is-invalid" : "") ?>" id="user_nama" name="user_nama" placeholder="Masukkan nama" value="<?= old('user_nama', $_user['user_nama']) ?>">
          <div class="invalid-feedback">
            <?= $_validation->getError('user_nama') ?>
          </div>
        </div>
        <div class="form-group">
          <label for="user_nik" class="col-form-label">NIK</label>
          <input type="text" data-inputmask="'mask': '9', 'repeat': 16, 'greedy' : false" class="form-control col-sm-4 <?= ($_validation->hasError('user_nik') ? "is-invalid" : "") ?>" id="user_nik" name="user_nik" placeholder="Masukkan NIK" value="<?= old('user_nik', $_user['user_nik']) ?>">
          <div class="invalid-feedback">
            <?= $_validation->getError('user_nik') ?>
          </div>
        </div>
        <div class="form-group">
          <label for="user_alamat">Alamat</label>
          <textarea class="form-control col-sm-4 <?= ($_validation->hasError('user_alamat') ? "is-invalid" : "") ?>" id="user_alamat" rows="3" name="user_alamat" placeholder="Masukkan Alamat"><?= old('user_alamat', $_user['user_alamat']) ?></textarea>
          <div class="invalid-feedback">
            <?= $_validation->getError('user_alamat') ?>
          </div>
        </div>
        <div class="form-group">
          <label for="user_telepon" class="col-form-label">No Telepon Aktif</label>
          <input type="text" class="form-control col-sm-4 <?= ($_validation->hasError('user_telepon') ? "is-invalid" : "") ?>" id="user_telepon" name="user_telepon" placeholder="Masukkan No Telepon Aktif" value="<?= old('user_telepon', $_user['user_telepon']) ?>">
          <div class="invalid-feedback">
            <?= $_validation->getError('user_telepon') ?>
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
  $(function() {
    $(":input").inputmask();
  })
</script>
<?= $this->endSection('customjs'); ?>