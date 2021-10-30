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
	<!-- <link href="<?= base_url() ?>/docs/dashboard/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" /> -->
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
		<?= $this->include("admin/template/header") ?>
        <!-- end #header -->

        <!-- begin #sidebar -->
        <?= $this->include("admin/template/sidebar") ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Dashboard <small>booking hotel</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-3 -->
				<div class="col-xl-3 col-md-6">
					<div class="widget widget-stats bg-blue">
						<div class="stats-icon"><i class="fa fa-users"></i></div>
						<div class="stats-info">
							<h4>TOTAL PENGGUNA</h4>
							<p><?= $total_pengguna; ?></p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-xl-3 col-md-6">
					<div class="widget widget-stats bg-info">
						<div class="stats-icon"><i class="fas fa-door-open"></i></div>
						<div class="stats-info">
							<h4>TOTAL KAMAR KOSONG</h4>
							<p><?= $total_kamar_kosong; ?></p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-xl-3 col-md-6">
					<div class="widget widget-stats bg-orange">
						<div class="stats-icon"><i class="fas fa-door-closed"></i></div>
						<div class="stats-info">
							<h4>TOTAL KAMAR TERISI</h4>
							<p><?= $total_kamar_terisi; ?></p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-xl-3 col-md-6">
					<div class="widget widget-stats bg-red">
						<div class="stats-icon"><i class="fas fa-hotel"></i></div>
						<div class="stats-info">
							<h4>PEMESANAN BULAN INI</h4>
							<p><?= $total_pemesanan_bulan_ini; ?></p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
			</div>
			<!-- end row -->
			<!-- begin row -->
			<div class="row">
				<!-- begin col-8 -->
				<div class="col-xl-12">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="index-1">
						<div class="panel-heading">
							<h4 class="panel-title">Website Analytics (Last 7 Days)</h4>
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="panel-body pr-1">
							<div id="interactive-chart" class="height-sm"></div>
						</div>
					</div>
					<!-- end panel -->
				</div>
				<!-- end col-8 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->

	 <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $.ajax({
                    url:"<?= base_url()?>/Admin/Dashboard/jumlah_pemesanan",
                    type:"POST",
                    dataType:"json",
                    data:{},
                    success:function(data){
                        $('#total_pemesanan').html(data.total_pemesanan);
                    }
                })
            }, 5000)
        })
    </script>
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?= base_url() ?>/docs/dashboard/assets/js/app.min.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/js/theme/google.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<!-- <script src="<?= base_url() ?>/docs/dashboard/assets/plugins/gritter/js/jquery.gritter.js"></script> -->
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