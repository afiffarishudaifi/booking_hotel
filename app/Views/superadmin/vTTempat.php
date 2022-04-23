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
                                        <th class="text-nowrap" style="text-align: center;">Nama</th>
                                        <th class="text-nowrap" style="text-align: center;">Alamat</th>
                                        <th class="text-nowrap" style="text-align: center;">Deskripsi</th>
                                        <th class="text-nowrap" style="text-align: center;">Jarak</th>
                                        <th class="text-nowrap" style="text-align: center;" width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($tempat as $item) {
                                    ?>
                                    <tr>
                                        <td width="1%"><?= $no++; ?></td>
                                        <td><?= $item['nama_tempat']; ?></td>
                                        <td><?= $item['alamat_tempat']; ?></td>
                                        <td><?= substr($item['deskripsi'], 0, 300) ?></td>
                                        <td><?= $item['jarak_tempat']; ?>  km</td>
                                        <td>
                                            <center>
                                                <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_tempat']; ?>)" class="btn btn-sm btn-edit btn-warning"><i
                                                        class="fa fa-pen"></i></a>
                                                <a href="" class="btn btn-sm btn-delete btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal" data-id="<?= $item['id_tempat']; ?>"><i
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

        <form action="<?php echo base_url('SuperAdmin/Tempat/delete_tempat'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus tempat ini?</h4>

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
    <form autocomplete="off" action="<?php echo base_url('SuperAdmin/Tempat/add_tempat'); ?>" method="post" id="form_add" data-parsley-validate="true" enctype="multipart/form-data">
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
                            <label>Nama Tempat</label>
                            <input type="text" class="form-control" id="input_nama" name="input_nama"  data-parsley-required="true" placeholder="Masukkan Tempat">
                        </div>

                        <div class="form-group">
                            <label>Url Tempat</label>
                            <input type="text" class="form-control" id="input_url" name="input_url"  data-parsley-required="true" placeholder="Masukkan Url">
                        </div>

                        <div class="form-group">
                            <label>Alamat Tempat</label>
                            <textarea class="form-control" name="input_alamat" id="input_alamat" placeholder="Masukkan Alamat" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Tempat</label>
                            <textarea class="form-control" name="input_deskripsi" id="input_deskripsi" placeholder="Masukkan Deskripsi" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Jarak Tempat</label>
                            <input type="number" class="form-control" id="input_jarak" name="input_jarak"  data-parsley-required="true" placeholder="Masukkan Jarak">
                        </div>

                        <div class="form-group">
                            <label>Latitude Tempat</label>
                            <input type="text" class="form-control" id="input_lat" name="input_lat"  data-parsley-required="true" placeholder="Masukkan Latitude">
                        </div>

                        <div class="form-group">
                            <label>Longitude Tempat</label>
                            <input type="text" class="form-control" id="input_long" name="input_long"  data-parsley-required="true" placeholder="Masukkan Longitude">
                        </div>

                        <div class="form-group">
                            <label>Foto Cover</label>
                            <br>
                            <input type="file" id="input_foto" name="input_foto"
                                data-parsley-required="true" multiple />
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
    <form autocomplete="off" action="<?php echo base_url('SuperAdmin/Tempat/update_tempat'); ?>" method="post" id="form_edit" data-parsley-validate="true" enctype="multipart/form-data">
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?= csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Tempat </h5>
                        <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="id_tempat" name="id_tempat" id="id_tempat">
                        <input type="hidden" class="id_tempat" name="foto_edit_lama" id="foto_edit_lama">

                        <div class="form-group">
                            <label>Nama Tempat</label>
                            <input type="text" class="form-control" id="edit_nama" name="edit_nama"  data-parsley-required="true" placeholder="Masukkan Tempat">
                        </div>

                        <div class="form-group">
                            <label>Url Tempat</label>
                            <input type="text" class="form-control" id="edit_url" name="edit_url"  data-parsley-required="true" placeholder="Masukkan Url">
                        </div>

                        <div class="form-group">
                            <label>Alamat Tempat</label>
                            <textarea class="form-control" name="edit_alamat" id="edit_alamat" placeholder="Masukkan Alamat" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Tempat</label>
                            <textarea class="form-control" name="edit_deskripsi" id="edit_deskripsi" placeholder="Masukkan Deskripsi" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Jarak Tempat</label>
                            <input type="number" class="form-control" id="edit_jarak" name="edit_jarak"  data-parsley-required="true" placeholder="Masukkan Jarak">
                        </div>

                        <div class="form-group">
                            <label>Latitude Tempat</label>
                            <input type="text" class="form-control" id="edit_lat" name="edit_lat"  data-parsley-required="true" placeholder="Masukkan Latitude">
                        </div>

                        <div class="form-group">
                            <label>Longitude Tempat</label>
                            <input type="text" class="form-control" id="edit_long" name="edit_long"  data-parsley-required="true" placeholder="Masukkan Longitude">
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <center>
                                    <img id="foto_lama" style="width: 300px; height: 160px;" src="">
                                </center>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Foto Cover</label>
                            <br>
                            <input type="file" id="edit_foto" name="edit_foto"  />
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
            $('#batal').on('click', function() {
                $('#form_add')[0].reset();
                $('#form_edit')[0].reset();
                $("#input_nama").val('');
                $("#input_url").val('');
                $("#input_alamat").val('');
                $("#input_deskripsi").val('');
                $("#input_lat").val('');
                $("#input_long").val('');
                $("#input_jarak").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_nama").val('');
                $("#input_url").val('');
                $("#input_alamat").val('');
                $("#input_deskripsi").val('');
                $("#input_lat").val('');
                $("#input_long").val('');
                $("#input_jarak").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_nama").val('');
                $("#edit_url").val('');
                $("#edit_alamat").val('');
                $("#edit_deskripsi").val('');
                $("#edit_lat").val('');
                $("#edit_long").val('');
                $("#edit_jarak").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('SuperAdmin/Tempat/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_tempat').val(json.id_tempat);
                    $('#edit_nama').val(json.nama_tempat);
                    $('#edit_url').val(json.url_tempat);
                    $('#edit_alamat').val(json.alamat_tempat);
                    $('#edit_deskripsi').val(json.deskripsi);
                    $('#edit_lat').val(json.latitude);
                    $('#edit_long').val(json.longitude);
                    $('#edit_jarak').val(json.jarak_tempat);
                    $('#foto_edit_lama').val(json.foto);
                    if (json.foto != '' || json.foto != null) {
                        $("#foto_lama").attr("src", "<?= base_url('docs/img/img_tempat') . '/' ?>" + json.foto) ;
                    } else {
                        $("#foto_lama").attr("src", "<?= base_url() . '/' ?>" + "docs/img/img_tempat/noimage.jpg");
                    }
                });
        }
    </script>
</body>

</html>
