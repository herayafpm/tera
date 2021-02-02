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
    <h4><b><u>SURAT KETERANGAN HASIL PENGUJIAN</u></b></h4>
    <h4 style="font-weight: 600;white-space:pre">Nomor: <?= $_GET['no_surat'] ?? "...... / ...... / ......." ?></h4>
  </td>
</tr>
<tr>
  <td align="right" style="padding: 0px 20px;" colspan="3">
    <table style="width: 150px; border:1px solid #000;">
      <tr>
        <td style="vertical-align: top;width: 52px;padding:5px">
          <p>No Order : </p>
        </td>
        <td align="center" style="padding: 0px 5px 0px 0px;">
          <p style="border-bottom: 1px solid #000;"><?= $tera['tera_no_order'] ?></p>
        </td>
      </tr>
      <tr>
        <td align="center">
        </td>
        <td align="center">
          <p><?= date("d - m - Y", strtotime($tera['tera_date_order'])) ?></p>
        </td>
      </tr>
    </table>
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
    <p style="white-space:pre">9. Metode &#9;&#9;&#9;&#9;&#9;: Perbandingan Langsung dengan standar</p>
    <div style="display: flex;">
      <div style="width:200px;margin-right:70px">10. Hasil Pengujian</div>
      <div>:</div>
      <div style="padding-left:2px;text-align:justify">
        Disahkan Untuk <?= $tera['jenis_tera_nama'] ?> Tahun <?= date("Y", strtotime($tera_uttp['tera_uttp_pengujian_at'])) ?> berdasarkan Undang - Undang Republik Indonesia Nomor 2 Tahun 1981 tentang Metrologi Legal dengan membubuhkan Tanda Sah dan Tanda Jaminan
      </div>
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
  <td style="padding: 5px 20px;">

  </td>
  <td align="center" style="width:200px;padding: 20px 20px;">
    <p>......................................, <?= date("d - m - Y") ?></p>
    <p>a.n KEPALA DINPERINDAG</p>
    <p>KAB. BANYUMAS</p>
    <br>
    <br>
    <br>
    <p style="border-bottom: 1px solid rgba(0, 0, 0, 0.6);">..................................................................</p>
    <p>NIP. ..........................................................</p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 50px;" colspan="3">
    <p>CATATAN: </p>
    <div style="padding:0px 10px;text-align:justify">
      <p>1. Tera Ulang berikutnya bulan ........................</p>
      <p>2. Keterangan ini tidak berlaku apabila tanda tera masuk rusak</p>
      <p>3. Apabila Kepala Dinas tidak ditempat, Surat Keterangan Pengujian ditandatangani oleh Sekretaris Dinperindag Kab. Banyumas</p>
      <p>4. Apabila Kepala Dinas dan Sekretaris Dinas tidak ada ditempat, Surat Keterangan Pengujian ditandatangani oleh Kepala Bidang Metrologi.</p>
    </div>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px 0px 20px;" colspan="3">
    <hr style="border-bottom: 1px solid #000000; height:0px;">
  </td>
</tr>
<tr>
  <td style="padding: 0px 20px;text-align:center" colspan="3">
    Dilarang menggandakan sebagian isi Surat Keterangan ini tanpa seijin dari Bidang Metrologi Dinperindag Kab. Banyumas
  </td>
</tr>
<?= $this->endSection('content'); ?>