<!DOCTYPE html>
<html lang="en" >
<head>  
  <meta charset="utf-8" />
  <title>SIA ULM</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/data/images/logo-unlam2.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/animate.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/icon.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/font.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/app.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/main/css/style.css" type="text/css" />  
    <!--[if lt IE 9]>
    <script src="data/js/ie/html5shiv.js"></script>
    <script src="data/js/ie/respond.min.js"></script>
    <script src="data/js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<style>
    body{
        background-color: #f1f2f2; 
    }
    .svg {
        
        height: 25%;
        width: 25%;
    }
    .text-center {
        color : #D7D7D7 ;
    }
    .cp {
        position: absolute ;
        top : 92% ;
        text-align: center ;
        color : #D7D7D7 ;
    }
    .count {
/*        position: absolute ;
        top : 50% ;*/
    }
/*    .up {
        background-color: #f1f2f2;
        height: 50%;
        width: 100%;
        top : 0px;
        position: absolute ;
    }
    .bot{
        
        background-color: #f1f2f2;
        height: 50%;
        top : 50%;
        width: 100%;
        position: absolute ;
        left: 0%;
        margin-top: 10px;
    }*/
    .space {
        bottom: 0px;
        position: absolute;
    }
    @media screen and (max-width : 767px) {
        .space {
            bottom: 0px;
            position: absolute;
        }
        .svg {
            height: 85%;
            width: 85%;
        }
        #content {
            margin-top: 15%;
        }
    }
    #content {
        margin-top: 2%;
    }
    h1,h2,h3,h4,h5,h6 {
        color : #58595b ;
    }
    h4{
        font-size: 17px;
    }
    .sp2{
        top : 200px;
        position: relative;
    }
</style>
<body>
    <section id="content">
    <div class="row m-n up">
      <div class="col-xs-12">
        <div class="text-center">
            <img class="svg" src="<?php echo base_url(); ?>assets/images/contruct3.svg">
            <h3 style="margin-top : 0px; margin-bottom: 25px;" class="hidden-xs">
                Maaf, Website Sedang Maintenance.
            </h3>
            <h4 style="margin-top : 0px; margin-bottom: 5px;" class="hidden-lg hidden-md hidden-sm">
                Maaf, Website Sedang Maintenance.
            </h4>
             <!--Timer-->
    <div class="clockdiv bot col-xs-12" id="jam">
        <div>
          <span class="days"></span>
          <div class="smalltext">HARI</div>
        </div>
        <div>
          <span class="hours"></span>
          <div class="smalltext">JAM</div>
        </div>
        <div>
          <span class="minutes"></span>
          <div class="smalltext">MENIT</div>
        </div>
        <div>
          <span class="seconds"></span>
          <div class="smalltext">DETIK</div>
        </div>
    </div>
        </div>
      </div>
    </div>
   
    <div class="col-xs-12 cp">
        <small style="color :  #58595b">UPT PTIK ULM &copy; 2016</small>
    </div>
  </section>
  <!-- footer -->

  <!-- / footer -->
  <script src="<?php echo base_url(); ?>assets/data/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url(); ?>assets/data/js/bootstrap.js"></script>
  <!-- App -->
  <script src="<?php echo base_url(); ?>assets/data/js/app.js"></script>  
  <script src="<?php echo base_url(); ?>assets/data/js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/data/js/app.plugin.js"></script>
  <script src="<?php echo base_url(); ?>assets/main/js/index.js"></script>
</body>
</html>