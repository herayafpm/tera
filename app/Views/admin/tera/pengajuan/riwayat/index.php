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
        <h5>Filter</h5>
        <div class="form-group row">
          <div class="col-md-4"><input data-inputmask="'mask': '9', 'repeat': 16, 'greedy' : false" class="form-control form-control-sm" type="text" id="user_nik" placeholder="NIK" /></div>
          <div class="col-md-4">
            <div id="daterange" class="form-control form-control-sm"><span class="date">Pilih Tanggal</span> <i class="fa fa-fw fa-calendar"></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i></div>
          </div>
        </div>
        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
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
              <th>Nama</th>
              <th>Alamat</th>
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
<div class="modal fade" id="detailPengajuanTeraModal" tabindex="-1" role="dialog" aria-labelledby="detailPengajuanTeraModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailPengajuanTeraModalLabel">Detail Tera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" data-id="">
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
            Status
          </div>
          <div class="col">
            : <span class="tera_pengajuan_status"></span>
          </div>
        </div>
        <div class="row tera_pengajuan_status_verif_row">
          <div class="col-4">
            Diverifikasi
          </div>
          <div class="col">
            : <span class="tera_pengajuan_status_verif"></span>
          </div>
        </div>
        <div class="row tera_pengajuan_status_tolak_row">
          <div class="col-4">
            Ditolak
          </div>
          <div class="col">
            : <span class="tera_pengajuan_status_tolak"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Petugas
          </div>
          <div class="col row">
            <span class="ml-2">:</span>
            <div class="tera_petugas"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Tanggal Order
          </div>
          <div class="col">
            : <span class="tera_pengajuan_date_order"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Tanggal Dibuat
          </div>
          <div class="col">
            : <span class="tera_pengajuan_date"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Keterangan
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="tera_pengajuan_keterangan"></div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
            No Pendaftaran
          </div>
          <div class="col">
            : <span class="tera_no_pendaftaran"></span>
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

  function detail(index) {
    var tera_pengajuan = datas[index];
    $('.tera_pengajuan_status_verif_row').addClass('d-none');
    $('.tera_pengajuan_status_tolak_row').addClass('d-none');
    $('.user_nama').html(tera_pengajuan.user_nama);
    $('.user_alamat').html(tera_pengajuan.user_alamat);
    var status = "Proses";
    if (tera_pengajuan.tera_pengajuan_status == 1) {
      if (tera_pengajuan.tera_pengajuan_status_by != null) {
        $('.tera_pengajuan_status_verif_row').removeClass('d-none');
        $('.tera_pengajuan_status_verif').html(tera_pengajuan.tera_pengajuan_status_admin_nama + " Pada " + toLocaleDate(tera_pengajuan.tera_pengajuan_status_at, 'LLL'))
      }
      status = "Verifikasi"
    } else if (tera_pengajuan.tera_pengajuan_status == 2) {
      if (tera_pengajuan.tera_pengajuan_status_by != null) {
        $('.tera_pengajuan_status_tolak_row').removeClass('d-none');
        $('.tera_pengajuan_status_tolak').html(tera_pengajuan.tera_pengajuan_status_admin_nama + " Pada " + toLocaleDate(tera_pengajuan.tera_pengajuan_status_at, 'LLL'))
      }
      status = "Ditolak"
    }
    $('.tera_pengajuan_date_order').html(toLocaleDate(tera_pengajuan.tera_pengajuan_date_order));
    $('.tera_pengajuan_date').html(toLocaleDate(tera_pengajuan.tera_pengajuan_date, 'LLL'));
    var keterangan = tera_pengajuan.tera_pengajuan_keterangan;
    var petugas = "<ol>";
    tera_pengajuan.petugas.forEach(element => {
      petugas += "<li>"
      petugas += element.tera_petugas_admin_nama
      petugas += "</li>"
    });
    petugas += "</ol>"
    $('.tera_petugas').html(petugas);
    $('.tera_pengajuan_keterangan').html(keterangan);
    $('.tera_pengajuan_status').html(status);
    $('#detailPengajuanTeraModal').modal()
  }

  function detailTera(index) {
    var tera = datas[index].tera;
    $('.tera_no_pendaftaran').html(tera.tera_no_pendaftaran)
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

  function batalVerif(id) {
    Swal.fire({
      title: "Konfirmasi Batalkan Verifikasi",
      text: "Yakin ingin membatalkan verifikasi pengajuan tera ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= $_batal_tera ?>/" + id + "/1";
      }
    })
  }

  function batalTolak(id) {
    Swal.fire({
      title: "Konfirmasi Batalkan Penolakan Pengajuan Tera",
      text: "Yakin ingin membatalkan penolakan pengajuan tera ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= $_batal_tera ?>/" + id + "/2";
      }
    })
  }

  function verif(id) {
    Swal.fire({
      title: "Konfirmasi Verifikasi",
      text: "Yakin ingin verifikasi pengajuan tera ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= $_proses_tera ?>/" + id + "/1";
      }
    })

  }

  function tolak(id) {
    Swal.fire({
      title: "Konfirmasi Penolakan",
      text: "Yakin ingin menolak pengajuan tera ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= $_proses_tera ?>/" + id + "/2";
      }
    })
  }

  async function printSuratTugas(id) {
    const {
      value: no_surat
    } = await Swal.fire({
      title: 'Masukkan NO Surat',
      input: 'text',
      inputValue: "800 / 000 / 000 / 000",
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
      window.open("<?= $_print_surat_tugas ?>/" + id + "?no_surat=" + no_surat, "_blank")
    }
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
        [4, 'desc'],
      ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
      'columnDefs': [{
        "targets": [5],
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
          "data": "tera_id",
        }, {
          "data": "user_nama",
        }, {
          "data": "user_alamat",
        }, {
          "data": "tera_pengajuan_status",
          "render": function(data, type, row, meta) {
            var status = "Proses"
            if (row.tera_pengajuan_status == 1) {
              status = "Diverif Oleh " + row.tera_pengajuan_status_admin_nama
            } else if (row.tera_pengajuan_status == 2) {
              status = "Ditolak Oleh " + row.tera_pengajuan_status_admin_nama
            }
            return status;
          }

        }, {
          "data": "tera_pengajuan_date",
          "render": function(data, type, row, meta) {
            return toLocaleDate(row.tera_pengajuan_date)
          }
        },
        {
          "render": function(data, type, row, meta) {
            var html = '<button type="button" class="btn btn-link text-info" onClick="detail(' + meta.row + ')"><i class="fa fa-fw fa-eye" aria-hidden="true" title="Detail"></i></button>'
            html += '<button type="button" class="btn btn-link text-info" onClick="detailTera(' + meta.row + ')">Detail Tera</button>'
            if (row.tera_pengajuan_status == 0) {
              html += '<button type="button" class="btn btn-link text-success" onClick="verif(' + row.tera_pengajuan_id + ')"><i class="fa fa-fw fa-check" aria-hidden="true" title="Verif"></i></button>'
              html += '<button type="button" class="btn btn-link text-danger" onClick="tolak(' + row.tera_pengajuan_id + ')"><i class="fa fa-fw fa-times" aria-hidden="true" title="Tolak"></i></button>'
            }
            if (row.tera_pengajuan_status_by == "<?= $_admin->admin_id ?>") {
              if (row.tera_pengajuan_status == 1) {
                html += '<button type="button" class="btn btn-link text-success" onclick="printSuratTugas(' + row.tera_pengajuan_id + ')"><i class="fa fa-fw fa-print" aria-hidden="true" title="Print Surat Tugas"></i></button>'
                html += '<button type="button" class="btn btn-link text-danger" onClick="batalVerif(' + row.tera_pengajuan_id + ')"><i class="fa fa-fw fa-times" aria-hidden="true" title="Batal Verif"></i></button>'
              } else if (row.tera_pengajuan_status == 2) {
                html += '<button type="button" class="btn btn-link text-danger" onClick="batalTolak(' + row.tera_pengajuan_id + ')"><i class="fa fa-fw fa-times" aria-hidden="true" title="Batal Tolak"></i></button>'
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
    $('#user_nik').on('keyup change clear', function() {
      var value = $(this).val();
      var min_karakter = 16;
      if (value.length >= min_karakter) {
        data.user_nik = value;
      }
      if (value.length == 0 && value.length < min_karakter) {
        data.user_nik = "";
      }
      if (value.length >= min_karakter || value.length == 0) {
        tabel.ajax.reload(null, function(data) {
          datas = json.data
        })
      }
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