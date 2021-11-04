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
                        <img src="../assets/img/user/user-13.jpg" alt="" />
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
                                    $uri->getSegment(2) == 'DetailController' || $uri->getSegment(2) == 'KamarController' ||
                                    $uri->getSegment(2) == 'KategoriController' || $uri->getSegment(2) == 'FasilitasController' ||
                                    $uri->getSegment(2) == 'FotoController' || $uri->getSegment(2) == 'DetailKamarController' || $uri->getSegment(2) == 'PenggunaController'
                                ) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                    <i class="material-icons">inbox</i>
                    <span>Master Data</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php
                                if ($uri->getSegment(2) == 'KategoriController') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/KategoriController'); ?>">Kategori Kamar</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'FasilitasController') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/FasilitasController'); ?>">Fasilitas</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'KamarController') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/KamarController'); ?>">Kamar</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'PenggunaController') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/PenggunaController'); ?>">Pengguna</a></li>
                </ul>
            </li>
            <li class="has-sub <?php
                                if (
                                    $uri->getSegment(2) == 'PemesananController' || $uri->getSegment(2) == 'KonfirmasiPemesananController'
                                ) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                    <i class="material-icons">assignment</i>
                    <span>Pemesanan</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php
                                if ($uri->getSegment(2) == 'PemesananController') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/PemesananController'); ?>">Pemesanan</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'KonfirmasiPemesananController') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/KonfirmasiPemesananController'); ?>">Konfirmasi Pemesanan</a></li>
                </ul>
            </li>
            <li class="has-sub <?php
                                if (
                                    $uri->getSegment(2) == 'LaporanController' || $uri->getSegment(2) == 'KonfirmasiPemesananController'
                                ) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                    <i class="material-icons">article</i>
                    <span>Pemesanan</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php
                                if ($uri->getSegment(2) == 'LaporanController') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/LaporanController'); ?>">Laporan Pemesanan</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'LaporanPendapatanController') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('Admin/LaporanPendapatanController'); ?>">Laporan Pendapatan</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<div class="sidebar-bg"></div>