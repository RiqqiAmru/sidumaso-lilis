<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SIDUMASO</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assetsadmin/img/logo.png" rel="icon">
  <link href="/assetsadmin/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assetsadmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assetsadmin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assetsadmin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assetsadmin/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/assetsadmin/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/assetsadmin/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assetsadmin/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assetsadmin/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
  /* Sembunyikan tombol cetak saat mencetak */
  .print-only {
    display: none;
  }

  .no-print {
    display: block;
  }

  @media print {
    #printBtn {
      display: none;
    }



    /*  class card jadikan full width*/
    .card {
      width: 100% !important;
    }

    /* Menambahkan kop surat saat mencetak */
    #kopSurat {
      display: block;
      text-align: center;
      font-weight: bold;
      font-size: 20px;
    }

    /* Sembunyikan elemen-elemen yang tidak perlu dicetak */
    .no-print {
      /* important */
      display: none !important;
    }

    .print-only {
      display: block;
    }

    /* Atur margin halaman */
    /* scale 80% */

    @page {
      /* page A4 */
      margin: none;
      scale: 0.8;
      size: A4 landscape;
    }

    /* Atur font ukuran saat mencetak */


    /* Sesuaikan tampilan tabel saat dicetak */
    table {
      width: 100%;
      border-collapse: collapse;

    }



    th,
    td {

      padding: 8px;
      text-align: left;
    }
  }
  </style>
</head>

<body>
  <?= $this->include('templates/header'); ?>
  <?= $this->include('templates/sidebar'); ?>
  <?= $this->renderSection('content'); ?>
  <?php if (session('user_id')['role'] == 'Masyarakat' && session('user_id')['row_status'] == 'Menunggu'): ?>
  <main id="main" class="main">

    <div class="alert alert-info" role="alert">
      <h4 class="alert-heading">Menunggu</h4>
      <p>Mohon menunggu admin untuk memverifikasi status ktp anda. Anda tidak dapat mengajukan pengaduan sampai
        ktp anda terverifikasi oleh admin</p>
      <hr>
      <p class="mb-0">Silahkan hubungi admin jika dalam waktu 3x24 jam tidak ada perbaruan lebih lanjut</p>
    </div>
  </main>
  <?php endif ?>
  <?= $this->include('templates/footer'); ?>
  <!-- Template Main CSS File -->


  <script>
  // hanya jalankan jika ada elemen dengan id printBtn
  if (document.getElementById('printBtn')) {
    document.getElementById('printBtn').addEventListener('click', function() {
      // Menyembunyikan elemen yang tidak ingin dicetak
      document.getElementById('printBtn').style.display = 'none'; // Sembunyikan tombol cetak
      // sembunyikan elemen dengan class no-print
      document.querySelectorAll('.no-print').forEach(function(el) {
        el.style.display = 'none';
        console.log(el);
      });
      document.querySelectorAll('.print-only').forEach(function(el) {
        el.style.display = 'block';
      })

      window.print(); // Memanggil dialog cetak
      // Menampilkan kembali tombol cetak setelah selesai mencetak
      window.onafterprint = function() {
        document.getElementById('printBtn').style.display = 'block';
        document.querySelectorAll('.no-print').forEach(function(el) {
          el.style.display = 'block';
        });
        document.querySelectorAll('.print-only').forEach(function(el) {
          el.style.display = 'none';
        })
      };
    });
  }
  </script>

</body>