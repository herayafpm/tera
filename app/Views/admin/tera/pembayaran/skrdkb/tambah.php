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
          <label for="tera_skrdkb_keterangan" class="col-sm-1 col-form-label">Keterangan</label>
          <div class="col-sm-8">
            <textarea class="form-control form-control-sm <?= ($_validation->hasError('tera_skrdkb_keterangan') ? "is-invalid" : "") ?>" id="tera_skrdkb_keterangan" rows="4" name="tera_skrdkb_keterangan" placeholder="Masukkan Keterangan (Opsional)"><?= old('tera_skrdkb_keterangan') ?></textarea>
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_skrdkb_keterangan') ?>
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
<?= $this->endSection('customjs'); ?>