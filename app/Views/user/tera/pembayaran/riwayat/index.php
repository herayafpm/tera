<?= $this->extend('template'); ?>
<?= $this->section('customcss'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/daterangepicker/daterangepicker.css" />

<?= $this->endSection('customcss'); ?>
<?= $this->section('content'); ?>
<div class="container auth-section" data-aos="fade-up">
  <div class="section-title">
    <h2><?= $_title ?></h2>
    <p><?= env("app.appName") ?></p>
  </div>
  <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
    <div class="col-lg-12">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <h5>Filter</h5>
          <div class="form-group row">
            <div class="col-md-4 mb-1"><input class="form-control form-control-sm" type="text" id="tera_no_order" placeholder="No order" /></div>
            <div class="col-md-4 mb-1"><input class="form-control form-control-sm" type="text" id="tera_no_pendaftaran" placeholder="No Pendaftaran" /></div>
            <div class="col-md-4">
              <select class="form-control form-control-sm" id="jenis_tera_id">
                <option value="">--Pilih Jenis Pekerjaan--</option>
                <?php foreach ($_jenis_teras as $jenis_tera) : ?>
                  <option value="<?= $jenis_tera['jenis_tera_id'] ?>"><?= $jenis_tera['jenis_tera_nama'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>No Order</th>
                <th>No Pendaftaran</th>
                <th>Jenis Pekerjaan</th>
                <th>Jenis Tempat</th>
                <th>Ketetapan Retribusi</th>
                <th>Keringanan</th>
                <th>Status Pembayaran</th>
                <th>Total Retribusi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>No Order</th>
                <th>No Pendaftaran</th>
                <th>Jenis Pekerjaan</th>
                <th>Jenis Tempat</th>
                <th>Ketetapan Retribusi</th>
                <th>Keringanan</th>
                <th>Status Pembayaran</th>
                <th>Total Retribusi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>

  </div>

</div>
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
                <th>Keringanan</th>
                <th>Sanksi Administrasi</th>
                <th>Jumlah Retribusi</th>
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

  function detail(index) {
    var tera = datas[index];
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
        $('.tera_status_verif').html(tera.admin_nama + " Pada " + toLocaleDate(tera.tera_status_at, 'LLL'))
      }
      status = "Verifikasi"
    } else if (tera.tera_status == 2) {
      if (tera.tera_status_by != null) {
        $('.tera_status_tolak_row').removeClass('d-none');
        $('.tera_status_tolak').html(tera.admin_nama + " Pada " + toLocaleDate(tera.tera_status_at, 'LLL'))
      }
      status = "Ditolak"
    }
    $('.tera_date_order').html(toLocaleDate(tera.tera_date_order));
    $('.tera_created').html(toLocaleDate(tera.tera_created, 'LLL'));
    $('.tera_status').html(status);
    $('.tbody-jenis_uttps').html("")
    var tbody = ""
    tera.tera_uttps.forEach((item, index) => {
      var total_retribusi = (parseInt(item.tera_uttp_retribusi) * parseInt(item.tera_uttp_jumlah) - parseInt(item.tera_uttp_keringanan)) + parseInt(item.tera_uttp_sanksi_adm)
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
      tbody += formatRupiah(item.tera_uttp_keringanan)
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
    $(":input").inputmask();
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
          $('#tera_no_order').val('');
          $('#jenis_tera_id').val('');
          $('#user_nik').val('');
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
        [9, 'desc'],
      ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
      'columnDefs': [{
        "targets": [10],
        "orderable": false
      }, {
        "targets": [3, 4],
        "visible": false
      }],
      "rowGroup": {
        "dataSrc": ['jenis_tera_nama', 'jenis_tempat_nama']
      },
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
          "data": "tera_id",
        }, {
          "data": "tera_no_order",
        }, {
          "data": "tera_no_pendaftaran",
        }, {
          "data": "jenis_tera_nama",
        }, {
          "data": "jenis_tempat_nama",
        }, {
          "data": "tera_ketetapan_at",
          "render": function(data, type, row, meta) { // Tampilkan kolom aksi
            if (row.tera_ketetapan_at == null) {
              return "Belum ditetapkan SKRD";
            } else {
              return toLocaleDate(row.tera_ketetapan_at, 'LL')
            }
          }
        }, {
          "data": "tera_keringanan_at",
          "render": function(data, type, row, meta) { // Tampilkan kolom aksi
            if (row.tera_keringanan_at == null) {
              return "Tidak mengajukan Keringanan";
            } else {
              return toLocaleDate(row.tera_keringanan_at, 'LL')
            }
          }
        }, {
          "data": "tera_status_bayar",
          "render": function(data, type, row, meta) {
            var status = '<span class="text-danger"><i class="nav-icon fas fa-times"></i> Belum</span>'
            if (row.tera_status_bayar == 1) {
              status = '<span class="text-success"><i class="nav-icon fas fa-check"></i> Lunas</span>'
            } else if (row.tera_status_bayar == 2) {
              status = '<span class="text-warning"><i class="nav-icon fas fa-money-check"></i> Keringanan</span>'
            }
            return status;
          }
        }, {
          "render": function(data, type, row, meta) {
            var total_retribusi = 0;
            row.tera_uttps.forEach((element) => {
              total_retribusi += (parseInt(element.tera_uttp_retribusi) * parseInt(element.tera_uttp_jumlah) - parseInt(element.tera_uttp_keringanan)) + parseInt(element.tera_uttp_sanksi_adm)
            });
            return formatRupiah("" + total_retribusi)
          }
        }, {
          "data": "tera_created",
          "render": function(data, type, row, meta) { // Tampilkan kolom aksi
            return toLocaleDate(row.tera_created)
          }
        },
        {
          "render": function(data, type, row, meta) { // Tampilkan kolom aksi
            var html = '<button type="button" class="btn btn-link text-info" onClick="detail(' + meta.row + ')"><i class="fa fa-fw fa-eye" aria-hidden="true" title="Detail"></i></button>'
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
    $('#tera_no_order').on('keyup change clear', function() {
      var value = $(this).val();
      data.tera_no_order = value;
      tabel.ajax.reload(null, function(data) {
        datas = json.data
      })
    })
    $('#tera_no_pendaftaran').on('keyup change clear', function() {
      var value = $(this).val();
      data.tera_no_pendaftaran = value;
      tabel.ajax.reload(null, function(data) {
        datas = json.data
      })
    })
    $('#jenis_tera_id').on('change clear', function() {
      var value = $(this).val();
      data.jenis_tera_id = value;
      tabel.ajax.reload(null, function(data) {
        datas = json.data
      })
    })
  });
</script>
<?= $this->endSection('customjs'); ?>