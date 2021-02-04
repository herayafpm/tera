  <?= $this->extend('admin/template_surats'); ?>
  <?= $this->section('customcss') ?>
  <style>
    @media print {
      table {
        page-break-after: always;
      }
    }
  </style>
  <?= $this->endSection('customcss') ?>
  <?= $this->section('content'); ?>
  <?php foreach ($tera_uttps as $tera_uttp) : ?>
    <table>
      <tbody>
        <?php
        $data = [
          'tera_uttp' => $tera_uttp,
          'tera' => $tera,
        ]
        ?>
        <?php if ($tera_uttp['tera_uttp_volume'] == null && $tera_uttp['tera_uttp_buatan'] != null) : ?>
          <?= view("admin/tera/pengujian/hasil_pengujian/1/print_all", $data) ?>
        <?php elseif ($tera_uttp['tera_uttp_volume'] != null && $tera_uttp['tera_uttp_buatan'] == null) : ?>
          <?= view("admin/tera/pengujian/hasil_pengujian/2/print_all", $data) ?>
        <?php elseif ($tera_uttp['tera_uttp_volume'] == null && $tera_uttp['tera_uttp_buatan'] == null) : ?>
          <?= view("admin/tera/pengujian/hasil_pengujian/3/print_all", $data) ?>
        <?php endif ?>
      </tbody>
    </table>
  <?php endforeach ?>
  <?= $this->endSection('content'); ?>