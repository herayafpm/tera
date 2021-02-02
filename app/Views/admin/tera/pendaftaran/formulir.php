<?= $this->extend('admin/template_surat'); ?>
<?= $this->section('content'); ?>
<tr>
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <h4 style="text-transform: uppercase;"><b><u>formulir pendaftaran <?= $tera['jenis_tera_nama'] ?></u></b></h4>
  </td>
</tr>
<tr>
  <td style="padding: 0 20px;" colspan="3">
    <p style="white-space:pre">Nama &#9;&#9;: <?= $tera['user_nama'] ?></p>
    <p style="white-space:pre">Alamat &#9;&#9;: <?= $tera['user_alamat'] ?></p>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <table border="1">
      <thead>
        <tr style="text-align: center;">
          <th>No Order</th>
          <th>Jenis UTTP</th>
          <th>Kap. / Daya Baca</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($tera['tera_uttps'] as $tera_uttp) : ?>
          <tr style="text-align: center;">
            <td><?= $tera['tera_no_order'] ?></td>
            <td><?= ($tera_uttp['jenis_uttp_tipe_id'] == null) ? $tera_uttp['jenis_uttp_nama'] : $tera_uttp['jenis_uttp_tipe_nama'] . ": " . $tera_uttp['jenis_uttp_nama'] ?></td>
            <td><?= format_rupiah($tera_uttp['tera_uttp_kapasitas']) ?> <?= $tera_uttp['tera_uttp_daya_baca'] ?></td>
            <td><?= format_rupiah($tera_uttp['tera_uttp_jumlah']) ?></td>
          </tr>
        <?php
        endforeach; ?>
      </tbody>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 0 20px;" colspan="3">
    <br>
    <p style="white-space:pre">SKP / Sertifikat dibuat atas nama :</p>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 0 20px;" colspan="3">
    <p style="white-space:pre">Nama &#9;&#9;: <?= $tera['tera_atas_nama'] ?></p>
    <p style="white-space:pre">Alamat &#9;&#9;: <?= $tera['tera_atas_nama_alamat'] ?></p>
    <br>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 0 20px;" colspan="3">
    <p style="white-space:pre">Perkiraan selesai&#9;: 1. Tera &#9;&#9;&#9;: Maksimal 3 hari kerja</p>
    <p style="white-space:pre">&#9;&#9;&#9;&#9;&nbsp; 2. Tera Ulang &#9;: Maksimal 3 hari kerja</p>
    <p style="white-space:pre">&#9;&#9;&#9;&#9;&nbsp; Kecuali UTTP yang bersifat masal</p>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <table border="1">
      <thead>
        <tr style="text-align: center;">
          <th colspan="2">PENERIMAAN</th>
          <th colspan="2">PENYERAHAN</th>
        </tr>
      </thead>
      <tbody>
        <tr style="text-align: center;">
          <td>Pemohon,</td>
          <td>Penerima,</td>
          <td>Yang Menerima,</td>
          <td>Yang Menyerahkan,</td>
        </tr>
        <tr>
          <td>
            <p>&nbsp;Tgl:</p>
            <br>
            <br>
            <p>&nbsp;(....................................................)&nbsp;</p>
            <br>
          </td>
          <td>
            <p>&nbsp;Tgl:</p>
            <br>
            <br>
            <p>&nbsp;(....................................................)&nbsp;</p>
            <p>&nbsp;NIP</p>
          </td>
          <td>
            <p>&nbsp;Tgl:</p>
            <br>
            <br>
            <p>&nbsp;(....................................................)&nbsp;</p>
            <br>
          </td>
          <td>
            <p>&nbsp;Tgl:</p>
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