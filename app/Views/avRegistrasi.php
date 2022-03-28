<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Registrasi | Booking Hotel</title>
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
        <div class="login-cover-image" style="background-image: url(../booking_hotel/docs/img/img_logo/login-bg.jpg)" data-id="login-cover-image"></div>
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
                            <div class="widget-img rounded widget-img-lg" style="background-image: url(../booking_hotel/docs/img/img_logo/logo.png); height: 80px; width: 80px;">
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
                            <h4><b>Registrasi Customer</b></h4>
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
                <form action="<?php echo base_url('Register/registrasi'); ?>" method="POST" data-parsley-validate="true" enctype="multipart/form-data" style="padding-bottom: 10px;">

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="input_username" name="input_username"  data-parsley-required="true" placeholder="Masukkan Username">
                            <span class="text-danger" id="error_username"></span>
                        </div> 

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="input_password" name="input_password"  data-parsley-required="true" placeholder="Masukkan Password">
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" id="input_nama" name="input_nama"  data-parsley-required="true" placeholder="Masukkan Nama Lengkap">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="input_email" name="input_email"  data-parsley-required="true" placeholder="Masukkan Email">
                            <span class="text-danger" id="error_email"></span>
                        </div>

                         <div class="form-group">
                            <label>No Hp</label>
                            <input type="text" class="form-control" id="input_no_hp" name="input_no_hp"  data-parsley-required="true" placeholder="Masukkan No Hp">
                        </div>

                         <div class="form-group">
                            <label>Alamat</label>
                            <textarea id="input_alamat" class="form-control" name="input_alamat"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Foto Pengguna</label>
                            <br>
                            <input type="file" id="input_file" name="input_file"
                                data-parsley-required="true"/>
                        </div>

                    <div class="login-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Masuk</button>
                    </div>
                </form>
                Apakah anda sudah memiliki akun ? klik <a href="<?php echo base_url('Login'); ?>">Login</a>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $("#input_username").keyup(function(){

                var input_username = $(this).val().trim();
          
                if(input_username != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Register/cek_username'); ?>' + '/' + input_username,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_username").html('Username telah dipakai,coba yang lain');
                                $("#input_username").val(input_username);
                            }else{
                                $("#error_username").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
            });

            $("#input_email").keyup(function(){

                var input_email = $(this).val().trim();
          
                if(input_email != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Register/cek_email'); ?>' + '/' + input_email,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_email").html('Email telah dipakai,coba yang lain');
                                $("#input_email").val(input_email);
                            }else{
                                $("#error_email").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
            });
        })
    </script>
</body>

</html>
