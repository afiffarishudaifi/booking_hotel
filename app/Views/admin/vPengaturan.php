<!DOCTYPE html>
<html lang="en">

<?= $this->include("admin/template/head") ?>

<body>
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>

    <div id="page-container"
        class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar page-with-light-sidebar">
        <?= $this->include("admin/template/header") ?>

        <?= $this->include("admin/template/sidebar") ?>

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
                    <div class="panel panel-warning" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Form Pengaturan</h4>
                        </div>
                        <div class="panel-body">
                            <form action="<?= base_url('Admin/Pengaturan/update_pengguna'); ?>" method="post" id="form_edit" data-parsley-validate="true" enctype="multipart/form-data">
                       			<input type="hidden" class="id_pengguna" name="id_pengguna" id="id_pengguna" value="<?= $id_pengguna; ?>">

                                <div class="form-group row m-b-15">
                                    <label class="col-form-label col-md-3">Password</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_password" name="edit_password"  data-parsley-required="true" placeholder="Masukkan Password">
                                    </div>
                                </div>

                                <div class="form-group row m-b-15">
                                    <label class="col-form-label col-md-3">Nama Lengkap</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_nama" name="edit_nama"  data-parsley-required="true" placeholder="Masukkan Nama Lengkap">
                                    </div>
                                </div>

                                 <div class="form-group row m-b-15">
                                    <label class="col-form-label col-md-3">No Hp</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="edit_no_hp" name="edit_no_hp"  data-parsley-required="true" placeholder="Masukkan No Hp">
                                    </div>
                                </div>

                                 <div class="form-group row m-b-15">
                                    <label class="col-form-label col-md-3">Alamat</label>
                                    <div class="col-md-9">
                                        <textarea id="edit_alamat" class="form-control" rows="3" name="edit_alamat"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row m-b-15" style="padding-top: 10px;">
                                	<div class="col-md-12">
                                    <center>
                                    	<a href="<?= base_url('Admin/Dashboard'); ?>" class="btn btn-secondary">Batal</a>
                        				<button type="submit" name="update" class="btn btn-primary">Simpan</button>
                                    </center>
                                		
                                	</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.btn-delete').on('click', function() {
            const id = $(this).data('id');
            $('.id').val(id);
            $('#deleteModal').modal('show');
        });
    });
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
    <script src="<?= base_url() ?>/docs/dashboard/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script type="text/javascript">
        $(document).ready(function(){
        	var isi = $('#id_pengguna').val();
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

            $.getJSON('<?php echo base_url('Admin/Pengaturan/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#edit_password').val(json.password);
                    $('#edit_nama').val(json.nama_lengkap);
                    $('#edit_email').val(json.email);
                    $('#edit_no_hp').val(json.no_hp);
                    $('#edit_alamat').val(json.alamat);
                });
        })
    </script>
</body>

</html>
