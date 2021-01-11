<?= $this->extend('template'); ?>
<?= $this->section('customcss'); ?>
<?= $this->endSection('customcss'); ?>

<?= $this->section('content'); ?>
<div class="container auth-section" data-aos="fade-up">
  <div class="section-title">
    <h2><?= $_title ?></h2>
    <p><?= env("app.appName") ?></p>
  </div>
  <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
    <div class="col-lg-6">
      <?= form_open(); ?>
      <div class="form-group">
        <input type="text" data-inputmask="'mask': '9', 'repeat': 16, 'greedy' : false" class="form-control <?= ($_validation->hasError('nik') ? "is-invalid" : "") ?>" name="nik" id="nik" placeholder="NIK" />
        <div class="invalid-feedback">
          <?= $_validation->getError('nik') ?>
        </div>
      </div>
      <div class="form-group">
        <input type="password" class="form-control <?= ($_validation->hasError('new_password') ? "is-invalid" : "") ?>" name="new_password" id="new_password" placeholder="Password Baru" />
        <div class="invalid-feedback">
          <?= $_validation->getError('new_password') ?>
        </div>
      </div>
      <div class="form-group">
        <input type="password" class="form-control <?= ($_validation->hasError('new_password2') ? "is-invalid" : "") ?>" name="new_password2" id="new_password2" placeholder="Konfirmasi Password Baru" />
        <div class="invalid-feedback">
          <?= $_validation->getError('new_password2') ?>
        </div>
      </div>
      <div class="text-center"><button class="btn btn-primary py-3 px-5 button-submit" type="submit">Simpan</button></div>
      <?= form_close(); ?>
    </div>

  </div>

</div>
<?= $this->endSection('content'); ?>
<?= $this->section('customjs'); ?>
<script src="<?= base_url('assets/vendor') ?>/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
  $(document).ready(function() {
    $(":input").inputmask();
  });
</script>
<?= $this->endSection('customjs'); ?>