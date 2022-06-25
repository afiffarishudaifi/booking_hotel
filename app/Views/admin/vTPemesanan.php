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
                                        <th width="1%">No</th>
                                        <th class="text-nowrap" style="text-align: center;">Nama Pengunjung</th>
                                        <th class="text-nowrap" style="text-align: center;">Tanggal Pemesanan</th>
                                        <th class="text-nowrap" style="text-align: center;">Status Pemesanan</th>
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
                                            <center>
                                                <a href="<?= base_url('/Admin/DetailPemesanan/viewData/' . $item['id_pemesanan']) ?>" class="btn btn-edit btn-info btn-sm"><i
                                                        class="fa fa-eye"></i></a>
                                                <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_pemesanan']; ?>)" class="btn btn-edit btn-warning btn-sm"><i
                                                        class="fa fa-pen"></i></a>
                                                <?php if($item['status_pemesanan'] == 'selesai') { ?>
                                                    <a href="<?= base_url('/Admin/DetailPemesanan/cetakPdf/' . $item['id_pemesanan']) ?>" class="btn btn-edit btn-success btn-sm"><i
                                                            class="fa fa-print"></i></a>
                                                <?php }?>
                                                <a href="" type="button" onclick="Hapus(<?= $item['id_pemesanan']; ?>)" class="btn btn-danger btn-sm" id="btn-delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a>
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

        <form action="<?php echo base_url('Admin/Pemesanan/delete_pemesanan'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus pemesanan ini?</h4>

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

        <form action="<?php echo base_url('Admin/Pemesanan/add_pemesanan'); ?>" method="post" id="form_add" data-parsley-validate="true" enctype="multipart/form-data">
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pemesanan </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nama Pengguna</label>
                                <select name="input_pengguna" id="input_pengguna" class="form-control select2">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Pesan</label>
                                <input type="datetime-local" class="form-control" id="input_tanggal" name="input_tanggal"  data-parsley-required="true" value="<?= date('Y-m-d G:i:s'); ?>">
                            </div>

                            <div class="form-group">
                                <label>Status Pemesanan</label>
                                <select name="input_status" class="form-control" id="input_status">
                                    <option value="pengajuan" selected="">Pengajuan</option>
                                    <option value="terkonfirmasi">Terkonfirmasi</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Bukti Pembayaran</label>
                                <input type="file" name="input_foto" id="input_foto">
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
        <form action="<?php echo base_url('Admin/Pemesanan/update_pemesanan'); ?>" method="post" id="form_edit" data-parsley-validate="true" enctype="multipart/form-data">
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pemesanan </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_pemesanan" id="id_pemesanan">
                            <div class="form-group">
                                <label>Nama Pengguna</label>
                                <select name="edit_pengguna" id="edit_pengguna" class="form-control select2">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Pesan</label>
                                <input type="datetime-local" class="form-control" id="edit_tanggal" name="edit_tanggal"  data-parsley-required="true" value="<?= date('Y-m-d G:i:s'); ?>">
                            </div>

                            <div class="form-group">
                                <label>Status Pemesanan</label>
                                <select name="edit_status" class="form-control" id="edit_status">
                                    <option value="pengajuan" selected="">Pengajuan</option>
                                    <option value="terkonfirmasi">Terkonfirmasi</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12">
                                    <center>
                                        <img id="foto_lama" style="width: 300px; height: 160px;" src="">
                                    </center>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Bukti Pembayaran</label>
                                <input type="file" name="edit_foto" id="edit_foto">
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
    </div>
    <!-- end page container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        function Hapus(id){
            $('.id').val(id);
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

            $('.select2').select2()

            $("#input_pengguna").select2({
                placeholder: "Pilih Pengguna",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/Pemesanan/data_pengguna'); ?>',
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            query: params.term, // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response.data
                        };
                    },
                    cache: true
                }
            });

            $("#edit_pengguna").select2({
                placeholder: "Pilih Pengguna",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/Pemesanan/data_pengguna'); ?>',
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            query: params.term, // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response.data
                        };
                    },
                    cache: true
                }
            });

            $('#batal').on('click', function() {
                $('#form_add')[0].reset();
                $('#form_edit')[0].reset();
                $("#input_pengguna").val('');
                $("#input_tanggal").val('');
                $("#input_status").val('');
                $("#input_foto").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_pengguna").val('');
                $("#input_tanggal").val('');
                $("#input_status").val('');
                $("#input_foto").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_pengguna").val('');
                $("#edit_tanggal").val('');
                $("#edit_status").val('');
                $("#edit_foto").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/Pemesanan/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_pemesanan').val(json.id_pemesanan);

                    $('#edit_pengguna').append('<option selected value="' + json.id_pengguna + '">' + json.nama_lengkap +
                        '</option>');
                    $('#edit_pengguna').select2('data', {
                        id: json.id_pengguna,
                        text: json.nama_lengkap
                    });
                    $('#edit_pengguna').trigger('change');

                    $('#edit_tanggal').val(json.tanggal_pesan);

                    if (json.status_pemesanan == 'pengajuan') {
                        document.getElementById("edit_status").selectedIndex = 0;
                    } else if (json.status_pemesanan == 'terkonfirmasi') {
                        document.getElementById("edit_status").selectedIndex = 1;
                    } else {
                        document.getElementById("edit_status").selectedIndex = 2;
                    }
                    // console.log(json.bukti_transaksi);

                    if (json.bukti_transaksi != '' || json.bukti_transaksi != null) {
                        $("#foto_lama").attr("src", "<?= base_url() . '/docs/img/img_transaksi/' ?>" + json.bukti_transaksi) ;
                    } else {
                        $("#foto_lama").attr("src", "<?= base_url() . '/' ?>" + "docs/img/img_kamar/noimage.jpg");
                    }
                });
        }
    </script>
</body>

</html>
