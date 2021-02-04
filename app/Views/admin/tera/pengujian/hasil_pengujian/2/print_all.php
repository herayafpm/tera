<?= view("admin/components/header_surat_legal") ?>

<tr>
  <td align="center" style="padding: 20px 20px;" colspan="3">
    <p style="font-size: 19px;"><b><u>SURAT KETERANGAN HASIL PENGUJIAN</u></b></p>
    <p style="font-size: 16px;white-space:pre">Nomor: <?= $_GET['no_surat'] ?? "...... / ...... / ......." ?></p>
  </td>
</tr>
<tr>
  <td align="right" style="padding: 0px 20px;" colspan="3">
    <table style="width: 250px; border:1px solid #000;">
      <tr>
        <td style="vertical-align: top;width: 70px;padding:5px">
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
  <td style="padding: 10px 50px 20px;" colspan="3">
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">1. Jenis UTTP</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> Tangki Ukur Mobil untuk <?= (($tera_uttp_retribusi['jenis_uttp_tipe_id'] != null) ? $tera_uttp_retribusi['jenis_uttp_tipe_nama'] . ":" : "") . $tera_uttp_retribusi['jenis_uttp_nama'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">2. Pemilik / Alamat</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['tera_atas_nama'] ?> / <?= $tera['tera_atas_nama_alamat'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">3. Merk / No. Seri</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['tera_uttp_merk'] ?> / <?= $tera_uttp['tera_uttp_no_seri'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">4. Volume Nominal</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['tera_uttp_volume'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">5. Merk Kendaraan</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['tera_uttp_merk_kendaraan'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">6. No. Polisi / Chasis</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['tera_uttp_no_polisi'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">7. Metoda</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> Penakaran Masuk</div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">8. No. Kode Plat</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['tera_uttp_no_kd_plat'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">9. Suhu</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> 28° C</div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">10. Dilaksanakan Oleh</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1">
        <p>
          <?php
          $no = 1;
          foreach ($tera['tera_petugas'] as $petugas) : ?>
        <p><?= $no ?>. <?= $petugas['tera_petugas_admin_nama'] ?> NIP. <?= $petugas['tera_petugas_admin_username'] ?></p>
      <?php
            $no++;
          endforeach ?>
      </p>
      </div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">11. Tanggal</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= date("d-m-Y", strtotime($tera_uttp['tera_uttp_pengujian_at'])) ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 2px;">
      <div style="width: 190px;">12. Hasil Pengujian</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> Disahkan Untuk <?= $tera['jenis_tera_nama'] ?> Tahun <?= date("Y", strtotime($tera_uttp['tera_uttp_pengujian_at'])) ?> berdasarkan Undang - Undang Republik Indonesia Nomor 2 Tahun 1981 tentang Metrologi Legal dengan membubuhkan Tanda Sah dan Tanda Jaminan</div>
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