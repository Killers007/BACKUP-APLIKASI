<?php
$name = $this->router->fetch_method();
if ($changeAsuransi) {
  if ($name == 'asuransi_kesehatan') {
    show_404();
  }
}
?>
<!DOCTYPE html>

<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <meta name="description" content="Name of your web site">
  <meta name="author" content="Marketify">

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <title>Portal Administrasi Tes Kesehatan - </title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/data/images/logo-unlam2.png" />
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.css" rel="stylesheet" type="text/css" />
  <!-- STYLES -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/mecha/css/font/roboto.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/mecha/css/font/raleway.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/mecha/css/font/mont.css') ?>" />

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/mecha/css/plugins.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/mecha/css/style5.css') ?>" />
  <!-- /STYLES -->

  <!-- JS -->
  <script src="<?php echo base_url('assets/mecha/js/jquery.js') ?>"></script>
  <script src="<?php echo base_url('assets/mecha/js/plugins.js') ?>"></script>
  <script src="<?php echo base_url('assets/mecha/js/init.js') ?>"></script>
  <!-- Toastr -->
  <script src="<?php echo base_url('assets/plugins/toastr/toastr.js'); ?>"></script>

  <!-- bootstrap datepicker -->
  <script src="<?php echo base_url('assets/mecha/js/bootstrap-datepicker.js') ?>"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/mecha/css/bootstrap-datepicker3.min.css') ?>" />

  <!-- <script src="http://malsup.github.com/jquery.form.js"></script> -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/bootstrap.min.css" type="text/css" />
  <style>
    .product-wrapper {
      width: 400px;
      height: 400px;
      margin: 0 auto;
    }

    .pad_bot {
      padding: 10px 0 10px 0;
    }

    .no_pad {
      padding: 0 0 0 0;
    }

    .no_mar {
      margin: 0;
    }

    .font_raleway {
      font-size: 20px;
    }

    .responsive_img {
      max-width: 10%;
      height: auto;
    }

    .valign {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
    }

    .details {
      padding: 0px 25px 0px 25px !important;
    }

    @media (min-width: 481px) {

      .isipad {
        padding: 0 100px 0 100px !important;
      }
    }

    a.a_white:hover {
      color: white !important;
    }
  </style>
</head>

<body>

  <!-- PRELOADER -->
  <!-- <div class="arlo_tm_preloader">
		<div class="spinner_wrap">
			<div class="spinner"></div>
		</div>
	</div> -->
  <!-- /PRELOADER -->


  <!-- WRAPPER ALL -->
  <div class="arlo_tm_all_wrap">
    <div class="wrapper_inner">
      <?php
      $nav = [];
      if ($this->session->userdata('user')) {
        $nav = array_merge(
          $nav,
          array(
            'beranda' => 'Beranda',
            'biodata' => 'Biodata',
            'asuransi_kesehatan' => 'Asuransi Kesehatan',
            'administrasi' => 'Administrasi',
            'panduan' => 'Panduan Tes Kesehatan',
            'pengumuman' => 'Pengumuman',
            'logout' => "Logout"
          )
        );

        if ($changeAsuransi) {
          unset($nav[3]);
        }
      } else {
        $nav = array_merge(
          $nav,
          array(
            'panduan' => 'Panduan',
            'masuk' => "Masuk"
          )

        );
      }
      ?>

      <!-- Topbar -->
      <div class="arlo_tm_topbar">
        <div class="topbar_inner">
          <div class="container">
            <div class="topbar_in text-center">
              <div class="logo">
                <a href="#"><img class="responsive_img" src="<?php echo base_url('assets/mecha/img/logo/logo_ulm.png') ?>" alt="" /></a>
              </div>

            </div>
            <div class="text-center">
              <?php
              foreach ($nav as $link => $n) {
                // echo '<a style=" color:#333333;font-size:20px;" href="#about" onclick="req_v(\'' . strtolower($n) . '\')">' . $n . '</a>&nbsp&nbsp';
                echo '<a style=" color:#333333;font-size:20px;" href="' .  base_url('peserta') . "/" . $link . '">' . $n . '</a>&nbsp&nbsp';
              }
              ?>
            </div>
          </div>
        </div>

      </div>
      <!-- /Topbar -->

      <!-- LEFTPART -->
      <div class="arlo_tm_leftpart" id="mySidebar">
        <div class="inner">
          <div class="text-center">
            <a class="dark" href="#"><img style="width:75%;height:auto;" src="<?php echo base_url('assets/mecha/img/logo/logo_ulm.png') ?>" alt="" /></a>
          </div>
          <br>
          <div class="menu scrollable">
            <center>
              <ul>
                <?php


                foreach ($nav as $link => $n) {
                  if ($link == $navi) {
                    echo '<li><a style="color:#d81500" href="' . base_url('peserta') . '/' . $link . '">' . $n . '</a></li>';
                  } else {
                    echo '<li><a href="' . base_url('peserta') . '/' . $link . '">' . $n . '</a></li>';
                  }
                  // echo '<li><a href="#home" onclick="req_v(\'' . strtolower($n) . '\')">' . $n . '</a></li>';
                }
                ?>
              </ul>
            </center>
          </div>
          <br>

          <!-- <p><b>PORTAL ADM-KES © LMMC ULM</b></p> -->
          <div class="social" style="margin-top:300px !important;">
            <p><b>PORTAL ADM-KES © LMMC ULM</b></p>
          </div>

          <div class="bottom">
            <div class="social">
              <!-- <p><b>PORTAL ADM-KES © LMMC ULM</b></p> -->
              <!-- <ul>
							<li><a href="#"><i class="xcon-facebook"></i></a></li>
							<li><a href="#"><i class="xcon-twitter"></i></a></li>
							<li><a href="#"><i class="xcon-linkedin"></i></a></li>
							<li><a href="#"><i class="xcon-instagram"></i></a></li>
							<li><a href="#"><i class="xcon-behance"></i></a></li>
						</ul> -->
            </div>
          </div>
          <div class="resize" id="mys" onclick="sidebarStatus()" value="1">
            <a href="#" id="navcol"><span></span></a>
          </div>
        </div>
      </div>
      <!-- /LEFTPART -->

      <!-- RIGHTPART -->
      <div class="arlo_tm_rightpart">
        <div class="rightpart_inner" id="rightpart">