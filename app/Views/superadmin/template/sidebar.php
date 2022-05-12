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
                        if ($uri->getSegment(2) == 'SuperAdmin') {
                            echo "active";
                        } ?>">
                <a href="<?= base_url('SuperAdmin/Dashboard'); ?>">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="has-sub <?php
                                if (
                                    $uri->getSegment(2) == 'Kamar' || $uri->getSegment(2) == 'Admin' ||
                                    $uri->getSegment(2) == 'Kategori' || $uri->getSegment(2) == 'Fasilitas' ||
                                    $uri->getSegment(2) == 'Foto' || $uri->getSegment(2) == 'DetailKamar' || $uri->getSegment(2) == 'Pengunjung'
                                ) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="material-icons">inbox</i>
                        <span>Data Master</span>
                    </a>
                <ul class="sub-menu">
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Admin') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('SuperAdmin/Admin'); ?>">
                                <i class="fa fa-user"></i> &nbsp;Admin</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Kategori') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('SuperAdmin/Kategori'); ?>">
                                <i class="fa fa-server"></i> &nbsp;Kategori Kamar</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Fasilitas') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('SuperAdmin/Fasilitas'); ?>">
                                <i class="fa fa-plus"></i> &nbsp;Fasilitas</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Kamar') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('SuperAdmin/Kamar'); ?>">
                                <i class="fa fa-bed"></i> &nbsp;Kamar</a></li>
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Pengunjung') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('SuperAdmin/Pengunjung'); ?>">
                                <i class="fa fa-users"></i> &nbsp;Pengunjung</a></li>
                </ul>
            </li>
            <li class="has-sub <?php
                                if (
                                    $uri->getSegment(2) == 'Laporan' || $uri->getSegment(2) == 'LaporanPendapatan'
                                ) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="material-icons">article</i>
                    <span>Laporan</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php
                                if ($uri->getSegment(2) == 'Laporan') {
                                    echo "active";
                                } ?>"><a href="<?= base_url('SuperAdmin/Laporan'); ?>">
                                <i class="fa fa-book"></i> &nbsp;Laporan Pemesanan</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<div class="sidebar-bg"></div>
