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
         <div class="header" style="background-color: #da6717;">
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
                                 <a class="nav-link" href="<?= base_url() . '/' . 'Frontend/Frontend'; ?>#kamar">Kamar</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="<?= base_url() . '/' . 'Frontend/Frontend'; ?>#wisata">Wisata Terdekat</a>
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

      <section style="padding-top: 110px;">
          <div class="container">
              <div class="row" style="padding-top: 20px; height: 330px;">
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
          </div>
      </section>

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
      </script>
   </body>
</html>