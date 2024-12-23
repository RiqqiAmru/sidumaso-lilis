<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login- SIDUMASO</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo base_url('assets/img/logo.png') ?>" rel="icon">
    <link href="<?php echo base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url('assets/css/style.css" rel="stylesheet') ?>">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <!-- alert -->
            <?php if ((session('message'))): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?= session('message') ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="/home" class="logo d-flex align-items-center w-auto">
                                    <img src="<?php echo base_url('assets/img/logo.png') ?>" alt="" width="20px">
                                    <span class="d-none d-lg-block">SIDUMASO</span>
                                </a>
                            </div><!-- End Logo -->
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Silahkan Login</h5>
                                        <p class="text-center small">Masukkan username dan password</p>
                                    </div>

                                    <?php if (isset($_GET['refresh'])): ?>
                                        <script>
                                            if (!sessionStorage.getItem('refreshed')) {
                                                sessionStorage.setItem('refreshed', 'true');
                                                location.reload();
                                            } else {
                                                sessionStorage.removeItem('refreshed');
                                            }
                                        </script>
                                    <?php endif; ?>

                                    <form method="POST" action="<?= site_url('auth/login') ?>"
                                        class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="username"
                                                    class="form-control <?= (isset(session()->getFlashdata('errors')['username'])) ? 'is-invalid' : '' ?>"
                                                    id="yourUsername" required>
                                                <!-- Menampilkan pesan error untuk username -->
                                                <?php if (isset(session()->getFlashdata('errors')['username'])): ?>
                                                    <br>
                                                    <div class="invalid-feedback">
                                                        <?= session()->getFlashdata('errors')['username']; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="invalid-feedback">Username harus diisi</div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">password harus diisi</div>

                                            <!-- Menampilkan pesan error untuk password -->
                                            <?php if (isset(session()->getFlashdata('errors')['password'])): ?>
                                                <div class="text-danger fs-6 ">
                                                    <?= session()->getFlashdata('errors')['password']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>


                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Belum punya akun? <a href="auth/register">Buat
                                                    Akun</a></p>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Kembali Ke Beranda? <a href="home">Tekan Disini</a>
                                            </p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                Tim IT Pemerintah Desa Wonoyoso</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?php echo base_url('assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/chart.js/chart.umd.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/echarts/echarts.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/quill/quill.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/tinymce/tinymce.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/php-email-form/validate.js') ?>"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo base_url('assets/js/main.js') ?>"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>