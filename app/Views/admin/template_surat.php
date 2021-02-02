<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title><?= $_title ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="<?= base_url('assets/css/report.css') ?>" rel="stylesheet" type="text/css">
  <?php $this->renderSection('customcss') ?>
</head>

<body>
  <div id="body">
    <table>
      <tbody>
        <tr>
          <td align="center" style="height:100px" colspan="3">
            <img src="<?= base_url('assets/images/logobms.png') ?>" alt="" style="float:left;margin-left:10px;width:100px; height:auto">
            <h4>PEMERINTAH KABUPATEN BANYUMAS</h4>
            <h2 style="margin-top: 5px;">DINAS PERINDUSTRIAN DAN PERDAGANGAN </h2>
            <p style="margin-top: 5px;">
              <b>
                Jl. Jend. Gatot Soebroto No. 102 Purwokerto, 53116, Telp (0281) 637087, 630549, 626114, Fax (0281) 622940
              </b>
            </p>
            <p style="margin-top: 5px;">
              <b>
                Jalan D.I. Panjaitan No. 222 Purwokerto Telp. 0281 636846 <?= $this->renderSection('departement') ?>
              </b>
            </p>
          </td>
        </tr>
        <tr>
          <td style="padding: 5px 20px;" colspan="3">
            <hr style="border-bottom: 2px solid #000000; height:0px;">
          </td>
        </tr>
        <?php $this->renderSection('content') ?>
      </tbody>
    </table>
  </div>
  <script>
    window.print()
  </script>
</body>

</html>