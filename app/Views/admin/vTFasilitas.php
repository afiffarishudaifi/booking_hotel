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
                    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i>Tambah Data</button>
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
                                        <th width="1%">No </th>
                                        <th class="text-nowrap" style="text-align: center;">Nama Kategori</th>
                                        <th class="text-nowrap" style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($fasilitas as $item) {
                                    ?>
                                    <tr>
                                        <td width="1%"><?= $no++; ?></td>
                                        <td><?= $item['nama_fasilitas']; ?></td>
                                        <td>
                                            <center>
                                                <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id']; ?>)" class="btn btn-sm btn-edit btn-warning"><i
                                                        class="fa fa-pen"></i></a>
                                                <a href="" class="btn btn-sm btn-delete btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal" data-id="<?= $item['id']; ?>"><i
                                                        class="fa fa-trash"></i></a>
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

        <form action="<?php echo base_url('Admin/Fasilitas/delete_fasilitas'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus Fasilitas ini?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" class="id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    </div>

    <!-- Modal Add Class-->
    <form action="<?php echo base_url('Admin/Fasilitas/add_fasilitas'); ?>" method="post" id="form_add" data-parsley-validate="true">
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?= csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Fasilitas </h5>
                        <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Fasilitas</label>
                            <input type="text" class="form-control" id="input_fasilitas" name="input_fasilitas"  data-parsley-required="true" placeholder="Masukkan Fasilitas">
                            <span class="text-danger" id="error_fasilitas"></span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" id="batal_add" data-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Add Class-->

    <!-- Modal Edit Class-->
    <form action="<?php echo base_url('Admin/Fasilitas/update_fasilitas'); ?>" method="post" id="form_edit" data-parsley-validate="true">
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?= csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Fasilitas </h5>
                        <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="id_fasilitas" name="id_fasilitas" id="id_fasilitas">

                        <div class="form-group">
                            <label>Fasilitas</label>
                            <input type="text" class="form-control" id="edit_fasilitas" name="edit_fasilitas" data-parsley-required="true" placeholder="Fasilitas">
                            <span class="text-danger" id="error_edit_fasilitas"></span>
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
    <!-- End Modal Edit Class-->

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
    <!-- ================== END PAGE LEVEL JS ================== -->

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

    <script type="text/javascript">
        $(function() {
            
            $("#input_fasilitas").keyup(function(){

                var nama = $(this).val().trim();
          
                if(nama != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Fasilitas/cek_nama'); ?>' + '/' + nama,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_fasilitas").html('Fasilitas telah dipakai,coba yang lain');
                                $("#input_fasilitas").val(nama);
                            }else{
                                $("#error_fasilitas").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
          
              });
            $("#edit_fasilitas").keyup(function(){

                var nama = $(this).val().trim();
          
                if(nama != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Fasilitas/cek_nama'); ?>' + '/' + nama,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_edit_fasilitas").html('Fasilitas telah dipakai,coba yang lain');
                                $("#edit_fasilitas").val(nama);
                            }else{
                                $("#error_edit_fasilitas").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
          
            });
            $('#batal').on('click', function() {
                $('#form_add')[0].reset();
                $('#form_edit')[0].reset();
                $("#input_fasilitas").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_fasilitas").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_fasilitas").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/Fasilitas/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_fasilitas').val(json.id);
                    $('#edit_fasilitas').val(json.nama_fasilitas);
                });
        }
    </script>
</body>

</html>