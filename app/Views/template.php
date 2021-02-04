<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $_title ?> - <?= env("app.appName") ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" href="<?= base_url('favicon.ico') ?>" sizes="32x32">
  <link rel="icon" href="<?= base_url('favicon.ico') ?>" sizes="192x192">
  <link rel="apple-touch-icon" href="<?= base_url('favicon.ico') ?>">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('') ?>/assets/vendor/presento/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('') ?>/assets/vendor/presento/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?= base_url('') ?>/assets/vendor/presento/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url('') ?>/assets/vendor/presento/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url('') ?>/assets/vendor/presento/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url('') ?>/assets/vendor/presento/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?= base_url('') ?>/assets/vendor/presento/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('') ?>/assets/vendor/presento/css/style.css" rel="stylesheet">
  <link href="<?= base_url('') ?>/assets/vendor/adminlte/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte') ?>/plugins/sweetalert2/sweetalert2.min.css">
  <?= $this->renderSection('customcss'); ?>

  <!-- =======================================================
  * Template Name: Presento - v1.0.0
  * Template URL: https://bootstrapmade.com/presento-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid">
      <div class="row justify-content-between">
        <div class="col-xl-12 d-flex align-items-center text-center">
          <h1 class="logo mr-auto"><a href="<?= base_url('') ?>"><?= env("app.appName") ?></a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a>-->
          <nav class="nav-menu d-none d-lg-block">
            <ul>
              <?php if (isset($_session->isLogin)) : ?>
                <li class="text-capitalize <?= ($_view == 'user/tera/pendaftaran/riwayat/index') ? "active" : "" ?>"><a href="<?= base_url('user/tera/pendaftaran/riwayat') ?>">riwayat pendaftaran</a></li>
                <li class="text-capitalize <?= ($_view == 'user/tera/pembayaran/riwayat/index') ? "active" : "" ?>"><a href="<?= base_url('user/tera/pembayaran/riwayat') ?>">riwayat pembayaran</a></li>
                <li class="text-capitalize <?= ($_view == 'user/tera/pengujian/riwayat/index') ? "active" : "" ?>"><a href="<?= base_url('user/tera/pengujian/riwayat') ?>">riwayat pengujian</a></li>
              <?php else : ?>
                <li class="text-capitalize <?= ($_view == 'auth/lupa_password') ? "active" : "" ?>"><a href="<?= base_url('auth/lupa_password') ?>">lupa password</a></li>
              <?php endif ?>
            </ul>
          </nav>
          <?php if (isset($_session->isLogin)) : ?>
            <a href="#" onclick="logout()" class="get-started-btn">Logout</a>
          <?php else : ?>
            <a href="<?= base_url('auth/login') ?>" class="get-started-btn">Login</a>
          <?php endif ?>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <?= $this->renderSection('content'); ?>

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-6 footer-links">
            <h4>Menu</h4>
            <ul>
              <?php if (isset($_session->isLogin)) : ?>
                <?php if ($_session->isPenjual) : ?>
                  <li><i class="bx bx-chevron-right"></i><a href="<?= base_url('penjual/dashboard') ?>">Dashboard</a></li>
                  <li><i class="bx bx-chevron-right"></i><a href="<?= base_url('penjual/transaksi') ?>">Transaksi</a></li>
                  <li><i class="bx bx-chevron-right"></i><a href="<?= base_url('penjual/riwayat_transaksi') ?>">Riwayat Transaksi</a></li>
                <?php elseif ($_session->isSantri) : ?>
                  <li><i class="bx bx-chevron-right"></i><a href="<?= base_url('santri/dashboard') ?>">Dashboard</a></li>
                  <li><i class="bx bx-chevron-right"></i><a href="<?= base_url('santri/riwayat_transaksi') ?>">Riwayat Transaksi</a></li>
                <?php endif ?>
              <?php endif ?>
              <?php if (isset($_session->isLogin)) : ?>
                <li><i class="bx bx-chevron-right"></i><a href="<?= base_url('auth/ubah_password') ?>">Ubah Password</a></li>
                <li><i class="bx bx-chevron-right"></i><a onclick="logout()" href="#">Logout (<?= $_session->user_nama ?? "" ?>)</a></li>
              <?php else : ?>
                <li><i class="bx bx-chevron-right"></i><a href="<?= base_url('auth') ?>">Login</a></li>
              <?php endif ?>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span><?= env("app.appName") ?></span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/presento-bootstrap-corporate-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('') ?>/assets/vendor/presento/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('') ?>/assets/vendor/presento/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('') ?>/assets/vendor/presento/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?= base_url('') ?>/assets/vendor/presento/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url('') ?>/assets/vendor/presento/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?= base_url('') ?>/assets/vendor/presento/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?= base_url('') ?>/assets/vendor/presento/vendor/counterup/counterup.min.js"></script>
  <script src="<?= base_url('') ?>/assets/vendor/presento/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url('') ?>/assets/vendor/presento/vendor/venobox/venobox.min.js"></script>
  <script src="<?= base_url('') ?>/assets/vendor/presento/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('') ?>/assets/vendor/presento/js/main.js"></script>
  <script src="<?= base_url('assets/vendor/adminlte') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="<?= base_url('assets/vendor/moment/moment-with-locales.js') ?>"></script>



  <script>
    var Toast;

    <?php if (isset($_session->isLogin)) : ?>

      function logout() {
        Swal.fire({
          title: 'Yakin ingin mengakhiri sesi?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location = "<?= base_url('auth/logout') ?>"
          }
        })
      }
    <?php endif ?>

    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function toLocaleDate(date, format = 'LL') {
      moment.locale('id')
      return moment(date).format(format)
    }

    $(function() {
      Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 8000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      $('.toRupiah').text(function(index, currentcontent) {
        return formatRupiah(currentcontent, 'Rp.')
      })
      <?php if ($_session->getFlashdata('success')) : ?>
        Toast.fire({
          icon: 'success',
          title: "<?= $_session->getFlashdata('success') ?>"
        })
      <?php endif; ?>
      <?php if ($_session->getFlashdata('error')) : ?>
        Toast.fire({
          icon: 'error',
          title: "<?= $_session->getFlashdata('error') ?>"
        })
      <?php endif; ?>
    });
  </script>
  <?= $this->renderSection('customjs'); ?>

</body>

</html>