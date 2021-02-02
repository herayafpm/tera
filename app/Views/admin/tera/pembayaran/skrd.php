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
        <div class="form-group row">
          <div class="col-4">
            No Order
          </div>
          <div class="col">
            : <span><?= $_tera['tera_no_order'] ?></span>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-4">
            Nama Wajib Tera
          </div>
          <div class="col">
            : <span><?= $_tera['user_nama'] ?></span>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-4">
            Alamat Wajib Tera
          </div>
          <div class="col">
            : <span><?= $_tera['user_alamat'] ?></span>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-4">
            Atas Nama
          </div>
          <div class="col">
            : <span><?= $_tera['tera_atas_nama'] ?></span>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-4">
            Atas Nama Alamat
          </div>
          <div class="col">
            : <span><?= $_tera['tera_atas_nama_alamat'] ?></span>
          </div>
        </div>
        <?php if ($_tera['tera_ketetapan_at'] != null) : ?>
          <div class="form-group row">
            <div class="col-4">
              Ditetapkan
            </div>
            <div class="col">
              : <span class="toLocaleDate"><?= $_tera['tera_ketetapan_at'] ?></span> Oleh <span><?= $_tera['tera_ketetapan_admin_nama'] ?></span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
              Ditetapkan Sejak
            </div>
            <div class="col">
              : <span class="ketetapan_diff"></span>
            </div>
          </div>
        <?php endif ?>
        <?php if ($_tera['tera_keringanan_at'] != null) : ?>
          <div class="form-group row">
            <div class="col-4">
              Verifikasi Keringanan
            </div>
            <div class="col">
              : <span class="toLocaleDate"><?= $_tera['tera_keringanan_at'] ?></span> Oleh <span><?= $_tera['tera_keringanan_admin_nama'] ?></span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
              Verifikasi Keringanan Sejak
            </div>
            <div class="col">
              : <span class="keringanan_diff"></span>
            </div>
          </div>
        <?php endif ?>

        <input type="hidden" name="jenis_uttp_ids[]" class="form-jenis_uttp_ids" value="<?= implode(",", old('jenis_uttp_ids', $_jenis_uttp_ids) ?? []) ?>">
        <input type="hidden" name="jenis_uttp_namas[]" class="form-jenis_uttp_namas" value="<?= implode(",", old('jenis_uttp_namas', $_jenis_uttp_namas) ?? []) ?>">
        <input type="hidden" name="kapasitass[]" class="form-kapasitass" value="<?= implode(",", old('kapasitass', $_kapasitass) ?? []) ?>">
        <input type="hidden" name="daya_bacas[]" class="form-daya_bacas" value="<?= implode(",", old('daya_bacas', $_daya_bacas) ?? []) ?>">
        <input type="hidden" name="jumlahs[]" class="form-jumlahs" value="<?= implode(",", old('jumlahs', $_jumlahs) ?? []) ?>">
        <input type="hidden" name="tera_uttp_ids[]" class="form-tera_uttp_ids" value="<?= implode(",", old('tera_uttp_ids', $_tera_uttp_ids) ?? []) ?>">
        <input type="hidden" name="jenis_retribusi_ids[]" class="form-jenis_retribusi_ids" value="<?= implode(",", old('jenis_retribusi_ids', $_jenis_retribusi_ids) ?? []) ?>">
        <input type="hidden" name="retribusis[]" class="form-retribusis" value="<?= implode(",", old('retribusis', $_retribusis) ?? []) ?>">
        <input type="hidden" name="keringanans[]" class="form-keringanans" value="<?= implode(",", old('keringanans', $_keringanans) ?? []) ?>">
        <input type="hidden" name="sanksi_adms[]" class="form-sanksi_adms" value="<?= implode(",", old('sanksi_adms', $_sanksi_adms) ?? []) ?>">
        <?php if ($_validation->hasError('jenis_uttp_ids')) : ?>
          <p class="text-danger">*<?= $_validation->getError('jenis_uttp_ids') ?></p>
        <?php endif ?>
        <div class="table-responsive">
          <table class="table table-stripped table-hover">
            <thead>
              <th>#</th>
              <th>Jenis UTTP</th>
              <th>Kapasitas / Daya Baca</th>
              <th>Jumlah</th>
              <th>Jenis Pekerjaan</th>
              <th>Retribusi</th>
              <th>Keringanan</th>
              <th>Sanksi Administrasi</th>
              <th>Jumlah Retribusi</th>
              <th>Aksi</th>
            </thead>
            <tbody class="tbody-jenis_uttps">
            </tbody>
          </table>
        </div>
        <div class="form-group row">
          <div class="col-md-3">
            Jumlah Retribusi Yang Harus Dibayar
          </div>
          <div class="col">
            : <span class="total_retribusi"></span></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_total_terbilang" class="col-md-3 col-form-label">Total Terbilang</label>
          <div class="col-md-8">
            <textarea class="form-control form-control-sm <?= ($_validation->hasError('tera_total_terbilang') ? "is-invalid" : "") ?>" id="tera_total_terbilang" rows="3" name="tera_total_terbilang" placeholder="Masukkan Total Terbilang"><?= old('tera_total_terbilang', $_tera['tera_total_terbilang']) ?></textarea>
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_total_terbilang') ?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <?php if ($_tera['tera_ketetapan_at'] != null) : ?>
            <button class="mb-1 btn btn-primary" type="submit"><i class="fas fa-fw fa-save"></i> Simpan</button>
            <button type="button" onclick="batal_penetapan()" class="mb-1 btn btn-secondary"><i class="fas fa-fw fa-times"></i> Batal Tetapkan</button>
            <a href="<?= $_url_print ?>" target="_blank" class="mb-1 btn btn-success" role="button"><i class="fas fa-fw fa-print"></i> Cetak SKRD</a>
          <?php else : ?>
            <button class="mb-1 btn btn-primary" type="submit" name="tetapkan"><i class="fas fa-fw fa-save"></i> Simpan & Tetapkan</button>
          <?php endif ?>
          <a href="<?= $_url_keringanan ?>" class="mb-1 btn btn-success" role="button"><i class="fas fa-fw fa-folder-open"></i> Keringanan</a>
          <a href="<?= $_url_skrdkb ?>" class="mb-1 btn btn-success" role="button"><i class="fas fa-fw fa-folder-open"></i> SKRDKB</a>
          <a href="<?= $_url_skrdlb ?>" class="mb-1 btn btn-success" role="button"><i class="fas fa-fw fa-folder-open"></i> SKRDLB</a>
          <a href="<?= $_url_ssrd ?>" class="mb-1 btn btn-success" role="button"><i class="fas fa-fw fa-folder-open"></i> SSRD</a>
          <a href="<?= $_url_back ?>" class="mb-1 btn btn-secondary" role="button"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        </div>
        <?= form_close() ?>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<!-- modal -->
<div class="modal fade" id="jenisUTTPModal" tabindex="-1" role="dialog" aria-labelledby="jenisUTTPModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="jenisUTTPModalLabel">Jenis UTTP Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" data-id="">
        <div class="form-group">
          <label for="jenis_retribusi" class="col-form-label">Jenis Retribusi</label>
          <select class="jenis_retribusi form-control" id="jenis_retribusi" data-tarif="">
          </select>
        </div>
        <div class="form-group">
          <label for="tarif_keringanan" class="col-form-label">Keringanan</label>
          <input type="text" class="form-control money" id="tarif_keringanan"></input>
        </div>
        <input type="hidden" class="form-control" id="tarif_retribusi"></input>
        <div class="form-group">
          <label for="sanksi_adm" class="col-form-label">Sanksi Administrasi</label>
          <input type="text" class="form-control money" id="sanksi_adm"></input>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary btn-ubah-jenis">Ubah</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection('content'); ?>
<?= $this->section('customjs'); ?>
<script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url('assets/vendor') ?>/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>

<script>
  var jenis_uttp_ids = [];
  var jenis_uttp_namas = [];
  var kapasitass = [];
  var daya_bacas = [];
  var jumlahs = [];
  var tera_uttp_ids = [];
  var jenis_retribusi_ids = [];
  var retribusis = [];
  var keringanans = [];
  var sanksi_adms = [];
  var jenis;
  var kapasitas;
  var daya_baca;
  var jumlah;
  var jenis_retribusi;
  var retribusi;
  var keringanan;
  var sanksi_adm;

  function batal_penetapan() {
    Swal.fire({
      title: "Konfirmasi ingin membatalkan penetapan SKRD Tera",
      text: "Yakin ingin membatalkan penetapan SKRD ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= $_url_batal_penetapan ?>";
      }
    })
  }

  function openModal(index) {
    clearJenisRetribusi()
    $.ajax("<?= $_url_api ?>/" + jenis_uttp_ids[index])
      .done(function(json) {
        var html = "<option value=''>Pilih Jenis Retribusi</option>"
        json.data.forEach(element => {
          html += "<option data-tarif='" + element.tarifs[0].jenis_retribusi_tarif_bayar +
            "' value='" + element.jenis_retribusi_id + "'>"
          html += element.jenis_retribusi_tipe_nama + ": " + element.jenis_retribusi_nama
          html += "</option>"
        });
        $('#jenis_retribusi').html(html)
        if (jenis_retribusi_ids[index] != null) {
          $('#jenis_retribusi').val(jenis_retribusi_ids[index]);
          $('#jenis_retribusi').trigger('change');
          $('#tarif_keringanan').val(keringanans[index]);
        }
      })
    $('#jenisUTTPModalLabel').html("Ubah Tera Jenis UTTP")
    $('.btn-ubah-jenis').removeClass('d-none');
    $('#sanksi_adm').val(sanksi_adms[index]);
    $('#jenisUTTPModal').find('.modal-body').data('id', index)
    $('#jenisUTTPModal').modal()
  }
  $(document).ready(function() {
    var tera_ketetapan_at = "<?= $tera_ketetapan_at ?? '' ?>";
    if (tera_ketetapan_at != "") {
      var date1 = moment(tera_ketetapan_at);
      var date2 = moment()
      $('.ketetapan_diff').html(date2.diff(date1, 'days') + " Hari yang lalu")
    }
    var tera_keringanan_at = "<?= $tera_keringanan_at ?? '' ?>";
    if (tera_keringanan_at != "") {
      var date1 = moment(tera_keringanan_at);
      var date2 = moment()
      $('.keringanan_diff').html(date2.diff(date1, 'days') + " Hari yang lalu")
    }
    tera_uttp_ids = $('.form-tera_uttp_ids').val().split(",").filter((e) => e != "")
    jenis_uttp_ids = $('.form-jenis_uttp_ids').val().split(",").filter((e) => e != "")
    jenis_uttp_namas = $('.form-jenis_uttp_namas').val().split(",").filter((e) => e != "")
    kapasitass = $('.form-kapasitass').val().split(",").filter((e) => e != "")
    daya_bacas = $('.form-daya_bacas').val().split(",").filter((e) => e != "")
    jumlahs = $('.form-jumlahs').val().split(",").filter((e) => e != "")
    jenis_retribusi_ids = $('.form-jenis_retribusi_ids').val().split(",")
    retribusis = $('.form-retribusis').val().split(",").filter((e) => e != "")
    keringanans = $('.form-keringanans').val().split(",").filter((e) => e != "")
    sanksi_adms = $('.form-sanksi_adms').val().split(",").filter((e) => e != "")
    updateTabel()
    $('.jenis_retribusi').select2({});
    $(":input").inputmask();
    $(".money").inputmask('integer', {
      'removeMaskOnSubmit': true,
      'alias': 'numeric',
      'groupSeparator': '.',
      'autoGroup': true,
      'digitsOptional': false,
      'allowMinus': false,
      'placeholder': '0'
    });
    $("#jenis_retribusi").change(function() {
      $('#tarif_retribusi').val($(this).find(":selected").data('tarif'))
    });
    $('.btn-ubah-jenis').on('click', function() {
      var index = $("#jenisUTTPModal").find('.modal-body').data('id')
      var isValid = validation()
      if (isValid) {
        jenis_retribusi_ids.splice(index, 1, jenis);
        keringanans.splice(index, 1, keringanan);
        retribusis.splice(index, 1, retribusi);
        jenis_retribusi_ids.splice(index, 1, jenis_retribusi);
        sanksi_adms.splice(index, 1, sanksi_adm);
        updateTabel()
        clearJenisRetribusi()
        $('#jenisUTTPModal').modal('hide')
      }
    })
  })

  function clearJenisRetribusi() {
    $('.form-sanksi_adms').val(sanksi_adms)
    $('#sanksi_adm').val("");
    $('#tarif_keringanan').val("");
    $('#tarif_retribusi').val("");
    $('.form-jenis_retribusi_ids').val(jenis_retribusi_ids)
    $('#jenis_retribusi_id').val("");
    $('.form-retribusis').val(retribusis)
    $('.form-keringanans').val(keringanans)
    $('#retribusis').val("");
    $('#keringanans').val("");
  }

  function updateTabel() {
    $('.tbody-jenis_uttps').html("")
    var html = ""
    var total_retribusi = 0;
    jenis_uttp_ids.forEach((item, index) => {
      var jumlah_retribusi = parseInt(jumlahs[index]) * (parseInt(retribusis[index]) - parseInt(keringanans[index])) + parseInt(sanksi_adms[index]);
      total_retribusi += jumlah_retribusi;
      html += "<tr>"
      html += "<td>"
      html += index + 1
      html += "</td>"
      html += "<td>"
      html += jenis_uttp_namas[index]
      html += "</td>"
      html += "<td>"
      html += formatRupiah(kapasitass[index])
      html += " "
      html += daya_bacas[index]
      html += "</td>"
      html += "<td>"
      html += formatRupiah(jumlahs[index])
      html += "</td>"
      html += "<td>"
      html += "<?= $_tera['jenis_tera_nama'] ?>"
      html += "</td>"
      html += "<td>"
      html += formatRupiah("" + retribusis[index])
      html += "</td>"
      html += "<td>"
      html += formatRupiah("" + keringanans[index])
      html += "</td>"
      html += "<td>"
      html += formatRupiah(sanksi_adms[index])
      html += "</td>"
      html += "<td>"
      html += formatRupiah("" + jumlah_retribusi)
      html += "</td>"
      html += "<td>"
      html += '<button type="button" class="btn btn-link text-info" onClick="openModal(' + index + ')"><i class="fa fa-fw fa-edit" aria-hidden="true" title="Edit Jenis UTTP' + jenis_uttp_namas[index] + '"></i></button>'
      html += "</td>"
      html += "</tr>"
    })
    $('.tbody-jenis_uttps').html(html)
    $('.total_retribusi').html(formatRupiah("" + total_retribusi))
  }

  function validation() {
    jenis_retribusi = $('#jenis_retribusi').val();
    sanksi_adm = $('#sanksi_adm').inputmask('unmaskedvalue');
    keringanan = $('#tarif_keringanan').inputmask('unmaskedvalue');
    retribusi = $('#tarif_retribusi').val();
    if (jenis_retribusi == "") {
      showError("Jenis Retribusi harus dipilih")
      return false;
    }
    if (sanksi_adm == "") {
      sanksi_adm = "0"
    }
    if (retribusi == "") {
      retribusi = "0"
    }
    if (keringanan == "") {
      keringanan = "0"
    }
    return true;
  }

  function showError(title) {
    Swal.fire({
      icon: 'error',
      title: title
    });
  }
</script>
<?= $this->endSection('customjs'); ?>