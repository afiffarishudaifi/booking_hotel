<!DOCTYPE html>
<html lang="en">

<?= $this->include("customer/template/head") ?>

<body>
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>

    <div id="page-container"
        class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar page-with-light-sidebar">
        <!-- begin #header -->
        <?= $this->include("customer/template/header") ?>
        <!-- end #header -->

        <!-- begin #sidebar -->
        <?= $this->include("customer/template/sidebar"); date_default_timezone_set('Asia/Jakarta'); ?>
        <!-- end #sidebar -->

        <div id="content" class="content">
            <?php $session = session();
            if ($session->getFlashdata('sukses')) { ?>
            <input type="hidden" name="pemberitahuan" id="pemberitahuan"
                value="<?php echo $session->getFlashdata('sukses'); ?>">
            <?php } ?>

            <ol class="breadcrumb float-xl-right">
                <!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i>Tambah Data</button> -->
            </ol>

            <h1 class="page-header"><?= $page_header; ?>
            </h1>

            <div class="row">
                <div class="col-xl-12">
                    <div class="panel panel-warning">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title"><?= $panel_title; ?></h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table id="data-table-responsive" style="width: 100%" class="table table-striped table-bordered table-td-valign-middle">    
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th class="text-nowrap" style="text-align: center;">Pengunjung</th>
                                        <th class="text-nowrap" style="text-align: center;">Tanggal Pesan</th>
                                        <th class="text-nowrap" style="text-align: center;">Status Pesan</th>
                                        <th class="text-nowrap" style="text-align: center;">Rekening Tujuan</th>
                                        <th class="text-nowrap" style="text-align: center;">Tagihan</th>
                                        <th class="text-nowrap" style="text-align: center;">Bukti Pembayaran</th>
                                        <th class="text-nowrap" style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pemesanan as $item) {
                                    ?>
                                    <tr>
                                        <td width="1%"><?= $no++; ?></td>
                                        <td><?= $item['nama_lengkap']; ?></td>
                                        <td><?= $item['tanggal_pesan']; ?></td>
                                        <td><?= $item['status_pemesanan']; ?></td>
                                        <td> 
                                            BNI : 071748734 <br>
                                            Atas Nama : Hotel Purbaya
                                        </td>
                                        <td><?= $item['total_tagihan']; ?></td>
                                        <td>
                                            <center>
                                                <?php if($item['status_pemesanan'] != 'batal') { 
                                                    if($item['bukti_transaksi'] == 'n') { ?>
                                                    <a href="" data-toggle="modal" data-toggle="modal" data-target="#uploadModal" class="btn btn-bayar btn-warning btn-sm" onclick="Upload(<?= $item['id_pemesanan']; ?>)">Upload Bukti</a>
                                                <?php } else { ?>
                                                    <a href="" data-toggle="modal" data-toggle="modal" data-target="#form_edit_upload" class="btn btn-bayar btn-success btn-sm" onclick="detail_edit(<?= $item['id_pemesanan']; ?>)">Bukti Terupload</a>
                                                <?php } 
                                                } else { echo "-";} ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="<?= base_url('/Customer/DetailPemesanan/viewData/' . $item['id_pemesanan']) ?>" class="btn btn-edit btn-info btn-sm"><i
                                                        class="fa fa-eye"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>

        <!-- Modal Upload Class-->
        <form action="<?= base_url('Customer/Pemesanan/upload_pemesanan'); ?>" method="post" id="form_upload" data-parsley-validate="true" enctype="multipart/form-data">
            <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_pemesanan" id="id_pemesanan">

                            <div class="form-group">
                                <label>Bukti Pembayaran</label>
                                <input class="form_group" type="file" name="edit_foto" id="edit_foto">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" id="batal_up" data-dismiss="modal">Batal</button>
                            <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Upload Class-->

        <!-- Modal Upload Class-->
        <form action="<?= base_url('Customer/Pemesanan/upload_edit_pemesanan'); ?>" method="post" id="form_edit" data-parsley-validate="true" enctype="multipart/form-data">
            <div class="modal fade" id="form_edit_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_pemesanan" id="id_pemesanan">
                            <input type="hidden" name="foto_lama_transaksi" id="foto_lama_transaksi">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <center>
                                        <img id="foto_lama" style="width: 300px; height: 100%;" src="">
                                    </center>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" id="batal_up" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Upload Class-->

    </div>
    <!-- end page container -->
    </div>
    <!-- end page container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        function Upload(id){
            $('#id_pemesanan').val(id);
            $('#form_upload').modal('show');
        };
    </script>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?= base_url() ?>/docs/dashboard/assets/js/app.min.js"></script>
    <script src="<?= base_url() ?>/docs/dashboard/assets/js/theme/google.min.js"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?= base_url() ?>/docs/dashboard/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/docs/dashboard/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js">
    </script>
    <script src="<?= base_url() ?>/docs/dashboard/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script>
    <script
        src="<?= base_url() ?>/docs/dashboard/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
    </script>
    <script src="<?= base_url() ?>/docs/dashboard/assets/js/demo/table-manage-responsive.demo.js"></script>
    <script src="<?php echo base_url('/docs/dashboard/assets/plugins/select2/js/select2.full.min.js') ?>"></script>
    <script src="<?= base_url() ?>/docs/dashboard/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->


    <script type="text/javascript">
        $(function() {

            $('#batal').on('click', function() {
                $('#form_add')[0].reset();
                $('#form_edit')[0].reset();
                $("#input_tanggal").val();
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_tanggal").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_tanggal").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('customer/Pemesanan/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_pemesanan').val(json.id_pemesanan);
                    $('#foto_lama_transaksi').val(json.bukti_transaksi);
                    $("#foto_lama").attr("src", "<?= base_url('docs/img/img_transaksi') . '/' ?>" + json.bukti_transaksi);
                });
        }
    </script>
</body>

</html>
