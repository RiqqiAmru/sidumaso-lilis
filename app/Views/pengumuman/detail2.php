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
</head>

<body>
    <main class="main" class='container ' style="max-width: 1000px; margin:auto ; margin-top:100px ;">

        <div class=" pagetitle">
            <h1>Detail Pengumuman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Pengumuman</a></li>
                    <li class="breadcrumb-item active">Detail Pengumuman</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body text-center">
                            <!-- Foto atau Dokumen -->
                            <div class="mb-4">
                                <?php
                                $fileExtension = pathinfo($pengumuman['dokumen'], PATHINFO_EXTENSION);
                                if ($pengumuman['dokumen']):
                                    // Jika file adalah gambar
                                    if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])):
                                ?>
                                        <img src="<?= base_url('/uploads/pengumuman/' . $pengumuman['dokumen']); ?>" alt="Dokumen Pengumuman"
                                            class="img-fluid" style="max-height: 300px;">
                                    <?php
                                    // Jika file adalah PDF
                                    elseif ($fileExtension == 'pdf'):
                                    ?>
                                        <iframe src="<?= base_url('/uploads/pengumuman/' . $pengumuman['dokumen']); ?>" width="100%"
                                            height="500px"></iframe>
                                    <?php else: ?>
                                        <p>Dokumen tidak dapat dipreview.</p>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <p>Tidak ada dokumen untuk pengumuman ini.</p>
                                <?php endif; ?>
                            </div>

                            <!-- Judul Pengumuman -->
                            <h2 class="mb-3"><?= esc($pengumuman['judul']); ?></h2>

                            <!-- Tanggal Pengumuman -->
                            <p class="text-muted"><?= date('d-m-Y H:i:s', strtotime($pengumuman['tanggal'])); ?></p>

                            <!-- Deskripsi Pengumuman -->
                            <div class="mt-4">
                                <h5>Deskripsi:</h5>
                                <p><?= nl2br(esc($pengumuman['deskripsi'])); ?></p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
</body>