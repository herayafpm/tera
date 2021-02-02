<?= $this->extend('admin/template_surat'); ?>
<?= $this->section('departement') ?>
(Bidang Metrologi)
<?= $this->endSection('departement') ?>
<?= $this->section('content'); ?>
<tr>
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <h4><b>SURAT KETETAPAN RETRIBUSI DAERAH LEBIH BAYAR</b></h4>
    <h4><b>(SKRDLB)</b></h4>
  </td>
</tr>
<tr>
  <td style="padding: 0 50px;" colspan="3">
    <p style="white-space:pre">1. Nama &#9;&#9;&#9;: <?= $tera['user_nama'] ?></p>
    <br>
    <p style="white-space:pre">2. Alamat &#9;&#9;: <?= $tera['user_alamat'] ?></p>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 5px 50px;" colspan="3">
    <table border="1">
      <thead>
        <tr style="text-align: center;">
          <th>NOMOR</th>
          <th>JENIS RETRIBUSI DAERAH</th>
          <th>JUMLAH</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td align="center" style="vertical-align: top;">
            <p><?= $tera['tera_no_order'] ?></p>
          </td>
          <td style="padding: 0 5px;">
            <p style="text-transform: uppercase; text-align:center">
              KELEBIHAN PEMBAYARAN RETRIBUSI PELAYANAN <?= $tera['jenis_tera_nama'] ?>
            </p>
            <?php
            $no = 0;
            foreach ($tera['count_retribusis'] as $count_retribusi) : ?>
              <p><?= $no + 1 ?>. <?= $count_retribusi['jenis_retribusi_tipe_nama'] ?> <?= $count_retribusi['jenis_retribusi_nama'] ?></p>
            <?php
              $no++;
            endforeach; ?>
          </td>
          <td style="padding: 0 5px;">
            <br>
            <?php
            foreach ($tera['count_retribusis'] as $count_retribusi) : ?>
              <p><?= format_rupiah((int) $count_retribusi['count_retribusi']) ?></p>
            <?php
            endforeach; ?>
          </td>
        </tr>
        <tr>
          <td></td>
          <td style="padding: 0 5px;">Jumlah Ketetapan Pokok Retribusi Yang Telah Dibayar</td>
          <td style="padding: 0 5px;">Rp <?= format_rupiah(($_total_telah_bayar > $_total_bayar) ? $_total_bayar : $_total_telah_bayar) ?></td>
        </tr>
        <tr>
          <td></td>
          <td style="padding: 0 5px;">Jumlah Kelebihan Retribusi</td>
          <td style="padding: 0 5px;">Rp <?= format_rupiah(($_total_kurang_bayar < 0) ? $_total_kurang_bayar * -1 : $_total_kurang_bayar) ?></td>
        </tr>
        <tr>
          <td></td>
          <td style="padding: 0 5px;">Jumlah Yang Harus Dibayar</td>
          <td style="padding: 0 5px;">Rp <?= format_rupiah(($_total_kurang_bayar < 0) ? $_total_kurang_bayar * -1 : $_total_kurang_bayar) ?></td>
        </tr>
        <tr>
          <td style="padding: 0 5px;" colspan="3">Dengan huruf: <?= $tera['tera_skrdlb_terbilang'] ?></td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <p>PERHATIAN: </p>
    <p>Apabila SKRDLB ini tidak atau kurang dibayar lewat waktu paling lama 30 hari setelah SKRDLB ini diterima, dikenakan sanksi administrasi denda berupa bunga sebesar 2% (dua persen) tiap bulan</p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;">

  </td>
  <td align="center" style="width:200px;padding: 20px 20px;">
    <p>Purwokerto, <?= date('d - m - Y', strtotime($tera['tera_skrdlb_at'])) ?></p>
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
<?= $this->endSection('content'); ?>