<?= $this->extend('admin/template_surat'); ?>
<?= $this->section('customcss') ?>
<style>
  .table td:not([class^="border-none"]) {
    border: 1px solid #000;
    border-collapse: collapse;
  }
</style>
<?= $this->endSection('customcss') ?>
<?= $this->section('content'); ?>
<?= view("admin/components/header_surat") ?>
<tr>
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <p style="font-size: 19px;"><b><u>KETERANGAN PENGGANTI TANDA TERA</u></b></p>
    <p style="font-size: 16px;white-space:pre">Nomor: <?= $_GET['no_surat'] ?? "...... / ...... / ......." ?></p>
  </td>
</tr>
<tr>
  <td style="padding: 10px 50px;" colspan="3">
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">1. Jenis Alat UTTP</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= (($tera_uttp_retribusi['jenis_uttp_tipe_id'] != null) ? $tera_uttp_retribusi['jenis_uttp_tipe_nama'] . ":" : "") . $tera_uttp_retribusi['jenis_uttp_nama'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">2. Merk / Type / Nomer Seri</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['tera_uttp_merk'] ?> / <?= $tera_uttp['tera_uttp_tipe'] ?> / <?= $tera_uttp['tera_uttp_no_seri'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">3. Kapasitas / Daya Baca</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp_retribusi['tera_uttp_kapasitas'] ?> / <?= $tera_uttp_retribusi['tera_uttp_daya_baca'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">4. Buatan</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['tera_uttp_buatan'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">5. Pemilik / Pemakai</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['tera_atas_nama'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">6. Alamat</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['tera_atas_nama_alamat'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">7. Diuji Oleh</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['admin_nama'] ?> NIP. <?= $tera_uttp['admin_username'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">8. Tanggal Pengujian</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= date("d-m-Y", strtotime($tera_uttp['tera_uttp_pengujian_at'])) ?></div>
    </div>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <hr style="border-bottom: 1px solid #000000; height:0px;">
  </td>
</tr>
<tr>
  <td style="padding: 5px 50px;">
    <div style="text-align: center; border-radius: 100px; border:1px solid #000;font-size: 12px;width:70px;padding:10px">
      <p>Tempat</p>
      <p>untuk</p>
      <p>Tanda Tera</p>
      <p>atas lak</p>
    </div>
  </td>
  <td align="center" style="width:300px;padding: 20px 40px;">
    <p>......................................, <?= date("d - m - Y") ?></p>
    <p>Pegawai Berhak</p>
    <br>
    <br>
    <br>
    <p style="border-bottom: 1px solid rgba(0, 0, 0, 0.6);"><?= $_admin->admin_nama ?></p>
    <p>NIP. <?= $_admin->admin_username ?></p>
  </td>
</tr>
<?= $this->endSection('content'); ?>