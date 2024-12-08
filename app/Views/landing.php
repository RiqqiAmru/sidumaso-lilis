<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SIDUMASO</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: QuickStart
  * Template URL: https://bootstrapmade.com/quickstart-bootstrap-startup-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <img src="assets/img/logo.png" alt="">
                <h1 class="sitename">SIDUMASO</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero" class="active">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#features">Tentang</a></li>
                    <li><a class="nav-link scrollto" href="#pengumuman">Pengumuman</a></li>
                    <li><a href="index.html#services">Daftar Laporan</a></li>
                    <!-- <li><a href="index.html#pricing">Pricing</a></li>
                    <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li> -->
                    <li><a class="nav-link scrollto" href="#contact">Saran</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="<?php echo base_url('Auth') ?>">Login</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="hero-bg">
                <img src="assets/img/hero-bg.jpg" alt="">
            </div>
            <div class="container text-center">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h1 data-aos="fade-up">Selamat Datang Di <span>Sistem Informasi Pengaduan Masyarakat Desa
                            Wonoyoso</span></h1>
                    <p data-aos="fade-up" data-aos-delay="100">Layanan Pengaduan Online Pemerintah Desa Wonoyoso<br></p>
                    <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        <a href="<?php echo base_url('Auth') ?>" class="btn-get-started">Login</a>
                        <a href="https://youtu.be/V7LjMOTO7Xw?feature=shared"
                            class="glightbox btn-watch-video d-flex align-items-center"><i
                                class="bi bi-play-circle"></i><span>Video Desa Wonoyoso</span></a>
                    </div>
                    <img src="assets/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out"
                        data-aos-delay="300">
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section light-background">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-briefcase"></i></div>
                            <div>
                                <h4 class="title"><a href="auth/register" class="stretched-link">Daftar Akun</a></h4>
                                <p class="description">Silahkan Daftar Akun untuk melaporkan aduan</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-card-checklist"></i></div>
                            <div>
                                <h4 class="title"><a href="auth/index" class="stretched-link">Login</a></h4>
                                <p class="description">Harap login terlebih dahulu</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-bar-chart"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Aduan Terkirim</a></h4>
                                <p class="description">Akan ada 4 proses yaitu laporan masuk, laporan valid atau tidak
                                    valid, laporan diproses, laporan selesai</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Featured Services Section -->



        <section>

        </section>


        <!-- Features Details Section -->
        <section id="features-details" class="features-details section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang</h2>
                <p>Sistem Informasi Pengaduan Masyarakat Desa Wonoyoso</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4 justify-content-between features-item">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="assets/img/1.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <h3>SIDUMASO</h3>
                            <p>
                                Sistem Informasi Pengaduan Masyarakat Desa Wonoyoso (SIDUMASO) adalah platform berbasis
                                web yang dirancang untuk memfasilitasi masyarakat dalam menyampaikan pengaduan terkait
                                permasalahan di lingkungan desa. Sistem ini bertujuan untuk meningkatkan keterhubungan
                                antara masyarakat dengan pemerintah desa melalui proses pengaduan yang terstruktur dan
                                mudah diakses.
                            </p>
                        </div>
                    </div>

                </div><!-- Features Item -->


            </div>

        </section><!-- /Features Details Section -->

        <!-- Services Section -->
        <section id="pengumuman" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Pengumuman</h2>
                <p>Semua informasi terkait program dan aktivitas yang sedang berlangsung kini dapat diakses melalui
                    dokumentasi resmi yang kami sediakan.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <?php if (!empty($pengumuman)): ?>
                        <?php foreach ($pengumuman as $p): ?>
                            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="service-item item-cyan position-relative" style="margin-bottom: 20px;">
                                    <!-- Preview Dokumen -->
                                    <div class="mb-3">
                                        <?php if (in_array(pathinfo($p['dokumen'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                            <img src="/uploads/pengumuman/<?= esc($p['dokumen']); ?>" alt="Preview Dokumen"
                                                style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px; margin-bottom: 15px;">
                                        <?php else: ?>
                                            <p class="text-muted">Preview tidak tersedia untuk file non-gambar.</p>
                                        <?php endif; ?>
                                    </div>
                                    <!-- Konten Pengumuman -->
                                    <div>
                                        <h3><?= esc($p['judul']); ?></h3>
                                        <p><?= esc(substr($p['deskripsi'], 0, 100)) . '...'; ?></p>
                                        <a href="/pengumuman/detail/<?= $p['id']; ?>" class="read-more stretched-link">
                                            Learn More <i></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada pengumuman yang tersedia.</p>
                    <?php endif; ?>
                </div>


                <style>
                    img {
                        max-width: 100%;
                        height: auto;
                        border-radius: 8px;
                        /* Rounded corners */
                    }

                    .service-item img {
                        height: 150px;
                        /* Fixed height for consistency */
                        object-fit: cover;
                        /* Crop image to fit the container */
                    }
                </style>


            </div>

        </section><!-- /Services Section -->

        <!-- More Features Section -->
        <section id="more-features" class="more-features section">
            <div class="container">
                <div data-aos="fade-up" data-aos-delay="200">
                    <img src="assets/img/2.png" alt="Gambar Fitur"
                        style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    <img src="assets/img/3.png" alt="Gambar Fitur"
                        style="width: 100%; height: 100%; object-fit: cover; display: block;">

                </div>
            </div>

        </section>
        <!-- /More Features Section -->



        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak dan Saran</h2>
                <p>Kritik dan Saran sangat membantu meningkatkan kualitas pengaduan kami</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Alamat</h3>
                            <p>Dusun I, Wonoyoso, Kec. Buaran, Kabupaten Pekalongan, Jawa Tengah 51171</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone"></i>
                            <h3>No Telepon</h3>
                            <p>+1 5589 55488 55</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p>Desawonoyoso@gmail.com</p>
                        </div>
                    </div><!-- End Info Item -->

                </div>

                <div class="row gy-4 mt-1">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1873.5496097811981!2d109.65529160764731!3d-6.935438399875723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e702151013a2d55%3A0xb8bfa42e00584a78!2sKantor%20Kepala%20Desa%20Wonoyoso!5e0!3m2!1sid!2sid!4v1699601526562!5m2!1sid!2sid"
                            frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div><!-- End Google Maps -->

                    <div class="col-lg-6">
                        <form action="/saran/store" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="400">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Anda"
                                        required="">
                                </div>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="saran" rows="6" placeholder="Isi Saran"
                                        required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Saran Anda telah terkirim. Terima kasih!</div>

                                    <button type="submit">Kirim Saran</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer position-relative light-background">



        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Pemerintah Desa Wonoyoso</strong></p>

        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>