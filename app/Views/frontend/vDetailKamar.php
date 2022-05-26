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
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"> -->
      <link rel="stylesheet" href="<?php echo base_url('docs/dashboard/assets/plugins/select2/css/select2.min.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('docs/dashboard/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"  />
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

      <!-- GOOGLE WEB FONT -->
      <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->

      <!-- BASE CSS -->
      <link href="<?= base_url() ?>/docs/panagea/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?= base_url() ?>/docs/panagea/css/style.css" rel="stylesheet">
      <link href="<?= base_url() ?>/docs/panagea/css/vendors.css" rel="stylesheet">

      <!-- YOUR CUSTOM CSS -->
      <link href="<?= base_url() ?>/docs/panagea/css/custom.css" rel="stylesheet">

      <style>
          .title-app {
              margin-top: 5px;
          }
          .main-menu {
              top: 7px;
          }

          @media (max-width: 480px) {
              .title-app {
                  margin-top: 15px;
              }
              ul.mm-listview li a.btn{
                  color: #fff !important;
                  width: 60%;
                  padding: 10px;
              }
          }
          
          @media (max-width: 767px) {
              ul#top_menu li:first-child {
                  display: inherit;
              }
          }

          @media (max-width: 991px) {
              .title-app {
                  margin-top: 15px;
              }
              ul.mm-listview li a.btn{
                  color: #fff !important;
                  width: 60%;
                  padding: 10px;
              }
          }
      </style>

      <style type="text/css">
        .hero_in.hotels_detail2 {
          /*width: 1700px;*/
          height: 550px;
          background: url('<?= base_url() . '/' . $foto_cover ?>') center center no-repeat;
        }

        @media (max-width: 575px) {
          .hero_in.hotels_detail2 {
            /*width: 1650px;*/
            height: 500px;
          }
          
          img.mfp-img {
            height: inherit !important;
          }
        }

        .hero_in.hotels_detail2:before {
          background: url('<?= base_url() . '/' . $foto_cover ?>') center center no-repeat;
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }

        .hero_in.hotels_detail2 .wrapper {
          background-color: black;
          background-color: rgba(0, 0, 0, 0.6);
        }
        
        .list_articles ul li {
              width: 100%;
          }

        @media (max-width: 991px) {
          
          img.mfp-img {
            height: inherit !important;
          }
        }
        
        .tabs nav ul {
            display: inline-flex;
          }
          a.grid_item figure img{
              width: 100% !important;
              height: 165px;
          }

          .tabs nav ul li a i {
              top: 10px !important;
          }

          .tabs nav ul li.tab-current {
              background-color: #d9d9d9;
              z-index: 100;
          }
          .logo_objek {
              width: 100px;
              margin-bottom: -20px;
              height: auto;
              position: inherit;
          }
          
          .list_articles ul li {
              width: 100%;
          }

          @media (max-width: 1199px) {
              .logo_objek {
                  width: 100px;
                  margin-bottom: -20px;
                  height: auto;
                  position: inherit;
              }
          }

          @media (max-width: 767px) {
              .logo_objek {
                  width: 100px;
                  margin-bottom: -20px;
                  height: auto;
                  position: inherit;
              }
          }
      </style>
   </head>
   <!-- body -->
   <body>
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="<?= base_url() ?>/docs/frontend/images/loading.gif" alt="#" /></div>
      </div>

      <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
               <div class="full">
                  <div class="center-desk">
                  </div>
               </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9" style="background-color: #d14b0a;">
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
                           <a class="nav-link" href="<?= base_url() . '/' . 'Frontend/Frontend'; ?>#kamar">Kamar</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="<?= base_url() . '/' . 'Frontend/Frontend'; ?>#wisata">Wisata Terdekat</a>
                        </li>
                     </ul>
                     <?php if ($session->get('status_login') == 'customer') { ?>
                        <div class="sign_btn"><a href="<?= base_url('Customer/Dashboard'); ?>"><?= $session->get('username_login'); ?></a></div>
                     <?php } else { ?>
                        <div class="sign_btn"><a href="<?= base_url('Login'); ?>">Login</a></div>
                     <?php } ?>
                  </div>
               </nav>
            </div>
        </div>
        <div class="row" style="padding-top: 10px;">
            <div class="col-md-12">
              <section class="hero_in hotels_detail2" style='height:650px;'>
                <div class="wrapper">
                  <div class="container">
                      <img class="logo_objek" src="<?= base_url() ?>/docs/img/img_logo/logo.png" style="width: 5%;" alt="">
                      <h1 class="fadeInUp"><span></span> <?= $kamar['nama_kamar'] ?></h1>

                      <div class="row">
                        <div class="col-md-12">
                        <center>
                            <ul class="share-buttons">
                              <li><span><a onclick="window.open('https://www.google.com/maps/place/Purbaya+Hotel/@-7.6795402,111.2326438,17z/data=!3m1!4b1!4m5!3m4!1s0x2e798e87ce2f819f:0x4bfb15fbb38e05a9!8m2!3d-7.6795402!4d111.2348325'); return false;" class="btn_1 outline">Rute ke Lokasi</a></span></li>
                              <li><span><a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModalCenter" class="btn_1 outline">Biaya Menginap</a></span></li>
                            </ul>
                        </center>
                        </div>
                      </div>
                  </div>
                </div>
              </section>
            </div>
        </div>
      </div>

      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Biaya</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Untuk biaya permalam kamar <?= $kamar['nama_kamar'] ?> adalah <?= $kamar['biaya'] ?> / Malam 
            </div>
          </div>
        </div>
      </div>


      <header style="background-color: #d14b0a;">
         <!-- header inner -->
         <div class="row">
            <div class="container">
               <div class="row" style="background-color: #d14b0a;">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9" style="background-color: #d14b0a;">
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
                                 <a class="nav-link" href="<?= base_url() . '/' . 'Frontend/Frontend'; ?>#kamar">Kamar</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="<?= base_url() . '/' . 'Frontend/Frontend'; ?>#wisata">Wisata Terdekat</a>
                              </li>
                           </ul>
                           <?php if ($session->get('status_login') == 'customer') { ?>
                              <div class="sign_btn"><a href="<?= base_url('Customer/Dashboard'); ?>"><?= $session->get('username_login'); ?></a></div>
                           <?php } else { ?>
                              <div class="sign_btn"><a href="<?= base_url('Login'); ?>">Login</a></div>
                           <?php } ?>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>

      <section style="padding-top: 60px;">
          <div class="container">
              <div class="row" style="padding-top: 20px;">
                  <div class="col-md-7">
                      <div class="row">
                          <div class="col-md-12" style="padding-top: 10px;">
                            	<h2>Deskirpsi : </h2>
                              <p style="text-align: justify;">  
                                <?= $kamar['deskripsi'] ?>  </p>
                          </div>
                      </div>
                      <div class="row">
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
                      <?php if (count($fasilitas) != null) { ?>
                      <div class="row">
                          <div class="col-md-12">
                            <h2><i class='fa fa-hotel'></i> Fasilitas</h2>
                            <div class="">
                              <ul style='word-break: break-word;'>
                                <?php foreach ($fasilitas as $item) { ?>
                                  <li> - <?= $item['nama_fasilitas']; ?></li>
                                <?php } ?>
                              </ul>
                            </div>
                          </div>
                      </div>
                      <?php } ?>
                      <div class="row">
                          <div class="col-md-12">
                          	<h2><i class="fa fa-image"></i> Galeri</h2>
                          	<div class="pictures_grid magnific-gallery clearfix">
                          		<?php foreach ($foto as $item) { ?>
              									<figure><a href="<?= base_url() . '/' . $item['nama_foto'] ?>" title="Foto Hotel Purbaya" data-effect="mfp-zoom-in"><img src="<?= base_url() . '/' . $item['nama_foto'] ?>" alt=""></a></figure>
              								<?php } ?>
              							</div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                            <h2><i class="fa fa-map-marker"></i> Lokasi</h2>
                            <div class="pictures_grid magnific-gallery clearfix">
                              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.1044759537126!2d111.21650181419785!3d-7.671916378061466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798e9e0ba4721f%3A0x3c5dbc151c888349!2sPurboyo%20Hotel!5e0!3m2!1sen!2sid!4v1653579980321!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-5">
             <?php if ($session->get('status_login') == 'customer') { ?>
              <form action="<?php echo base_url('Frontend/Pemesanan/add_detail_pemesanan'); ?>" method="post" data-parsley-validate="true">
                <?= csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pemesanan </h5>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="input_kamar" id="input_kamar" value="<?= $kamar['id_kamar'] ?>">

                            <div class="form-group">
                                <label>Biaya Kamar/malam</label>
                                <input type="text" name="input_biaya" id="input_biaya" class="form-control" readonly="" value="<?= $kamar['biaya']?>">
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
      </section>

      <footer id="contact">
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>Copyright 2021 All Right Reserved By <a href="https://html.design/"> Hotel Purbaya</a></p>
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
      <script src="<?= base_url() ?>/docs/dashboard/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
      <!-- <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script> -->

      
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
      </script>
   </body>
</html>

