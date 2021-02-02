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
        <input type="hidden" name="jenis_uttp_ids[]" class="form-jenis_uttp_ids" value="<?= implode(",", old('jenis_uttp_ids', $_jenis_uttp_ids) ?? []) ?>">
        <input type="hidden" name="jenis_uttp_namas[]" class="form-jenis_uttp_namas" value="<?= implode(",", old('jenis_uttp_namas', $_jenis_uttp_namas) ?? []) ?>">
        <input type="hidden" name="kapasitass[]" class="form-kapasitass" value="<?= implode(",", old('kapasitass', $_kapasitass) ?? []) ?>">
        <input type="hidden" name="daya_bacas[]" class="form-daya_bacas" value="<?= implode(",", old('daya_bacas', $_daya_bacas) ?? []) ?>">
        <input type="hidden" name="jumlahs[]" class="form-jumlahs" value="<?= implode(",", old('jumlahs', $_jumlahs) ?? []) ?>">
        <input type="hidden" name="tera_uttp_ids[]" class="form-tera_uttp_ids" value="<?= implode(",", old('tera_uttp_ids', $_tera_uttp_ids) ?? []) ?>">
        <div class="table-responsive">
          <table class="table table-stripped table-hover">
            <thead>
              <th>#</th>
              <th>Jenis UTTP</th>
              <th>Kapasitas / Daya Baca</th>
              <th>Jumlah</th>
              <th>Jenis Pekerjaan</th>
              <th>Aksi</th>
            </thead>
            <tbody class="tbody-jenis_uttps">
            </tbody>
          </table>
        </div>
        <div class="form-group">
          <a href="<?= $_url_back ?>" class="mb-1 btn btn-secondary" role="button"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        </div>
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
  var jenis;
  var kapasitas;
  var daya_baca;
  var jumlah;
  $(document).ready(function() {
    tera_uttp_ids = $('.form-tera_uttp_ids').val().split(",").filter((e) => e != "")
    jenis_uttp_ids = $('.form-jenis_uttp_ids').val().split(",").filter((e) => e != "")
    jenis_uttp_namas = $('.form-jenis_uttp_namas').val().split(",").filter((e) => e != "")
    kapasitass = $('.form-kapasitass').val().split(",").filter((e) => e != "")
    daya_bacas = $('.form-daya_bacas').val().split(",").filter((e) => e != "")
    jumlahs = $('.form-jumlahs').val().split(",").filter((e) => e != "")
    updateTabel()
  })

  async function printBeritaAcara(id) {
    const {
      value: no_surat_permohonan
    } = await Swal.fire({
      title: 'Masukkan NO Surat Permohonan',
      input: 'text',
      inputAttributes: {
        autocapitalize: 'off'
      },
      inputValidator: (value) => {
        if (!value) {
          return 'Tidak boleh kosong!'
        }
      },
      inputLabel: 'No Surat Permohonan',
      inputPlaceholder: 'Masukkan No Surat Permohonan'
    })

    if (no_surat_permohonan) {
      const {
        value: no_surat_tugas
      } = await Swal.fire({
        title: 'Masukkan NO Surat Tugas',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        inputValidator: (value) => {
          if (!value) {
            return 'Tidak boleh kosong!'
          }
        },
        inputLabel: 'No Surat Tugas',
        inputPlaceholder: 'Masukkan No Surat Tugas'
      })
      if (no_surat_tugas) {
        window.open("<?= $_url_pengujian ?>/<?= $_tera['tera_id'] ?>/" + id + "/print_berita_acara?no_surat_permohonan=" + no_surat_permohonan + "&no_surat_tugas=" + no_surat_tugas, "_blank ")
      }
    }
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
      html += "<?= $_tera['jenis_tera_nama'] ?>"
      html += "</td>"
      html += "<td>"
      html += '<a role="button" class="btn btn-link text-info" target="_blank" href="<?= $_url_pengujian ?>/<?= $_tera['tera_id'] ?>/' + tera_uttp_ids[index] + '">Pengujian</a>'
      if ("<?= $_tera['tera_status_pengujian'] ?>" == 1 && "<?= $_tera['jenis_tempat_id'] ?>" == 2 && "<?= $_role_id ?>" == 4) {
        html += '<button class="btn btn-link text-info" onClick="printBeritaAcara(' + tera_uttp_ids[index] + ')">Cetak Berita Acara</button>'
      }
      html += "</td>"
      html += "</tr>"
    })
    $('.tbody-jenis_uttps').html(html)
  }
</script>
<?= $this->endSection('customjs'); ?>