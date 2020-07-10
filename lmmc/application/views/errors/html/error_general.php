<!DOCTYPE html>
<?php
if (isset($_SERVER['HTTP_HOST']) && preg_match('/^((\[[0-9a-f:]+\])|(\d{1,3}(\.\d{1,3}){3})|[a-z0-9\-\.]+)(:\d+)?$/i', $_SERVER['HTTP_HOST']))
{
	$base_url = (is_https() ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST']
  .substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], basename($_SERVER['SCRIPT_FILENAME'])));
}
else
{
	$base_url = 'http://localhost/';
}
?>
<html lang="en" class="bg-dark">
<head>  
  <meta charset="utf-8" />
  <title>SIMARI - Warning</title>
  <link rel="shortcut icon" href="<?php echo $base_url; ?>assets/data/images/logo-unlam.png" />
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet"  href="<?php echo $base_url; ?>assets/data/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo $base_url; ?>assets/data/css/animate.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo $base_url; ?>assets/data/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo $base_url; ?>assets/data/css/icon.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo $base_url; ?>assets/data/css/font.css" type="text/css" />
  <link rel="stylesheet"  href="<?php echo $base_url; ?>assets/data/css/app.css" type="text/css" />  
    <!--[if lt IE 9]>
    <script src="data/js/ie/html5shiv.js"></script>
    <script src="data/js/ie/respond.min.js"></script>
    <script src="data/js/ie/excanvas.js"></script>
    <![endif]-->
  </head>
  <body class="" >
    <section id="content">
      <div class="row"  style="margin-top:5%;">
        <div class="col-sm-2 col-sm-offset-5">
          <img src="<?php echo $base_url;?>/assets/images/warning.png" class="img img-responsive" />
        </div>
        
        <div class="col-sm-4 col-sm-offset-4">
          <div class="text-center alert bg-info " style="font-size: 18px;color:#FFF">
            <?php echo $message; ?>
          </div>       
          <div class="list-group bg-info auto m-b-sm m-b-lg">
            <a href="#" onclick="window.history.back();" class="list-group-item">
              <i class="fa fa-arrow-left icon-muted"></i> Kembali
            </a>
            <a href="<?php echo $base_url;?>" class="list-group-item">
              <i class="fa fa-fw fa-home icon-muted"></i> Halaman Utama
            </a>
            
          </div>
        </div>
      </div>
    </section>
    <!-- footer -->
    <footer id="footer">
      <div class="text-center padder clearfix">
        <p>
          <small>SIMARI &copy; 2016</small>
        </p>
      </div>
    </footer>
    <!-- / footer -->
    <script src="<?php echo $base_url; ?>assets/data/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $base_url; ?>assets/data/js/bootstrap.js"></script>
    <!-- App -->
    <script src="<?php echo $base_url; ?>assets/data/js/app.js"></script>  
    <script src="<?php echo $base_url; ?>assets/data/js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo $base_url; ?>assets/data/js/app.plugin.js"></script>
  </body>
  </html>
