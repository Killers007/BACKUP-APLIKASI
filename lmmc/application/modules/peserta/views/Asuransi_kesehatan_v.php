<!-- CONTACT -->
<style type="text/css">
    .rata{
        margin-top: -7px;
    }
</style>
<?php echo form_open_multipart('', 'id="formData" class="form-horizontal"'); ?>
<div class="arlo_tm_section" id="contact">
    <div class="arlo_tm_contact_wrapper_all">
        <div class="arlo_tm_contact">
            <div class="container" style="width: 90%">
                <div class="arlo_title_holder">
                    <h3>Asuransi Kesehatan<span></span></h3>
                </div>
                <div class="text" style="margin-top: 130px; margin-bottom: -40px">
                    <p align="justify">Pada tahap ini peserta tes kesehatan akan mendapat fasilitas asuran kesehatan yang bekerja sama pengan LMMC ULM. Maka dari pada itu peseta diharapkan bersedia memindahkan Faskes 1 BPJS -nya ke LMMC Universitas Lambung Mangkurat. Jika peserta tidak besedia memindahkan Faskes 1 -nya atau tidak memiliki BPJS, maka Mahasiswa harus mendaftarkan diri ke BPJS/LMMC paling lambat awal perkuliahan tahun ini. Jika Anda bersedia memindahkan faskes 1 BPJS ke LMMC ULM, silahkan tekan tombol ya pada kolom BPJS , isi kolom 'No BPJS' dengen nomor BPJS Anda dan kolom 'Upload Kartu BPJS' denga Kartu BPJS Anda kemudian simpan.</p>
                </div>
                <div class="about_inner" style="padding-top: 40px">

                    <div class="rightbox wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
                        <div class="about_short_contact_wrap">
                            <p><b>Apakah Anda bersedia memindahkan Faskes Tingkat 1 BPJS Anda ke LMMC ULM?</b></p>
                            <input type="radio" value="1" data-target="dana" name="bpjs"> YA
                            <input type="radio" value="0" data-target="dana" name="bpjs"> TIDAK
                            <!-- <div class="cleanlabel bpjs"></div> -->

                        </div>
                        <br>
                        <div class="about_short_contact_wrap showXX" style="margin-top: 10px">
                            <b>
                                <p class="lblInfo alert alert-info">Saya bersedia mengikuti Dana Sehat LMMC ULM</p>
                            </b>
                        </div>

                    </div>
                </div>
                <div class="contact_inner hide" style="padding-top: 40px; display : contents">
                    <div class="right wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
                        <div class="input_wrap" style="margin-top: 10px">
                            <div class="col-md-9 pad_bot">
                                <div class="col-md-12 no_pad">
                                    <ul>
                                        <b>Nomor BPJS*</b>
                                        <li style="margin-bottom:15px">
                                            <input name="noBpjs" type="text" placeholder="No BPJS" value="<?php echo $peserta->pesertaNoBpjs ?>"><br>
                                        </li>
                                        <div class="cleanlabel noBpjs"></div>
                                    </ul>

                                    <ul style="margin-bottom:10px">
                                        <b>File BPJS*</b>
                                        <br>
                                        <input name="fileBpjs" type="file" style="margin-bottom:10px">
                                        <div class="cleanlabel fileBpjs text-danger"></div>
                                    </ul>
                                    <?php if ($peserta->pesertaFileBpjs) : ?>
                                        <embed src="<?php echo base_url('peserta/getFile/' . $peserta->pesertaFileBpjs) ?>" width="100%" height="100%">
                                        <?php endif ?>
                                        <div>
                                            <p style="color:#ff4b36;margin-bottom:0px; font-size: 12px">Ekstensi berkas <b>jpg,png,jpeg,pdf</b></p>
                                            <p style="color:#ff4b36;margin-bottom:0px; font-size: 12px">Maks File Upload <b>1MB</b></p>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="arlo_tm_button" data-color="pink" style="margin-top:10px">
                        <a target="_blank" class="a_white" id="btnSimpan" value=""><span>Simpan</span> </a>
                        <div id=" comment-v" name="inVal" style="margin-top:10px" hidden></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /CONTACT -->
    <?php echo form_close(); ?>

    <script type="text/javascript">
        $(document).ready(function($) {

            $(document).on('click', 'input[type="radio"]', function(event) {

                var id = $(this).data('target');
                var value = $(this).val();

                if (value == 1) {
                    $('input[name="' + id + '"][value="0"]').prop('checked', true);
                } else {
                    $('input[name = "' + id + '"][value = "1"]').prop('checked ', true);
                }

                var bpjs = $('input[name="bpjs"]:checked').val();

                if (bpjs == 0) {
                    $('.contact_inner, .hideXX').addClass('hide');
                    $('.lblInfo').html('Mahasiswa harus mendaftarkan diri ke BPJS/LMMC paling lambat awal perkuliahan tahun ini.');
                    $('.lblInfo').removeClass('alert-success').addClass('alert-info');
                } else {
                    $('.contact_inner, .hideXX').removeClass('hide');
                    $('.lblInfo').removeClass('alert-info').addClass('alert-success');
                    $('.lblInfo').html('Saya bersedia  memindahkan Faskes Tingkat 1 BPJS ke LMMC ULM');
                }

            });

            var isBpjs = '<?php echo ($peserta->pesertaIsBpjs == null) ? null : $peserta->pesertaIsBpjs ? 1 : 0; ?>';

            if (isBpjs != null) {
                console.log(<?php echo $peserta->pesertaIsBpjs ?>)
                $('input[name="bpjs"][value="' + isBpjs + '"]').trigger('click');
            }

            $(document).on('click', '#btnSimpan', function(event) {
                $('form').trigger('submit');
            });

            $('form').submit(function(e) {
                e.preventDefault();
                var data = new FormData(this);

                $.ajax({
                    url: '<?php echo current_url() ?>',
                    type: 'POST',
                    dataType: 'JSON',
                    cache: false,
                    processData: false,
                    contentType: false,
                    data: data,
                    beforeSend: function() {
                        btnLoading('#btnSimpan')
                        cleanError();

                    },
                    complete: function() {
                        btnNormal('#btnSimpan')
                    },
                    success: function(res) {
                        if (!res.status) {
                            getError(res)
                        } else {
                            // toastr[res.status](res.message);
                            window.location = '<?php echo base_url('peserta/administrasi') ?>';
                        }
                    }
                })
            });

            $('input[type="radio"]').trigger('change');

            toastConfig();

            function toastConfig() {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }

            function getError(data) {
                $.each(data.error, function(index, el) {
                    $('.' + index).addClass('alert alert-danger').html(el);
                });
            }

            function cleanError() {
                $('.cleanlabel').removeClass('alert alert-danger').html('');
            }

            var btnText;

            function btnLoading(selector) {
                btnText = $(selector).html();
                $(selector).html('<i class="fa fa-spinner fa-spin"></i> Loading .....');
                $(selector).attr('disabled', 'true');
            }

            function btnNormal(selector) {
                $(selector).html(btnText);
                $(selector).removeAttr('disabled');
            }

        });
    </script>