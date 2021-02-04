<?= view("admin/components/header_surat") ?>

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
  <td style="padding: 10px 50px;" colspan="3">
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">1. Jenis Alat UTTP</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= (($tera_uttp_retribusi['jenis_uttp_tipe_id'] != null) ? $tera_uttp_retribusi['jenis_uttp_tipe_nama'] . ":" : "") . $tera_uttp_retribusi['jenis_uttp_nama'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">2. Merk / Type / Nomer Seri</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['tera_uttp_merk'] ?> / <?= $tera_uttp['tera_uttp_tipe'] ?> / <?= $tera_uttp['tera_uttp_no_seri'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">3. Merk Kendaraan</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['tera_uttp_merk_kendaraan'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">4. No. Polisi dan No. Lambung</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['tera_uttp_no_polisi'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">5. Pemilik / Pemakai</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera['tera_atas_nama'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">6. Diuji Oleh</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= $tera_uttp['admin_nama'] ?> NIP. <?= $tera_uttp['admin_username'] ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">7. Tanggal Pengujian</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> <?= date("d-m-Y", strtotime($tera_uttp['tera_uttp_pengujian_at'])) ?></div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">8. Metode</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> Perbandingan Langsung dengan standar</div>
    </div>
    <div style="display:flex;text-align: justify;margin-bottom: 5px;">
      <div style="width: 225px;">9. Hasil Pengujian</div>
      <div style="margin-right: 10px;">:</div>
      <div style="flex:1"> Disahkan Untuk <?= $tera['jenis_tera_nama'] ?> Tahun <?= date("Y", strtotime($tera_uttp['tera_uttp_pengujian_at'])) ?> berdasarkan Undang - Undang Republik Indonesia Nomor 2 Tahun 1981 tentang Metrologi Legal dengan membubuhkan Tanda Sah dan Tanda Jaminan</div>
    </div>
    <br>
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;" colspan="3">
    <hr style="border-bottom: 1px solid #000000; height:0px;">
  </td>
</tr>
<tr>
  <td style="padding: 5px 20px;">

  </td>
  <td align="center" style="width:200px;padding: 20px 40px;">
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
  <td style="padding: 5px 30px;" colspan="3">
    <p>CATATAN: </p>
    <div style="padding:0px 10px;text-align:justify">
      <div style="display:flex;text-align: justify;margin-bottom: 5px;">
        <div style="width: 10px;">1.</div>
        <div style="margin-right: 10px;"></div>
        <div style="flex:1"> Tera Ulang berikutnya bulan ........................</div>
      </div>
      <div style="display:flex;text-align: justify;margin-bottom: 5px;">
        <div style="width: 10px;">2.</div>
        <div style="margin-right: 10px;"></div>
        <div style="flex:1"> Keterangan ini tidak berlaku apabila tanda tera masuk rusak</div>
      </div>
      <div style="display:flex;text-align: justify;margin-bottom: 5px;">
        <div style="width: 10px;">3.</div>
        <div style="margin-right: 10px;"></div>
        <div style="flex:1"> Apabila Kepala Dinas tidak ditempat, Surat Keterangan Pengujian ditandatangani oleh Sekretaris Dinperindag Kab. Banyumas</div>
      </div>
      <div style="display:flex;text-align: justify;margin-bottom: 5px;">
        <div style="width: 10px;">4.</div>
        <div style="margin-right: 10px;"></div>
        <div style="flex:1"> Apabila Kepala Dinas dan Sekretaris Dinas tidak ada ditempat, Surat Keterangan Pengujian ditandatangani oleh Kepala Bidang Metrologi.</div>
      </div>
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