<?= $this->extend('admin/template_surat'); ?>
<?= $this->section('content'); ?>
<?= view("admin/components/header_surat") ?>

<tr>
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <p style="font-size: 19px;text-transform: uppercase;"><b><u>SURAT TUGAS</u></b></p>
    <p style="font-size: 16px;white-space:pre">Nomor: <?= $_GET['no_surat'] ?? "800 /       /       /" ?></p>
  </td>
</tr>
<tr>
  <td style="padding: 20px 40px;text-align: justify;" colspan="3">
    <table>
      <tr>
        <td style="vertical-align: top;">
          <p style="white-space:pre;">Dasar&#9;&#9;&#9;: </p>
        </td>
        <td style="padding-left: 5px;">
          <table>
            <tr>
              <td style="vertical-align: top;">1.</td>
              <td style="padding-left: 5px;">Peraturan Daerah Kabupaten Banyumas Nomor 13 Tahun 2017 Tentang APBD Kabupaten Banyumas Tahun Anggaran 2018 Lembaran Daerah Kabupaten Banyumas Tahun 2017 Nomor 3 Seri A;</td>
            </tr>
            <tr>
              <td style="vertical-align: top;">2.</td>
              <td style="padding-left: 5px;">Peraturan Bupati Banyumas Nomor 90 Tahun 2017 Tentang Penjabaran APBD Kabupaten Banyumas Tahun Anggaran 2018 Berita Daerah Kabupaten Banyumas Tahun 2017 Nomor 90;</td>
            </tr>
            <tr>
              <td style="vertical-align: top;">3.</td>
              <td style="padding-left: 5px;">Peraturan Bupati Banyumas Nomor 69 Tahun 2016 tanggal 17 November 2016 Tentang Kedudukan, Susunan Organisasi, Tugas dan Fungsi serta Tata Kerja Dinas Perindustrian dan Perdagangan Kabupaten Banyumas;</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td align="center" style="padding: 10px 40px;" colspan="3">
    <h5 style="text-transform: uppercase;font-size: 14px;">MEMERINTAHKAN</h5>
  </td>
</tr>
<tr>
  <td style="padding:10px 40px;vertical-align: top;" colspan="3">
    <table>
      <tr>
        <td style="vertical-align: top;width:20px">
          <p style="white-space:pre">Kepada&#9;&#9;&#9;: </p>
        </td>
        <td style="padding-left: 5px;">
          <table>
            <?php
            $no = 0;
            foreach ($petugass as $petugas) : ?>
              <tr>
                <td>
                  <div style="display:flex;text-align: justify;margin-bottom: 2px;">
                    <div style="width: 115px;"><?= $no  + 1 ?>. Nama</div>
                    <div style="margin-right: 10px;">:</div>
                    <div style="flex:1"> <?= $petugas['tera_petugas_admin_nama'] ?></div>
                  </div>
                  <div style="display:flex;text-align: justify;margin-bottom: 2px;">
                    <div style="width: 100px;padding-left: 15px;">Pangkat / Gol</div>
                    <div style="margin-right: 10px;">:</div>
                    <div style="flex:1"> <?= $petugas['aparatur_pangkat'] ?></div>
                  </div>
                  <div style="display:flex;text-align: justify;margin-bottom: 2px;">
                    <div style="width: 100px;padding-left: 15px;">NIP</div>
                    <div style="margin-right: 10px;">:</div>
                    <div style="flex:1"> <?= $petugas['tera_petugas_admin_username'] ?></div>
                  </div>
                  <div style="display:flex;text-align: justify;margin-bottom: 2px;">
                    <div style="width: 100px;padding-left: 15px;">Jabatan</div>
                    <div style="margin-right: 10px;">:</div>
                    <div style="flex:1"> <?= $petugas['jabatan_nama'] ?></div>
                  </div>
                </td>
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
  <td style="padding: 0px 40px;vertical-align: top;" colspan="3">
    <table>
      <tr style="text-align: justify;">
        <td style="vertical-align: top;">
          <p style="white-space:pre">Untuk&#9;&#9;&#9;: </p>
        </td>
        <td style="padding-left: 0px;">
          <table>
            <tr>
              <td style="vertical-align: top;">1.</td>
              <td style="padding-left: 5px;">Melaksanakan Perjalanan Dinas Ke <?= $tera['tera_atas_nama'] ?> dalam rangka <?= $tera['jenis_tera_nama'] ?> tanggal <?= date("d-m-Y", strtotime($tera['tera_date_order'])) ?>;</td>
            </tr>
            <tr>
              <td style="vertical-align: top;">2.</td>
              <td style="padding-left: 5px;">Segala biaya yang timbul dibebankan pada Anggaran Kegiatan Pelayanan <?= $tera['jenis_tera_nama'] ?>, Perjalanan Dinas Dalam Daerah dengan kode rekening 5.2.2.15.01;</td>
            </tr>
            <tr>
              <td style="vertical-align: top;">3.</td>
              <td style="padding-left: 5px;">Melaporkan hasil pelaksanaan tugas kepada kepala Dinperindag Kabupaten Banyumas;</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 0px 20px;" colspan="3">
    <br>
    <p style="white-space:pre">Demikian untuk dilaksanakan dengan penuh tanggung jawab.</p>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;">

  </td>
  <td align="center" style="width:200px;padding: 20px 20px;">
    <p style="text-align: left;">Ditetapkan di Purwokerto</p>
    <p style="text-align: left;">Pada tanggal: <?= date("d - m - Y") ?></p>
    <br>
    <p style="font-weight: 500;">KEPALA DINPERINDAG KABUPATEN BANYUMAS</p>
    <br>
    <br>
    <br>
    <p style="border-bottom: 1px solid rgba(0, 0, 0, 0.6);">...................................................................</p>
    <p>.....................................</p>
    <p>NIP. ..........................................................</p>
  </td>
</tr>
<?= $this->endSection('content'); ?>