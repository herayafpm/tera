<?= $this->extend('admin/template_surat'); ?>
<?= $this->section('content'); ?>
<tr>
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <h4><b>SURAT KETETAPAN RETRIBUSI DAERAH</b></h4>
    <h4><b>(SKRD)</b></h4>
  </td>
</tr>
<tr>
  <td style="padding: 0 20px 10px;" colspan="3">
    <p>DATA PEMOHON</p>
  </td>
</tr>
<tr>
  <td style="padding: 0 20px;" colspan="3">
    <p style="white-space:pre">1. Nama Pemilik / Kuasa / Pemakai &#9;: <?= $tera['user_nama'] ?></p>
    <br>
    <p style="white-space:pre">2. Alamat &#9;&#9;&#9;&#9;&#9;&#9;: <?= $tera['user_alamat'] ?></p>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <table border="1">
      <thead>
        <tr style="text-align: center;">
          <th>No</th>
          <th>Jenis UTTP</th>
          <th>Kap.</th>
          <th>Jumlah</th>
          <th>Jenis Pekerjaan</th>
          <th>Retribusi (Rp)</th>
          <th>Sanksi Administrasi (Rp)</th>
          <th>Jumlah Retribusi (Rp)</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total_bayar = 0;
        $no = 0;
        foreach ($tera['tera_uttps'] as $tera_uttp) : ?>
          <tr style="text-align: center;">
            <td><?= $no + 1 ?></td>
            <td><?= ($tera_uttp['jenis_uttp_tipe_id'] != null ? $tera_uttp['jenis_uttp_tipe_nama'] . " : " : "") . $tera_uttp['jenis_uttp_nama'] ?></td>
            <td><?= format_rupiah($tera_uttp['tera_uttp_kapasitas']) ?></td>
            <td><?= format_rupiah($tera_uttp['tera_uttp_jumlah']) ?></td>
            <td><?= $tera['jenis_tera_nama'] ?></td>
            <td><?= format_rupiah($tera_uttp['tera_uttp_retribusi']) ?></td>
            <td><?= format_rupiah($tera_uttp['tera_uttp_sanksi_adm']) ?></td>
            <?php
            $jumlah_bayar = ((int) $tera_uttp['tera_uttp_retribusi'] * (int) $tera_uttp['tera_uttp_jumlah']) + $tera_uttp['tera_uttp_sanksi_adm'];
            $total_bayar += $jumlah_bayar;
            ?>
            <td><?= format_rupiah($jumlah_bayar) ?></td>
          </tr>
        <?php
          $no++;
        endforeach; ?>
      </tbody>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <p style="white-space:pre">Jenis Pekerjaan: 1. Tera &#9;&#9; 2. Tera Ulang</p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <p style="white-space:pre">JUMLAH RETRIBUSI YANG HARUS DIABAYAR : Rp <?= format_rupiah($total_bayar) ?></p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <p style="white-space:pre">Terbilang : <?= $tera['tera_total_terbilang'] ?></p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;">

  </td>
  <td align="center" style="width:200px;padding: 20px 20px;">
    <p>Purwokerto, <?= date("d - m - Y") ?></p>
    <p>a.n KEPALA DINPERINDAG</p>
    <p>KAB. BANYUMAS</p>
    <p>Bendahara Penerimaan Pembantu</p>
    <br>
    <br>
    <br>
    <p style="border-bottom: 1px solid rgba(0, 0, 0, 0.6);"><?= $_admin->admin_nama ?></p>
    <p>NIP. <?= $_admin->admin_username ?></p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <p>CATATAN: </p>
    <p>Biaya Retribusi harus dibayar sebelum UTTP dilakukan pengujian</p>
    <p>Tarif Retribusi berdasarkan <?= env('perdaTarifRetribusi') ?></p>
  </td>
</tr>
<?= $this->endSection('content'); ?>