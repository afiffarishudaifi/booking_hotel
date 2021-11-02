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
                                        <th width="1%">No</th>
                                        <th class="text-nowrap">Nama Customer</th>
                                        <th class="text-nowrap">Nama Kamar</th>
                                        <th class="text-nowrap">Tanggal Masuk</th>
                                        <th class="text-nowrap">Tanggal Keluar</th>
                                        <th class="text-nowrap">Status Pemesanan</th>
                                        <th class="text-nowrap">Total Biaya</th>
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
                                        <td><?= $item['nama_kamar']; ?></td>
                                        <td><?= $item['tanggal_masuk']; ?></td>
                                        <td><?= $item['tanggal_keluar']; ?></td>
                                        <td><?= $item['status_pemesanan']; ?></td>
                                        <td><?= $item['total_biaya']; ?></td>
                                        <td>
                                            <center>
                                                <a href="" data-toggle="modal" data-toggle="modal" data-target="#updateModal" name="btn-edit" onclick="detail_edit(<?= $item['id']; ?>)" class="btn btn-circle btn-edit btn-warning btn-sm"><i
                                                        class="fa fa-pen"></i></a>
                                                <a href="" type="button" onclick="Hapus(<?= $item['id']; ?>,<?= $item['id_kamar']; ?>)" class="btn btn-circle btn-danger btn-sm" id="btn-delete" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a>
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

        <form action="<?php echo base_url('Admin/PemesananController/delete_pemesanan'); ?>" method="post">
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
                            <input type="hidden" name="id_kamar" class="id_kamar">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>

        <form action="<?php echo base_url('Admin/PemesananController/add_pemesanan'); ?>" method="post" id="form_add" data-parsley-validate="true">
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
                                <label>Nama Kamar</label>
                                <select name="input_kamar" id="input_kamar" class="form-control" onchange="get_biaya(this.value)">
                                </select>
                            </div> 

                            <div class="form-group">
                                <label>Biaya Kamar/malam</label>
                                <input type="text" name="input_biaya" id="input_biaya" class="form-control" value="0" readonly="">
                            </div>

                            <div class="form-group">
                                <label>Nama Pengguna</label>
                                <select name="input_pengguna" id="input_pengguna" class="form-control">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="datetime-local" class="form-control" id="input_masuk" name="input_masuk"  data-parsley-required="true" value="<?= date('Y-m-d G:i:s'); ?>" onchange="get_result(this.value, $('#input_keluar').val())">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Keluar</label>
                                <input type="datetime-local" class="form-control" id="input_keluar" name="input_keluar"  data-parsley-required="true" value="<?= date('Y-m-d G:i:s'); ?>" onchange="get_result($('#input_masuk').val(),this.value)">
                            </div>

                            <div class="form-group">
                                <label>Tagihan Biaya</label>
                                <input type="text" name="input_hasil_total" value="0" id="input_hasil_total" class="form-control"  readonly="">
                            </div>

                            <div class="form-group">
                                <label>Status Pemesanan</label>
                                <select name="input_status" class="form-control" id="input_status">
                                    <option value="pengajuan" selected="">Pengajuan</option>
                                    <option value="terkonfirmasi">Terkonfirmasi</option>
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
        <form action="<?php echo base_url('Admin/PemesananController/update_pemesanan'); ?>" method="post" id="form_edit" data-parsley-validate="true">
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
                            <input type="hidden" name="edit_kamar_lama" id="edit_kamar_lama">

                            <div class="form-group">
                                <label>Nama Kamar</label>
                                <select name="edit_kamar" id="edit_kamar" class="form-control" onchange="get_biaya_edit(this.value)">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Biaya Kamar/malam</label>
                                <input type="text" name="edit_biaya" id="edit_biaya" class="form-control" value="0" readonly="">
                            </div>

                            <div class="form-group">
                                <label>Nama Pengguna</label>
                                <select name="edit_pengguna" id="edit_pengguna" class="form-control">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="datetime-local" class="form-control" id="edit_masuk" name="edit_masuk"  data-parsley-required="true" value="<?= date('Y-m-d G:i:s'); ?>" onchange="get_result_edit(this.value, $('#edit_keluar').val())">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Keluar</label>
                                <input type="datetime-local" class="form-control" id="edit_keluar" name="edit_keluar"  data-parsley-required="true" value="<?= date('Y-m-d G:i:s'); ?>" onchange="get_result_edit($('#edit_masuk').val(),this.value)">
                            </div>

                            <div class="form-group">
                                <label>Tagihan Biaya</label>
                                <input type="text" name="edit_hasil_total" value="0" id="edit_hasil_total" class="form-control"  readonly="">
                            </div>

                            <div class="form-group">
                                <label>Status Pemesanan</label>
                                <select name="edit_status" class="form-control" id="edit_status">
                                    <option value="pengajuan" selected="">Pengajuan</option>
                                    <option value="terkonfirmasi">Terkonfirmasi</option>
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
    <script src="<?= base_url() ?>/docs/dashboard/assets/plugins/gritter/js/jquery.gritter.js"></script>
    <script src="<?= base_url() ?>/docs/dashboard/assets/js/demo/ui-gritter.js"></script>
    <script src="<?php echo base_url('/docs/dashboard/assets/plugins/select2/js/select2.full.min.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('/docs/dashboard/assets/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/docs/dashboard/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
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

        function get_result(masuk, akhir) {
            var tanggal_masuk = new Date(masuk);
            var tanggal_akhir = new Date(akhir);
            var timeDiff=0
            if (tanggal_akhir) {
                timeDiff = (tanggal_akhir - tanggal_masuk) / 1000;
            }

            var selisih = Math.floor(timeDiff/(86400))
            var biaya = $('#input_biaya').val()

            var total_biaya = parseInt(selisih) * parseInt(biaya);

            if (isNaN(total_biaya)) {
                $('#input_hasil_total').val('0')
            } else {
                $('#input_hasil_total').val(total_biaya)
            }
		}

        function get_result_edit(masuk, akhir) {
            var tanggal_masuk = new Date(masuk);
            var tanggal_akhir = new Date(akhir);
            var timeDiff=0
            if (tanggal_akhir) {
                timeDiff = (tanggal_akhir - tanggal_masuk) / 1000;
            }

            var selisih = Math.floor(timeDiff/(86400))
            var biaya = $('#edit_biaya').val()

            var total_biaya = parseInt(selisih) * parseInt(biaya);

            if (isNaN(total_biaya)) {
                $('#edit_hasil_total').val('0')
            } else {
                $('#edit_hasil_total').val(total_biaya)
            }
        }

		function get_biaya(id_kamar) {
			$.ajax({
                url:"<?= base_url()?>/Admin/PemesananController/biaya_kamar" + "/" + id_kamar,
                type:"GET",
                dataType:"json",
                data:{},
                success:function(data){
                    $('#input_biaya').val(data.biaya);
                }
            });
		}

		function get_biaya_edit(id_kamar) {
			$.ajax({
                url:"<?= base_url()?>/Admin/PemesananController/biaya_kamar" + "/" + id_kamar,
                type:"GET",
                dataType:"json",
                data:{},
                success:function(data){
                    $('#edit_biaya').val(data.biaya);
                }
            });
		}
    </script>

    <script type="text/javascript">
        $(function() {

            $('#input_kamar').select2({
                placeholder: "Pilih Kamar",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/PemesananController/data_kamar'); ?>',
                    dataType: 'json'
                }
            });

            $('#edit_kamar').select2({
                placeholder: "Pilih Kamar",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/PemesananController/data_kamar'); ?>',
                    dataType: 'json'
                }
            });

            $('#input_pengguna').select2({
                placeholder: "Pilih Pengguna",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/PemesananController/data_pengguna'); ?>',
                    dataType: 'json'
                }
            });

            $('#edit_pengguna').select2({
                placeholder: "Pilih Pengguna",
                theme: 'bootstrap4',
                ajax: {
                    url: '<?php echo base_url('Admin/PemesananController/data_pengguna'); ?>',
                    dataType: 'json'
                }
            });

            $('#batal').on('click', function() {
                $('#form_add')[0].reset();
                $('#form_edit')[0].reset();
                $("#input_kamar").val();
                $("#input_pengguna").val('');
                $("#input_masuk").val('');
                $("#input_keluar").val('');
                $("#input_status").val('');
            });

            $('#batal_add').on('click', function() {
                $('#form_add')[0].reset();
                $("#input_kamar").val('');
                $("#input_pengguna").val('');
                $("#input_masuk").val('');
                $("#input_keluar").val('');
                $("#input_status").val('');
            });

            $('#batal_up').on('click', function() {
                $('#form_edit')[0].reset();
                $("#edit_kamar").val('');
                $("#edit_pengguna").val('');
                $("#edit_masuk").val('');
                $("#edit_keluar").val('');
                $("#edit_status").val('');
            });
        })

        function detail_edit(isi) {
            $.getJSON('<?php echo base_url('Admin/PemesananController/data_edit'); ?>' + '/' + isi, {},
                function(json) {
                    $('#id_pemesanan').val(json.id);
                    $('#edit_kamar_lama').val(json.id_kamar);

                    $('#edit_kamar').append('<option selected value="' + json.id_kamar + '">' + json.nama_kamar +
                        '</option>');
                    $('#edit_kamar').select2('data', {
                        id: json.id_kamar,
                        text: json.nama_kamar
                    });
                    $('#edit_kamar').trigger('change');

                    $('#edit_pengguna').append('<option selected value="' + json.id_pengguna + '">' + json.nama_lengkap +
                        '</option>');
                    $('#edit_pengguna').select2('data', {
                        id: json.id_pengguna,
                        text: json.nama_lengkap
                    });
                    $('#edit_pengguna').trigger('change');

                    $('#edit_masuk').val(json.tanggal_masuk);
                    $('#edit_keluar').val(json.tanggal_keluar);
                    $('#edit_hasil_total').val(json.total_biaya);

                    if (json.status_pemesanan == 'pengajuan') {
                        document.getElementById("edit_status").selectedIndex = 0;
                    } else {
                        document.getElementById("edit_status").selectedIndex = 1;
                    }
                });
        }
    </script>
</body>

</html>