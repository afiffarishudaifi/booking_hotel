<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Hotel Purbaya</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="<?= base_url() ?>/docs/dashboard/assets/css/google/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar page-with-light-sidebar">
		<?= $this->include("Customer/template/header") ?>
        <!-- end #header -->

        <!-- begin #sidebar -->
        <?= $this->include("Customer/template/sidebar"); date_default_timezone_set('Asia/Jakarta'); ?>
        <!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb hidden-print float-xl-right">
				<li class="breadcrumb-item"><a href="<?= base_url('/Customer/Dashboard') ?>">Dashboard</a></li>
				<li class="breadcrumb-item active">Item Pemesanan</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header hidden-print">Item Pemesanan</h1>
			<!-- end page-header -->
			<!-- begin invoice -->
			<div class="invoice">
				<!-- begin invoice-company -->
				<div class="invoice-company">
					<span class="pull-right hidden-print">
						<a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
					</span>
					Hotel Purbaya
				</div>
				<!-- end invoice-company -->
				<!-- begin invoice-header -->
				<div class="invoice-header">
					<div class="invoice-from">
						<small>Pemesan</small>
						<address class="m-t-5 m-b-5">
							<strong class="text-inverse"><?= $session->get('username_login'); ?></strong><br />
							Alamat<br />
							<?= $pengunjung['alamat'] ?><br />
							Phone: <?= $pengunjung['no_hp'] ?><br />
						</address>
					</div>
					<div class="invoice-to">
						<small>Pihak</small>
						<address class="m-t-5 m-b-5">
							<strong class="text-inverse">Hotel Purbaya</strong><br />
							Alamat<br />
							Jalan Raya Magetan Sarangan No. 8, Ngerong<br />
							Phone: (123) 456-7890<br />
						</address>
					</div>
					<div class="invoice-date">
						<small>Pemesanan / <?= date("M") ?> period</small>
						<div class="date text-inverse m-t-5"><?= date("d - M - Y") ?></div>
						<div class="invoice-detail">
							#<?= date("dmYHis") ?><br />
						</div>
					</div>
				</div>
				<!-- end invoice-header -->
				<!-- begin invoice-content -->
				<div class="invoice-content">
					<!-- begin table-responsive -->
					<div class="table-responsive">
						<table class="table table-invoice">
							<thead>
								<tr>
									<th width="5%">NO</th>
									<th class="text-center">ITEM</th>
									<th class="text-center" width="20%">CHECK IN</th>
									<th class="text-center" width="20%">CHECK OUT</th>
									<th class="text-center" width="10%">BIAYA</th>
									<th class="text-center" width="5%">AKSI</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                    $no = 1;
                                    $sum = 0;
                                    foreach ($pemesanan as $item) {
                                    $sum = $sum + $item['total_biaya'];
                                    ?>
                                    <tr>
                                        <td width="1%"><?= $no++; ?></td>
                                        <td><center><?= $item['nama_kamar']; ?></center></td>
                                        <td><center><?= $item['tanggal_masuk']; ?></center></td>
                                        <td><center><?= $item['tanggal_keluar']; ?></center></td>
                                        <td><center><?= $item['total_biaya']; ?></center></td>
                                        <td>
                                                <a href="" type="button" onclick="Hapus(<?= $item['id_keranjang']; ?>,<?= $item['id_kamar']; ?>)" class="btn btn-danger btn-sm" id="btn-delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
							</tbody>
						</table>
					</div>
					<!-- end table-responsive -->
					<!-- begin invoice-price -->
					<div class="invoice-price">
						<div class="invoice-price-left">
							<div class="invoice-price-row">
								<div class="sub-price">
									<!-- <h4>SUBTOTAL</h4> -->
									<!-- <span class="text-inverse">$4,500.00</span> -->
								</div>
								<div class="sub-price">
									<center>
										<h3>Total yang harus dibayarkan</h3>
									</center>
									<!-- <i class="fa fa-plus text-muted"></i> -->
								</div>
								<div class="sub-price">
									<!-- <small>PAYPAL FEE (5.4%)</small> -->
									<!-- <span class="text-inverse">$108.00</span> -->
								</div>
							</div>
						</div>
						<div class="invoice-price-right">
							<small>TOTAL</small> <span class="f-w-600">Rp. <?= $sum ?></span>
						</div>
					</div>
					<!-- end invoice-price -->
				</div>
				<!-- end invoice-content -->
				<!-- begin invoice-note -->
				<div class="invoice-note">
					<b>
						* Pembayaran bisa dilakukan secara transfer atau langsung di Hotel Purbaya<br />
						* Pembayaran melalui transfer harus dibayar dalam waktu 1x24 Jam<br />
						* Bukti pembayaran melalui transfer harus di upload di menu Pemesanan<br />
						* Apabila ingin melakukan pembatalan, bisa menghubungi pihak hotel
					</b>
				</div>
				<!-- end invoice-note -->
				<!-- begin invoice-footer -->
				<div class="invoice-footer">
					<p class="text-center m-b-5 f-w-600">
						TERIMA KASIH ATAS PEMESANAN ANDA
					</p>
					<p class="text-center">
						<span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> bookinghotel.com</span>
						<span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:016-18192302</span>
						<span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> bookinghotel@gmail.com</span>
					</p>
				</div>
				<!-- end invoice-footer -->
			</div>
			<!-- end invoice -->
		</div>
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->

		<form action="<?= base_url('Customer/DetailPemesanan/delete_pemesanan'); ?>" method="post">
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>Apakah Ingin menghapus item pemesanan ini?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" class="id">
                            <input type="hidden" name="id_kamar" class="id_kamar">
                            <input type="hidden" name="id_pemesanan" value="<?= $id_pemesanan ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script>
        function Hapus(id, id_kamar){
            $('.id').val(id);
            $('.id_kamar').val(id_kamar);
            $('#deleteModal').modal('show');
        };
    </script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/js/app.min.js"></script>
	<script src="<?= base_url() ?>/docs/dashboard/assets/js/theme/google.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</body>
</html>
