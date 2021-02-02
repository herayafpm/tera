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
          <label for="tera_uttp_merk" class="col-sm-2 col-form-label">Merk</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_merk') ? "is-invalid" : "") ?>" id="tera_uttp_merk" name="tera_uttp_merk" placeholder="Masukkan Merk" value="<?= old('tera_uttp_merk', $_tera_uttp['tera_uttp_merk']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_merk') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_uttp_no_seri" class="col-sm-2 col-form-label">Nomor Seri</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_no_seri') ? "is-invalid" : "") ?>" id="tera_uttp_no_seri" name="tera_uttp_no_seri" placeholder="Masukkan Nomor Seri" value="<?= old('tera_uttp_no_seri', $_tera_uttp['tera_uttp_no_seri']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_no_seri') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_uttp_volume" class="col-sm-2 col-form-label">Volume Nominal</label>
          <div class="col-sm-4">
            <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_volume') ? "is-invalid" : "") ?>" id="tera_uttp_volume" name="tera_uttp_volume" placeholder="Masukkan Volume Nominal" value="<?= old('tera_uttp_volume', $_tera_uttp['tera_uttp_volume']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_volume') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_uttp_merk_kendaraan" class="col-sm-2 col-form-label">Merk Kendaraan</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_merk_kendaraan') ? "is-invalid" : "") ?>" id="tera_uttp_merk_kendaraan" name="tera_uttp_merk_kendaraan" placeholder="Masukkan Merk Kendaraan" value="<?= old('tera_uttp_merk_kendaraan', $_tera_uttp['tera_uttp_merk_kendaraan']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_merk_kendaraan') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_uttp_no_polisi" class="col-sm-2 col-form-label">No. Polisi / Chasis</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_no_polisi') ? "is-invalid" : "") ?>" id="tera_uttp_no_polisi" name="tera_uttp_no_polisi" placeholder="Masukkan No. Polisi / Chasis" value="<?= old('tera_uttp_no_polisi', $_tera_uttp['tera_uttp_no_polisi']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_no_polisi') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_uttp_no_kd_plat" class="col-sm-2 col-form-label">No. Kode Plat</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_no_kd_plat') ? "is-invalid" : "") ?>" id="tera_uttp_no_kd_plat" name="tera_uttp_no_kd_plat" placeholder="Masukkan No. Kode Plat" value="<?= old('tera_uttp_no_kd_plat', $_tera_uttp['tera_uttp_no_kd_plat']) ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_no_kd_plat') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col">
            <div>
              <p>Muka (mm)</p>
            </div>
            <!-- Muka -->
            <div>
              <label for="tera_uttp_detail_t1_muka" class="col-sm-3 col-form-label">t1 muka</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_t1_muka') ? "is-invalid" : "") ?>" id="tera_uttp_detail_t1_muka" name="tera_uttp_detail_t1_muka" placeholder="Masukkan t1 muka" value="<?= old('tera_uttp_detail_t1_muka', $_tera_uttp['tera_uttp_detail_t1_muka'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_t1_muka') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_t2_muka" class="col-sm-3 col-form-label">t2 muka</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_t2_muka') ? "is-invalid" : "") ?>" id="tera_uttp_detail_t2_muka" name="tera_uttp_detail_t2_muka" placeholder="Masukkan t2 muka" value="<?= old('tera_uttp_detail_t2_muka', $_tera_uttp['tera_uttp_detail_t2_muka'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_t2_muka') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_t3_muka" class="col-sm-3 col-form-label">t3 muka</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_t3_muka') ? "is-invalid" : "") ?>" id="tera_uttp_detail_t3_muka" name="tera_uttp_detail_t3_muka" placeholder="Masukkan t3 muka" value="<?= old('tera_uttp_detail_t3_muka', $_tera_uttp['tera_uttp_detail_t3_muka'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_t3_muka') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_t4_muka" class="col-sm-3 col-form-label">t4 muka</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_t4_muka') ? "is-invalid" : "") ?>" id="tera_uttp_detail_t4_muka" name="tera_uttp_detail_t4_muka" placeholder="Masukkan t4 muka" value="<?= old('tera_uttp_detail_t4_muka', $_tera_uttp['tera_uttp_detail_t4_muka'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_t4_muka') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_t_muka" class="col-sm-3 col-form-label">t muka</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_t_muka') ? "is-invalid" : "") ?>" id="tera_uttp_detail_t_muka" name="tera_uttp_detail_t_muka" placeholder="Masukkan t muka" value="<?= old('tera_uttp_detail_t_muka', $_tera_uttp['tera_uttp_detail_t_muka'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_t_muka') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_d_muka" class="col-sm-3 col-form-label">d muka</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_d_muka') ? "is-invalid" : "") ?>" id="tera_uttp_detail_d_muka" name="tera_uttp_detail_d_muka" placeholder="Masukkan d muka" value="<?= old('tera_uttp_detail_d_muka', $_tera_uttp['tera_uttp_detail_d_muka'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_d_muka') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_p_muka" class="col-sm-3 col-form-label">p muka</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_p_muka') ? "is-invalid" : "") ?>" id="tera_uttp_detail_p_muka" name="tera_uttp_detail_p_muka" placeholder="Masukkan p muka" value="<?= old('tera_uttp_detail_p_muka', $_tera_uttp['tera_uttp_detail_p_muka'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_p_muka') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_q_muka" class="col-sm-3 col-form-label">q muka</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_q_muka') ? "is-invalid" : "") ?>" id="tera_uttp_detail_q_muka" name="tera_uttp_detail_q_muka" placeholder="Masukkan q muka" value="<?= old('tera_uttp_detail_q_muka', $_tera_uttp['tera_uttp_detail_q_muka'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_q_muka') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_s_muka" class="col-sm-3 col-form-label">s muka</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_s_muka') ? "is-invalid" : "") ?>" id="tera_uttp_detail_s_muka" name="tera_uttp_detail_s_muka" placeholder="Masukkan s muka" value="<?= old('tera_uttp_detail_s_muka', $_tera_uttp['tera_uttp_detail_s_muka'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_s_muka') ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div>
              <p>Belakang (mm)</p>
            </div>
            <!-- Belakang -->
            <div>
              <label for="tera_uttp_detail_t1_belakang" class="col-sm-3 col-form-label">t1 belakang</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_t1_belakang') ? "is-invalid" : "") ?>" id="tera_uttp_detail_t1_belakang" name="tera_uttp_detail_t1_belakang" placeholder="Masukkan t1 belakang" value="<?= old('tera_uttp_detail_t1_belakang', $_tera_uttp['tera_uttp_detail_t1_belakang'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_t1_belakang') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_t2_belakang" class="col-sm-3 col-form-label">t2 belakang</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_t2_belakang') ? "is-invalid" : "") ?>" id="tera_uttp_detail_t2_belakang" name="tera_uttp_detail_t2_belakang" placeholder="Masukkan t2 muka" value="<?= old('tera_uttp_detail_t2_belakang', $_tera_uttp['tera_uttp_detail_t2_belakang'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_t2_belakang') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_t3_belakang" class="col-sm-3 col-form-label">t3 belakang</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_t3_belakang') ? "is-invalid" : "") ?>" id="tera_uttp_detail_t3_belakang" name="tera_uttp_detail_t3_belakang" placeholder="Masukkan t3 belakang" value="<?= old('tera_uttp_detail_t3_belakang', $_tera_uttp['tera_uttp_detail_t3_belakang'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_t3_belakang') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_t4_belakang" class="col-sm-3 col-form-label">t4 belakang</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_t4_belakang') ? "is-invalid" : "") ?>" id="tera_uttp_detail_t4_belakang" name="tera_uttp_detail_t4_belakang" placeholder="Masukkan t4 belakang" value="<?= old('tera_uttp_detail_t4_belakang', $_tera_uttp['tera_uttp_detail_t4_belakang'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_t4_belakang') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_t_belakang" class="col-sm-3 col-form-label">t belakang</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_t_belakang') ? "is-invalid" : "") ?>" id="tera_uttp_detail_t_belakang" name="tera_uttp_detail_t_belakang" placeholder="Masukkan t belakang" value="<?= old('tera_uttp_detail_t_belakang', $_tera_uttp['tera_uttp_detail_t_belakang'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_t_belakang') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_d_belakang" class="col-sm-3 col-form-label">d belakang</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_d_belakang') ? "is-invalid" : "") ?>" id="tera_uttp_detail_d_belakang" name="tera_uttp_detail_d_belakang" placeholder="Masukkan d belakang" value="<?= old('tera_uttp_detail_d_belakang', $_tera_uttp['tera_uttp_detail_d_belakang'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_d_belakang') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_p_belakang" class="col-sm-3 col-form-label">p belakang</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_p_belakang') ? "is-invalid" : "") ?>" id="tera_uttp_detail_p_belakang" name="tera_uttp_detail_p_belakang" placeholder="Masukkan p belakang" value="<?= old('tera_uttp_detail_p_belakang', $_tera_uttp['tera_uttp_detail_p_belakang'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_p_belakang') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_q_belakang" class="col-sm-3 col-form-label">q belakang</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_q_belakang') ? "is-invalid" : "") ?>" id="tera_uttp_detail_q_belakang" name="tera_uttp_detail_q_belakang" placeholder="Masukkan q belakang" value="<?= old('tera_uttp_detail_q_belakang', $_tera_uttp['tera_uttp_detail_q_belakang'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_q_belakang') ?>
                </div>
              </div>
            </div>
            <div>
              <label for="tera_uttp_detail_s_belakang" class="col-sm-3 col-form-label">s belakang</label>
              <div class="col-sm">
                <input type="text" class="form-control money form-control-sm <?= ($_validation->hasError('tera_uttp_detail_s_belakang') ? "is-invalid" : "") ?>" id="tera_uttp_detail_s_belakang" name="tera_uttp_detail_s_belakang" placeholder="Masukkan s belakang" value="<?= old('tera_uttp_detail_s_belakang', $_tera_uttp['tera_uttp_detail_s_belakang'] ?? "") ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('tera_uttp_detail_s_belakang') ?>
                </div>
              </div>
            </div>
          </div>
          <!-- End Muka -->
        </div>
        <div class="form-group row">
          <label for="tera_uttp_keterangan" class="col-sm-3 col-form-label">Keterangan / Media (Opsional)</label>
          <div class="col-sm-9">
            <textarea class="form-control form-control-sm <?= ($_validation->hasError('tera_uttp_keterangan') ? "is-invalid" : "") ?>" id="tera_uttp_keterangan" rows="4" name="tera_uttp_keterangan" placeholder="Masukkan Keterangan / Media (Opsional)"><?= old('tera_uttp_keterangan', $_tera_uttp['tera_uttp_keterangan']) ?></textarea>
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_uttp_keterangan') ?>
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
<script src="<?= base_url('assets/vendor') ?>/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
  $(document).ready(function() {
    $(".money").inputmask('integer', {
      'removeMaskOnSubmit': true,
      'alias': 'numeric',
      'groupSeparator': '.',
      'autoGroup': true,
      'digitsOptional': false,
      'allowMinus': false,
      'placeholder': '0'
    });
  });
</script>
<?= $this->endSection('customjs'); ?>