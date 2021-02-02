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
        <p>Total Retribusi: Rp<?= format_rupiah($_total_bayar) ?></p>
        <?php if ($_total_kurang_bayar < 0) : ?>
          <p>Total Lebih Bayar: Rp<?= format_rupiah($_total_kurang_bayar * -1) ?></p>
        <?php else : ?>
          <p>Total Kurang Bayar: Rp<?= format_rupiah($_total_kurang_bayar) ?></p>
        <?php endif ?>
        <button class="btn btn-primary mb-1" onClick="detail()"><i class="fa fa-eye"></i> Detail Tera</button>
        <a href="<?= $_url_skrd ?>" class="mb-1 btn btn-success" role="button"><i class="fas fa-folder-open"></i> SKRD</a>
        <a href="<?= $_url_skrdkb ?>" class="mb-1 btn btn-success" role="button"><i class="fas fa-folder-open"></i> SKRDKB</a>
        <a href="<?= $_url_skrdlb ?>" class="mb-1 btn btn-success" role="button"><i class="fas fa-folder-open"></i> SKRDLB</a>
        <a class="btn btn-secondary mb-1" href="<?= $_url_back ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
        <h5>Filter</h5>
        <div class="form-group row">
          <div class="col-md-4">
            <select class="form-control form-control-sm" id="tera_ssrd_status">
              <option value="">--Pilih Status--</option>
              <option value="0">Proses</option>
              <option value="1">Verif</option>
              <option value="2">Tolak</option>
            </select>
          </div>
          <div class="col-md-4">
            <div id="daterange" class="form-control form-control-sm"><span class="date">Pilih Tanggal</span> <i class="fa fa-calendar"></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i></div>
          </div>
        </div>
        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Uang</th>
              <th>Bank</th>
              <th>No Rek.</th>
              <th>Kode Rek.</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Uang</th>
              <th>Bank</th>
              <th>No Rek</th>
              <th>Kode Rek.</th>
              <th>Status</th>
              <th>Tanggal</th>
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
      title: "Konfirmasi Verifikasi SSRD Tera",
      text: "Yakin ingin memverifikasi SSRD ini?",
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

  function batal(id, tipe) {
    Swal.fire({
      title: "Konfirmasi Membatalkan Status SSRD Tera",
      text: "Yakin ingin Membatalkan Status SSRD ini?",
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

  function tolak(id) {
    Swal.fire({
      title: "Konfirmasi Menolak SSRD Tera",
      text: "Yakin ingin Menolak SSRD ini?",
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
  async function printSSRD(id) {
    const {
      value: no_register
    } = await Swal.fire({
      title: 'Masukkan NO Register',
      input: 'text',
      inputValue: "0 / 0 / 0",
      inputAttributes: {
        autocapitalize: 'off'
      },
      inputValidator: (value) => {
        if (!value) {
          return 'Tidak boleh kosong!'
        }
      },
      inputLabel: 'No Register',
      inputPlaceholder: 'Masukkan No Register'
    })

    if (no_register) {
      window.open("<?= $_print_ssrd ?>/" + id + "?no_register=" + no_register, "_blank")
    }
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
    var add = {}
    <?php
    $tera = json_decode($_tera);
    if ($tera->tera_status_bayar != 1) : ?>
      add = {
        text: '<i class="fas fa-fw fa-plus"></i> Tambah',
        attr: {
          "class": "btn btn-success"
        },
        action: function(e, dt, node, config) {
          window.location.href = "<?= $_url_tambah ?>"
        }
      }
    <?php endif ?>
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
      }, add, {
        text: '<i class="fas fa-fw fa-sync"></i> Segarkan',
        attr: {
          "class": "btn btn-info"
        },
        action: function(e, dt, node, config) {
          data = {};
          $('#tera_ssrd_status').val('');
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
        [6, 'desc'],
      ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
      'columnDefs': [{
        "targets": [7],
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
          "data": "tera_ssrd_id",
        }, {
          "data": "tera_ssrd_uang",
          "render": function(data, type, row, meta) { // Tampilkan kolom aksi
            return formatRupiah(row.tera_ssrd_uang, 'Rp');
          }
        }, {
          "data": "tera_ssrd_bank",
        }, {
          "data": "tera_ssrd_no_rek",
        }, {
          "data": "tera_ssrd_kd_rek",
        }, {
          "data": "tera_ssrd_status",
          "render": function(data, type, row, meta) { // Tampilkan kolom aksi
            var status = "Proses"
            if (row.tera_ssrd_status == 1) {
              status = "Diverif " + row.admin_nama
            } else if (row.tera_ssrd_status == 2) {
              status = "Ditolak " + row.admin_nama
            }
            return status;
          }
        }, {
          "data": "tera_ssrd_date",
          "render": function(data, type, row, meta) { // Tampilkan kolom aksi
            return toLocaleDate(row.tera_ssrd_date)
          }
        },
        {
          "render": function(data, type, row, meta) { // Tampilkan kolom aksi
            var html = ""
            if (row.tera_ssrd_status == 0 && tera.tera_status_bayar != 1) {
              html += '<button type="button" class="btn btn-link text-success" onClick="verif(' + row.tera_ssrd_id + ')"><i class="fa fa-fw fa-check" aria-hidden="true" title="Verif SSRD"></i></button>'
              html += '<button type="button" class="btn btn-link text-danger" onClick="tolak(' + row.tera_ssrd_id + ')"><i class="fa fa-fw fa-times" aria-hidden="true" title="Tolak SSRD"></i></button>'
            } else {
              var text = "Tolak"
              var tipe = 2;
              if (row.tera_ssrd_status == 1) {
                text = "Verif"
                tipe = 1;
              }
              html += '<button type="button" class="btn btn-link text-danger" onClick="batal(' + row.tera_ssrd_id + ',' + tipe + ')"><i class="fa fa-fw fa-times" aria-hidden="true" title="Batal ' + text + ' SSRD"></i></button>'
            }
            html += '<button type="button" class="btn btn-link text-info" onClick="printSSRD(' + row.tera_ssrd_id + ')"><i class="fa fa-fw fa-print" aria-hidden="true" title="Print SSRD"></i></button>'
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
    $('#tera_ssrd_status').on('change clear', function() {
      var value = $(this).val();
      data.tera_ssrd_status = value;
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