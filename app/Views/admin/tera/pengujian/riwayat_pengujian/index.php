<?= $this->extend('admin/template'); ?>
<?= $this->section('customcss'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/daterangepicker/daterangepicker.css" />

<?= $this->endSection('customcss'); ?>
<?= $this->section('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <div class="form-group row">
          <div class="col-2">
            Jenis UTTP Nama
          </div>
          <div class="col">
            : <?= (($_tera_uttp_retribusi['jenis_uttp_tipe_id'] != null) ? $_tera_uttp_retribusi['jenis_uttp_tipe_nama'] . ":" : "") . $_tera_uttp_retribusi['jenis_uttp_nama'] ?>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-2">
            Kapasitas / Daya Baca
          </div>
          <div class="col">
            : <?= $_tera_uttp_retribusi['tera_uttp_kapasitas'] ?> / <?= $_tera_uttp_retribusi['tera_uttp_daya_baca'] ?>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-2">
            Jumlah
          </div>
          <div class="col">
            : <?= $_tera_uttp_retribusi['tera_uttp_jumlah'] ?>
          </div>
        </div>
        <?php if ($_tera_uttp['tera_uttp_pengujian_at'] != null) : ?>
          <div class="form-group row">
            <div class="col-2">
              Diuji
            </div>
            <div class="col">
              : <span class="toLocaleDate"><?= $_tera_uttp['tera_uttp_pengujian_at'] ?></span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-2">
              Diuji Sejak
            </div>
            <div class="col">
              : <span class="diuji_diff"></span>
            </div>
          </div>
        <?php endif ?>
        <button class="btn btn-primary mb-1" onClick="detail()"><i class="fa fa-eye"></i> Detail Tera</button>
        <button class="btn btn-primary mb-1" onClick="detailPengujianTeraUttp(0)"><i class="fa fa-eye"></i> Detail Pengujian Tera UTTP</button>
        <?php if ($_role_id == 4) : ?>
          <button class="btn btn-link mb-1" onClick="pengujianAllTipe(1)">Pengujian Tipe 1</button>
          <button class="btn btn-link mb-1" onClick="pengujianAllTipe(2)">Pengujian Tipe 2</button>
          <button class="btn btn-link mb-1" onClick="pengujianAllTipe(3)">Pengujian Tipe 3</button>
          <button class="btn btn-link mb-1" onClick="verif_all()">Sahkan Semua</button>
          <button class="btn btn-link mb-1" onClick="tolak_all()">Batalkan Semua</button>
          <button class="btn btn-link mb-1" onClick="batal_all()">Ubah Ke Proses Semua</button>
        <?php endif ?>
        <a class="btn btn-secondary mb-1" href="<?= $_url_back ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
        <h5>Filter</h5>
        <div class="form-group row">
          <div class="col-md-4">
            <select class="form-control form-control-sm" id="tera_uttp_pengujian_status">
              <option value="">--Pilih Status--</option>
              <option value="0">Proses</option>
              <option value="1">Sah</option>
              <option value="2">Batal</option>
            </select>
          </div>
          <div class="col-md-4">
            <div id="daterange" class="form-control form-control-sm"><span class="date">Pilih Tanggal</span> <i class="fa fa-fw fa-calendar"></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i></div>
          </div>
        </div>
        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Merk</th>
              <th>Tipe</th>
              <th>No Seri</th>
              <th>Status</th>
              <th>Tanggal Pengujian</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Merk</th>
              <th>Tipe</th>
              <th>No Seri</th>
              <th>Status</th>
              <th>Tanggal Pengujian</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<div class="modal fade" id="detailTeraModal" tabindex="-1" role="dialog" aria-labelledby="detailTeraModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailTeraModalLabel">Detail Tera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" data-id="">
        <div class="row tera_no_order_row">
          <div class="col-4">
            No Order
          </div>
          <div class="col">
            : <span class="tera_no_order"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Nama Wajib Tera
          </div>
          <div class="col">
            : <span class="user_nama"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Alamat Wajib Tera
          </div>
          <div class="col">
            : <span class="user_alamat"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Atas Nama
          </div>
          <div class="col">
            : <span class="tera_atas_nama"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Atas Nama Alamat
          </div>
          <div class="col">
            : <span class="tera_atas_nama_alamat"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Jenis Tempat
          </div>
          <div class="col">
            : <span class="jenis_tempat_nama"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Jenis Pekerjaan
          </div>
          <div class="col">
            : <span class="jenis_tera_nama"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Status
          </div>
          <div class="col">
            : <span class="tera_status"></span>
          </div>
        </div>
        <div class="row tera_status_verif_row">
          <div class="col-4">
            Diverifikasi
          </div>
          <div class="col">
            : <span class="tera_status_verif"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Ditetapkan
          </div>
          <div class="col">
            : <span class="tera_ketetapan"></span>
          </div>
        </div>
        <div class="row tera_status_tolak_row">
          <div class="col-4">
            Ditolak
          </div>
          <div class="col">
            : <span class="tera_status_tolak"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Tanggal Order
          </div>
          <div class="col">
            : <span class="tera_date_order"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Tanggal Dibuat
          </div>
          <div class="col">
            : <span class="tera_created"></span>
          </div>
        </div>
        <div class="row">
          <div class="col">
            Tera Jenis UTTP
          </div>
        </div>
        <div class="row">
          <div class="col">
            <table class="table table-bordered table-hover">
              <thead>
                <th>#</th>
                <th>Jenis UTTP</th>
                <th>Kapasitas / Daya Baca</th>
                <th>Jumlah</th>
                <th>Retribusi</th>
                <th>Sanksi Adm</th>
                <th>Total Retribusi</th>
              </thead>
              <tbody class="tbody-jenis_uttps">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detailPengujianTeraUttpModal" tabindex="-1" role="dialog" aria-labelledby="detailPengujianTeraUttpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailPengujianTeraUttpModalLabel">Detail Pengujian Tera UTTP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-4">
            Merk
          </div>
          <div class="col">
            : <span class="tera_uttp_merk"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Type
          </div>
          <div class="col">
            : <span class="tera_uttp_tipe"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Nomor Seri
          </div>
          <div class="col">
            : <span class="tera_uttp_no_seri"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Buatan
          </div>
          <div class="col">
            : <span class="tera_uttp_buatan"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Volume Nominal
          </div>
          <div class="col">
            : <span class="tera_uttp_volume"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Merk Kendaraan
          </div>
          <div class="col">
            : <span class="tera_uttp_merk_kendaraan"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            No Polisi / Chasis
          </div>
          <div class="col">
            : <span class="tera_uttp_no_polisi"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            No Kode Plat
          </div>
          <div class="col">
            : <span class="tera_uttp_no_kd_plat"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Keterangan / Media
          </div>
          <div class="col">
            : <span class="tera_uttp_keterangan"></span>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <p>Muka</p>
            <div class="row">
              <div class="col-4">
                t1 muka
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_t1_muka"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                t2 muka
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_t2_muka"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                t3 muka
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_t3_muka"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                t4 muka
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_t4_muka"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                t muka
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_t_muka"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                d muka
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_d_muka"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                p muka
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_p_muka"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                q muka
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_q_muka"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                s muka
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_s_muka"></span>
              </div>
            </div>
          </div>
          <div class="col">
            <p>Belakang</p>
            <div class="row">
              <div class="col-4">
                t1 belakang
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_t1_belakang"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                t2 belakang
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_t2_belakang"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                t3 belakang
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_t3_belakang"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                t4 belakang
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_t4_belakang"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                t belakang
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_t_belakang"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                d belakang
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_d_belakang"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                p belakang
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_p_belakang"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                q belakang
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_q_belakang"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                s belakang
              </div>
              <div class="col">
                : <span class="tera_uttp_detail_s_belakang"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row tera_uttp_pengujian_status_sah_row">
          <div class="col-4">
            Disahkan
          </div>
          <div class="col">
            : <span class="tera_uttp_pengujian_status_sah"></span>
          </div>
        </div>
        <div class="row tera_uttp_pengujian_status_batal_row">
          <div class="col-4">
            Dibatalkan
          </div>
          <div class="col">
            : <span class="tera_uttp_pengujian_status_batal"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Tanggal Pengujian
          </div>
          <div class="col">
            : <span class="tera_uttp_pengujian_at"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Status
          </div>
          <div class="col">
            : <span class="tera_uttp_pengujian_status"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection('content'); ?>
<?= $this->section('customjs'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js"></script>
<script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-rowgroup/js/rowGroup.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/vendor') ?>/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/vendor') ?>/adminlte/plugins/daterangepicker/daterangepicker.js"></script>

<script>
  var tabel = null;
  var datas = [];
  var id = null;
  var data = {};
  var date = "";
  var start;
  var end;
  var tera;

  function verif(id) {
    Swal.fire({
      title: "Konfirmasi sah pengujian ini",
      text: "Yakin ingin mensahkan pengujian ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= $_url_verif ?>/" + id;
      }
    })
  }

  function verif_all() {
    Swal.fire({
      title: "Konfirmasi sah semua pengujian ini",
      text: "Yakin ingin mensahkan semua pengujian ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= $_url_verif_all ?>/";
      }
    })
  }

  function batal(id, tipe) {
    Swal.fire({
      title: "Konfirmasi Membatalkan pensahan pengujian ini",
      text: "Yakin ingin Membatalkan pensahan pengujian ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= $_url_batal ?>/" + id;
      }
    })
  }

  function batal_all() {
    Swal.fire({
      title: "Konfirmasi Membatalkan semua pensahan pengujian ini",
      text: "Yakin ingin Membatalkan semua pensahan pengujian ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= $_url_batal_all ?>/";
      }
    })
  }

  function tolak(id) {
    Swal.fire({
      title: "Konfirmasi mengubah status pengujian menjadi tidak sah",
      text: "Yakin ingin mengubah status pengujian menjadi tidak sah?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= $_url_tolak ?>/" + id;
      }
    })
  }

  function tolak_all() {
    Swal.fire({
      title: "Konfirmasi mengubah semua status pengujian menjadi tidak sah",
      text: "Yakin ingin mengubah semua status pengujian menjadi tidak sah?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= $_url_tolak_all ?>/";
      }
    })
  }

  function pengujianAllTipe(tipe) {
    window.location.href = "<?= $_url_pengujian ?>/" + tipe;
  }

  function pengujianTipe(id, tipe) {
    window.location.href = "<?= $_url_pengujian ?>/" + id + "/" + tipe;
  }
  async function cetakHasilPengujian(id, tipe) {
    const {
      value: no_surat
    } = await Swal.fire({
      title: 'Masukkan NO Surat',
      input: 'text',
      inputValue: "000 / 000 / 000 ",
      inputAttributes: {
        autocapitalize: 'off'
      },
      inputValidator: (value) => {
        if (!value) {
          return 'Tidak boleh kosong!'
        }
      },
      inputLabel: 'No Surat',
      inputPlaceholder: 'Masukkan No Surat'
    })

    if (no_surat) {
      window.open("<?= $_url_pengujian ?>/" + id + "/" + tipe + "/print_hasil?no_surat=" + no_surat, "_blank")
    }
  }
  async function cetakKeteranganPengganti(id) {
    const {
      value: no_surat
    } = await Swal.fire({
      title: 'Masukkan NO Surat',
      input: 'text',
      inputValue: "000 / 000 / 000 ",
      inputAttributes: {
        autocapitalize: 'off'
      },
      inputValidator: (value) => {
        if (!value) {
          return 'Tidak boleh kosong!'
        }
      },
      inputLabel: 'No Surat',
      inputPlaceholder: 'Masukkan No Surat'
    })

    if (no_surat) {
      window.open("<?= $_url_pengujian ?>/" + id + "/print_keterangan_pengganti?no_surat=" + no_surat, "_blank")
    }
  }

  function detailPengujianTeraUttp(index) {
    var tera_uttp = datas[index];
    $('.tera_uttp_merk').html(tera_uttp.tera_uttp_merk);
    $('.tera_uttp_tipe').html(tera_uttp.tera_uttp_tipe);
    $('.tera_uttp_no_seri').html(tera_uttp.tera_uttp_no_seri);
    $('.tera_uttp_buatan').html(tera_uttp.tera_uttp_buatan);
    $('.tera_uttp_volume').html(tera_uttp.tera_uttp_volume);
    $('.tera_uttp_merk_kendaraan').html(tera_uttp.tera_uttp_merk_kendaraan);
    $('.tera_uttp_no_polisi').html(tera_uttp.tera_uttp_no_polisi);
    $('.tera_uttp_no_kd_plat').html(tera_uttp.tera_uttp_no_kd_plat);
    $('.tera_uttp_keterangan').html(tera_uttp.tera_uttp_keterangan);
    if (tera_uttp.tera_uttp_detail_t1_muka != null) {
      // Muka
      $('.tera_uttp_detail_t1_muka').html(formatRupiah(tera_uttp.tera_uttp_detail_t1_muka));
      $('.tera_uttp_detail_t2_muka').html(formatRupiah(tera_uttp.tera_uttp_detail_t2_muka));
      $('.tera_uttp_detail_t3_muka').html(formatRupiah(tera_uttp.tera_uttp_detail_t3_muka));
      $('.tera_uttp_detail_t4_muka').html(formatRupiah(tera_uttp.tera_uttp_detail_t4_muka));
      $('.tera_uttp_detail_t_muka').html(formatRupiah(tera_uttp.tera_uttp_detail_t_muka));
      $('.tera_uttp_detail_d_muka').html(formatRupiah(tera_uttp.tera_uttp_detail_d_muka));
      $('.tera_uttp_detail_p_muka').html(formatRupiah(tera_uttp.tera_uttp_detail_p_muka));
      $('.tera_uttp_detail_q_muka').html(formatRupiah(tera_uttp.tera_uttp_detail_q_muka));
      $('.tera_uttp_detail_s_muka').html(formatRupiah(tera_uttp.tera_uttp_detail_s_muka));
      // Belakang
      $('.tera_uttp_detail_t1_belakang').html(formatRupiah(tera_uttp.tera_uttp_detail_t1_belakang));
      $('.tera_uttp_detail_t2_belakang').html(formatRupiah(tera_uttp.tera_uttp_detail_t2_belakang));
      $('.tera_uttp_detail_t3_belakang').html(formatRupiah(tera_uttp.tera_uttp_detail_t3_belakang));
      $('.tera_uttp_detail_t4_belakang').html(formatRupiah(tera_uttp.tera_uttp_detail_t4_belakang));
      $('.tera_uttp_detail_t_belakang').html(formatRupiah(tera_uttp.tera_uttp_detail_t_belakang));
      $('.tera_uttp_detail_d_belakang').html(formatRupiah(tera_uttp.tera_uttp_detail_d_belakang));
      $('.tera_uttp_detail_p_belakang').html(formatRupiah(tera_uttp.tera_uttp_detail_p_belakang));
      $('.tera_uttp_detail_q_belakang').html(formatRupiah(tera_uttp.tera_uttp_detail_q_belakang));
      $('.tera_uttp_detail_s_belakang').html(formatRupiah(tera_uttp.tera_uttp_detail_s_belakang));
    }
    $('.tera_uttp_pengujian_status_sah_row').addClass('d-none');
    $('.tera_uttp_pengujian_status_batal_row').addClass('d-none');
    var status = "Proses";
    if (tera_uttp.tera_uttp_pengujian_status == 1) {
      if (tera_uttp.tera_uttp_pengujian_status_by != null) {
        $('.tera_uttp_pengujian_status_sah_row').removeClass('d-none');
        $('.tera_uttp_pengujian_status_sah').html(tera_uttp.admin_nama + " Pada " + toLocaleDate(tera_uttp.tera_uttp_pengujian_status_at, 'LLL'))
      }
      status = "Disahkan"
    } else if (tera_uttp.tera_uttp_pengujian_status == 2) {
      if (tera_uttp.tera_uttp_pengujian_status_by != null) {
        $('.tera_uttp_pengujian_status_batal_row').removeClass('d-none');
        $('.tera_uttp_pengujian_status_batal').html(tera_uttp.admin_nama + " Pada " + toLocaleDate(tera_uttp.tera_uttp_pengujian_status_at, 'LLL'))
      }
      status = "Dibatalkan"
    }
    $('.tera_uttp_pengujian_status').html(status);
    $('.tera_uttp_pengujian_at').html(toLocaleDate(tera_uttp.tera_uttp_pengujian_at, 'LLL'));
    $('#detailPengujianTeraUttpModal').modal()
  }

  function detail() {
    $('.tera_no_order_row').addClass('d-none');
    $('.tera_status_verif_row').addClass('d-none');
    $('.tera_status_tolak_row').addClass('d-none');
    if (tera.tera_status >= 1 && tera.tera_no_order != null) {
      $('.tera_no_order_row').removeClass('d-none');
      $('.tera_no_order').html(tera.tera_no_order);
    }
    $('.user_nama').html(tera.user_nama);
    $('.user_alamat').html(tera.user_alamat);
    $('.tera_atas_nama').html(tera.tera_atas_nama);
    $('.tera_atas_nama_alamat').html(tera.tera_atas_nama_alamat);
    $('.jenis_tempat_nama').html(tera.jenis_tempat_nama);
    $('.jenis_tera_nama').html(tera.jenis_tera_nama);
    var status = "Proses";
    if (tera.tera_status == 1) {
      if (tera.tera_status_by != null) {
        $('.tera_status_verif_row').removeClass('d-none');
        $('.tera_status_verif').html(tera.tera_status_admin_nama + " Pada " + toLocaleDate(tera.tera_status_at, 'LLL'))
      }
      status = "Verifikasi"
    } else if (tera.tera_status == 2) {
      if (tera.tera_status_by != null) {
        $('.tera_status_tolak_row').removeClass('d-none');
        $('.tera_status_tolak').html(tera.tera_status_admin_nama + " Pada " + toLocaleDate(tera.tera_status_at, 'LLL'))
      }
      status = "Ditolak"
    }
    $('.tera_ketetapan').html(tera.tera_ketetapan_admin_nama + " Pada " + toLocaleDate(tera.tera_ketetapan_at, 'LLL'))
    $('.tera_date_order').html(toLocaleDate(tera.tera_date_order));
    $('.tera_created').html(toLocaleDate(tera.tera_created, 'LLL'));
    $('.tera_status').html(status);
    $('.tbody-jenis_uttps').html("")
    var tbody = ""
    tera.tera_uttps.forEach((item, index) => {
      var total_retribusi = 0;
      total_retribusi = parseInt(item.tera_uttp_jumlah) * parseInt(item.tera_uttp_retribusi) + parseInt(item.tera_uttp_sanksi_adm);
      tbody += "<tr>"
      tbody += "<td>"
      tbody += index + 1
      tbody += "</td>"
      tbody += "<td>"
      tbody += item.jenis_uttp_nama
      tbody += "</td>"
      tbody += "<td>"
      tbody += formatRupiah(item.tera_uttp_kapasitas)
      tbody += " "
      tbody += item.tera_uttp_daya_baca
      tbody += "</td>"
      tbody += "<td>"
      tbody += formatRupiah(item.tera_uttp_jumlah)
      tbody += "</td>"
      tbody += "<td>"
      tbody += formatRupiah(item.tera_uttp_retribusi)
      tbody += "</td>"
      tbody += "<td>"
      tbody += formatRupiah(item.tera_uttp_sanksi_adm)
      tbody += "</td>"
      tbody += "<td>"
      tbody += formatRupiah("" + total_retribusi)
      tbody += "</td>"
      tbody += "</tr>"
    })
    $('.tbody-jenis_uttps').html(tbody)
    $('#detailTeraModal').modal()
  }

  $(function() {
    var tera_uttp_pengujian_at = "<?= $_tera_uttp_pengujian_at ?? '' ?>";
    if (tera_uttp_pengujian_at != "") {
      var date1 = moment(tera_uttp_pengujian_at);
      var date2 = moment()
      $('.diuji_diff').html(date2.diff(date1, 'days') + " Hari yang lalu")
    }
    $(":input").inputmask();
    var add = {}
    <?php
    $tera = json_decode($_tera);
    ?>
    tera = <?= $_tera ?>;
    tabel = $("#datatable").DataTable({
      "language": {
        "buttons": {
          "pageLength": {
            "_": "Tampil %d baris <i class='fas fa-fw fa-caret-down'></i>",
            "-1": "Tampil Semua <i class='fas fa-fw fa-caret-down'></i>"
          }
        },
        "lengthMenu": "Tampil _MENU_ data per hal",
        "zeroRecords": "Data tidak ditemukan",
        "info": "Tampil halaman _PAGE_ dari _PAGES_",
        "infoEmpty": "Tidak ada data",
        "infoFiltered": "(difilter dari _MAX_ total data)"
      },
      "dom": 'Bfrtip',
      "buttons": [{
        extend: "pageLength",
        attr: {
          "class": "btn btn-primary"
        },
      }, {
        text: '<i class="fas fa-fw fa-sync"></i> Segarkan',
        attr: {
          "class": "btn btn-info"
        },
        action: function(e, dt, node, config) {
          data = {};
          $('#tera_uttp_pengujian_status').val('');
          $('.date').html('Pilih Tanggal');
          start = moment();
          end = moment();
          cb(start, end)
          dt.ajax.reload()
        }
      }],
      "searching": false,
      "processing": true,
      "serverSide": true,
      "ordering": true, // Set true agar bisa di sorting
      "order": [
        [0, 'asc'],
      ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
      'columnDefs': [{
        "targets": [6],
        "orderable": false
      }],
      "ajax": {
        "url": "<?= $_uri_datatable ?>", // URL file untuk proses select datanya
        "type": "POST",
        "data": function(d) {
          return {
            ...d,
            ...data
          }
        }
      },
      "initComplete": function(settings, json) {
        datas = json.data;
      },
      "scrollY": "<?= $_scroll_datatable ?>",
      "scrollCollapse": true,
      "lengthChange": true,
      "lengthMenu": [
        [10, 25, 50, -1],
        ['10 baris', '25 baris', '50 baris', 'Tampilkan Semua']
      ],
      "columns": [{
          "data": "tera_uttp_id",
        }, {
          "data": "tera_uttp_merk",
        }, {
          "data": "tera_uttp_tipe",
        }, {
          "data": "tera_uttp_no_seri",
        }, {
          "data": "tera_uttp_pengujian_status",
          "render": function(data, type, row, meta) { // Tampilkan kolom aksi
            var status = "Proses"
            if (row.tera_uttp_pengujian_status == 1) {
              status = "Disahkan " + row.admin_nama
            } else if (row.tera_uttp_pengujian_status == 2) {
              status = "Dibatalkan " + row.admin_nama
            }
            return status;
          }
        }, {
          "data": "tera_uttp_pengujian_at",
          "render": function(data, type, row, meta) {
            var tanggal = row.tera_uttp_pengujian_at;
            if (tanggal != null) {
              tanggal = toLocaleDate(tanggal)
            } else {
              tanggal = "belum diuji"
            }
            return tanggal;
          }
        },
        {
          "render": function(data, type, row, meta) { // Tampilkan kolom aksi
            var role_id = "<?= $_role_id ?>";
            var html = '<button type="button" class="btn btn-link text-primary" onClick="detailPengujianTeraUttp(' + meta.row + ')"><i class="fa fa-fw fa-eye" aria-hidden="true" title="Detail Pengujian"></i></button>'
            if (row.tera_uttp_pengujian_status == 0 && role_id == 4) {
              html += '<button type="button" class="btn btn-link text-info" onClick="pengujianTipe(' + row.tera_uttp_id + ',1)">Pengujian Tipe 1</button>'
              html += '<button type="button" class="btn btn-link text-info" onClick="pengujianTipe(' + row.tera_uttp_id + ',2)">Pengujian Tipe 2</button>'
              html += '<button type="button" class="btn btn-link text-info" onClick="pengujianTipe(' + row.tera_uttp_id + ',3)">Pengujian Tipe 3</button>'
              html += '<button type="button" class="btn btn-link text-success" onClick="verif(' + row.tera_uttp_id + ')"><i class="fa fa-fw fa-check" aria-hidden="true" title="Verif Pengujian"></i></button>'
              html += '<button type="button" class="btn btn-link text-danger" onClick="tolak(' + row.tera_uttp_id + ')"><i class="fa fa-fw fa-times" aria-hidden="true" title="Tolak Pengujian"></i></button>'
            } else {
              var text = "Tolak"
              var tipe = 2;
              if (row.tera_uttp_pengujian_status == 1) {
                text = "Verif"
                tipe = 1;
                html += '<button type="button" class="btn btn-link text-info" onClick="cetakHasilPengujian(' + row.tera_uttp_id + ',1)">Cetak Pengujian Tipe 1</button>'
                html += '<button type="button" class="btn btn-link text-info" onClick="cetakHasilPengujian(' + row.tera_uttp_id + ',2)">Cetak Pengujian Tipe 2</button>'
                html += '<button type="button" class="btn btn-link text-info" onClick="cetakHasilPengujian(' + row.tera_uttp_id + ',3)">Cetak Pengujian Tipe 3</button>'
                if (role_id == 4) {
                  html += '<button type="button" class="btn btn-link text-info" onClick="cetakKeteranganPengganti(' + row.tera_uttp_id + ',3)">Cetak Keterangan Pengganti Tanda Tera</button>'
                }
              }
              if (role_id == 4) {
                html += '<button type="button" class="btn btn-link text-danger" onClick="batal(' + row.tera_uttp_id + ',' + tipe + ')"><i class="fa fa-fw fa-times" aria-hidden="true" title="Batal ' + text + ' Pengujian"></i></button>'
              }
            }
            return html
          }
        },
      ],
    });

    tabel.on('order.dt page.dt', function() {
      tabel.column(0, {
        order: 'applied',
        page: 'applied',
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1;
      });
    }).draw();
    $('#tera_uttp_pengujian_status').on('change clear', function() {
      var value = $(this).val();
      data.tera_uttp_pengujian_status = value;
      tabel.ajax.reload(null, function(data) {
        datas = json.data
      })
    })
    moment.locale('id')
    start = moment();
    end = moment();

    function cb(start, end) {
      data.date = start.format('YYYY-MM-D') + '/' + end.format('YYYY-MM-D');
      $('.date').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'))
      tabel.ajax.reload(function(json) {
        datas = json.data
      })
    }

    $('#daterange').daterangepicker({
      showDropdowns: true,
      autoApply: false,
      startDate: start,
      endDate: end,
      locale: {
        customRangeLabel: 'Tentukan Sendiri',
        cancelLabel: 'Batal',
        applyLabel: 'Pilih',
      },
      ranges: {
        'Hari ini': [moment(), moment()],
        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 Hari terakhir': [moment().subtract(6, 'days'), moment()],
        '30 Hari terakhir': [moment().subtract(29, 'days'), moment()],
        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
        'Bulan sebelumnya': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, cb);
    cb(start, end)
    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
      cb(picker.startDate, picker.endDate)
    })
  });
</script>
<?= $this->endSection('customjs'); ?>