<div class="arlo_tm_contact" id="rightpart" hidden>
    <div class="container isipad" style="margin:10px 0px 0px 0px" id=" mainContent">
        <div class="arlo_title_holder">
            <h3>Administrasi</span></h3>
        </div>
        <div class="contact_inner" style="padding:20px 0 0 0">
            <div class="right wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
                <p style="color:black;margin:0px">Pembayaran bisa dilakukan lewat Teller atau ATM pada Bank yang sudah bekerja sama dengan ULM (BNI, Mandiri, BTN).

                </p>

                <div class="col-md-12 pad_bot" style="padding:0px 0px  !important;">
                    <div class="col-md-12 no_pad">
                        <div class="col-md-12 pad_bot">
                            <label class="no_mar">
                                <h3 class="no_mar"><b>Token Pembayaran : </b></h3>
                            </label>
                            <h3><?php echo $dt_pes->tagihanVoucher ?></h3>
                        </div>
                    </div>
                    <div class="col-md-12 no_pad">
                        <div class="col-md-12 pad_bot">
                            <label class="no_mar">
                                <h3 class="no_mar"><b>Jumlah pembayaran : </b></h3>
                            </label>
                            <h3> <?php echo $biaya ?></h3>
                        </div>
                    </div>
                    <?php if ($tanggal) { ?>
                        <div class="col-md-12 no_pad">
                            <div class="col-md-12 pad_bot">
                                <label class="no_mar">
                                    <h3 class="no_mar"><b>Tanggal dan Lokasi Tes Kesehatan : </b></h3>
                                </label>
                                <h3><?php echo $tanggal . '. Berlokasi di Lambung Mangkurat Medical Center (LMMC)' ?></h3>
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <!-- <div class="arlo_tm_button" data-color="pink">
                    <a target="_blank" id="send_message" href="<?php //echo base_url('peserta/formulir_tok') 
                                                                ?>" value=""><span>Download Kartu Pemeriksaan Kesehatan</span> </a>


                </div> -->
                <div class="arlo_tm_button" data-color="pink" style="margin: 0px 0px 10px 0px">
                    <a target="_blank" id="send_message" href="<?php echo base_url('peserta/formulir_new') ?>" value=""><span>Download Berkas Pemeriksaan Kesehatan</span> </a>
                </div>
                <p style="color:red;margin:0px 0px 0px 0px;">
                    Pembayaran tes kesehatan bisa dilakukan mulai <b>tanggal <?php echo $mulaiBiaya; ?> sampai dengan tanggal <?php echo $akhirBiaya; ?></b>.
                </p>
                Info lebih lanjut silahkan hubungi <b>082250461614</b> atau <b> 081250502221 </b>
            </div>
        </div>
    </div>

</div>