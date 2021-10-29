<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | Booking Hotel</title>
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
        <div class="login-cover-image" style="background-image: url(../../docs/assets/img/login-bg.jpg)" data-id="login-cover-image"></div>
        <div class="login-cover-bg"></div>
    </div>
    <!-- end login-cover -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin login-header -->
            <div class="login-header" style="background-color: #000;">
                <div class="brand">
                    <b>LOGIN</b>
                    <!-- <small>admin panel</small> -->
                </div>
                <div class="icon">
                    <div class="widget-img rounded widget-img-lg" style="background-image: url(../../docs/assets/img/twh.png)">
                    </div>
                </div>
            </div>
            <!-- end login-header -->

            <!-- begin login-content -->
            <div class="login-content" style="background-color: #000">
                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                <?php endif; ?>
                <form action="<?php echo base_url('index.php/dashboard/login/login'); ?>" method="GET" class="margin-bottom-0">
                    <div class="form-group m-b-20">
                        <input type="text" name="email" class="form-control form-control-lg" placeholder="Email Address" required />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
                    </div>

                    <div class="login-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Masuk</button>
                    </div>
                </form>
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
    <script src="<?php echo base_url('docs/dashboard/assets/js/google.min.js') ?>"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?php echo base_url('docs/dashboard/assets/js/demo/login-v2.demo.js') ?>"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
</body>

</html>