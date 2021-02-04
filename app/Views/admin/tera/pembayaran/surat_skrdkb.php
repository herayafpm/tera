<?= $this->extend('admin/template_surat'); ?>
<?= $this->section('departement') ?>
(Bidang Metrologi)
<?= $this->endSection('departement') ?>
<?= $this->section('content'); ?>
<?= view("admin/components/header_surat") ?>
<tr>
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <p style="font-size: 19px;"><b>SURAT KETETAPAN RETRIBUSI DAERAH KURANG BAYAR</b></p>
    <p style="font-size: 19px;"><b>(SKRDKB)</b></p>
  </td>
</tr>
<tr>
  <td style="padding: 0 40px;" colspan="3">
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 100px;">Nama</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['user_nama'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 100px;">Alamat</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['user_alamat'] ?></div>
    </div>
  </td>
</tr>
<tr>
  <td style="padding: 5px 40px;" colspan="3">
    <table border="1">
      <thead>
        <tr style="text-align: center;">
          <td style="padding: 5px;">NOMOR</td>
          <td>JENIS RETRIBUSI DAERAH</td>
          <td>JUMLAH</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td align="center" style="vertical-align: top;width:60px">
            <p><?= $tera['tera_no_order'] ?></p>
          </td>
          <td style="padding: 0 5px;width:270px">
            <p style="text-transform: uppercase; text-align:center;font-size: 14px;margin-bottom: 5px;">
              KEKURANGAN PEMBAYARAN RETRIBUSI PELAYANAN <?= $tera['jenis_tera_nama'] ?>
            </p>
            <?php
            $no = 0;
            foreach ($tera['count_retribusis'] as $count_retribusi) : ?>
              <p><?= $no + 1 ?>. <?= $count_retribusi['jenis_retribusi_tipe_nama'] ?> <?= $count_retribusi['jenis_retribusi_nama'] ?></p>
            <?php
              $no++;
            endforeach; ?>
          </td>
          <td style="padding: 5px 5px 0px; vertical-align: bottom; width:150px">
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
          <td style="padding: 0 5px;">Rp <?= ($_total_telah_bayar > $_total_bayar) ? $_total_bayar : $_total_telah_bayar ?></td>
        </tr>
        <tr>
          <td></td>
          <td style="padding: 0 5px;">Jumlah Kekurangan Retribusi</td>
          <td style="padding: 0 5px;">Rp <?= ($_total_kurang_bayar < 0) ? "" : $_total_kurang_bayar ?></td>
        </tr>
        <tr>
          <td></td>
          <td style="padding: 0 5px;">Jumlah Yang Harus Dibayar</td>
          <td style="padding: 0 5px;">Rp <?= ($_total_kurang_bayar < 0) ? "" : $_total_kurang_bayar ?></td>
        </tr>
        <tr>
          <td style="padding: 0 5px;" colspan="3">Dengan huruf: <?= $tera['tera_skrdkb_terbilang'] ?></td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <p>PERHATIAN: </p>
    <p>1. Harap penyetoran dilakukan pada Bendahara Penerimaan Pembantu di Kantor Bidang Metrologi dengan menggunakan Surat Setoran Retribusi Daerah (SSRD)</p>
    <p>2. Apabila SKRDKB ini tidak atau kurang dibayar lewat waktu paling lama 30 hari setelah SKRDKB ini diterima, dikenakan sanksi administrasi denda berupa bunga sebesar 2% (dua persen) tiap bulan</p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;">

  </td>
  <td align="center" style="width:300px;padding: 20px 50px;">
    <p>Purwokerto, <?= date('d - m - Y', strtotime($tera['tera_skrdkb_at'])) ?></p>
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