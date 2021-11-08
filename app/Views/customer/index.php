<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?= $judul; ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
    <link rel="icon" href="<?= base_url() ?>/docs/img/img_logo/logo.png">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link href="<?= base_url() ?>/docs/dashboard/assets/css/google/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="<?= base_url() ?>/docs/dashboard/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
	<link href="<?= base_url() ?>/docs/dashboard/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="<?= base_url() ?>/docs/dashboard/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar page-with-light-sidebar">
		<!-- begin #header -->
		<?= $this->include("customer/template/header") ?>
        <!-- end #header -->

        <!-- begin #sidebar -->
        <?= $this->include("customer/template/sidebar") ?>
		<!-- end #sidebar -->
		
		<div id="content" class="content">
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>

			<h1 class="page-header">Dashboard <small>booking hotel</small></h1>

			<div class="row">
				<!-- begin col-8 -->
				<div class="col-xl-12">
					<!-- begin panel -->
					<div class="panel panel-warning" data-sortable-id="index-1">
						<div class="panel-heading">
						</div>
						<div class="panel-body pr-1">
							<div class="row">
								<div class="col-md-12">
									<center>
										<h2>
											Selamat Datang di Aplikasi Hotel Purbaya
										</h2>
										<h2>
											<img src="<?= base_url() ?>/docs/img/img_logo/logo.png" style="">
										</h2>
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?= base_url() ?>/docs/dashboard/assets/js/app.min.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/js/theme/google.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.canvaswrapper.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.colorhelpers.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.saturated.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.browser.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.drawSeries.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.uiConstants.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.time.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.resize.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.pie.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.crosshair.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.categories.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.navigate.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.touchNavigate.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.hover.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.touch.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.selection.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.symbol.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/flot/source/jquery.flot.legend.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/js/demo/dashboard.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
</body>
</html>