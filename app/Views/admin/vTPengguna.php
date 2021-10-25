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
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title"><?= $panel_title; ?></h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                    data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                    data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                    data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                                    data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table id="data-table-responsive" style="width: 100%" class="table table-striped table-bordered table-td-valign-middle">
                                <thead>
                                    <tr>
                                        <th width="1%">No </th>
                                        <th class="text-nowrap" style="text-align: center;">Username</th>
                                        <th class="text-nowrap" style="text-align: center;">Nama Lengkap</th>
                                        <th class="text-nowrap" style="text-align: center;">Alamat</th>
                                        <th class="text-nowrap" style="text-align: center;">Email</th>
                                        <th class="text-nowrap" style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pengguna as $item) {
                                    ?>
                                    <tr>
                                        <td width="1%"><?= $no++; ?></td>
                                        <td><?= $item['username']; ?></td>
                                        <td><?= $item['nama_lengkap']; ?></td>
                                        <td><?= $item['alamat']; ?></td>
                                        <td><?= $item['email']; ?></td>
                                        <td>
                                            <center>
                                                <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id']; ?>)" class="btn btn-circle btn-edit btn-warning"><i
                                                        class="fa fa-pen"></i></a>
                                                <a href="" class="btn btn-circle btn-delete btn-danger" data-toggle="modal"
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

        <form action="<?php echo base_url('Admin/PenggunaController/delete_pengguna'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus Pengguna ini?</h4>

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
    <form action="<?php echo base_url('Admin/PenggunaController/add_pengguna'); ?>" method="post" id="form_add" data-parsley-validate="true" enctype="multipart/form-data">
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
                            <label>Username</label>
                            <input type="text" class="form-control" id="input_username" name="input_username"  data-parsley-required="true" placeholder="Masukkan Username">
                                <span class="text-danger" id="error_username"></span>
                        </div> 

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
                            <label>Status Pengguna</label>
                            <select name="input_status" class="form-control" id="input_status">
                                <option value="admin" selected="">Admin</option>
                                <option value="customer">Customer</option>
                            </select>
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
    <form action="<?php echo base_url('Admin/PenggunaController/update_pengguna'); ?>" method="post" id="form_edit" data-parsley-validate="true" enctype="multipart/form-data">
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
                        <input type="hidden" class="id_pengguna" name="id_pengguna" id="id_pengguna">

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="edit_username" name="edit_username"  data-parsley-required="true" placeholder="Masukkan Username">
                                <span class="text-danger" id="error_edit_username"></span>
                        </div> 

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
                            <label>Status Pengguna</label>
                            <select name="edit_status" class="form-control" id="edit_status">
                                <option value="admin" selected="">Admin</option>
                                <option value="customer">Customer</option>
                            </select>
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
                                data-parsley-required="true" multiple />
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
    <script src="<?= base_url() ?>/docs/dashboard/assets/plugins/gritter/js/jquery.gritter.js"></script>
    <script src="<?= base_url() ?>/docs/dashboard/assets/js/demo/ui-gritter.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $.ajax({
                    url:"<?= base_url()?>/Dashboard/Dashboard/jumlah_pengajuan",
                    type:"POST",
                    dataType:"json",
                    data:{},
                    success:function(data){
                        $('#total_tempat').html(data.total_tempat);
                    }
                })
            }, 5000)
        })
    </script>

    <script type="text/javascript">
        $(function() {

            $("#input_username").keyup(function(){

                var input_username = $(this).val().trim();
          
                if(input_username != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/PenggunaController/cek_username'); ?>' + '/' + input_username,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_username").html('Username telah dipakai,coba yang lain');
                                $("#input_username").val(input_username);
                            }else{
                                $("#error_username").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
          
              });
            $("#edit_username").keyup(function(){

                var edit_username = $(this).val().trim();
          
                if(edit_username != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/PenggunaController/cek_username'); ?>' + '/' + edit_username,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_edit_username").html('Username telah dipakai,coba yang lain');
                                $("#edit_username").val(edit_username);
                            }else{
                                $("#error_edit_username").html('');
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
                $("#input_username").val('');
                $("#input_password").val('');
                $("#input_email").val('');
                $("#input_no_hp").val('');
                $("#input_nama").val('');
                $("#input_alamat").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_username").val('');
                $("#input_password").val('');
                $("#input_email").val('');
                $("#input_no_hp").val('');
                $("#input_nama").val('');
                $("#input_alamat").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_username").val('');
                $("#edit_password").val('');
                $("#edit_email").val('');
                $("#edit_no_hp").val('');
                $("#edit_nama").val('');
                $("#edit_alamat").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/PenggunaController/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_pengguna').val(json.id);
                    $('#edit_username').val(json.username);
                    $('#edit_password').val(json.password);
                    $('#edit_nama').val(json.nama_lengkap);
                    $('#edit_email').val(json.email);
                    $('#edit_no_hp').val(json.no_hp);
                    $('#edit_alamat').val(json.alamat);

                    if (json.status == 'customer') {
                        document.getElementById("edit_status").selectedIndex = 1;
                    } else {
                        document.getElementById("edit_status").selectedIndex = 0;
                    }

                    if (json.file != '' || json.file != null) {
                        $("#foto_lama").attr("src", "../../../../" + json.file) ;
                    } else {
                        $("#foto_lama").attr("src", "../../../../noimage.jpg");
                    }
                });
        }
    </script>
</body>

</html>