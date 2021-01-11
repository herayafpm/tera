<?= $this->extend('admin/template'); ?>
<?= $this->section('customcss'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.css">
<?= $this->endSection('customcss'); ?>
<?= $this->section('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <h5>Filter</h5>
        <div class="form-group row">
          <div class="col-md-4"><input class="form-control form-control-sm" type="text" id="jenis_uttp_nama" placeholder="Jenis UTTP (min. 3 karakter)" /></div>
          <div class="col-md-4">
            <select class="form-control form-control-sm" id="jenis_uttp_tipe_id">
              <option value="">-- Tipe --</option>
              <option value="no_tipe">Tanpa Tipe</option>
              <?php foreach ($_jenis_uttp_tipes as $jenis_uttp_tipe) : ?>
                <option value="<?= $jenis_uttp_tipe['jenis_uttp_tipe_id'] ?>"><?= $jenis_uttp_tipe['jenis_uttp_tipe_nama'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-control form-control-sm" id="jenis_uttp_tempat_pakai">
              <option value="all">-- Pilih Tempat --</option>
              <option value="0">Semua Tempat</option>
              <option value="1">Bisa Di Tempat Pakai</option>
            </select>
          </div>
        </div>
        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Jenis</th>
              <th>Tipe</th>
              <th>Tempat Pakai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama Jenis</th>
              <th>Tipe</th>
              <th>Tempat Pakai</th>
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
<script>
  var tabel = null;
  var datas = [];
  var id = null;
  var data = {};

  function ubah(id) {
    window.location.href = "<?= base_url('admin/master/jenis_uttp/ubah') ?>/" + id;
  }

  function hapus(id) {
    hapusData({
      fun: function() {
        window.location.href = "<?= base_url('admin/master/jenis_uttp/hapus') ?>/" + id
      }
    })
  }
  $(function() {
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
        text: '<i class="fas fa-fw fa-plus"></i> Tambah',
        attr: {
          "class": "btn btn-success"
        },
        action: function(e, dt, node, config) {
          window.location.href = "<?= base_url('admin/master/jenis_uttp/tambah') ?>"
        }
      }, {
        text: '<i class="fas fa-fw fa-sync"></i> Segarkan',
        attr: {
          "class": "btn btn-info"
        },
        action: function(e, dt, node, config) {
          data = {};
          $('#jenis_uttp_nama').val('');
          $('#jenis_uttp_tipe_id').val("");
          $('#jenis_uttp_tempat_pakai').val("");
          dt.ajax.reload()
        }
      }],
      "searching": false,
      "processing": true,
      "serverSide": true,
      "ordering": true, // Set true agar bisa di sorting
      "order": [
        [0, 'desc']
      ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
      "rowGroup": {
        "dataSrc": 'jenis_uttp_tipe_nama'
      },
      'columnDefs': [{
        "targets": [4],
        "orderable": false
      }, {
        "targets": [2],
        "visible": false
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
          "data": "jenis_uttp_id",
        }, {
          "data": "jenis_uttp_nama",
        },
        {
          "data": "jenis_uttp_tipe_nama",
        },
        {
          "data": "jenis_uttp_tempat_pakai",
          "render": function(dt, type, row, meta) {
            return (row.jenis_uttp_tempat_pakai == 1) ? "Ya" : "Semua Tempat";
          }
        },
        {
          "render": function(dt, type, row, meta) { // Tampilkan kolom aksi
            var html = '<button type="button" class="btn btn-link text-info" onClick="ubah(' + row.jenis_uttp_id + ')"><i class="fa fa-fw fa-edit" aria-hidden="true" title="Edit ' + row.jenis_uttp_nama + '"></i></button>'
            html += '<form method="POST" class="d-inline deleteData"><button type="button" class="btn btn-link text-danger" onClick="hapus(' + row.jenis_uttp_id + ')"><i class="fa fa-fw fa-trash" aria-hidden="true" title="Hapus ' +
              row.jenis_uttp_nama + '"></i></button></form>'
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
    $('#jenis_uttp_nama').on('keyup change clear', function() {
      var value = $(this).val();
      var min_karakter = 3;
      if (value.length >= min_karakter) {
        data.jenis_uttp_nama = value;
      }
      if (value.length == 0 && value.length < min_karakter) {
        data.jenis_uttp_nama = "";
      }
      if (value.length >= min_karakter || value.length == 0) {
        tabel.ajax.reload(null, function(data) {
          datas = json.data
        })
      }
    })
    $('#jenis_uttp_tipe_id').on('change clear', function() {
      var value = $(this).val();
      data.jenis_uttp_tipe_id = value;
      tabel.ajax.reload(null, function(data) {
        datas = json.data
      })
    })
    $('#jenis_uttp_tempat_pakai').on('change clear', function() {
      var value = $(this).val();
      data.jenis_uttp_tempat_pakai = value;
      tabel.ajax.reload(null, function(data) {
        datas = json.data
      })
    })
  });
</script>
<?= $this->endSection('customjs'); ?>