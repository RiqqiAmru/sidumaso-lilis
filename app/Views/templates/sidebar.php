<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar no-print">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('Dashboard') ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <?php if (session('user_id')['role'] == 'Admin' | session('user_id')['role'] == 'Kepala_dusun'): ?>
            <?php if (session('user_id')['role'] == 'Admin'): ?>
                <li class="nav-heading">User Manage</li>
                <li class="nav-item">

                    <a class="nav-link collapsed" data-bs-target="#tables-dp" data-bs-toggle="collapse" href="">
                        <i class="bi bi-layout-text-window-reverse"></i><span>Daftar Pengguna</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="tables-dp" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?php echo base_url('/admin/manageuser/') ?>">
                                <i class="bi bi-circle"></i><span> Daftar Pengguna</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('/admin/manageuser/addUser') ?>">
                                <i class="bi bi-circle"></i><span>Tambah Pengguna</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Tables Nav -->
            <?php endif ?>
            <li class="nav-heading">Pengaduan</li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-dpn" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Daftar Pengaduan</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-dpn" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= base_url('/pengaduan/masuk') ?>">
                            <i class="bi bi-circle"></i><span>Pengaduan Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('/pengaduan/invalid') ?>">
                            <i class="bi bi-circle"></i><span>Pengaduan Tidak Valid</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('/pengaduan/daftarProses') ?>">
                            <i class="bi bi-circle"></i><span>Pengaduan Diproses</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('/pengaduan/selesai') ?>">
                            <i class="bi bi-circle"></i><span>Pengaduan Selesai</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-heading">lainnya</li>
            <?php if (session('user_id')['role'] == 'Admin'): ?>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?php echo base_url('Pengumuman') ?>">
                        <i class="bi bi-question-circle"></i>
                        <span>Pengumuman</span>
                    </a>
                </li>
            <?php endif ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo base_url('pengaduan/laporan') ?>">
                    <i class="bi bi-question-circle"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo base_url('sarancontroller') ?>">
                    <i class="bi bi-question-circle"></i>
                    <span>Saran</span>
                </a>
            </li>End F.A.Q Page Nav -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo base_url('log/index') ?>">
                    <i class="bi bi-envelope"></i>
                    <span>Log Aktivitas</span>
                </a>
            </li>End Contact Page Nav -->
        <?php endif ?>
        <?php if (session('user_id')['role'] == 'Masyarakat'): ?>
            <?php if (session('user_id')['role'] == 'Masyarakat' && session('user_id')['row_status'] == 'Aktif'): ?>
                <li class="nav-heading">Pengaduan</li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= base_url('/pengaduan/daftarPengaduan') ?>">
                        <i class="bi bi-layout-text-window-reverse"></i><span>Daftar Pengaduan Saya</span>
                    </a>

                </li>
            <?php endif ?>
        <?php endif ?>


        <li class="nav-heading">lainnya</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo base_url('AkunController/index') ?>">
                <i class="bi bi-card-list"></i>
                <span>Akun Saya</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo base_url('home') ?>">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>

</aside><!-- End Sidebar-->