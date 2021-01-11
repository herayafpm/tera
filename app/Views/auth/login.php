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
        <input type="text" name="username" class="form-control <?= ($_validation->hasError('username') ? "is-invalid" : "") ?>" id="username" placeholder="Username / NIK / NIP" />
        <div class="invalid-feedback">
          <?= $_validation->getError('username') ?>
        </div>
      </div>
      <div class="form-group">
        <input type="password" class="form-control <?= ($_validation->hasError('password') ? "is-invalid" : "") ?>" name="password" id="password" placeholder="Password" />
        <div class="invalid-feedback">
          <?= $_validation->getError('password') ?>
        </div>
      </div>
      <div class="text-center"><button class="btn btn-primary py-3 px-5 button-submit" type="submit">Login</button></div>
      <?= form_close(); ?>
    </div>

  </div>

</div>
<?= $this->endSection('content'); ?>
<?= $this->section('customjs'); ?>
<?= $this->endSection('customjs'); ?>