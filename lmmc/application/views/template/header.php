<!DOCTYPE html>
<html lang="en" class="app">

<head>
  <meta charset="utf-8" />
  <title>LMMC ULM</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/data/images/logo-unlam2.png" />
  <meta name="google" value="notranslate">
  <meta name="description" content="lmmc" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/animate.css" type="text/css" />
  <!-- <link rel="stylesheet" href="https://portal.ulm.ac.id/assets/css/animate.css" type="text/css" /> -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/icon.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/font.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/app.css" type="text/css" />
  <!-- <link rel="stylesheet" href="https://portal.ulm.ac.id/assets/css/app.css" type="text/css" /> -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/costum.css" type="text/css" />
  <!-- <link rel="stylesheet" type="text/css" href="http://localhost/Template/themeforest-7016215-scale-web-application-admin-template/src/css/app.css"> -->

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/js/calendar/bootstrap_calendar.css" type="text/css" />
  <script src="<?php echo base_url(); ?>assets/data/js/jquery.min.js"></script>
  <!--dropdown -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/js/typehead/typehead.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/js/chosen/chosen.css" type="text/css" />
  <!-- DATA TABLES -->
  <link href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/data/js/datatables/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
  <!-- Upload -->
  <link href="<?php echo base_url(); ?>assets/data/js/upload/upload.css" rel="stylesheet" type="text/css" />
  <!--Datepicker-->
  <link href="<?php echo base_url(); ?>assets/data/js/datepicker/datepicker.css" rel="stylesheet" type="text/css" />
  <!--Datetimepicker-->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" media="print" href="<?php echo base_url("assets/css/print.media.css"); ?>" type="text/css" />
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.css" rel="stylesheet" type="text/css" />

  <!-- tinyMCE -->
  <script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/tinymce.dev.js"></script>
  <script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/plugins/table/plugin.dev.js"></script>
  <script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/plugins/paste/plugin.dev.js"></script>
  <script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/plugins/wordcount/plugin.js"></script>
  <script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/plugins/spellchecker/plugin.dev.js"></script>

  <!-- sweet -->
  <script src="<?php echo base_url('assets/sweet/sweetalert2.min.js'); ?>"></script>
  <link rel="stylesheet" href="<?php echo base_url('assets/sweet/sweetalert2.min.css'); ?>">
  <script src="<?= base_url('assets/js/vue.js'); ?>"></script>

  <!-- file input -->
  <link href="<?php echo base_url(); ?>assets/css/fileinput.min.css" rel="stylesheet" type="text/css" />


  <!--[if lt IE 9]>
    <script src="data/js/ie/html5shiv.js"></script>
    <script src="data/js/ie/respond.min.js"></script>
    <script src="data/js/ie/excanvas.js"></script>
  <![endif]-->
  <style>
    .text-wrap {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 100px;
    }

    .img-circle2 {
      border-top-left-radius: 50% 50%;
      border-top-right-radius: 50% 50%;
      border-bottom-right-radius: 50% 50%;
      border-bottom-left-radius: 50% 50%;
      object-fit: cover;
      height: 192px;
      width: 192px;
    }
  </style>
</head>
<script>
  $(document).ready(function() {
    $("#upload-xls").hide();
  });

  function myFunction() {
    $(".slimScrollBar").setAttribute('style', 'top : 160px ;');
  }
</script>

<body class="">
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html"><i class="fa fa-bars"></i></a>
        <a href="#" class="navbar-brand">
          <img src="<?php echo base_url(); ?>assets/data/images/logo-unlam2.png" class="m-r-sm" alt="scale">
          <span class="hidden-nav-xs text-center-nav-xs">LMMC ULM</span>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user"><i class="fa fa-cog"></i></a>
      </div>
      <a href="#nav" data-toggle="class:nav-xs" class="btn-navku hidden-xs btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs"><i class="i i-grid icon"></i></a>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">

        <li class="hidden-xs">
          <div style="margin : 20px">
            <span class="" style="display: inline-block;">

              <a class="auto" href="<?php echo base_url('jalur_masuk'); ?>" data-placement="left" data-toggle="tooltip" title="Jalur Masuk">
                <i class="i i-settings" style="margin-right:3px;">

                </i>
                <?php echo $jalur ?>
              </a>
            </span>
          </div>
        </li>
        <li class="dropdown hidden-lg hidden-md hidden-sm">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-top : -50px">
            <span class="thumb-sm avatar pull-left" style="margin-bottom : 5px">
              <img src="<?php echo base_url(); ?>assets/data/images/no_pict.png" alt="tidak ada gambar">
            </span>
          </a>
          <ul class="dropdown-menu animated fadeInRight m-t-xs" style="margin-top :55px;">

            <li>
              <span class="arrow top hidden-nav-xs"></span>
              <a href="<?php echo base_url("user/ubah_password"); ?>"><i class="i i-cog2"></i><span> Ubah Password</span></a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="<?php echo ($this->config->item('saml_sp_active') ? base_url('saml/slo') : base_url('login/keluar')); ?>"><i class="i i-logout"></i><span> Logout</span></a>
            </li>
          </ul>
        </li>
        <li class="dropdown hidden-xs logout">
          <a href="<?php echo ($this->config->item('saml_sp_active') ? base_url('saml/slo') : base_url('login/keluar')); ?>"><i style="color : white" class="i i-logout"></i><span style="color : white"> LOGOUT</span></a>
        </li>
      </ul>
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black aside-md hidden-print hidden-xs" id="nav">
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railopacity="0.2">
                <div class="clearfix wrapper dk nav-user hidden-xs">
                  <div class="dropdown text-center">
                    <div href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb avatar pull-left m-r">
                        <img src="<?php echo base_url(); ?>assets/data/images/no_pict.png" alt="tidak ada gambar">
                        <i class="on md b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear text-left">
                        <span class="block m-t-xs" style="margin : 8px 0px 0px 0px">
                          <strong class="font-bold text-lt"><?php echo $this->session->user['nama']; ?></strong>
                        </span>
                        <span class="text-muted text-xs block"><?php echo $this->session->user['username']; ?></span></span>
                    </div>
                  </div>
                </div>
                <?php
                //                    $this->load->model('permohonan/Permohonan_m');
                $role = $this->session->user['role'];
                $notifPermohonan = 0; //$this->Permohonan_m->getNotif($role);

                // if($role == "superadmin" || $role == 'ptik')
                $this->load->view('template/menu_side', array('notifPermohonan' => $notifPermohonan));
                // elseif($role == "admin_univ" || $role == 'admin_bak' || $role == 'admin_ult' || $role == 'lainnya'){
                //     $this->load->view('template/menu_side_admin_univ',array('notifPermohonan'=>$notifPermohonan));
                // }elseif($role == "admin_fakul" || $role == "dekan"){
                //     $this->load->view('template/menu_side_admin_fakul',array('notifPermohonan'=>$notifPermohonan));
                // }elseif($role == "operator" || $role == "absensi" || $role == "kaprodi"){
                //     $this->load->view('template/menu_side_operator',array('notifPermohonan'=>$notifPermohonan));
                // }elseif($role == "alumni"){
                //     $this->load->view('template/menu_side_alumni',array('notifPermohonan'=>$notifPermohonan));
                // }elseif($role == "keuangan"){
                //     $this->load->view('template/menu_side_keuangan',array('notifPermohonan'=>$notifPermohonan));
                // }
                ?>
              </div>
            </section>
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <!--<a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs"><i class="fa fa-sign-out"></i></a>-->
            </footer>
          </section>
        </aside>
        <!-- /.aside -->