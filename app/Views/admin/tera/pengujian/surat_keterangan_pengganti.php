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
<tr>
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <h3><b><u>KETERANGAN PENGGANTI TANDA TERA</u></b></h3>
    <h4 style="font-weight: 600;white-space:pre">Nomor: <?= $_GET['no_surat'] ?? "...... / ...... / ......." ?></h4>
  </td>
</tr>
<tr>
  <td style="padding: 0 50px;" colspan="3">
    <p style="white-space:pre">1. Jenis Alat UTTP &#9;&#9;&#9;: <?= (($tera_uttp_retribusi['jenis_uttp_tipe_id'] != null) ? $tera_uttp_retribusi['jenis_uttp_tipe_nama'] . ":" : "") . $tera_uttp_retribusi['jenis_uttp_nama'] ?></p>
    <p style="white-space:pre">2. Merk / Type / Nomer Seri &#9;&#9;: <?= $tera_uttp['tera_uttp_merk'] ?> / <?= $tera_uttp['tera_uttp_tipe'] ?> / <?= $tera_uttp['tera_uttp_no_seri'] ?></p>
    <p style="white-space:pre">3. Kapasitas / Daya Baca &#9;&#9;: <?= $tera_uttp_retribusi['tera_uttp_kapasitas'] ?> / <?= $tera_uttp_retribusi['tera_uttp_daya_baca'] ?></p>
    <p style="white-space:pre">4. Buatan &#9;&#9;&#9;&#9;&#9;: <?= $tera_uttp['tera_uttp_buatan'] ?></p>
    <p style="white-space:pre">5. Pemilik / Pemakai &#9;&#9;&#9;: <?= $tera['tera_atas_nama'] ?></p>
    <p style="white-space:pre">6. Alamat &#9;&#9;&#9;&#9;&#9;: <?= $tera['tera_atas_nama_alamat'] ?></p>
    <p style="white-space:pre">7. Diuji Oleh &#9;&#9;&#9;&#9;&#9;: <?= $tera_uttp['admin_nama'] ?> NIP. <?= $tera_uttp['admin_username'] ?></p>
    <p style="white-space:pre">8. Tanggal Pengujian &#9;&#9;&#9;: <?= date("d-m-Y", strtotime($tera_uttp['tera_uttp_pengujian_at'])) ?></p>
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
    <div style="text-align: center; border-radius: 100px; border:1px solid #000;width:70px;padding:10px">
      <p>Tempat</p>
      <p>untuk</p>
      <p>Tanda Tera</p>
      <p>atas lak</p>
    </div>
  </td>
  <td align="center" style="width:200px;padding: 20px 20px;">
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