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
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
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
                                 <a class="nav-link" href="#about">Tentang</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#contact">Hubungi Kami</a>
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
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
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
      <!-- end banner -->
      <!-- form_lebal -->
      <section>
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <form class="form_book">
                     <div class="row">
                        <div class="col-md-3">
                           <label class="date">Tanggal Masuk</label>
                           <input class="book_n"  type="date" >
                        </div>
                        <div class="col-md-3">
                           <label class="date">Tanggal Keluar</label>
                           <input class="book_n"  type="date" >
                        </div>
                        <div class="col-md-3">
                           <label class="date">Tipe Kamar</label>
                           <input class="book_n" placeholder="2" type="type" name="2">
                        </div>
                        <div class="col-md-3">
                           <button class="book_btn">Booking Sekarang</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>
      <!-- end form_lebal -->
      <!-- choose  section -->
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
      <!-- end choose  section -->
      <!-- our  section -->
      <div class="our">
         <div class="container">
            <div class="row d_flex">
               <div class="col-md-6">
                  <div class="img_box">
                     <figure><img src="<?= base_url() ?>/docs/frontend/images/img4.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="our_box">
                     <div class="titlepage">
                        <h2><span class="text_norlam">Hidangan Sarapan </span> <br>Terbaik</h2>
                     </div>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit </p>
                     <a class="read_more" href="#">Lihat Selengkapnya</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end our  section -->
      <!-- about -->
      <div id="about"  class="about">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-md-6">
                  <div class="about_text">
                     <div class="titlepage">
                        <h2>Hotel Purbaya</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="about_img">
                     <figure><img src="<?= base_url() ?>/docs/frontend/images/about_img.jpg" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end about -->
      <!-- testimonial -->
      <div class="testimonial">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Testimonial</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div id="myCarousel" class="carousel slide testimonial_Carousel " data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                     </ol>
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <div class="container">
                              <div class="carousel-caption ">
                                 <div class="row">
                                    <div class="col-md-6 margin_boot">
                                       <div class="test_box">
                                          <h4>Mark jonson</h4>
                                          <i><img src="<?= base_url() ?>/docs/frontend/images/te1.png" alt="#"/></i>
                                          <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,</p>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="test_box">
                                          <h4>Mac Du</h4>
                                          <i><img src="<?= base_url() ?>/docs/frontend/images/te1.png" alt="#"/></i>
                                          <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="container">
                              <div class="carousel-caption">
                                 <div class="row">
                                    <div class="col-md-6 margin_boot">
                                       <div class="test_box">
                                          <h4>Mark jonson</h4>
                                          <i><img src="<?= base_url() ?>/docs/frontend/images/te1.png" alt="#"/></i>
                                          <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,</p>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="test_box">
                                          <h4>Mac Du</h4>
                                          <i><img src="<?= base_url() ?>/docs/frontend/images/te1.png" alt="#"/></i>
                                          <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="container">
                              <div class="carousel-caption">
                                 <div class="row">
                                    <div class="col-md-6 margin_boot">
                                       <div class="test_box">
                                          <h4>Mark jonson</h4>
                                          <i><img src="<?= base_url() ?>/docs/frontend/images/te1.png" alt="#"/></i>
                                          <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,</p>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="test_box">
                                          <h4>Mac Du</h4>
                                          <i><img src="<?= base_url() ?>/docs/frontend/images/te1.png" alt="#"/></i>
                                          <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                     <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                     <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end testimonial -->
      <!--  footer -->
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
                        <p>Copyright 2019 All Right Reserved By <a href="https://html.design/"> Free Html Templates</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="<?= base_url() ?>/docs/frontend/js/jquery.min.js"></script>
      <script src="<?= base_url() ?>/docs/frontend/js/popper.min.js"></script>
      <script src="<?= base_url() ?>/docs/frontend/js/bootstrap.bundle.min.js"></script>
      <script src="<?= base_url() ?>/docs/frontend/js/jquery-3.0.0.min.js"></script>
      <script src="<?= base_url() ?>/docs/frontend/js/plugin.js"></script>
      <!-- sidebar -->
      <script src="<?= base_url() ?>/docs/frontend/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="<?= base_url() ?>/docs/frontend/js/custom.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
   </body>
</html>

