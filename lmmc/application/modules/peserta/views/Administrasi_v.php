<!-- CONTACT -->
<style type="text/css">
    .rata{
        margin-top: -7px;
    }
</style>
<div class="arlo_tm_section" id="contact">
    <div class="arlo_tm_contact_wrapper_all">
        <div class="arlo_tm_contact">
            <div class="container" style="width: 90%">
                <div class="arlo_title_holder">
                    <h3>Administrasi<span></span></h3>
                </div>
                <div class="text" style="margin-top: 120px; margin-bottom: -40px">
                    <p><h4>Pembayaran bisa dilakukan lewat Teller atau ATM pada Bank yang sudah bekerja sama dengan ULM (BNI, Mandiri, BTN) dengan cara melampirkan / input nomor token.</h4></p>
                </div>
                <div class="contact_inner">
                    <div class="left wow fadeInLeft" data-wow-duration="0.8s">
                        <div class="about_short_contact_wrap">
                            <h4>
                                <ul>
                                    <li>
                                        <img class="svg rata" src="<?php echo base_url('assets/mecha/img/svg') ?>/padlock.svg" alt="" />
                                        <span><label style="width: 200px"><b>Nomor Token</b></label> <a><?php echo $dt_pes->tagihanVoucher ?></a></span>
                                    </li>
                                    <li>
                                        <img class="svg rata" src="<?php echo base_url('assets/mecha/img/svg') ?>/shopping-cart.svg" alt="" />
                                        <span><label style="width: 200px"><b>Jumlah Pembayaran</b></label> <a><?php echo $biaya ?></a></span>
                                    </li>
                                    <li>
                                        <img class="svg rata" src="<?php echo base_url('assets/mecha/img/svg') ?>/checked_fat.svg" alt="" />
                                        <span><label style="width: 200px"><b>Status Pembayaran</b></label> <a><?php echo $dt_pes->tagihanIslunas?'Lunas':'Belum Bayar' ?></a></span>
                                    </li>
                                    <li  style="margin-top: 30px">
                                        <img class="svg rata" src="<?php echo base_url('assets/mecha/img/svg') ?>/calendar-4.svg" alt="" />
                                        <span><label><b>Tanggal dan Tempat Tes Kesehatan:</b></label></span>
                                    </li>
                                    <li>
                                        <span><a><?php echo $tanggal ?>, </br> di Lambung Mangkurat Medical Center (LMMC)</a></span>
                                    </li>
                                </ul>
                            </h4>
                        </div>
                    </div>
                    <div class="right wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
                        <div class="about_short_contact_wrap">
                            <div class="arlo_tm_button" data-color="pink" style="margin-bottom: 30px; width: auto">
                                <a target="_blank" id="send_message" class="a_white" <?php echo $dt_pes->tagihanIslunas?'href="'.base_url('peserta/formulir_new').'"':'' ?>><span>Download Berkas Pemeriksaan Kesehatan</span>   </a>
                                <div class="message_error">
                                    <?php if (!$dt_pes->tagihanIslunas): ?>
                                        <div class="alert alert-info">
                                            <i class="fa fa-ok-sign"></i>Harap <strong>Bayar Tagihan</strong> terlebih dahulu.
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <br>
                            <ul style="margin-left: 0px">
                                <li>
                                    <img class="svg rata" src="<?php echo base_url('assets/mecha/img/svg') ?>/calendar.svg" alt="" />
                                    <span><label>Pembayaran bisa dilakukan mulai tanggal</label>  <b><?php echo $mulaiBiaya; ?> </b> sampai dengan tanggal  <b>24-04-2020 23:59:00<!-- <?php echo $akhirBiaya; ?> --> </b></span>
                                </li>
                                <li>
                                    <img class="svg rata" src="<?php echo base_url('assets/mecha/img/svg') ?>/phone-call.svg" alt="" />
                                    <span><label>Info lebih lanjut silahkan hubungi <b>082250461614</b> atau <b> 081250502221 </b></label></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /CONTACT -->

<script type="text/javascript">

    $(document).ready(function($) {
        $('.message_error').hide();

        $(document).on('click', '#send_message', function(event) {
            $('.message_error').hide();
            $('.message_error').show('fast');
        });
    });

</script>
