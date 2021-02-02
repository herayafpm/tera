<?= $this->extend('admin/template_surat'); ?>
<?= $this->section('content'); ?>
<tr>
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <h4 style="text-transform: uppercase;"><b><u>surat tugas</u></b></h4>
    <h4 style="font-weight: 600;white-space:pre">Nomor: <?= $_GET['no_surat'] ?? "800 /       /       /" ?></h4>
  </td>
</tr>
<tr>
  <td style="padding: 20px 20px;" colspan="3">
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
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <h5 style="text-transform: uppercase;">MEMERINTAHKAN</h5>
  </td>
</tr>
<tr>
  <td style="padding:20px 20px;vertical-align: top;" colspan="3">
    <table>
      <tr>
        <td style="vertical-align: top;width:20px">
          <p style="white-space:pre">Kepada&#9;&#9;&#9;: </p>
        </td>
        <td style="padding-left: 5px;">
          <table>
            <tr>
              <td style="vertical-align: top;">1.</td>
              <td>
                <p style="white-space:pre">Nama &#9;&#9;&#9;: <?= $tera_pengajuan['tera_pengajuan_petugas1_admin_nama'] ?></p>
                <p style="white-space:pre">Pangkat / Gol &#9;&#9;: <?= $tera_pengajuan['tera_pengajuan_petugas1_aparatur_pangkat'] ?></p>
                <p style="white-space:pre">NIP &#9;&#9;&#9;&#9;: <?= $tera_pengajuan['tera_pengajuan_petugas1_admin_username'] ?></p>
                <p style="white-space:pre">Jabatan &#9;&#9;&#9;: <?= $tera_pengajuan['tera_pengajuan_petugas1_jabatan_nama'] ?></p>
              </td>
            </tr>
            <tr>
              <td><br></td>
            </tr>
            <?php if ($tera_pengajuan['tera_pengajuan_petugas2'] != null) : ?>
              <tr>
                <td style="vertical-align: top;">2.</td>
                <td>
                  <p style="white-space:pre">Nama &#9;&#9;&#9;: <?= $tera_pengajuan['tera_pengajuan_petugas2_admin_nama'] ?></p>
                  <p style="white-space:pre">Pangkat / Gol &#9;&#9;: <?= $tera_pengajuan['tera_pengajuan_petugas2_aparatur_pangkat'] ?></p>
                  <p style="white-space:pre">NIP &#9;&#9;&#9;&#9;: <?= $tera_pengajuan['tera_pengajuan_petugas2_admin_username'] ?></p>
                  <p style="white-space:pre">Jabatan &#9;&#9;&#9;: <?= $tera_pengajuan['tera_pengajuan_petugas2_jabatan_nama'] ?></p>
                </td>
              </tr>
              <tr>
                <td><br></td>
              </tr>
            <?php endif ?>
          </table>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 20px 20px;vertical-align: top;" colspan="3">
    <table>
      <tr>
        <td style="vertical-align: top;">
          <p style="white-space:pre">Untuk&#9;&#9;&#9;: </p>
        </td>
        <td style="padding-left: 5px;">
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
  <td style="padding: 0 20px;" colspan="3">
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