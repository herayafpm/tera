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
    <h4><b><u>SURAT KETERANGAN HASIL PENGUJIAN</u></b></h4>
    <h4 style="font-weight: 600;white-space:pre">Nomor: <?= $_GET['no_surat'] ?? "...... / ...... / ......." ?></h4>
  </td>
</tr>
<tr>
  <td align="right" style="padding: 0px 20px;" colspan="3">
    <table style="width: 150px; border:1px solid #000;">
      <tr>
        <td style="vertical-align: top;width: 52px;padding:5px">
          <p>No Order : </p>
        </td>
        <td align="center" style="padding: 0px 5px 0px 0px;">
          <p style="border-bottom: 1px solid #000;"><?= $tera['tera_no_order'] ?></p>
        </td>
      </tr>
      <tr>
        <td align="center">
        </td>
        <td align="center">
          <p><?= date("d - m - Y", strtotime($tera['tera_date_order'])) ?></p>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 0 50px 20px;" colspan="3">
    <p style="white-space:pre">1. Jenis UTTP &#9;&#9;&#9;: Tangki Ukur Mobil untuk <?= (($tera_uttp_retribusi['jenis_uttp_tipe_id'] != null) ? $tera_uttp_retribusi['jenis_uttp_tipe_nama'] . ":" : "") . $tera_uttp_retribusi['jenis_uttp_nama'] ?></p>
    <p style="white-space:pre">2. Pemilik / Alamat &#9;&#9;: <?= $tera['tera_atas_nama'] ?> / <?= $tera['tera_atas_nama_alamat'] ?></p>
    <p style="white-space:pre">3. Merk / No. Seri &#9;&#9;&#9;: <?= $tera_uttp['tera_uttp_merk'] ?> / <?= $tera_uttp['tera_uttp_no_seri'] ?></p>
    <p style="white-space:pre">4. Volume Nominal &#9;&#9;: <?= $tera_uttp['tera_uttp_volume'] ?></p>
    <p style="white-space:pre">5. Merk Kendaraan &#9;&#9;: <?= $tera_uttp['tera_uttp_merk_kendaraan'] ?></p>
    <p style="white-space:pre">6. No. Polisi / Chasis &#9;&#9;: <?= $tera_uttp['tera_uttp_no_polisi'] ?></p>
    <p style="white-space:pre">7. Metoda &#9;&#9;&#9;&#9;: Penakaran Masuk</p>
    <p style="white-space:pre">8. No. Kode Plat &#9;&#9;&#9;: <?= $tera_uttp['tera_uttp_no_kd_plat'] ?></p>
    <p style="white-space:pre">9. Suhu &#9;&#9;&#9;&#9;&#9;: 28° C</p>
    <div style="display: flex;">
      <div style="width:144px;">10. Dilaksanakan Oleh</div>
      <div>:</div>
      <div style="padding-left:2px;text-align:justify">
        <?php
        $no = 1;
        foreach ($tera['tera_petugas'] as $petugas) : ?>
          <p><?= $no ?>. <?= $petugas['tera_petugas_admin_nama'] ?> NIP. <?= $petugas['tera_petugas_admin_username'] ?></p>
        <?php
          $no++;
        endforeach ?>
      </div>
    </div>
    <p style="white-space:pre">11. Tanggal &#9;&#9;&#9;&#9;: <?= date("d-m-Y", strtotime($tera_uttp['tera_uttp_pengujian_at'])) ?></p>
    <div style="display: flex;">
      <div style="width:161px">12. Hasil Pengujian</div>
      <div>:</div>
      <div style=" padding-left:2px;text-align:justify">
        Disahkan Untuk <?= $tera['jenis_tera_nama'] ?> Tahun <?= date("Y", strtotime($tera_uttp['tera_uttp_pengujian_at'])) ?> berdasarkan Undang - Undang Republik Indonesia Nomor 2 Tahun 1981 tentang Metrologi Legal dengan membubuhkan Tanda Sah dan Tanda Jaminan
      </div>
    </div>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 0px 20px;">
    <img style="width:68vw" src="<?= base_url('assets/images/tangki_ukur.png') ?>" alt="" srcset="">
  </td>
  <td style="padding: 30px 20px 0px 20px;width: 200px;vertical-align: top;" colspan="2">
    <table border="1">
      <thead style="text-align: center;">
        <td></td>
        <td>
          <p>Muka</p>
          <p>(mm)</p>
        </td>
        <td>
          <p>Belakang</p>
          <p>(mm)</p>
        </td>
      </thead>
      <tbody>
        <tr>
          <td style="text-align:center">t1 = </td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_t1_muka'] ?? 0) ?></td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_t1_belakang'] ?? 0) ?></td>
        </tr>
        <tr>
          <td style="text-align:center">t2 = </td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_t2_muka'] ?? 0) ?></td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_t2_belakang'] ?? 0) ?></td>
        </tr>
        <tr>
          <td style="text-align:center">t3 = </td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_t3_muka'] ?? 0) ?></td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_t3_belakang'] ?? 0) ?></td>
        </tr>
        <tr>
          <td style="text-align:center">t4 = </td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_t4_muka'] ?? 0) ?></td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_t4_belakang'] ?? 0) ?></td>
        </tr>
        <tr>
          <td style="text-align:center">T = </td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_t_muka'] ?? 0) ?></td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_t_belakang'] ?? 0) ?></td>
        </tr>
        <tr>
          <td style="text-align:center">d = </td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_d_muka'] ?? 0) ?></td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_d_belakang'] ?? 0) ?></td>
        </tr>
        <tr>
          <td style="text-align:center">q = </td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_q_muka'] ?? 0) ?></td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_q_belakang'] ?? 0) ?></td>
        </tr>
        <tr>
          <td style="text-align:center">s = </td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_s_muka'] ?? 0) ?></td>
          <td align="center"><?= format_rupiah($tera_uttp['tera_uttp_detail_s_belakang'] ?? 0) ?></td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;">

  </td>
  <td align="center" style="width:200px;padding: 20px 50px;">
    <p>......................................, <?= date("d - m - Y") ?></p>
    <p>a.n KEPALA DINPERINDAG</p>
    <p>KAB. BANYUMAS</p>
    <br>
    <br>
    <br>
    <p style="border-bottom: 1px solid rgba(0, 0, 0, 0.6);">..................................................................</p>
    <p>NIP. ..........................................................</p>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <p>Catatan: </p>
    <div style="padding:0px 10px;text-align:justify">
      <p>1. Tera Ulang berikutnya bulan ........................</p>
      <p>2. Kepekaan pada Indeks penunjuk, Muka .........L/mm, Belakang ...... L/mm.</p>
      <p>3. Ruang kosong TUM: Muka ......... L, Belakang ......... L.</p>
      <p>4. Diameter pipa penyerahan: ....., Panjang pipa penyerahan: Muka .....mm, Belakang .....mm</p>
      <p>5. t2 diukur dasar sampai batas atas lidah indeks: ....., pengukuran dilakukan menempel di depan indeks.</p>
      <p>6. Volume TUM diukur sampai dengan kran penyerahan terakhir</p>
      <p>7. Tutup dom disegel dengan tanda tera jaminan</p>
      <p>8. Keterangan ini tidak berlaku apabila tanda tera, indeks dan bentuk tangki berubah/rusak</p>
    </div>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px 0px 20px;" colspan="3">
    <hr style="border-bottom: 1px solid #000000; height:0px;">
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;text-align:center" colspan="3">
    Dilarang menggandakan sebagian isi Surat Keterangan ini tanpa seijin dari Bidang Metrologi Dinperindag Kab. Banyumas
  </td>
</tr>
<tr>
  <td style="padding: 0px 20px;text-align:justify" colspan="3">
    <p>1. Apabila Kepala Dinas tidak ditempat, Surat Keterangan Pengujian ditandatangani oleh Sekretaris Dinperindag Kab. Banyumas</p>
    <p>2. Apabila Kepala Dinas dan Sekretaris Dinas tidak ada ditempat, Surat Keterangan Pengujian ditandatangani oleh Kepala Bidang Metrologi.</p>
    <p>3. Ukuran kertas: Legal 80 gram, Logo Pemkab berwarna, Logo Bancana berwarna kuning.</p>
  </td>
</tr>
<?= $this->endSection('content'); ?>