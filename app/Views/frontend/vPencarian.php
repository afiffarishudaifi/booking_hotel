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

    <style>
        .nice-select{
          display: none;
        }
        .act-btn{
              background:#e28743;
              display: block;
              width: 50px;
              height: 50px;
              line-height: 50px;
              text-align: center;
              color: white;
              font-size: 30px;
              font-weight: bold;
              border-radius: 50%;
              -webkit-border-radius: 50%;
              text-decoration: none;
              transition: ease all 0.3s;
              position: fixed;
              right: 30px;
              bottom:30px;
            }
        .act-btn:hover{background: #eab676}

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

      <section>
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                    <div class="row form_book">
                    </div>
               </div>
            </div>
         </div>
      </section>

      <section style="padding-top: 110px;">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <center>
                          <h1>Hasil Pencarian</h1>
                      </center>
                  </div>
              </div>
              <div class="row" style="padding-top: 20px; height: 330px;">
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
                  <?php foreach ($kamar as $item) { ?>
                  <div class="col-md-3" style="height: 400px;">
                      <div class="row" style="height: 150px;">
                          <div class="col-md-12">
                              <img src="<?= base_url() . '/' . $item['nama_foto'] ?>" style="height: 150px;">
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12" style="padding-top: 10px;">
                              <h4><b><?= $item['nama_kamar'] ?></b></h4>
                              <p style="text-align: justify;"> Harga : <?= $item['biaya'] ?>/Malam<br>
                              Kategori Kamar : <?= $item['nama_kategori'] ?><br>
                              Status Kamar : Kosong</p><br>
                              <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="detail(<?= $item['id_kamar']; ?>)" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn_1 outline">Detail</a>

                                 <a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="detail_pesan(<?= $item['id_kamar']; ?>)" data-toggle="modal" data-target=".bd-example-modal-lg-pesan" class="btn_1 outline">Pesan</a>
                          </div>
                      </div>
                  </div>
                  <?php }
               } ?>
              </div>
          </div>
      </section>

      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

          <div class="modal-content">
            
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Detail Kamar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
              <section style="padding-bottom: 20px;">
                <div class="container">
                    <div class="row" style="padding-left: 20px; padding-right: 20px;">
                        <div class="col-md-12">
                            <div class="row" style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
                                <div class="col-md-12" style="padding-top: 10px;">
                                    <h2>Deskirpsi : </h2>
                                    <p style="text-align: justify;" id="text_deskripsi">  
                                      </p>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
                                <div class="col-md-12">
                                 <h2></i> Informasi</h2>
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
                                  <h2>Fasilitas</h2>
                                  <div class="">
                                    <ul style='word-break: break-word;' id="text_fasilitas">
                                    </ul>
                                  </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="row" style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
                                <div class="col-md-12">
                                  <h2>Galeri</h2>
                                  <div class="pictures_grid magnific-gallery clearfix" id="wrapper-foto">
                                  </div>
                                </div>
                            </div>
                            <div class="row"  style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
                                <div class="col-md-12">
                                  <h2></i> Lokasi</h2>
                                  <div class="pictures_grid magnific-gallery clearfix">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.1044759537126!2d111.21650181419785!3d-7.671916378061466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798e9e0ba4721f%3A0x3c5dbc151c888349!2sPurboyo%20Hotel!5e0!3m2!1sen!2sid!4v1653579980321!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
          </div>
        </div>
      </div>

      <div class="modal fade bd-example-modal-lg-pesan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

          <div class="modal-content">
            
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Pemesanan Kamar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <section>
                <div class="container">
                    <div class="row" style="padding-top: 20px; padding-bottom: 20px">
                         <div class="col-md-12">
                            <?php if ($session->get('status_login') == 'customer') { ?>
                             <form action="<?= base_url('Frontend/Pemesanan/add_detail_pemesanan'); ?>" method="post" data-parsley-validate="true" autocomplete="off">
                               <?= csrf_field(); ?>
                               <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                       <div class="modal-body">

                                           <input type="hidden" name="input_kamar" id="input_kamar">
                                           <input type="hidden" name="total_pengunjung" id="total_pengunjung">

                                           <div class="form-group">
                                               <label>Biaya Kamar/malam</label>
                                               <input type="text" name="input_biaya" id="input_biaya" class="form-control" readonly="" value="">
                                           </div>

                                           <div class="form-group">
                                               <label>Nama Pengguna</label>
                                               <input type="hidden" value="<?= $session->get('user_id'); ?>" name="input_pengguna">
                                               <input type="text" name="" id="" class="form-control" readonly="" value="<?= $session->get('username_login'); ?>">
                                           </div>

                                           <div class="form-group">
                                               <label>Tanggal Masuk</label>
                                               <input type="date" class="form-control" id="input_masuk" name="input_masuk"  data-parsley-required="true" value="<?= date('Y-m-d'); ?>" onchange="get_result(this.value, $('#input_keluar').val())" min="<?= date('Y-m-d'); ?>">
                                           </div>

                                           <div class="form-group">
                                               <label>Lama Menginap</label>
                                              <div class="row">
                                                   <div class="col-md-3">
                                                      <select name="input_lama" id="input_lama" class="book_n" onchange="hitung_tanggal(this.value, $('#tipe_lama').val())">
                                                        <?php for($i = 1; $i <= 31; $i++){ ?>
                                                          <option value="<?= $i; ?>"><?= $i; ?></option>
                                                        <?php } ?>
                                                      </select>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <select name="tipe_lama" id="tipe_lama" class="book_n" onchange="hitung_tanggal($('#input_lama').val(), this.value)">
                                                        <option value="Hari">Hari</option>
                                                        <option value="Minggu">Minggu</option>
                                                        <option value="Bulan">Bulan</option>
                                                      </select>
                                                   </div>
                                              </div>
                                           </div>

                                           <div class="form-group">
                                               <label>Tanggal Keluar</label>
                                               <input type="date" class="form-control" id="input_keluar" readonly="" name="input_keluar"  data-parsley-required="true" value="<?= date('Y-m-d', strtotime("+1 day")); ?>" onchange="get_result($('#input_masuk').val(),this.value)">
                                           </div>

                                           <div class="form-group">
                                               <label>Tagihan Biaya</label>
                                               <input type="text" name="input_hasil_total" id="input_hasil_total" class="form-control"  readonly="">
                                           </div>

                                            <div id="wrapper-pengunjung"></div>

                                       </div>
                                       <div class="modal-footer">
                                           <button type="reset" class="btn btn-secondary" id="batal_add" data-dismiss="modal">Batal</button>
                                           <button type="submit" name="tambah" class="btn btn-primary">Pesan</button>
                                       </div>
                                   </div>
                               </div>
                             </form>

                           <?php } else { ?>
                             <center>
                               <h4>Anda harus sign in untuk dapat melakukan pemesanan</h4>
                               <a href="<?= base_url('Login'); ?>" class="btn btn-primary">Sign In</a>
                             </center>
                           <?php } ?>
                         </div>
                    </div>
                </div>
            </section>
          </div>
        </div>
      </div>

      <?php if ($session->get('status_login') != '') { ?>
        <a href="<?= base_url('Customer/Keranjang'); ?>" class="act-btn">
          <i class="fa fa-shopping-cart" alt="Keranjang" ></i>
        </a>
      <?php } ?>

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
         
        function detail(isi) {
            const wrapper = $("#wrapper-foto");
            $.getJSON('<?= base_url('Frontend/Pencarian/detail'); ?>' + '/' + isi, {},
                function(json) {              
                  var foto_cover = json.kamar.foto;
                    $('#id_tempat').val(json.id_tempat);
                    document.getElementById("text_deskripsi").innerHTML = "";
                    document.getElementById("text_deskripsi").textContent += json.kamar.deskripsi;

                    document.getElementById("text_fasilitas").innerHTML = "";
                    var ul = document.getElementById("text_fasilitas");
                    var li = document.createElement("li");
                    var panjang_fasilitas =  json.fasilitas.length;
                    for(i = 0; i < panjang_fasilitas ; i++) {
                      if (i == (panjang_fasilitas-1)) {
                        li.appendChild(document.createTextNode(json.fasilitas[i].nama_fasilitas));
                        ul.appendChild(li);
                      } else {
                        li.appendChild(document.createTextNode(json.fasilitas[i].nama_fasilitas  + ', '));
                        ul.appendChild(li);
                      }
                    }

                    $("#wrapper-foto").empty();
                    for( i = 1; i <= json.foto.length; i++) {
                        wrapper.append(
                            `<figure><a href="<?= base_url() . '/'?>${json.foto[i].nama_foto}" title="Foto Hotel Purbaya" data-effect="mfp-zoom-in"><img src="<?= base_url() . '/'?>${json.foto[i].nama_foto}" alt="" height="200" width="200"></a></figure>`
                        );
                    }
                });
        }

        function detail_pesan(isi) {
            const wrapper = $("#wrapper-pengunjung");
            $.getJSON('<?= base_url('Frontend/Pencarian/detail'); ?>' + '/' + isi, {},
                function(json) {
                    $('#input_biaya').val(json.kamar.biaya);
                    $('#input_hasil_total').val(json.kamar.biaya);
                    $('#input_kamar').val(json.kamar.id_kamar);
                    $('#total_pengunjung').val(json.kamar.isi);
                    $("#wrapper-pengunjung").empty();
                    for( i = 1; i <= json.kamar.isi; i++) {
                      if(i == 1) {
                        wrapper.append(
                            `<div class="form-group">
                               <label>Nama Pengguna ${i}</label>
                               <input type="text" name="input_pengunjung_${i}" id="" placeholder="Masukkan Nama" class="form-control" required>
                           </div>
                           <div class="form-group">
                               <label>Jenis Kelamin ${i}</label>
                                <select name="input_pengunjung_jenis_kelamin_${i}" class="form-control">
                                  <option value="Laki - Laki">Laki - Laki</option>
                                  <option value="Perempuan">Perempuan</option>
                                </select>
                           </div>`
                        );
                      } else {
                        wrapper.append(
                            `<div class="form-group">
                               <label>Nama Pengguna ${i}</label>
                               <input type="text" name="input_pengunjung_${i}" id="" placeholder="Masukkan Nama" class="form-control">
                           </div>
                           <div class="form-group">
                               <label>Jenis Kelamin ${i}</label>
                                <select name="input_pengunjung_jenis_kelamin_${i}" class="form-control">
                                  <option value="Laki - Laki">Laki - Laki</option>
                                  <option value="Perempuan">Perempuan</option>
                                </select>
                           </div>`
                        );
                      }
                    }
                });
        }

        function hitung_tanggal(lama, type) {
            var default_tipe;

            if(type == 'Hari') {
              default_tipe = 1;
            } else if(type == 'Minggu') {
              default_tipe = 7;
            } else {
              default_tipe = 30;
            }

            var tanggal_awal = new Date($('#input_masuk').val());
            var total_tanggal = tanggal_awal.setDate(tanggal_awal.getDate() + (lama*default_tipe));

            var tanggal_awal = new Date($('#input_masuk').val());
            var tanggal_baru = new Date(tanggal_awal);

            tanggal_baru.setDate(tanggal_baru.getDate() + (lama*default_tipe)); // minus the date

            var nd = new Date(tanggal_baru);
            // console.log($('#input_masuk').val(dateFormat(nd, 'Y-m-d')));
            $('#input_keluar').val(dateFormat(nd, 'Y-m-d'));

            akhir = dateFormat(nd, 'Y-m-d');
            masuk = $('#input_masuk').val();

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

        function dateFormat(inputDate, format) {
            //parse the input date
            const date = new Date(inputDate);

            //extract the parts of the date
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();    

            //replace the month
            format = format.replace("m", month.toString().padStart(2,"0"));        

            //replace the year
            if (format.indexOf("Y") > -1) {
                format = format.replace("Y", year.toString());
            } else if (format.indexOf("yy") > -1) {
                format = format.replace("yy", year.toString().substr(2,2));
            }

            //replace the day
            format = format.replace("d", day.toString().padStart(2,"0"));

            return format;
        }

        function get_result(masuk, akhir) {
            document.getElementById("input_lama").selectedIndex = 0;
            document.getElementById("tipe_lama").selectedIndex = 0;
            $('#input_keluar').val(new Date('Y-m-d'));

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

