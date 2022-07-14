<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan</title>
    <link rel="shortcut icon" href="<?= base_url() ?>/docs/themeforest/base/assets/images/favicon.ico">
	<style type="text/css">
		table {
			font-family: "Times New Roman", serif;
			border-style: double;
			border-width: 3px;
			border-color: white;
		}
		table tr .text2 {
			text-align: right;
			font-size: 13px;
		}
		table tr .text {
			text-align: center;
			font-size: 13px;
		}
		table tr td {
			font-size: 13px;
		}

	</style>
</head>
<body>
	<center>
		<table width="625">
			<tr>
				<td><img src="<?= base_url() ?>/docs/img/logo.jpg" width="90" height="90"></td>
				<td>
				<center>
					<font size="4"><b>HOTEL PURBAYA</b></font><br>
					<font size="2"><i>JL Ngerong No 08, Plaosan, Sarangan I, Sarangan, Kec. Plaosan, Kab. Magetan, Jawa Timur</i></font><br>
					<font size="2"><i>Email : hotelpurbaya@gmail.com</i></font><br>
					<font size="3">MAGETAN (63361)</font>
				</center>
				</td>
			</tr>
			<tr>
				<td colspan="2"><b><hr></b></td>
			</tr>
		</table>
		<center>
			<h3>
				<?= $judul; ?>
			</h3>
		</center>
		<table width="625" border="1">
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Nama Kategori</th>
                <th style="text-align: center;">Tanggal Pemesanan</th>
                <th style="text-align: center;">Nama Pemesan</th>
                <th style="text-align: center;">Status Pemesanan</th>
            </tr>
        	<?php
            $no = 1;
            foreach ($laporan as $item) {
            ?>
            <tr>
                <td width="1%" style="text-align: center;"><?= $no++; ?></td>
                <td style="text-align: center;"><?= $item['nama_kategori']; ?></td>
                <td style="text-align: center;"><?= $item['tanggal_pesan']; ?></td>
                <td style="text-align: center;"><?= $item['nama_lengkap']; ?></td>
                <td style="text-align: center;"><?= $item['status_pemesanan']; ?></td>
            </tr>
            <?php } ?>
		</table>
	</center>
</body>
	<script>
		window.print();
	</script>
</html>
