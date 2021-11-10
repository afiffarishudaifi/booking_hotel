<?php
$uri = service('uri');
$session = session();
?>
<div id="sidebar" class="sidebar">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="<?= base_url() . '/' . $session->get('foto'); ?>" alt="" />
                    </div>
                    <div class="info">
                        Admin Sistem
                        <small>Pemilik Hotel</small>
                    </div>
                </a>
            </li>
        </ul>

        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="has-sub <?php
                        if ($uri->getSegment(2) == 'Admin') {
                            echo "active";
                        } ?>">
                <a href="<?= base_url('Admin/Dashboard'); ?>">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="has-sub <?php
                                if (
                                    $uri->getSegment(2) == 'Detail' || $uri->getSegment(2) == 'Kamar' ||
                                    $uri->getSegment(2) == 'Kategori' || $uri->getSegment(2) == 'Fasilitas' ||
                                    $uri->getSegment(2) == 'Foto' || $uri->getSegment(2) == 'DetailKamar' || $uri->getSegment(2) == 'Pengguna'
                                ) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                    <i class="material-icons">inbox</i>
                    <span>Master Data</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Kategori') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/Kategori'); ?>">Kategori Kamar</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Fasilitas') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/Fasilitas'); ?>">Fasilitas</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Kamar') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/Kamar'); ?>">Kamar</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Pengguna') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/Pengguna'); ?>">Pengguna</a></li>
                </ul>
            </li>
            <li class="has-sub <?php
                                if (
                                    $uri->getSegment(2) == 'Pemesanan' || $uri->getSegment(2) == 'KonfirmasiPemesanan'
                                ) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                    <i class="material-icons">assignment</i>
                    <span>Pemesanan</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Pemesanan') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/Pemesanan'); ?>">Pemesanan</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'KonfirmasiPemesanan') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/KonfirmasiPemesanan'); ?>">Konfirmasi Pemesanan</a></li>
                </ul>
            </li>
            <li class="has-sub <?php
                                if (
                                    $uri->getSegment(2) == 'Laporan' || $uri->getSegment(2) == 'LaporanPendapatan'
                                ) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                    <i class="material-icons">article</i>
                    <span>Laporan</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Laporan') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/Laporan'); ?>">Laporan Pemesanan</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'LaporanPendapatan') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/LaporanPendapatan'); ?>">Laporan Pendapatan</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<div class="sidebar-bg"></div>