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
                        <?= $session->get('username_login'); ?>
                        <small>Customer Hotel</small>
                    </div>
                </a>
            </li>
        </ul>

        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="has-sub <?php
                        if ($uri->getSegment(2) == 'Customer') {
                            echo "active";
                        } ?>">
                <a href="<?= base_url('Customer/Dashboard'); ?>">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="has-sub <?php
                        if ($uri->getSegment(2) == 'Customer') {
                            echo "active";
                        } ?>">
                <a href="<?= base_url('Customer/Pemesanan'); ?>">
                    <i class="material-icons">assignment</i>
                    <span>Pemesanan</span>
                </a>
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
                                } ?>"><a href="<?= base_url('Customer/Laporan'); ?>">Laporan Pemesanan</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<div class="sidebar-bg"></div>