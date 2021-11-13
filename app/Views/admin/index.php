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
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url() ?>/docs/dashboard/assets/plugins/daterangepicker/daterangepicker.css">
    <link href="<?= base_url() ?>/docs/dashboard/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/docs/dashboard/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<!-- daterange picker -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


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
							<a href="<?= base_url('Admin/Pengguna'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
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
							<a href="<?= base_url('Admin/Kamar'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-xl-3 col-md-6">
					<div class="widget widget-stats bg-green">
						<div class="stats-icon"><i class="fas fa-door-closed"></i></div>
						<div class="stats-info">
							<h4>TOTAL KAMAR TERISI</h4>
							<p><?= $total_kamar_terisi; ?></p>	
						</div>
						<div class="stats-link">
							<a href="<?= base_url('Admin/Kamar'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
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
							<a href="<?= base_url('Admin/Laporan'); ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
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
					<div class="panel panel-warning" data-sortable-id="index-1">
						<div class="panel-heading">
							<h4 class="panel-title">Data Pemesanan Harian <?= $range; ?></h4>
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="panel-body pr-1">
	                        <form action="<?php echo base_url('Admin/dashboard') ?>" method="POST" id="filter_form">
	                            <?= csrf_field(); ?>
	                            <div class="form-row">
	                                <div class="d-sm-flex align-items-center mb-5">
	                                	<a href="#" class="btn btn-primary mr-2 text-truncate" id="daterange">
											<i class="fa fa-calendar fa-fw ml-n1"></i>
											<input type="text" class="btn btn-primary text-truncate" name="daterange" value="<?= $range; ?>" / readonly>
											<b class="caret"></b>
										</a>
	                                </div>
	                            </div>
	                        </form>
	                    </div>
	                    <?php
	                    foreach ($pemesanan as $data) {
	                        $tanggal[] = $data['tanggal_pesan'];
	                        $jml[] = $data['id'];

	                        // echo json_encode($tanggal);
	                    }
	                    ?>
					</div>
                    
                    <div class="col-xl-12">
                        <!-- begin panel -->
                        <div>
                            <canvas id="line-chart" data-render="chart-js"></canvas>
                        </div>
                        <!-- end panel -->
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

    <script>
    	var COLOR_BLUE_TRANSPARENT_3 = '#d7ecfb'
    	var COLOR_BLUE = '#67b8f0'
        Chart.defaults.global.defaultFontColor = '#000';
        Chart.defaults.global.defaultFontFamily = 'Helvetica Neue';
        Chart.defaults.global.defaultFontStyle = 12;
        var lineChartData = {
            labels: <?php echo json_encode($tanggal); ?>,
            datasets: [{
                label: 'Pengunjung',
                borderColor: COLOR_BLUE,
                pointBackgroundColor: COLOR_BLUE,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: COLOR_BLUE_TRANSPARENT_3,
                data: <?php echo json_encode($jml); ?>
            }]
        };
        var handleChartJs = function() {
            var ctx = document.getElementById('line-chart').getContext('2d');
            var lineChart = new Chart(ctx, {
                type: 'line',
                data: lineChartData
            });
        };
        var ChartJs = function() {
            "use strict";
            return {
                //main function
                init: function() {
                    handleChartJs();
                }
            };
        }();

        $(document).ready(function() {
            ChartJs.init();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            var isi = $('#isi_tanggal').val();
            $('#tanggal').val(isi);

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
        });

        $('.applyBtn').on('click', function() {
            var isi = $('#isi_tanggal').val();
            $('#tanggal').val(isi);
        });
        $(function() {
            $('#daterange').daterangepicker({
                autoUpdateInput: true,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('#daterange').on('apply.daterangepicker', function(ev, picker) {
                $('input[name="daterange"]').val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                filter_form.submit();

            });

            $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
                $('input[name="daterange"]').val('');
                filter_form.submit();
            });

        });
    </script>
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?= base_url() ?>/docs/dashboard/assets/js/app.min.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/js/theme/google.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?= base_url() ?>/docs/dashboard/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/js/demo/dashboard.js"></script>

    <script src="<?= base_url(); ?>/docs/dashboard/assets/plugins/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>/docs/dashboard/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?= base_url(); ?>/docs/dashboard/assets/js/demo/dashboard-v3.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
</body>
</html>