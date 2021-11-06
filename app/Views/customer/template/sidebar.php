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
                        <img src="http://localhost:8080/booking_hotel/<?= $session->get('foto'); ?>" alt="" />
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
        </ul>
    </div>
</div>

<div class="sidebar-bg"></div>