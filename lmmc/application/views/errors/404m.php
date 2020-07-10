<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>  
  <meta charset="utf-8" />
  <title>Scale | Web Application</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/animate.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/icon.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/font.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/data/css/app.css" type="text/css" />  
    <!--[if lt IE 9]>
    <script src="data/js/ie/html5shiv.js"></script>
    <script src="data/js/ie/respond.min.js"></script>
    <script src="data/js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<?php
    $this->load->library("sia");
    $fakultas = $this->sia->getFakultas($this->session->user['fakultas']) ;
    $prodi = $this->sia->getProdi($this->session->user['prodi']);
?>
<body class="" >
    <section id="content">
    <div class="row m-n">
      <div class="col-sm-4 col-sm-offset-4">
        <div class="text-center m-b-lg">
            <h3 class="text-white animated fadeInDownBig">
                Anda dilarang mengubah data ini 
                <br/> karena Login Sebagai <br/>
                Fakultas : <?php echo $fakultas['fakNamaResmi']; ?> <br/>
                Prodi   : <?php echo $prodi['prodiNamaResmi'];?>
            </h3>
        </div>
        <div class="list-group bg-info auto m-b-sm m-b-lg">
          <a href="index.html" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <i class="fa fa-fw fa-home icon-muted"></i> Goto homepage
          </a>
          <a href="#" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <i class="fa fa-fw fa-question icon-muted"></i> Send us a tip
          </a>
          <a href="#" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <span class="badge bg-info lt">021-215-584</span>
            <i class="fa fa-fw fa-phone icon-muted"></i> Call us
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder clearfix">
      <p>
        <small>Web app framework base on Bootstrap<br>&copy; 2013</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="<?php echo base_url(); ?>assets/data/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url(); ?>assets/data/js/bootstrap.js"></script>
  <!-- App -->
  <script src="<?php echo base_url(); ?>assets/data/js/app.js"></script>  
  <script src="<?php echo base_url(); ?>assets/data/js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/data/js/app.plugin.js"></script>
</body>
</html>
