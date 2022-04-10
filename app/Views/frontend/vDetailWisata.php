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

      <!-- google maps -->
      <script src="http://maps.googleapis.com/maps/api/js"></script>

      <script>
            // fungsi initialize untuk mempersiapkan peta
            function initialize() {
            var propertiPeta = {
                center:new google.maps.LatLng(-8.5830695,116.3202515),
                zoom:9,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            
            var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
            }

            // event jendela di-load  
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>

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
          background: url('<?= base_url('docs/img/img_tempat') . '/' . $wisata['foto'] ?>') center center no-repeat;
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
          background: url('<?= base_url('docs/img/img_tempat') . '/' . $wisata['foto'] ?>') center center no-repeat;
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
                           <a class="nav-link" href="<?= base_url() . '/' . 'Frontend/Frontend'; ?>#wisata">Wiata Terdekat</a>
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
                      <h1 class="fadeInUp"><span></span> <?= $wisata['nama_tempat'] ?></h1>

                      <div class="row">
                        <div class="col-md-12">
                        <center>
                        </center>
                        </div>
                      </div>
                  </div>
                </div>
              </section>
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
                                <?= $wisata['deskripsi'] ?>  </p>
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
                      <div class="row">
                          <div class="col-md-12">
                            <h2><i class="fa fa-map-marker"></i> Lokasi</h2>
                            <div class="pictures_grid magnific-gallery clearfix">
                              <?= $wisata['url_tempat'] ?>
                            </div>
                      </div>
                  </div>
              </div>
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
    }
      </script>
   </body>
</html>

