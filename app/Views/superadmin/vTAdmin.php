<!DOCTYPE html>
<html lang="en">

<?= $this->include("superadmin/template/head") ?>

<body>
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>

    <div id="page-container"
        class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar page-with-light-sidebar">
        <?= $this->include("superadmin/template/header") ?>

        <?= $this->include("superadmin/template/sidebar") ?>

        <div id="content" class="content">
            <ol class="breadcrumb float-xl-right">
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i>Tambah Data</button>
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
                                        <th class="text-nowrap" style="text-align: center;">Nama Lengkap</th>
                                        <th class="text-nowrap" style="text-align: center;">Alamat</th>
                                        <th class="text-nowrap" style="text-align: center;">Email</th>
                                        <th class="text-nowrap" style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($admin as $item) {
                                    ?>
                                    <tr>
                                        <td width="1%"><?= $no++; ?></td>
                                        <td><?= $item['nama_lengkap']; ?></td>
                                        <td><?= $item['alamat']; ?></td>
                                        <td><?= $item['email']; ?></td>
                                        <td>
                                            <center>
                                                <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_admin']; ?>)" class="btn btn-sm btn-edit btn-warning"><i
                                                        class="fa fa-pen"></i></a>
                                                <a href="" class="btn btn-sm btn-delete btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal" data-id="<?= $item['id_admin']; ?>"><i
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

        <form action="<?php echo base_url('SuperAdmin/Admin/delete_admin'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus Admin ini?</h4>

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
    <form action="<?php echo base_url('SuperAdmin/Admin/add_admin'); ?>" method="post" id="form_add" data-parsley-validate="true" enctype="multipart/form-data">
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?= csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengguna </h5>
                        <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="input_password" name="input_password"  data-parsley-required="true" placeholder="Masukkan Password">
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" id="input_nama" name="input_nama"  data-parsley-required="true" placeholder="Masukkan Nama Lengkap">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="input_email" name="input_email"  data-parsley-required="true" placeholder="Masukkan Email">
                            <span class="text-danger" id="error_email"></span>
                        </div>

                         <div class="form-group">
                            <label>No Hp</label>
                            <input type="text" class="form-control" id="input_no_hp" name="input_no_hp"  data-parsley-required="true" placeholder="Masukkan No Hp">
                        </div>

                         <div class="form-group">
                            <label>Alamat</label>
                            <textarea id="input_alamat" class="form-control" name="input_alamat"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Foto Pengguna</label>
                            <br>
                            <input type="file" id="input_file" name="input_file"
                                data-parsley-required="true"/>
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
    <form action="<?php echo base_url('SuperAdmin/Admin/update_admin'); ?>" method="post" id="form_edit" data-parsley-validate="true" enctype="multipart/form-data">
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?= csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pengguna </h5>
                        <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="id_admin" name="id_admin" id="id_admin">

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="edit_password" name="edit_password"  data-parsley-required="true" placeholder="Masukkan Password">
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" id="edit_nama" name="edit_nama"  data-parsley-required="true" placeholder="Masukkan Nama Lengkap">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="edit_email" name="edit_email"  data-parsley-required="true" placeholder="Masukkan Email">
                        </div>

                         <div class="form-group">
                            <label>No Hp</label>
                            <input type="text" class="form-control" id="edit_no_hp" name="edit_no_hp"  data-parsley-required="true" placeholder="Masukkan No Hp">
                        </div>

                         <div class="form-group">
                            <label>Alamat</label>
                            <textarea id="edit_alamat" class="form-control" name="edit_alamat"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <center>
                                    <img id="foto_lama" style="width: 120px; height: 160px;" src="">
                                </center>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Foto Pengguna</label>
                            <br>
                            <input type="file" id="edit_file" name="edit_file"
                                data-parsley-required="true"/>
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
    <script src="<?= base_url() ?>/docs/dashboard/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
    <?= $this->include("superadmin/template/js") ?>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script type="text/javascript">
        $(function() {

            $("#input_email").keyup(function(){

                var input_email = $(this).val().trim();
          
                if(input_email != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('SuperAdmin/Admin/cek_email'); ?>' + '/' + input_email,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_email").html('Email telah dipakai,coba yang lain');
                                $("#input_email").val(input_email);
                            }else{
                                $("#error_email").html('');
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
                $("#input_password").val('');
                $("#input_email").val('');
                $("#input_no_hp").val('');
                $("#input_nama").val('');
                $("#input_alamat").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_password").val('');
                $("#input_email").val('');
                $("#input_no_hp").val('');
                $("#input_nama").val('');
                $("#input_alamat").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_password").val('');
                $("#edit_email").val('');
                $("#edit_no_hp").val('');
                $("#edit_nama").val('');
                $("#edit_alamat").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('SuperAdmin/Admin/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_admin').val(json.id_admin);
                    $('#edit_password').val(json.password);
                    $('#edit_nama').val(json.nama_lengkap);
                    $('#edit_email').val(json.email);
                    $('#edit_no_hp').val(json.no_hp);
                    $('#edit_alamat').val(json.alamat);

                    if (json.file != '' || json.file != null) {
                        $("#foto_lama").attr("src", "http://localhost:8080/booking_hotel/" + json.file) ;
                    } else {
                        $("#foto_lama").attr("src", "http://localhost:8080/booking_hotel/docs/img/img_pengguna/noimage.jpg");
                    }
                });
        }
    </script>
</body>

</html>
