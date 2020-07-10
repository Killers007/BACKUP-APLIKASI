<div class="arlo_tm_contact" id="about">
    <div class="arlo_tm_about_wrap_all">
        <div class="arlo_tm_about">
            <div class="container isipad">
                <div class="arlo_title_holder">
                    <h3 style="margin-left: 40px">Hasil Pemeriksaan</span></h3>
                </div>
                <div class="about_inner" style="margin-top: -80px">

                    <div class="rightbox wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
                        <div class="about_title">
                            <h3><span class="arlo_tm_animation_text_word-DISABLED"></span></h3>
                        </div>
                        <div class="text">
                            <!-- <p>Hi! My name is <span>Albert Walkers</span>. I am a Web Developer, and I'm very passionate and dedicated to my work. With 20 years experience as a professional Web developer, I have acquired the skills and knowledge necessary to make your project a success. I enjoy every step of the design process, from discussion and collaboration.</p> -->
                        </div>
                        <div class="about_short_contact_wrap">
                            <ul>
                                <?php foreach ($hasil as $key => $value): ?>
                                    <li style="width: 100%">
                                        <img class="svg" src="<?php echo base_url('assets') ?>/img/svg/book.svg" alt="" />
                                        <span><label><?php echo "$value->klinikFormnama" ?> : </label>
                                            <?php if ($value->knkdtNamahasil): ?>
                                                <span style="color: #ff4b36">&nbsp;<?php echo "$value->knkdtNamahasil" ?></span> 
                                            <?php else: ?>
                                                <span class="label label-danger">&nbsp;Belum Melakukan Pemeriksaan</span> 
                                            <?php endif ?>
                                        </span>
                                    </li>
                                <?php endforeach ?>

                            </ul>
                        </div>
                       <!--  <div class="buttons">
                            <ul>
                                <li><a href="#"><span>Download CV</span></a></li>
                                <li><a href="#"><span>Send Message</span></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

