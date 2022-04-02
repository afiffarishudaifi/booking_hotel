<!DOCTYPE html>
<html lang="en">

<?= $this->include("admin/template/head") ?>

<body>
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>

    <div id="page-container"
        class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar page-with-light-sidebar">
        <!-- begin #header -->
        <?= $this->include("admin/template/header") ?>
        <!-- end #header -->

        <!-- begin #sidebar -->
        <?= $this->include("admin/template/sidebar"); date_default_timezone_set('Asia/Jakarta'); ?>
        <!-- end #sidebar -->

        <div id="content" class="content">
            <?php $session = session();
            if ($session->getFlashdata('sukses')) { ?>
            <input type="hidden" name="pemberitahuan" id="pemberitahuan"
                value="<?php echo $session->getFlashdata('sukses'); ?>">
            <?php } ?>

            <ol class="breadcrumb float-xl-right">
                
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
                                        <th class="text-nowrap">Nama Pengunjung</th>
                                        <th class="text-nowrap">Tanggal Pemesanan</th>
                                        <th class="text-nowrap">Status Pemesanan</th>
                                        <th class="text-nowrap">Tagihan</th>
                                        <th class="text-nowrap">Bukti Pembayaran</th>
                                        <th class="text-nowrap">Aksi</th>
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
                                        <td><?= $item['total_tagihan']; ?></td>
                                        <td>
                                            <center>
                                            <a href="" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#pembayaranModal" data-whatever="<?= $item['bukti_transaksi']; ?>" name="btn-detail">
                                                Lihat
                                            </a>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_pemesanan']; ?>)" class="btn btn-edit btn-aqua btn-sm"><i
                                                        class="fa fa-check"></i></a>
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

        <!-- Modal Edit Class-->
        <form action="<?php echo base_url('Admin/KonfirmasiPemesanan/update_pemesanan'); ?>" method="post" id="form_edit" data-parsley-validate="true">
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Pemesanan </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_pemesanan" id="id_pemesanan">
                            <input type="hidden" name="edit_kamar_lama" id="edit_kamar_lama">

                            <div class="form-group">
                                <label>Nama Pengguna</label>
                                <input type="text" name="edit_pengguna" id="edit_pengguna" class="form-control" readonly="">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="text" class="form-control" id="edit_masuk" name="edit_masuk"  data-parsley-required="true" value="<?= date('Y-m-d G:i:s'); ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Keluar</label>
                                <input type="text" class="form-control" id="edit_keluar" name="edit_keluar"  data-parsley-required="true" value="<?= date('Y-m-d G:i:s'); ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label>Tagihan Biaya</label>
                                <input type="text" name="edit_hasil_total" value="0" id="edit_hasil_total" class="form-control"  readonly="">
                            </div>

                            <div class="form-group">
                                <label>Status Pemesanan</label>
                                <input type="text" name="edit_status" value="Pengajuan" id="edit_status" class="form-control"  readonly="">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" id="batal_up" data-dismiss="modal">Batal</button>
                            <button type="submit" name="update" class="btn btn-primary">Konfirmasi</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit Class-->

        <!-- Modal Pengantar-->
        <div class="modal fade example-modal-lg" aria-hidden="true" id="pembayaranModal" aria-labelledby="exampleOptionalLarge" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="exampleOptionalLarge"></h4>
                    </div>
                    <div class="modal-body">
                        <img id="bukti_show" src="" width="100%" height="100%">
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>
    <!-- end page container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        function Hapus(id, id_kamar){
            $('.id').val(id);
            $('.id_kamar').val(id_kamar);
            $('#deleteModal').modal('show');
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
    <?= $this->include("Admin/template/js") ?>
    <!-- ================== END PAGE LEVEL JS ================== -->


    <script type="text/javascript">
        $(document).ready(function(){
            var link_bukti = "<?= base_url('docs/img/img_transaksi') . '/' ?>";
            $('#pembayaranModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-body input').val(recipient)
                modal.find('#bukti_show').attr('src', link_bukti + recipient)
            })

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

    <script type="text/javascript">
        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/KonfirmasiPemesanan/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_pemesanan').val(json.id_pemesanan);
                    
                    $('#edit_pengguna').val(json.nama_lengkap);
                    $('#edit_hasil_total').val(json.total_tagihan);

                    $('#edit_tanggal').val(json.tanggal_pesan);
                    $('#edit_bukti').val(json.bukti_transaksi);
                });
        }
    </script>
</body>

</html>