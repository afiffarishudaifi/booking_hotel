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
    <link href="<?= base_url('docs/dashboard/assets/css/google/app.min.css') ?>" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin register -->
		<div class="register register-with-news-feed">
			<!-- begin news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url(../booking_hotel/docs/img/img_logo/login-bg.jpg)"></div>
				<div class="news-caption">
					<h4 class="caption-title"><b>Hotel Purbaya</b></h4>
					<p>
						Jalan Raya Magetan Sarangan No. 8, Ngerong
					</p>
				</div>
			</div>
			<!-- end news-feed -->
			<!-- begin right-content -->
			<div class="right-content">
				<!-- begin register-header -->
				<h1 class="register-header">
					Registrasi Customer
				</h1>
				<!-- end register-header -->
				<!-- begin register-content -->
				<div class="register-content">
	                <?php if (session()->getFlashdata('msg')) : ?>
	                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
	                <?php endif; ?>
					<form action="<?php echo base_url('Register/registrasi'); ?>" method="POST" data-parsley-validate="true" enctype="multipart/form-data" class="margin-bottom-0">

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="input_email" name="input_email"  data-parsley-required="true" placeholder="Masukkan Email" autofocus="on">
                            <span class="text-danger" id="error_email"></span>
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
				            <label>NIK</label>
				            <input type="text" class="form-control" id="input_nik" name="input_nik"
				                data-parsley-required="true" placeholder="Masukkan NIK" minlength="16" maxlength="16" >
				            <span class="text-danger" id="error_nik"></span>
				            <small id="emailHelp" class="form-text text-muted">Masukkan 16 karakter.</small>
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
						<div class="register-buttons">
							<button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
						</div>
						<div class="m-t-30 m-b-30 p-b-30">
                			Apakah anda sudah memiliki akun ? klik <a href="<?php echo base_url('Login'); ?>">Login</a>
						</div>
						<hr />
						<p class="text-center mb-0">
							&copy; Color Admin All Right Reserved 2020
						</p>
					</form>
				</div>
				<!-- end register-content -->
			</div>
			<!-- end right-content -->
		</div>
		<!-- end register -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
    <script src="<?= base_url('docs/dashboard/assets/js/app.min.js') ?>"></script>
    <script src="<?= base_url('docs/dashboard/assets/js/theme/google.min.js') ?>"></script>
	<!-- ================== END BASE JS ================== -->

	<script type="text/javascript">
        $(document).ready(function(){
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
