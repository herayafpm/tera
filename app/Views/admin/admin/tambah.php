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
          <label for="admin_nama" class="col-form-label">Nama</label>
          <input type="text" class="form-control col-sm-4 <?= ($_validation->hasError('admin_nama') ? "is-invalid" : "") ?>" id="admin_nama" name="admin_nama" placeholder="Masukkan nama" value="<?= old('admin_nama') ?>">
          <div class="invalid-feedback">
            <?= $_validation->getError('admin_nama') ?>
          </div>
        </div>
        <div class="form-group">
          <label for="admin_username" class="col-form-label">Username / NIP</label>
          <input type="text" class="form-control col-sm-4 <?= ($_validation->hasError('admin_username') ? "is-invalid" : "") ?>" id="admin_username" name="admin_username" placeholder="Masukkan username user" value="<?= old('admin_username') ?>">
          <div class="invalid-feedback">
            <?= $_validation->getError('admin_username') ?>
          </div>
        </div>
        <div class="form-group">
          <label for="role_id" class="col-sm-12 col-form-label">Tugas</label>
          <select class="col-sm-4 custom-select <?= ($_validation->hasError('role_id') ? "is-invalid" : "") ?>" id="role_id" name="role_id">
            <option value="">-- Tugas --</option>
            <?php foreach ($_roles as $role) : ?>
              <?php if ($role['role_id'] != 1) : ?>
                <option value="<?= $role['role_id'] ?>" <?= (old('role_id') == $role['role_id']) ? "selected" : "" ?>><?= $role['role_nama'] ?></option>
              <?php endif ?>
            <?php endforeach ?>
          </select>
          <div class="invalid-feedback">
            <?= $_validation->getError('role_id') ?>
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