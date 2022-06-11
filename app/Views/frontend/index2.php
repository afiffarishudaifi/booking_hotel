<?php $session = session(); ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <link rel="icon" href="<?= base_url() ?>/docs/img/img_logo/logo.png">
      <!-- site metas -->
      <title><?= $judul; ?></title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="<?= base_url() ?>/docs/frontend/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="<?= base_url() ?>/docs/frontend/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="<?= base_url() ?>/docs/frontend/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="<?= base_url() ?>/docs/frontend/images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="<?= base_url() ?>/docs/frontend/css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url('docs/dashboard/assets/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('docs/dashboard/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="<?= base_url() ?>/docs/frontend/images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item">
                                 <a class="nav-link" href="<?= base_url() . '/' . 'Frontend/Frontend'; ?>">Dashboard</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#kamar">Kamar</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#wisata">Wisata Terdekat</a>
                              </li>
                           </ul>
                           <?php if ($session->get('status_login') == 'customer') { ?>
                              <div class="sign_btn"><a href="<?= base_url('Customer/Dashboard'); ?>"><?= $session->get('username_login'); ?></a></div>
                           <?php } else { ?>
                              <div class="sign_btn"><a href="<?= base_url('Login'); ?>">Sign in</a></div>
                           <?php } ?>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>

      <section class="banner_main">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="text-bg">
                     <div class="padding_lert">
                        <h1>SELAMAT DATANG DI HOTEL PURBAYA </h1>
                        <span> Jalan Raya Magetan Sarangan No. 8, Ngerong</span>
                        <p>Penginapan yang wajib menjadi tempat istirahat kalian. Lokasi yang sangat strategis dan dapat menjakau tempat wisata di sekitarnya</p>
                        <a href="#">Baca Selengkapnya</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <section>
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <center>
                     <form class="form_book" method="get" action="<?php echo base_url('Frontend/Pencarian/pencarian'); ?>">
                        <div class="row">
                           <div class="col-md-4">
                              <label class="date">Tanggal Masuk</label>
                              <input class="book_n"  type="datetime-local" name="input_masuk" data-date-format="DD MMMM YYYY">
                           </div>
                           <div class="col-md-4">
                              <label class="date">Tanggal Keluar</label>
                              <input class="book_n"  type="datetime-local" name="input_keluar" data-date-format="DD MMMM YYYY">
                           </div>
                           <!-- <div class="col-md-3">
                              <label class="date">Tipe Kamar</label>
                              <select id="select_kategori" name="input_kategori" class="book_n">
                              </select>
                           </div> -->
                           <div class="col-md-3">
                              <button type="submit" class="book_btn">Pencarian</button>
                           </div>
                        </div>
                     </form>
                  </center>
               </div>
            </div>
         </div>
      </section>

      <div class="choose">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="choose_box">
                     <div class="titlepage">
                        <h2><span class="text_norlam">PILIHAN YANG TEPAT</span> <br>Penginapan</h2>
                     </div>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit </p>
                     <a class="read_more" href="#">Lihat Selengkapnya</a>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="img_box">
                           <figure><img src="<?= base_url() ?>/docs/frontend/images/img1.jpg" alt="#"/></figure>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="img_box">
                           <figure><img src="<?= base_url() ?>/docs/frontend/images/img2.jpg" alt="#"/></figure>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="img_box">
                           <figure><img src="<?= base_url() ?>/docs/frontend/images/img3.jpg" alt="#"/></figure>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div id="kamar" class="testimonial" style="padding-top: 60px;">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Kamar</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <?php if(count($kamar) == 0) { ?>
                  <div class="col-md-12">
                     <center>
                        <img src="<?= base_url('docs/img/tambahan/illustration-2.png') ?>" style="width:30%"><br>
                        <div class="alert alert-danger alert-dismissible fade show col-md-8" role="alert">
                                 <center>
                                       <strong>Peringatan!</strong> Kamar Penuh
                                 </center>
                              </div>
                     </center> 
                  </div>
               <?php } else { ?>
                  <?php foreach($kamar as $item) {?>
                  <div class="col-md-3" style="height: 350px;">
                        <div class="row" style="height: 150px;">
                           <div class="col-md-12">
                                 <img src="<?= base_url() . '/' . $item['nama_foto'] ?>" style="height: 150px; border-radius:10px;">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12" style="padding-top: 10px;">
                                 <h4><b><?= $item['nama_kamar'] ?></b></h4>
                                 <p style="text-align: justify;"> Harga : <?= $item['biaya'] ?>/Malam<br>
                                 Kategori Kamar : <?= $item['nama_kategori'] ?><br>
                                 Status Kamar : <?= $item['status_kamar'] ?></p><br>
                                 <a href="<?= base_url('Frontend/Pencarian/detail/' . $item['id']); ?>" class="btn btn-sm btn-primary">Detail</a>

                                 <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="detail(<?= $item['id']; ?>)" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn_1 outline">Pesan</a>
                           </div>
                        </div>
                     </div>
                  <?php } 
                  } ?>
            </div>
         </div>
      </div>

      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

          <div class="modal-content">
            
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Detail Kamar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
              <section style="padding-top: 60px;">
                <div class="container">
                    <div class="row" style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
                        <div class="col-md-12">
                            <div class="row" style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
                                <div class="col-md-12" style="padding-top: 10px;">
                                    <h2>Deskirpsi : </h2>
                                    <p style="text-align: justify;">  
                                      lorem  </p>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
                                <div class="col-md-12">
                                 <h2><i class="fa fa-info-circle"></i> Informasi</h2>
                                 <div class="">
                                          <ul style='word-break: break-word;'>
                                              
                                             <li><p >Alamat : Jalan Raya Magetan Sarangan No. 8, Ngerong, Dadi, Kec. Plaosan, Kabupaten Magetan, Jawa Timur 63361</p></li>
                                                                      
                                             <li><p >Nomor Telepon : (0351) 888097</p></li>

                                    </ul>
                                       </div>
                                </div>
                            </div>
                            <?php if (4 != 1) { ?>
                            <div class="row" style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
                                <div class="col-md-12">
                                  <h2><i class='fa fa-hotel'></i> Fasilitas</h2>
                                  <div class="">
                                    <ul style='word-break: break-word;'>
                                        <li> - bagus</li>
                                    </ul>
                                  </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="row" style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
                                <div class="col-md-12">
                                 <h2><i class="fa fa-image"></i> Galeri</h2>
                                 <div class="pictures_grid magnific-gallery clearfix">
                                       </div>
                            </div>
                            <div class="row"  style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
                                <div class="col-md-12">
                                  <h2><i class="fa fa-map-marker"></i> Lokasi</h2>
                                  <div class="pictures_grid magnific-gallery clearfix">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.1044759537126!2d111.21650181419785!3d-7.671916378061466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798e9e0ba4721f%3A0x3c5dbc151c888349!2sPurboyo%20Hotel!5e0!3m2!1sen!2sid!4v1653579980321!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 20px">
                         <div class="col-md-12">
                            <?php if ($session->get('status_login') == 'customer') { ?>
                             <form action="<?php echo base_url('Frontend/Pemesanan/add_detail_pemesanan'); ?>" method="post" data-parsley-validate="true">
                               <?= csrf_field(); ?>
                               <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pemesanan </h5>
                                       </div>
                                       <div class="modal-body">

                                           <input type="hidden" name="input_kamar" id="input_kamar" value="5">

                                           <div class="form-group">
                                               <label>Biaya Kamar/malam</label>
                                               <input type="text" name="input_biaya" id="input_biaya" class="form-control" readonly="" value="345345">
                                           </div>

                                           <div class="form-group">
                                               <label>Nama Pengguna</label>
                                               <input type="hidden" value="<?= $session->get('user_id'); ?>" name="input_pengguna">
                                               <input type="text" name="" id="" class="form-control" readonly="" value="<?= $session->get('username_login'); ?>">
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

                                       </div>
                                       <div class="modal-footer">
                                           <button type="reset" class="btn btn-secondary" id="batal_add" data-dismiss="modal">Batal</button>
                                           <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                                       </div>
                                   </div>
                               </div>
                             </form>

                           <?php } else { ?>
                             <center>
                               <h4>Anda harus login untuk dapat melakukan pemesanan</h4>
                               <a href="<?= base_url('Login'); ?>" class="btn btn-primary">Login</a>
                             </center>
                           <?php } ?>
                         </div>
                    </div>
                </div>
            </section>
          </div>
        </div>
      </div>

      <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Detail Kamar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            </div>
          </div>
        </div>
      </div>

      <div id="wisata" class="testimonial" style="padding-top: 60px;">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Wisata Terdekat</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <?php foreach($wisata as $item) {?>
               <div class="col-md-3" style="height: 350px;">
                      <div class="row" style="height: 150px;">
                          <div class="col-md-12">
                              <img src="<?= base_url('docs/img/img_tempat') . '/' . $item['foto'] ?>" style="height: 150px; border-radius:10px;">
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12" style="padding-top: 10px;">
                              <h4><b><?= $item['nama_tempat'] ?></b></h4>
                              <p style="text-align: justify;"> <b>Deskripsi</b> : <?= substr($item['deskripsi'], 0, 200) ?> . . .<br>
                              <b>Alamat</b> : <?= $item['alamat_tempat'] ?><br></p>
                              <a href="<?= base_url('Frontend/Wisata/detail/' . $item['id_tempat']); ?>" class="btn btn-sm btn-primary">Detail</a>
                          </div>
                      </div>
                  </div>
               <?php } ?>
            </div>
            <div class="row" style="padding-top:90px;">
               <div class="col-md-12">
                  <center>
                     <a href="<?= base_url('Frontend/Wisata') ?>" class="btn btn-success"><i class="fa fa-info-circle"></i> Lebih banyak</a>
                  </center> 
               </div>
            </div>
         </div>
      </div>

      <footer id="contact">
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-6">
                     <div class="titlepage">
                        <h2>Hubungi Kami</h2>
                     </div>
                     <div class="cont">
                        <h3>Hotel Purbaya</h3>
                        <p>Jalan Raya Magetan Sarangan No. 8, Ngerong, Dadi, Kec. Plaosan, Kabupaten Magetan, Jawa Timur 63361</p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <form id="request" class="main_form">
                        <div class="row">
                           <div class="col-md-12 ">
                              <input class="contactus" placeholder="Nama" type="type" name="Nama"> 
                           </div>
                           <div class="col-md-12">
                              <input class="contactus" placeholder="Email" type="type" name="Email"> 
                           </div>
                           <div class="col-md-12">
                              <input class="contactus" placeholder="No Hp" type="type" name="Phone Number">                          
                           </div>
                           <div class="col-md-12">
                              <textarea class="textarea" placeholder="Pesan" type="type" Message="Name">Pesan </textarea>
                           </div>
                           <div class="col-sm-12">
                              <button class="send_btn">Kirim</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>Copyright 2021 All Right Reserved By <a href="https://html.design/"> Hotel Purbaya</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>

      <script src="<?= base_url() ?>/docs/frontend/js/jquery.min.js"></script>
      <script src="<?= base_url() ?>/docs/frontend/js/popper.min.js"></script>
      <script src="<?= base_url() ?>/docs/frontend/js/bootstrap.bundle.min.js"></script>
      <script src="<?= base_url() ?>/docs/frontend/js/jquery-3.0.0.min.js"></script>
      <script src="<?= base_url() ?>/docs/frontend/js/plugin.js"></script>

      <script src="<?= base_url() ?>/docs/frontend/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="<?= base_url() ?>/docs/frontend/js/custom.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

      
    <script src="<?php echo base_url('docs/dashboard/assets/plugins/select2/js/select2.full.min.js') ?>"></script>

      <script type="text/javascript">
         $('#select_kategori').select2({
            placeholder: "Pilih Kategori",
            theme: 'bootstrap4',
            ajax: {
                url: '<?php echo base_url('Frontend/Frontend/data_kategori'); ?>',
                dataType: 'json'
            }
        });

         function detail(isi) {
            $.getJSON('<?= base_url('Frontend/Pencarian/detail'); ?>' + '/' + isi, {},
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

