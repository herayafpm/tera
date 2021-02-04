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
    <?php $this->renderSection('content') ?>
  </div>
  <script>
    window.print()
  </script>
</body>

</html>