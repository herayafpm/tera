<?= $this->extend('admin/template_surat'); ?>
<?= $this->section('content'); ?>
<?= view("admin/components/header_surat_formulir") ?>
<tr>
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <p style="font-size: 19px;text-transform: uppercase;"><b><u>FORMULIR PENDAFTARAN <?= $tera['jenis_tera_nama'] ?></u></b></p>
  </td>
</tr>
<tr>
  <td style="padding: 0 20px;" colspan="3">
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 80px;">Nama</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['user_nama'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 80px;">Alamat</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['user_alamat'] ?> lore</div>
    </div>
  </td>
</tr>
<tr>
  <td style="padding: 10px 30px 0px 30px;" colspan="3">
    <p>Mengajukan untuk di <?= $tera['jenis_tera_nama'] ?> UTTP dengan rincian sebagai berikut:</p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <table border="1">
      <thead>
        <tr style="text-align: center;">
          <td style="padding: 5px;">No Order</td>
          <td style="padding: 5px;">Jenis UTTP</td>
          <td style="padding: 5px;">Kap. / Daya Baca</td>
          <td style="padding: 5px;">Jumlah</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($tera['tera_uttps'] as $tera_uttp) : ?>
          <tr style="text-align: center;">
            <td style="width: 100px;"><?= $tera['tera_no_order'] ?></td>
            <td style="padding: 5px;"><?= ($tera_uttp['jenis_uttp_tipe_id'] == null) ? $tera_uttp['jenis_uttp_nama'] : $tera_uttp['jenis_uttp_tipe_nama'] . ": " . $tera_uttp['jenis_uttp_nama'] ?></td>
            <td style="padding: 5px;"><?= format_rupiah($tera_uttp['tera_uttp_kapasitas']) ?> <?= $tera_uttp['tera_uttp_daya_baca'] ?></td>
            <td style="padding: 5px;"><?= format_rupiah($tera_uttp['tera_uttp_jumlah']) ?></td>
          </tr>
        <?php
        endforeach; ?>
      </tbody>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 0 30px;" colspan="3">
    <br>
    <p style="white-space:pre">SKP / Sertifikat dibuat atas nama :</p>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 0 30px;" colspan="3">
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 80px;">Nama</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['tera_atas_nama'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 80px;">Alamat</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['tera_atas_nama_alamat'] ?></div>
    </div>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 0 30px;" colspan="3">
    <p style="white-space:pre">Perkiraan selesai&#9;: 1. Tera &#9;&#9;&#9;: Maksimal 3 hari kerja</p>
    <p style="white-space:pre">&#9;&#9;&#9;&#9;&nbsp; 2. Tera Ulang &#9;: Maksimal 3 hari kerja</p>
    <p style="white-space:pre">&#9;&#9;&#9;&#9;&nbsp; Kecuali UTTP yang bersifat masal</p>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 5px 30px;" colspan="3">
    <table border="1">
      <thead>
        <tr style="text-align: center;">
          <td style="padding: 5px;" colspan="2">PENERIMAAN</td>
          <td colspan="2">PENYERAHAN</td>
        </tr>
      </thead>
      <tbody>
        <tr style="text-align: center;">
          <td style="padding: 5px;">Pemohon,</td>
          <td style="padding: 5px;">Penerima,</td>
          <td style="padding: 5px;">Yang Menerima,</td>
          <td style="padding: 5px;">Yang Menyerahkan,</td>
        </tr>
        <tr>
          <td style="padding: 5px;">
            <p>&nbsp;Tgl: <?= date("d-m-Y", strtotime($tera['tera_created'])) ?></p>
            <br>
            <br>
            <br>
            <p>&nbsp;(....................................................)&nbsp;</p>
            <br>
          </td>
          <td style="padding: 5px;">
            <p>&nbsp;Tgl: <?= date("d-m-Y", strtotime($tera['tera_created'])) ?></p>
            <br>
            <br>
            <br>
            <p>&nbsp;(....................................................)&nbsp;</p>
            <p>&nbsp;NIP</p>
          </td>
          <td style="padding: 5px;">
            <p>&nbsp;Tgl: <?= date("d-m-Y", strtotime($tera['tera_created'])) ?></p>
            <br>
            <br>
            <br>
            <p>&nbsp;(....................................................)&nbsp;</p>
            <br>
          </td>
          <td style="padding: 5px;">
            <p>&nbsp;Tgl: <?= date("d-m-Y", strtotime($tera['tera_created'])) ?></p>
            <br>
            <br>
            <br>
            <p>&nbsp;(....................................................)&nbsp;</p>
            <br>
          </td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
<?= $this->endSection('content'); ?>