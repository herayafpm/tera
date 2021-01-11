<?= $this->extend('admin/template'); ?>
<?= $this->section('customcss'); ?>
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?= $this->endSection('customcss'); ?>
<?= $this->section('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <?= form_open() ?>
        <div class="form-group">
          <select class="jenis_uttp form-control select2-danger" name="jenis_uttp[]" data-dropdown-css-class="select2-danger" data-placeholder="Pilih Jenis UTTP" multiple="multiple">
            <?php foreach ($_jenis_uttps as $jenis_uttp) : ?>
              <?php
              $selected = false;
              $search = array_search($jenis_uttp['jenis_uttp_id'], $_jenis_uttp_retribusis);
              if ($search !== false) {
                $selected = true;
              }
              ?>
              <option value="<?= $jenis_uttp['jenis_uttp_id'] ?>" <?= $selected ? "selected" : "" ?>><?= (($jenis_uttp['jenis_uttp_tipe_id'] != null) ? $jenis_uttp['jenis_uttp_tipe_nama'] . ": " : "") . $jenis_uttp['jenis_uttp_nama'] ?></option>
            <?php endforeach; ?>
          </select>
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
<script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(document).ready(function() {
    $('.jenis_uttp').select2({
      theme: 'bootstrap4'
    });
  });
</script>
<?= $this->endSection('customjs'); ?>