<?= $this->extend('admin/template_surat'); ?>
<?= $this->section('content'); ?>
<?= view("admin/components/header_surat") ?>
<tr>
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <p style="font-size: 19px;"><b>SURAT KETETAPAN RETRIBUSI DAERAH</b></p>
    <p style="font-size: 19px;"><b>(SKRD)</b></p>
  </td>
</tr>
<tr>
  <td style="padding: 0 40px 10px;" colspan="3">
    <p>DATA PEMOHON</p>
  </td>
</tr>
<tr>
  <td style="padding: 0 40px;" colspan="3">
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 240px;">1. Nama Pemilik / Kuasa / Pemakai</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['user_nama'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 240px;">2. Alamat</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['user_alamat'] ?></div>
    </div>
  </td>
</tr>
<tr>
  <td style="padding: 5px 30px;" colspan="3">
    <table border="1">
      <thead>
        <tr style="text-align: center;">
          <td style="padding: 5px;">No</td>
          <td style="padding: 5px;">Jenis UTTP</td>
          <td style="padding: 5px;">Kap.</td>
          <td style="padding: 5px;">Jumlah</td>
          <td style="padding: 5px;">Jenis Pekerjaan</td>
          <td style="padding: 5px;">Retribusi (Rp)</td>
          <td style="padding: 5px;">Sanksi Administrasi (Rp)</td>
          <td style="padding: 5px;">Jumlah Retribusi (Rp)</td>
        </tr>
      </thead>
      <tbody>
        <?php
        $total_bayar = 0;
        $no = 0;
        foreach ($tera['tera_uttps'] as $tera_uttp) : ?>
          <tr style="text-align: center;">
            <td style="padding: 5px;"><?= $no + 1 ?>.</td>
            <td style="padding: 5px;"><?= ($tera_uttp['jenis_uttp_tipe_id'] != null ? $tera_uttp['jenis_uttp_tipe_nama'] . " : " : "") . $tera_uttp['jenis_uttp_nama'] ?></td>
            <td style="padding: 5px;"><?= format_rupiah($tera_uttp['tera_uttp_kapasitas']) ?></td>
            <td style="padding: 5px;"><?= format_rupiah($tera_uttp['tera_uttp_jumlah']) ?></td>
            <td style="padding: 5px;"><?= $tera['jenis_tera_nama'] ?></td>
            <td style="padding: 5px;"><?= format_rupiah($tera_uttp['tera_uttp_retribusi']) ?></td>
            <td style="padding: 5px;"><?= format_rupiah($tera_uttp['tera_uttp_sanksi_adm']) ?></td>
            <?php
            $jumlah_bayar = ((int) $tera_uttp['tera_uttp_retribusi'] * (int) $tera_uttp['tera_uttp_jumlah']) + $tera_uttp['tera_uttp_sanksi_adm'];
            $total_bayar += $jumlah_bayar;
            ?>
            <td style="padding: 5px;"><?= format_rupiah($jumlah_bayar) ?></td>
          </tr>
        <?php
          $no++;
        endforeach; ?>
      </tbody>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 5px 40px;" colspan="3">
    <p style="white-space:pre">Jenis Pekerjaan: 1. Tera &#9;&#9; 2. Tera Ulang</p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 40px;" colspan="3">
    <p style="white-space:pre">JUMLAH RETRIBUSI YANG HARUS DIABAYAR : Rp <?= format_rupiah($total_bayar) ?></p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 40px;" colspan="3">
    <p style="white-space:pre">Terbilang : <?= $tera['tera_total_terbilang'] ?></p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;">

  </td>
  <td align="center" style="width:300px;padding: 20px 50px;">
    <div>
      <p>..........................................., <?= date("d - m - Y") ?></p>
    </div>
    <p>a.n KEPALA DINPERINDAG</p>
    <p>KAB. BANYUMAS</p>
    <p>Bendahara Penerimaan Pembantu</p>
    <br>
    <br>
    <br>
    <div style="width: 280px;">
      <p style="border-bottom: 1px solid rgba(0, 0, 0, 0.6);"><?= $_admin->admin_nama ?></p>
    </div>
    <p>NIP. <?= $_admin->admin_username ?></p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 40px;" colspan="3">
    <p>CATATAN: </p>
    <p>Biaya Retribusi harus dibayar sebelum UTTP dilakukan pengujian</p>
    <p>Tarif Retribusi berdasarkan <?= env('perdaTarifRetribusi') ?></p>
  </td>
</tr>
<?= $this->endSection('content'); ?>