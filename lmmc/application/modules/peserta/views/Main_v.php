<!-- BERANDA -->
<div id="particles-js"></div>

<div class="arlo_tm_section" id="rightpart" hidden>
    <div class="arlo_tm_hero_header particle jarallax" data-speed="0.2">
        <div class="overlay"></div>
        <div class="hero_content">
            <!-- <div class="image_wrap">
								<img src="<?php echo base_url('assets/mecha/img/about/500x500.jpg') ?>" alt="" />
								<div class="main" data-img-url="<?php echo base_url('assets/mecha/img') ?>/logo/logo_ulm.png"></div>
							</div> -->
            <div class="name_holder">
                <h3>Halo <?php echo $dpes->pesertaNama; ?><br>
                    Selamat datang di <br> PORTAL ADMINISTRASI TES KESEHATAN</span></h3>
            </div>
            <!-- <hr style="color: 10px white;"> -->
            <div class="text_typing">
                <p>UNIVERSITAS LAMBUNG MANGKURAT</p>

                <!-- <p>I'm a <span class="arlo_tm_animation_text_word"></span></p> -->
            </div>
        </div>
        <div class="arlo_tm_arrow_wrap bounce anchor">
            <a href="#about"><i class="xcon-angle-double-down"></i></a>
        </div>
    </div>
    <!-- /BERANDA -->

    <!-- BIODATA -->
    <div class="container" style="padding:0 50px 0 50px">
        <div class="arlo_title_holder">
            <h3>Biodata</h3>
        </div>
        <div class="about_inner" style="padding:10px">
            <div class="rightbox wow fadeInLeft font_raleway " data-wow-duration="0.8s" data-wow-delay="0.2s">
                <div class="col-md-8 pad_bot">
                    <div class="col-md-6 no_pad">
                        <div class="col-md-12 pad_bot">
                            <label class="no_mar">Nama</label><br>
                            <?php echo $dpes->pesertaNama ?>
                        </div>
                        <div class="col-md-12 pad_bot">
                            <label class="no_mar">Alamat</label><br>
                            <?php echo $dpes->pesertaAlamat ?>
                        </div>
                    </div>
                    <div class="col-md-6 no_pad">
                        <div class="col-md-12 pad_bot">
                            <label class="no_mar">Nomor Peserta</label><br>
                            <?php echo $dpes->pesertaNoregis ?>
                        </div>
                        <div class="col-md-12 pad_bot">
                            <label class="no_mar">Nomor Handphone</label><br>
                            <?php echo $dpes->pesertaNohp ?>
                        </div>
                    </div>

                </div>

                <!-- <div class="buttons">
												<ul>
													<li><a href="#"><span>Download CV</span></a></li>
													<li><a href="#"><span>Send Message</span></a></li>
												</ul>
											</div> -->
            </div>
        </div>
    </div>
</div>
<!-- /BIODATA -->