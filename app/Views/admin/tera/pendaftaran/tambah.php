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
          <div class="col-sm-6">
            <div class="row">
              <label for="user_nik" class="col-sm-4 col-form-label">NIK</label>
              <div class="col-sm-8">
                <input data-inputmask="'mask': '9', 'repeat': 16, 'greedy' : false" type="text" class="form-control form-control-sm <?= ($_validation->hasError('user_nik') ? "is-invalid" : "") ?>" id="user_nik" name="user_nik" placeholder="Masukkan NIK wajib tera" value="<?= old('user_nik') ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('user_nik') ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <label for="user_nama" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('user_nama') ? "is-invalid" : "") ?>" id="user_nama" name="user_nama" placeholder="Masukkan Nama wajib tera" value="<?= old('user_nama') ?>">
                <div class="invalid-feedback">
                  <?= $_validation->getError('user_nama') ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="user_alamat" class="col-sm-2 col-form-label">Alamat</label>
          <div class="col-sm-10">
            <textarea class="form-control form-control-sm <?= ($_validation->hasError('user_alamat') ? "is-invalid" : "") ?>" id="user_alamat" rows="3" name="user_alamat" placeholder="Masukkan Alamat wajib tera"><?= old('user_alamat') ?></textarea>
            <div class="invalid-feedback">
              <?= $_validation->getError('user_alamat') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_no_order" class="col-sm-2 col-form-label">No Order</label>
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_no_order') ? "is-invalid" : "") ?>" id="tera_no_order" name="tera_no_order" placeholder="Masukkan No Order" value="<?= old('tera_no_order') ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_no_order') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="jenis_tera_id" class="col-sm-2 col-form-label">Jenis Pekerjaan</label>
          <div class="col-sm-4">
            <select class="form-control form-control-sm <?= ($_validation->hasError('jenis_tera_id') ? "is-invalid" : "") ?>" id="jenis_tera_id" name="jenis_tera_id">
              <option value="">-- Jenis Pekerjaan --</option>
              <?php foreach ($_jenis_teras as $jenis_tera) : ?>
                <option value="<?= $jenis_tera['jenis_tera_id'] ?>" data-nama="<?= $jenis_tera['jenis_tera_nama'] ?>" <?= old('jenis_tera_id') == $jenis_tera['jenis_tera_id'] ? "selected" : "" ?>><?= $jenis_tera['jenis_tera_nama'] ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
              <?= $_validation->getError('jenis_tera_id') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_atas_nama" class="col-sm-2 col-form-label">Atas Nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm <?= ($_validation->hasError('tera_atas_nama') ? "is-invalid" : "") ?>" id="tera_atas_nama" name="tera_atas_nama" placeholder="Masukkan Nama wajib tera" value="<?= old('tera_atas_nama') ?>">
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_atas_nama') ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tera_atas_nama_alamat" class="col-sm-2 col-form-label">Atas Nama Alamat</label>
          <div class="col-sm-10">
            <textarea class="form-control form-control-sm <?= ($_validation->hasError('tera_atas_nama_alamat') ? "is-invalid" : "") ?>" id="tera_atas_nama_alamat" rows="3" name="tera_atas_nama_alamat" placeholder="Masukkan Alamat wajib tera"><?= old('tera_atas_nama_alamat') ?></textarea>
            <div class="invalid-feedback">
              <?= $_validation->getError('tera_atas_nama_alamat') ?>
            </div>
          </div>
        </div>
        <input type="hidden" name="jenis_uttp_ids[]" class="form-jenis_uttp_ids" value="<?= implode(",", old('jenis_uttp_ids') ?? []) ?>">
        <input type="hidden" name="jenis_uttp_namas[]" class="form-jenis_uttp_namas" value="<?= implode(",", old('jenis_uttp_namas') ?? []) ?>">
        <input type="hidden" name="kapasitass[]" class="form-kapasitass" value="<?= implode(",", old('kapasitass') ?? []) ?>">
        <input type="hidden" name="daya_bacas[]" class="form-daya_bacas" value="<?= implode(",", old('daya_bacas') ?? []) ?>">
        <input type="hidden" name="jumlahs[]" class="form-jumlahs" value="<?= implode(",", old('jumlahs') ?? []) ?>">
        <?php if ($_validation->hasError('jenis_uttp_ids')) : ?>
          <p class="text-danger">*<?= $_validation->getError('jenis_uttp_ids') ?></p>
        <?php endif ?>
        <button class="btn btn-success py-1 px-2 mb-2" type="button" onclick="openModal(0)"><i class="fas fa-fw fa-plus"></i>Tambah Jenis UTTP</button>
        <div class="table-responsive">
          <table class="table table-stripped table-hover">
            <thead>
              <th>#</th>
              <th>Jenis UTTP</th>
              <th>Kapasitas / Daya Baca</th>
              <th>Jumlah</th>
              <th>Aksi</th>
            </thead>
            <tbody class="tbody-jenis_uttps">
            </tbody>
          </table>
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
          <label for="jenis_uttp" class="col-form-label">Jenis UTTP</label>
          <select class="jenis_uttp form-control" id="jenis_uttp" data-nama="">
            <option value="">Pilih Jenis UTTP</option>
            <?php foreach ($_jenis_uttps as $jenis_uttp) : ?>
              <option value="<?= $jenis_uttp['jenis_uttp_id'] ?>" data-nama="<?= (($jenis_uttp['jenis_uttp_tipe_id'] != null) ? $jenis_uttp['jenis_uttp_tipe_nama'] . ": " : "") . $jenis_uttp['jenis_uttp_nama'] ?>"><?= (($jenis_uttp['jenis_uttp_tipe_id'] != null) ? $jenis_uttp['jenis_uttp_tipe_nama'] . ": " : "") . $jenis_uttp['jenis_uttp_nama'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="kapasitas" class="col-form-label">Kapasitas</label>
          <input type="text" class="form-control money" id="kapasitas"></input>
        </div>
        <div class="form-group">
          <label for="daya_baca" class="col-form-label">Daya Baca</label>
          <input type="text" class="form-control" id="daya_baca"></input>
        </div>
        <div class="form-group">
          <label for="jumlah" class="col-form-label">Jumlah</label>
          <input type="text" class="form-control money" id="jumlah"></input>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary btn-ubah-jenis">Ubah</button>
        <button type="button" class="btn btn-primary btn-tambah-jenis">Tambah</button>
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
  var jenis;
  var kapasitas;
  var daya_baca;
  var jumlah;

  function openModal(tipe, index) {
    clearJenisUTTP()
    if (tipe == 0) {
      $('#jenisUTTPModalLabel').html("Tambah Tera Jenis UTTP")
      $('.btn-ubah-jenis').addClass('d-none');
      $('.btn-tambah-jenis').removeClass('d-none');
    } else {
      $('#jenisUTTPModalLabel').html("Ubah Tera Jenis UTTP")
      $('.btn-tambah-jenis').addClass('d-none');
      $('.btn-ubah-jenis').removeClass('d-none');
      $('#jenis_uttp').val(jenis_uttp_ids[index]);
      $('#jenis_uttp').trigger('change');
      $('#kapasitas').val(kapasitass[index]);
      $('#daya_baca').val(daya_bacas[index]);
      $('#jumlah').val(jumlahs[index]);
      $('#jenisUTTPModal').find('.modal-body').data('id', index)
    }
    $('#jenisUTTPModal').modal()
  }
  $(document).ready(function() {
    console.log($('.form-jenis_uttp_ids').val())
    jenis_uttp_ids = $('.form-jenis_uttp_ids').val().split(",").filter((e) => e != "")
    jenis_uttp_namas = $('.form-jenis_uttp_namas').val().split(",").filter((e) => e != "")
    kapasitass = $('.form-kapasitass').val().split(",").filter((e) => e != "")
    daya_bacas = $('.form-daya_bacas').val().split(",").filter((e) => e != "")
    jumlahs = $('.form-jumlahs').val().split(",").filter((e) => e != "")
    updateTabel()
    $('.jenis_uttp').select2({});
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
    $('#user_nik').on('keyup change clear', function() {
      var value = $(this).val();
      var min_karakter = 16;
      if (value.length >= min_karakter) {
        $.ajax("<?= base_url('api/user/') ?>/" + value)
          .done(function(json) {
            $('#user_nama').val(json.data.user_nama)
            $('#tera_atas_nama').val(json.data.user_nama)
            $('#user_alamat').val(json.data.user_alamat)
            $('#tera_atas_nama_alamat').val(json.data.user_alamat)
          })
      }
    })
    $("#jenis_uttp").change(function() {
      $(this).data('nama', $(this).find(":selected").data('nama'))
    });
    $('.btn-tambah-jenis').on('click', function() {
      var isValid = validation()
      if (isValid) {
        jenis_uttp_namas.push($("#jenis_uttp").data('nama'))
        jenis_uttp_ids.push(jenis)
        kapasitass.push(kapasitas)
        daya_bacas.push(daya_baca)
        jumlahs.push(jumlah)
        updateTabel()
        clearJenisUTTP()
        $('#jenisUTTPModal').modal('hide')
      }
    })
    $('.btn-ubah-jenis').on('click', function() {
      var index = $("#jenisUTTPModal").find('.modal-body').data('id')
      var isValid = validation()
      if (isValid) {
        var nama = $('#jenis_uttp').data('nama');
        jenis_uttp_ids.splice(index, 1, jenis);
        if (nama != "") {
          jenis_uttp_namas.splice(index, 1, nama);
        }
        kapasitass.splice(index, 1, kapasitas);
        daya_bacas.splice(index, 1, daya_baca);
        jumlahs.splice(index, 1, jumlah);
        updateTabel()
        clearJenisUTTP()
        $('#jenisUTTPModal').modal('hide')
      }
    })
  })

  function clearJenisUTTP() {
    $('.form-jenis_uttp_ids').val(jenis_uttp_ids)
    $('.form-jenis_uttp_namas').val(jenis_uttp_namas)
    $('.form-kapasitass').val(kapasitass)
    $('.form-daya_bacas').val(daya_bacas)
    $('.form-jumlahs').val(jumlahs)
    $("#jenis_uttp").data('nama', "")
    $('#jenis_uttp').val("");
    $('#jenis_uttp').trigger('change');
    $('#kapasitas').val("");
    $('#daya_baca').val("");
    $('#jumlah').val("");
  }

  function hapus(index) {
    jenis_uttp_ids.splice(index, 1);
    jenis_uttp_namas.splice(index, 1);
    kapasitass.splice(index, 1);
    daya_bacas.splice(index, 1);
    jumlahs.splice(index, 1);
    clearJenisUTTP()
    updateTabel()
  }

  function updateTabel() {
    $('.tbody-jenis_uttps').html("")
    var html = ""
    jenis_uttp_ids.forEach((item, index) => {
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
      html += '<button type="button" class="btn btn-link text-info" onClick="openModal(1,' + index + ')"><i class="fa fa-fw fa-edit" aria-hidden="true" title="Edit Jenis UTTP' + jenis_uttp_namas[index] + '"></i></button>'
      html += '<button type="button" class="btn btn-link text-danger" onClick="hapus(' + index + ')"><i class="fa fa-fw fa-trash" aria-hidden="true" title="Hapus Jenis UTTP' + jenis_uttp_namas[index] + '"></i></button>'
      html += "</td>"
      html += "</tr>"
    })
    $('.tbody-jenis_uttps').html(html)
  }

  function validation() {
    jenis = $('#jenis_uttp').val();
    kapasitas = $('#kapasitas').inputmask('unmaskedvalue');
    daya_baca = $('#daya_baca').val();
    jumlah = $('#jumlah').inputmask('unmaskedvalue');
    if (jenis == "") {
      showError("Jenis UTTP harus dipilih")
      return false;
    }
    if (kapasitas == "") {
      showError("Kapasitas tidak boleh kosong")
      return false;
    }
    if (daya_baca == "") {
      showError("Daya Baca tidak boleh kosong")
      return false;
    }
    if (jumlah == "") {
      showError("Jumlah tidak boleh kosong")
      return false;
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