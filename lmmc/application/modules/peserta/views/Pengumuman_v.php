<div class="arlo_tm_contact valign" id="rightpart" hidden>
    <div class="container" style="padding:0 50px 0 50px">
        <div class="arlo_title_holder">
            <h3>Pengumuman</h3>
        </div>
        <div class="contact_inner" style="padding:20px 0 0 0">
            <div class="right wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
                <div class="col-md-12 pad_bot" style="padding-bottom:0px !important;">
                    <div class="col-md-12 no_pad">
                        <div class="col-md-12 pad_bot">
                            <label class="no_mar">
                                <h3 class="no_mar"><b>
                                        Jalur <?php echo $db->jalurNama ?> Tahun <?php echo $db->jalurTahun ?>
                                    </b></h3>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- <div class="arlo_tm_button" data-color="pink">
                    <a target="_blank" id="send_message" href="<?php //echo base_url('peserta/formulir_tok') 
                                                                ?>" value=""><span>Download Kartu Pemeriksaan Kesehatan</span> </a>


                </div> -->
                <?php if ($db->jalurFileKelulusan) { ?>
                    <div class="arlo_tm_button" data-color="pink">
                        <a target="_blank" class="a_white" id="send_message" href="<?php echo base_url('peserta/file/path_pengumuman/') . $db->jalurFileKelulusan ?>" value=""><span>Download Pengumuman</span> </a>
                    </div>
                <?php } else { ?>
                    <h3 style="color:red;margin:0px;"><b>Pengumuman Belum Tersedia!</b></h3>
                <?php }  ?>

            </div>
        </div>
    </div>

</div>