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
        <?= $this->include("admin/template/sidebar") ?>
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
                                        <th class="text-nowrap">Nama Kamar</th>
                                        <th class="text-nowrap">Status Kamar</th>
                                        <th class="text-nowrap">Biaya/malam</th>
                                        <th class="text-nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kamar as $item) {
                                    ?>
                                    <tr>
                                        <td width="1%"><?= $no++; ?></td>
                                        <td><?= $item['nama_kamar']; ?></td>
                                        <td><?= $item['status_kamar']; ?></td>
                                        <td><?= $item['biaya']; ?></td>
                                        <td>
                                            <center>
                                                <a href="<?php base_url() ?>DetailKamar/view/<?php echo $item['id_kamar']; ?>" class="btn btn-sm btn-edit btn-aqua"><i
                                                class="fas fa-eye"></i></a>
                                                <a href="<?php base_url() ?>Kamar/view_foto/<?php echo $item['id_kamar']; ?>" class="btn btn-sm btn-edit btn-secondary"><i
                                                class="fas fa-file-image"></i></a>
                                                <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id_kamar']; ?>)" class="btn btn-sm btn-edit btn-warning"><i
                                                        class="fa fa-pen"></i></a>
                                                <a href="" type="button" onclick="Hapus(<?= $item['id_kamar']; ?>)" class="btn btn-sm btn-danger" id="btn-delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a>
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

        <form action="<?php echo base_url('Admin/Kamar/delete_kamar'); ?>" method="post">
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

                            <h4>Apakah Ingin menghapus kamar ini?</h4>

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

        <form action="<?php echo base_url('Admin/Kamar/add_kamar'); ?>" method="post" id="form_add" data-parsley-validate="true">
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kamar </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Kategori Kamar</label>
                                <select name="input_kategori" id="input_kategori" class="form-control select2">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama Kamar</label>
                                <input type="text" class="form-control" id="input_nama" name="input_nama"  data-parsley-required="true" placeholder="Masukkan Nama Kamar">
                                <span class="text-danger" id="error_nama"></span>
                            </div>

                            <div class="form-group">
                                <label>Biaya Kamar/malam</label>
                                <input type="number" class="form-control" id="input_biaya" name="input_biaya"  data-parsley-required="true" placeholder="Masukkan Biaya Permalam">
                            </div>

                            <div class="form-group">
                                <label>Status Kamar</label>
                                <select name="input_status" class="form-control" id="input_status">
                                    <option value="kosong" selected="">Kosong</option>
                                    <option value="terisi">Terisi</option>
                                </select>
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
        <form action="<?php echo base_url('Admin/Kamar/update_kamar'); ?>" method="post" id="form_edit" data-parsley-validate="true">
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kamar </h5>
                            <button type="reset" class="close" data-dismiss="modal" id="batal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_kamar" id="id_kamar">

                            <div class="form-group">
                                <label>Kategori Kamar</label>
                                <select name="edit_kategori" id="edit_kategori" class="form-control select2">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama Kamar</label>
                                <input type="text" class="form-control" id="edit_nama" name="edit_nama" data-parsley-required="true" placeholder="Masukkan Nama Kamar">
                                <span class="text-danger" id="error_edit_nama"></span>
                            </div>

                            <div class="form-group">
                                <label>Biaya Kamar/malam</label>
                                <input type="number" class="form-control" id="edit_biaya" name="edit_biaya"  data-parsley-required="true" placeholder="Masukkan Biaya Permalam">
                            </div>

                            <div class="form-group">
                                <label>Status Kamar</label>
                                <select name="edit_status" class="form-control" id="edit_status">
                                    <option value="kosong" selected="">Kosong</option>
                                    <option value="terisi">Terisi</option>
                                </select>
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
    <script src="<?= base_url('/docs/dashboard/assets/plugins/select2/js/select2.full.min.js') ?>"></script>
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

            //===================================================================
            
            $("#input_nama").keyup(function(){

                var nama = $(this).val().trim();
          
                if(nama != ''){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Kamar/cek_nama'); ?>' + '/' + nama,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_nama").html('Nama telah dipakai,coba yang lain');
                                $("#input_nama").val('');
                            }else{
                                $("#error_nama").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
          
              });
            $("#edit_nama").keyup(function(){

                var nama = $(this).val().trim();
          
                if(nama != '' && nama != $('#edit_nama_lama').val()){
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '<?php echo base_url('Admin/Kamar/cek_nama'); ?>' + '/' + nama,
                        success: function (data) {
                            if(data['results']>0){
                                $("#error_edit_nama").html('Nama telah dipakai,coba yang lain');
                                $("#edit_nama").val('');
                            }else{
                                $("#error_edit_nama").html('');
                            }
                        }, error: function () {
            
                            alert('error');
                        }
                    });
                }
          
            });

            $('.select2').select2()

            $("#input_kategori").select2({
                placeholder: "Pilih Kategori",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/Kamar/data_kategori'); ?>',
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

            $("#edit_kategori").select2({
                placeholder: "Pilih Kategori",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/Kamar/data_kategori'); ?>',
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
                $("#input_kategori").val('');
                $("#input_nama").val('');
                $("#input_biaya").val('');
                $("#input_status").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_kategori").val('');
                $("#input_nama").val('');
                $("#input_biaya").val('');
                $("#input_status").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_kategori").val('');
                $("#edit_nama").val('');
                $("#edit_biaya").val('');
                $("#edit_status").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/Kamar/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_kamar').val(json.id_kamar);
                    $('#edit_nama').val(json.nama_kamar);
                    $('#edit_biaya').val(json.biaya);

                    $('#edit_kategori').append('<option selected value="' + json.id_kategori + '">' + json.nama_kategori +
                        '</option>');
                    $('#edit_kategori').select2('data', {
                        id: json.id_kategori,
                        text: json.nama_kategori
                    });
                    $('#edit_kategori').trigger('change');

                    if (json.status_kamar == 'terisi') {
                        document.getElementById("edit_status").selectedIndex = 1;
                    } else {
                        document.getElementById("edit_status").selectedIndex = 0;
                    }
                });
        }
    </script>
</body>

</html>
