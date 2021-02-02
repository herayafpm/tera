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
    <h4><b>BERITA ACARA PENGUJIAN UTTP</b></h4>
    <h4><b>DI TEMPAT PAKAI / UTTP TERPASANG</b></h4>
  </td>
</tr>
<tr>
  <td style="padding: 20px 20px 20px 50px;" colspan="3">
    <p style="text-indent: 50px;text-align:justify;line-height:1.6">Berdasarkan Surat Permohonan dari <?= $tera['user_nama'] ?> Nomor <?= $_GET['no_surat_permohonan'] ?? ".............................." ?> tanggal <?= date("d-m-Y", strtotime($tera['tera_created'])) ?> dan Surat Perintah Tugas dari Kepala ................................... Nomor <?= $_GET['no_surat_tugas'] ?? ".............................." ?> tanggal <?= date("d-m-Y", strtotime($tera['tera_created'])) ?>, telah dilakukan pengujian UTTP (<?= strtolower($tera['jenis_tera_nama']) ?>) di tempat pakai dengan hasil sebagai berikut:</p>
  </td>
</tr>
<tr>
  <td style="padding: 0 50px;" colspan="3">
    <table>
      <tr style="vertical-align: top;text-align: justify;">
        <td style="width: 20px;">1.</td>
        <td style="width: 150px;">Dilaksanakan tanggal</td>
        <td style="width: 10px;">:</td>
        <td><?= date("d-m-Y", strtotime($tera['tera_date_order'])) ?></td>
      </tr>
      <tr style="vertical-align: top;text-align: justify;">
        <td></td>
        <td>Lokasi pengujian</td>
        <td>:</td>
        <td><?= $tera['tera_atas_nama_alamat'] ?></td>
      </tr>
      <tr style="vertical-align: top;text-align: justify;">
        <td></td>
        <td>Alamat / No. Telp</td>
        <td>:</td>
        <td><?= $tera['user_alamat'] ?> / <?= $tera['user_telp'] ?? "" ?></td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 10px 50px;" colspan="3">
    <table>
      <tr style="vertical-align: top;text-align: justify;">
        <td style="width: 20px;">2.</td>
        <td style="width: 150px;">Nama Perusahaan / Pemilik</td>
        <td style="width: 10px;">:</td>
        <td><?= $tera['tera_atas_nama'] ?></td>
      </tr>
      <tr style="vertical-align: top;text-align: justify;">
        <td></td>
        <td>Kuasa yang Mengajukan</td>
        <td>:</td>
        <td><?= $tera['user_nama'] ?></td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 10px 50px;" colspan="3">
    <table>
      <tr style="vertical-align: top;text-align: justify;">
        <td style="width: 20px;">3.</td>
        <td style="width: 150px;">Pegawai yang ditugaskan</td>
        <td style="width: 10px;"></td>
        <td>
          <table>
            <?php
            $no = 1;
            foreach ($tera['tera_petugas'] as $petugas) : ?>
              <tr>
                <td style="width: 10px;"><?= $no ?>. </td>
                <td><?= $petugas['tera_petugas_admin_nama'] ?> NIP. <?= $petugas['tera_petugas_admin_username'] ?></td>
              </tr>
            <?php
              $no++;
            endforeach ?>
          </table>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 10px 50px;" colspan="3">
    <table>
      <tr style="vertical-align: top;text-align: justify;">
        <td style="width: 20px;">4.</td>
        <td style="width: 150px;">Jenis UTTP yang diperiksa</td>
        <td style="width: 10px;">:</td>
        <td><?= (($tera_uttp_retribusi['jenis_uttp_tipe_id'] != null) ? $tera_uttp_retribusi['jenis_uttp_tipe_nama'] . ":" : "") . $tera_uttp_retribusi['jenis_uttp_nama'] ?></td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 10px 20px 10px 50px ;" colspan="3">
    <table border="1">
      <thead align="center">
        <td style="width: 10px; padding:5px">No.</td>
        <td>Merk</td>
        <td>Type / No. Seri</td>
        <td>Kap. / e</td>
        <td>Hasil</td>
        <td>Ket / Media</td>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($tera_uttps as $tera_uttp) : ?>
          <tr style="text-align: center;vertical-align: top;">
            <td style="padding: 5px;"><?= $no ?>.</td>
            <td style="padding: 5px;"><?= $tera_uttp['tera_uttp_merk'] ?></td>
            <td style="padding: 5px;"><?= $tera_uttp['tera_uttp_tipe'] ?? "Tidak ada tipe" ?> / <?= $tera_uttp['tera_uttp_no_seri'] ?></td>
            <td style="padding: 5px;"><?= $tera_uttp_retribusi['tera_uttp_kapasitas'] ?> / <?= $tera_uttp_retribusi['tera_uttp_daya_baca'] ?></td>
            <td style="padding: 5px;"><?= ($tera_uttp['tera_uttp_pengujian_status'] == 0) ? "Proses" : ($tera_uttp['tera_uttp_pengujian_status'] == 1) ? "Sah" : "Batal" ?></td>
            <td style="max-width: 300px;text-align: justify;padding:5px;"><?= $tera_uttp['tera_uttp_keterangan'] ?></td>

          </tr>
        <?php
          $no++;
        endforeach ?>
      </tbody>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 0px 20px 20px 55px;" colspan="3">
    <p style="text-align:justify">Demikian Berita Acara ini dibuat untuk dipergunakan seperlunya.</p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <table>
      <tr style="vertical-align: top;">
        <td align="center" style="width:200px;padding: 20px 20px;">
          <p>Mengetahui: </p>
          <p>Kepala Bidang Metrologi</p>
          <br>
          <br>
          <br>
          <p style="border-bottom: 1px solid rgba(0, 0, 0, 0.6);">..................................................................</p>
          <p>NIP. ..........................................................</p>
        </td>
        <td align="center" style="width:200px;padding: 20px 20px;">
          <p>Pihak Pemohon</p>
          <br>
          <br>
          <br>
          <br>
          <p style="border-bottom: 1px solid rgba(0, 0, 0, 0.6);"><?= $tera['user_nama'] ?></p>
        </td>
        <td align="center" style="width:200px;padding: 20px 20px;">
          <p>Pegawai yang Berhak</p>
          <br>
          <br>
          <br>
          <br>
          <p style="border-bottom: 1px solid rgba(0, 0, 0, 0.6);"><?= $_admin->admin_nama ?></p>
          <p>NIP. <?= $_admin->admin_username ?></p>
        </td>
      </tr>
    </table>
  </td>
</tr>
<?= $this->endSection('content'); ?>