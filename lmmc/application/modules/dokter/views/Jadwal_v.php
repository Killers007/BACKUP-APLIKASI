<div class="arlo_tm_section" id="about">
    <div class="arlo_tm_about_wrap_all">
        <div class="arlo_tm_about">
            <div class="container">
                <div class="arlo_title_holder">
                    <h3>Jadwal  <span>Jaga</span></h3>
                </div>
                <div class="about_inner">

                    <div class="rightbox wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
                        <div class="about_title">
                            <h3><?php echo $this->session->user['nama'] ?> <span class="arlo_tm_animation_text_word-DISABLED"></span>( NIP. <?php echo $this->session->user['username'] ?> )</h3>
                        </div>
                        <div class="text">
                            <!-- <p>Hi! My name is <span>Albert Walkers</span>. I am a Web Developer, and I'm very passionate and dedicated to my work. With 20 years experience as a professional Web developer, I have acquired the skills and knowledge necessary to make your project a success. I enjoy every step of the design process, from discussion and collaboration.</p> -->
                        </div>
                        <div class="about_short_contact_wrap">
                            <ul>
                                <?php foreach ($jadwal as $key => $value): ?>
                                    <?php $date = date_convert($value->jagaTanggal) ?>

                                    <li>
                                        <img class="svg" src="<?php echo base_url('assets') ?>/img/svg/calendar.svg" alt="" />
                                        <span><label><?php echo "$date->dayName, " ?></label><?php echo "$date->default" ?> </span>
                                    </li>
                                    <li>
                                        <!-- <img class="svg" src="<?php echo base_url('assets') ?>/img/svg/heartt.svg" alt="" /> -->
                                        <span><label>Klinik</label> <?php echo $value->klinikNama ?></span>
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
                <!-- /ABOUT -->