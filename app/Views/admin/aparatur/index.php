<?= $this->extend('admin/template'); ?>
<?= $this->section('customcss'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?= $this->endSection('customcss'); ?>
<?= $this->section('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <h5>Filter</h5>
        <div class="form-group row">
          <div class="col-md-4"><input data-inputmask="'mask': '99999999 999999 9 999'" class="form-control form-control-sm mb-1" type="text" id="aparatur_nip" placeholder="NIP (min. 3 karakter)" /></div>
          <div class="col-md-4"><input class="form-control form-control-sm" type="text" id="aparatur_nama" placeholder="Nama (min. 3 karakter)" /></div>
          <div class="col-md-4">
            <select class="form-control form-control-sm" id="aparatur_pangkat">
              <option value="">--Pilih Pangkat--</option>
              <?php foreach ($_pangkats as $pangkat) : ?>
                <option value="<?= $pangkat ?>"><?= $pangkat ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-control form-control-sm" id="jabatan_id">
              <option value="">--Pilih Jabatan--</option>
              <?php foreach ($_jabatans as $jabatan) : ?>
                <?php if ($jabatan['jabatan_id'] != 1) : ?>
                  <option value="<?= $jabatan['jabatan_id'] ?>"><?= $jabatan['jabatan_nama'] ?></option>
                <?php endif ?>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Pangkat</th>
              <th>Jabatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Pangkat</th>
              <th>Jabatan</th>
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
<script src="<?= base_url('assets/vendor') ?>/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
  var tabel = null;
  var datas = [];
  var id = null;
  var data = {};

  function ubah(id) {
    window.location.href = "<?= base_url('admin/aparatur/ubah') ?>/" + id;
  }

  function hapus(id) {
    hapusData({
      fun: function() {
        window.location.href = "<?= base_url('admin/aparatur/hapus') ?>/" + id
      }
    })
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
        text: '<i class="fas fa-fw fa-plus"></i> Tambah',
        attr: {
          "class": "btn btn-success"
        },
        action: function(e, dt, node, config) {
          window.location.href = "<?= base_url('admin/aparatur/tambah') ?>"
        }
      }, {
        text: '<i class="fas fa-fw fa-sync"></i> Segarkan',
        attr: {
          "class": "btn btn-info"
        },
        action: function(e, dt, node, config) {
          data = {};
          $('#aparatur_nip').val('');
          $('#aparatur_nama').val('');
          $('#aparatur_pangkat').val('');
          $('#jabatan_id').val('');
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
      'columnDefs': [{
        "targets": [5],
        "orderable": false
      }],
      "ajax": {
        "url": "<?= $_uri_datatable ?>", // URL file untuk proses select datanya
        "type": "POST",
        "data": function(d) {
          console.log(data)
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
          "data": "aparatur_id",
        },
        {
          "data": "aparatur_nip",
        },
        {
          "data": "aparatur_nama",
        },
        {
          "data": "aparatur_pangkat",
        },
        {
          "data": "jabatan_nama",
        },
        {
          "render": function(data, type, row, meta) { // Tampilkan kolom aksi
            html = '<button type="button" class="btn btn-link text-info" onClick="ubah(' + row.aparatur_id + ')"><i class="fa fa-fw fa-edit" aria-hidden="true" title="Edit ' +
              row.aparatur_nama + '"></i></button>'
            html += '<form method="POST" class="d-inline deleteData"><button type="button" class="btn btn-link text-danger" onClick="hapus(' + row.aparatur_id + ')"><i class="fa fa-fw fa-trash" aria-hidden="true" title="Hapus ' + row.aparatur_nama + '"></i></button></form>'
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
    $('#aparatur_nip').on('keyup change clear', function() {
      var value = $(this).inputmask('unmaskedvalue');
      var min_karakter = 3;
      if (value.length >= min_karakter) {
        data.aparatur_nip = value;
      }
      if (value.length == 0 && value.length < min_karakter) {
        data.aparatur_nip = "";
      }
      if (value.length >= min_karakter || value.length == 0) {
        tabel.ajax.reload(null, function(data) {
          datas = json.data
        })
      }
    })
    $('#aparatur_nama').on('keyup change clear', function() {
      var value = $(this).val();
      var min_karakter = 3;
      if (value.length >= min_karakter) {
        data.aparatur_nama = value;
      }
      if (value.length == 0 && value.length < min_karakter) {
        data.aparatur_nama = "";
      }
      if (value.length >= min_karakter || value.length == 0) {
        tabel.ajax.reload(null, function(data) {
          datas = json.data
        })
      }
    })
    $('#jabatan_id').on('change clear', function() {
      var value = $(this).val();
      data.jabatan_id = value;
      tabel.ajax.reload(null, function(data) {
        datas = json.data
      })
    })
    $('#aparatur_pangkat').on('change clear', function() {
      var value = $(this).val();
      data.aparatur_pangkat = value;
      tabel.ajax.reload(null, function(data) {
        datas = json.data
      })
    })
  });
</script>
<?= $this->endSection('customjs'); ?>