<html>
    <head>
        <title>Bukti Pembayaran</title>
        <style>
            #tabel
            {
                font-size:15px;
                border-collapse:collapse;
            }
            #tabel  td
            {
                padding-left:5px;
                border: 1px solid black;
            }
        </style> 
    </head>
    <body style='font-family:tahoma; font-size:8pt;'>
        <center>            
            <table width="100%" style="font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'">
                <tr>
                    <td>
                        <font size="4"><b>HOTEL PURBAYA</b></font><br>
                        <font size="2"><i>Jalan Raya Magetan Sarangan No. 8, Ngerong, <br>Dadi, Kec. Plaosan, Kabupaten Magetan, Jawa Timur 63361</i></font><br>
                        <font size="2"><i>Telp : (0351) 888097</i></font><br>
                    </td>
                    <td>
                        <font size="4"><b>FAKTUR PEMESANAN</b></font><br>
                        <font size="2"><i>No Trans. : PBY<?= date("dmY") ?> <br> Tanggal : <?= date("d-M-Y") ?></i></font><br>
                        <font size="2" color="white"><i>Tanggal : <?= date("d-M-Y") ?></i></font><br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b><hr></b></td>
                </tr>
            </table>
            <table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse; padding-bottom:20px;' border = '0'>
                <tr>
                    <td style='text-align:left; width:100%; font-size: 13px;'>
                        <b>Data Pemesan</b>
                    </td>
                </tr>
                <tr>
                    <td style='text-align:left; width:100%; font-size: 10px;'>
                        Nama    : <?= $pengunjung['nama_lengkap'] ?></br>
                    </td>
                </tr>
                <tr>
                    <td style='text-align:left; width:100%; font-size: 10px;'>
                        Alamat  : <?= $pengunjung['alamat'] ?> </br>
                    </td>
                </tr>
                <tr>
                    <td style='text-align:left; width:100%; font-size: 10px;'>
                        No Telp : <?= $pengunjung['no_hp'] ?>
                    </td>
                </tr>
            </table>
            <table cellspacing='0' style='width:100%; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
                <tr align='center'>
                    <th width='20%'>Nama Kamar</th>
                    <th width='13%'>Tanggal Masuk</th>
                    <th width='13%'>Taggal Keluar</th>
                    <th width='13%'>Total Harga</th>
                </tr>
                <?php foreach($pemesanan as $item) { ?>
                    <tr align='center'>
                        <td width='20%'><?= $item['nama_kamar'] ?></td>
                        <td width='13%'><?= $item['tanggal_masuk'] ?></td>
                        <td width='13%'><?= $item['tanggal_keluar'] ?></td>
                        <td width='13%'><?= $item['total_biaya'] ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan = '3'><div style='text-align:right'>Total Pembayaran : </div></td>
                    <td style='text-align:center'>Rp <?= $total_pembayaran ?></td>
                </tr>
            </table>
                
            <table style='width:100%; font-size:7pt;' cellspacing='1'>
                <tr>
                    <td style='border:1px solid black; padding:5px; text-align:CENTER; width:30%; font-size: 23px;'>
                        <b>LUNAS</b>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>
