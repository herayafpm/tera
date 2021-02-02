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
    <h4><b>SURAT SETORAN RETRIBUSI DAERAH</b></h4>
    <h4><b>(SSRD)</b></h4>
  </td>
</tr>
<tr>
  <td align="right" style="padding: 0px 50px;" colspan="3">
    <table border="1" style="width: 200px;">
      <tr>
        <td style="width: 70px;padding:5px">
          <p>No Register : </p>
        </td>
        <td>
          <p style="white-space: pre;"> <?= $_GET['no_register'] ?? "&#9;&#9;/&#9;/&#9;&#9;" ?></p>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 0 20px 2px;" colspan="3">
    <p>Telah terima dari</p>
  </td>
</tr>
<tr>
  <td style="padding: 0 20px;" colspan="3">
    <p style="white-space:pre">Nama &#9;&#9;&#9;: <?= $tera['user_nama'] ?></p>
    <p style="white-space:pre">Alamat &#9;&#9;&#9;: <?= $tera['user_alamat'] ?></p>
    <p style="white-space:pre">Uang sebesar &#9;&#9;: <?= format_rupiah($tera_ssrd['tera_ssrd_uang']) ?></p>
    <p style="white-space:pre">Terbilang &#9;&#9;: <?= $tera_ssrd['tera_ssrd_terbilang'] ?></p>
    <p style="white-space:pre">Keterangan &#9;&#9;: Penerimaan Retribusi <?= $tera['jenis_tera_nama'] ?></p>
    <p style="white-space:pre">Bank &#9;&#9;&#9;: <?= $tera_ssrd['tera_ssrd_bank'] ?></p>
    <p style="white-space:pre">No Rekening &#9;&#9;: <?= $tera_ssrd['tera_ssrd_no_rek'] ?></p>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <table class="table">
      <thead>
        <tr style="text-align: center;">
          <th rowspan="2">No</th>
          <th rowspan="2" colspan="9">Kode Rekening</th>
          <th colspan="3">Uraian Objek</th>
          <th rowspan="2">Jumlah Retribusi (Rp)</th>
        </tr>
        <tr style="text-align: center;">
          <th>Jenis UTTP</th>
          <th>Kap.</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total_bayar = 0;
        $no = 0;
        foreach ($tera['tera_uttps'] as $tera_uttp) : ?>
          <tr style="text-align: center;">
            <td><?= $no + 1 ?></td>
            <?php
            $kdRek = explode(".", $tera_ssrd['tera_ssrd_kd_rek']);
            ?>
            <td style="width: 25px;"><?= $kdRek[0] ?? "-" ?></td>
            <td style="width: 25px;"><?= $kdRek[1] ?? "-" ?></td>
            <td style="width: 25px;"><?= $kdRek[2] ?? "-" ?></td>
            <td style="width: 25px;"><?= $kdRek[3] ?? "-" ?></td>
            <td style="width: 25px;"><?= $kdRek[4] ?? "-" ?></td>
            <td style="width: 25px;"><?= $kdRek[5] ?? "-" ?></td>
            <td style="width: 25px;"><?= $kdRek[6] ?? "-" ?></td>
            <td style="width: 25px;"><?= $kdRek[7] ?? "-" ?></td>
            <td style="width: 25px;"><?= $kdRek[8] ?? "-" ?></td>
            <td><?= ($tera_uttp['jenis_uttp_tipe_id'] != null ? $tera_uttp['jenis_uttp_tipe_nama'] . " : " : "") . $tera_uttp['jenis_uttp_nama'] ?></td>
            <td><?= format_rupiah($tera_uttp['tera_uttp_kapasitas']) ?></td>
            <td><?= format_rupiah($tera_uttp['tera_uttp_jumlah']) ?></td>
            <?php
            $jumlah_bayar = ((int) $tera_uttp['tera_uttp_retribusi'] * (int) $tera_uttp['tera_uttp_jumlah']) + $tera_uttp['tera_uttp_sanksi_adm'];
            $total_bayar += $jumlah_bayar;
            ?>
            <td><?= format_rupiah($jumlah_bayar) ?></td>
          </tr>
        <?php
          $no++;
        endforeach; ?>
        <tr>
          <td colspan="12" class="border-none"></td>
          <td align="center">TOTAL</td>
          <td align="center"><?= format_rupiah($total_bayar) ?></td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 20px 100px;">
    <table>
      <tr>
        <td align="center" style="width:60px;padding: 20px 20px;">
          <p>Pembayar / Penyetor</p>
          <br>
          <br>
          <br>
          <p style="border-bottom: 1px solid rgba(0, 0, 0, 0.6);"><?= $tera['tera_atas_nama'] ?></p>
        </td>
        <td align="center" style="width:60px;padding: 20px 20px;">
          <p align="left">Purwokerto, <?= date("d - m - Y") ?></p>
          <p>Bendahara Penerimaan Pembantu</p>
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