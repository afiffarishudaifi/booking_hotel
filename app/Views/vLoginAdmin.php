<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | Booking Hotel</title>
    <link rel="icon" href="<?= base_url() ?>/docs/img/img_logo/logo.png">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="<?php echo base_url('docs/dashboard/assets/css/google/app.min.css') ?>" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
</head>

<body class="pace-top">

    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>
    <!-- end #page-loader -->

    <!-- begin login-cover -->
    <div class="login-cover">
        <div class="login-cover-image" style="background-image: url(../../booking_hotel/docs/img/img_logo/login-bg.jpg)" data-id="login-cover-image"></div>
        <div class="login-cover-bg"></div>
    </div>
    <!-- end login-cover -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-v2 rounded" data-pageload-addclass="animated fadeIn">
            <!-- begin login-header -->
            <div class="login-header" style="background-color: #190a01;">
                <div class="row" style="padding-top: 20px;">
                    <div class="col-md-3">
                        <center>
                            <div class="widget-img rounded widget-img-lg" style="background-image: url(../../booking_hotel/docs/img/img_logo/logo.png); height: 80px; width: 80px;">
                            </div>
                        </center>
                    </div>
                    <div class="col-md-9">
                        <center>
                            <h5>Hotel Purbaya</h5>
                            <p>Jalan Raya Magetan Sarangan No. 8, Ngerong</p>
                        </center>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <center>
                            <h4><b>Login Authentication</b></h4>
                        </center>
                    </div>
                </div>
            </div>
            <!-- end login-header -->

            <!-- begin login-content -->
            <div class="login-content" style="background-color: #190a01">
                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                <?php endif; ?>
                <form action="<?php echo base_url('Login/login'); ?>" method="POST" class="margin-bottom-0" style="padding-bottom: 10px;">
                    <div class="form-group m-b-20">
                        <input type="text" name="username" class="form-control form-control-lg" placeholder="Email Address" required />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
                    </div>

                    <div class="login-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Masuk</button>
                    </div>
                </form>
                Apakah anda belum memiliki akun ? klik <a href="<?php echo base_url('Register'); ?>">Daftar</a>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?php echo base_url('docs/dashboard/assets/js/app.min.js') ?>"></script>
    <script src="<?php echo base_url('docs/dashboard/assets/js/theme/google.min.js') ?>"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?php echo base_url('docs/dashboard/assets/js/demo/login-v2.demo.js') ?>"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
</body>

</html>