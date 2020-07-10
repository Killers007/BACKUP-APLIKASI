<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>SIA ULM</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/data/images/logo-unlam2.png"/>
    <meta name="description" content="Sistem Informasi Akademik ULM"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/icon.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/app.css" type="text/css"/>
    <!--[if lt IE 9]>
    <script src="data/js/ie/html5shiv.data/js"></script>
    <script src="data/js/ie/respond.min.data/js"></script>
    <script src="data/js/ie/excanvas.data/js"></script>
    <![endif]-->
    <!--slider-->
</head>
<style>
    .alert {
        margin: 0px 0px;
    }

    body {
        background-image: url(../assets/images/3.jpg);
        background-image: url(assets/images/3.jpg);
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    @media only screen and (max-width: 767px) {
        body {
            background-image: url(../assets/images/3.jpg);
            background-image: url(assets/images/3.jpg);
        }
    }

    ul {
        list-style-type: none;
    }

    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-top: 2%;
        width: 30%;
        height: 30%;
    }

    @media screen and (min-width: 767px) {
        #content {
            margin: 6% 5% 0% 0%;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 2%;
        }
    }

    @media screen and (max-width: 767px) {
        #content {
            margin: 0% 0% 0% 0%;
            /*background-color: rgba(0, 0, 0, 0.1);*/
            position: inherit;
            width: 100%;
            height: 100%;
            /*height: 600px;*/
            border-radius: 0%;
        }

        background {
            position: fixed;

        }
    }

    /*hover link*/
    .link_class {
        color: white;
    }

    .link_class:hover {
        color: #1bb399;
    }
</style>

<body class="">
<section id="content" class="m-t-lg wrapper-md animated fadeInUp pull-right">
    <div class="container aside-xl" style="">
        <div class="hidden-lg hidden-md hidden-sm" style="margin-top : 60px;"></div>
        <a class="navbar-brand block hidden-xs" style="color : #fff"><h4>Medical Center ULM</h4></a>
        <!-- <a class="navbar-brand block hidden-lg hidden-md hidden-sm" style="color : #fff"><h4>SIA ULM</h4></a> -->
        <img src="<?php echo base_url(); ?>assets/data/images/logo-unlam.png">
        <section class="m-b-lg">
            <header class="wrapper text-center ">
                <!--<span>Isikan Username dan Password</span>-->
            </header>
            <?php echo form_open(base_url(uri_string())); ?>
        
            <?php echo form_input('username', '', array("id" => "username", 'class' => 'form-control', 'placeholder' => 'Username')); ?><br>
            <?php echo form_password('password', '', array("id" => "password", 'class' => 'form-control', 'placeholder' => 'Password')); ?><br>
            <?php echo form_submit('Submit', 'Login', 'class="btn btn-lg btn-primary btn-block"'); ?>


            <!-- ?php echo form_submit('Submit', 'Fakultas', 'class="btn btn-lg btn-primary btn-block"'); ?>
            ?php echo form_submit('Submit', 'Prodi Pendidikan Dokter Gigi', 'class="btn btn-lg btn-primary btn-block"'); ?>
            ?php echo form_submit('Submit', 'Prodi Profesi Gigi', 'class="btn btn-lg btn-primary btn-block"'); ?> -->
            <div class="line line-dashed"></div>
            <!-- <p class="text-muted text-center"><small>Do not have an account?</small></p>
          <a href="signup.html" class="btn btn-lg btn-default btn-block">Create an account</a> -->
            <?php echo form_close(); ?>
        </section>
        <footer id="footer">
            <div class="text-center padder">
                <!--                         <p>
                             <small><a href="<?php echo base_url(); ?>login/developer" style="color : white">Lihat Pengembang</a></small>
                        </p>-->
                <p>
                    <small><a class="link_class" href="<?php echo base_url(); ?>login/developer">UPT PTIK ULM &copy;
                            2016</a></small>
                </p>
            </div>
        </footer>
    </div>
</section>
<!-- Script -->
<script src="<?php echo base_url(); ?>assets/data/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>assets/data/js/bootstrap.js"></script>
<!-- App -->
<script src="<?php echo base_url(); ?>assets/data/js/app.js"></script>
<script src="<?php echo base_url(); ?>assets/data/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/data/js/app.plugin.js"></script>
<!--Slider-->
<!--    <script src="<?php echo base_url(); ?>assets/data/js/sliderfull/data/js/modernizr.custom.86080.data/js"></script>-->
</body>
</html>