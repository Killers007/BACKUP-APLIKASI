<!-- <div class="arlo_tm_section" id="rightpart" hidden> -->

<!-- <div class="arlo_tm_section" id="rightpart" hidden> -->
<?php

// echo "<pre>";
// print_r($dpes);
//     echo "</pre>";
// exit;

?>
<style>
    .az_input {
        border: solid 1px #6F6F6F !important;
        width: 100% !important;
    }

    .about_short_contact_wrap {
        padding-bottom: 10px !important;
    }

    /* mobile view */
    @media (max-width: 481px) {
        .input_wrap {
            padding-left: 30px !important;
            padding-right: 30px !important;
        }

        .mobile_left_pad {
            padding-left: 50px !important;
            padding-right: 30px !important;
        }

        .m_btn {
            text-align: left;
        }
    }

    /* desktop view */
    @media (min-width: 481px) {
        .input_wrap {
            padding-left: 30px !important;
            padding-right: 30px !important;
        }

        div.input_wrap ul li {
            margin-bottom: 10px !important;
        }

        /*.kolom_kanan {
            padding-left: 0px !important;
        }*/

        .no_bottom_pad {
            padding-bottom: 0px !important;
        }
    }

    @media (min-width: 992px) {
        .kolom_kanan {
            padding-left: 0px !important;
        }
    }
</style>
<div class="jarallax" data-speed="0.2">
    <div class="arlo_tm_contact">
        <div class="arlo_title_holder mobile_left_pad" style="padding:0px 0px 0px 30px">
            <h3>Biodata Peserta</span></h3>
        </div>
        <div class="contact_inner" style="padding-top:40px !important;">

            <div class="left wow fadeInLeft" style="min-width:30% !important;padding-right:0px !important;" data-wow-duration="0.8s">
                <form id="form_id" class="" onsubmit="duar(this)" action="javascript:void(0);">

                    <div class="about_short_contact_wrap mobile_left_pad">
                        <ul>
                            <li class="no_bottom_pad input_wrap">
                                <img id="usrimg" src="<?php echo base_url('peserta/image/path_foto_peserta/');
                                                        if ($dpes['pesertaFoto']) echo $dpes['pesertaFoto'];
                                                        else echo 'default.png'; ?>" style="max-width:240px;">
                                <input type="hidden" value="<?php echo $dpes['pesertaFoto'] ?>" name="imgp">
                                <input name="pesertaFoto" id="pesertaFoto" type="file" placeholder="Foto Peserta" style="margin-bottom:10px;display:none;padding-top:10px !important;" />
                            </li>
                        </ul>

                        <div class="arlo_tm_button input_wrap m_btn" style="padding-top:0px !important;" data-color="">
                            <a id="send_message" class="a_white" href="#" style="padding:15px 100px;" onclick="file_show(this)"><span>Ubah</span> </a>
                        </div>
                    </div>
            </div>

            <div class="right wow fadeInLeft" style="min-width:70% !important;" data-wow-duration="0.8s" data-wow-delay="0.2s">

                <div class="col-md-12 no_pad">
                    <div class="col-md-12 no_pad">
                        <div class="col-md-6 no_pad">
                            <div class="input_wrap mobile_left_pad">
                                <ul class="about_short_contact_wrap">
                                    <b>Nomor Peserta</b>
                                    <p><?php echo $dpes['pesertaNoregis'] ?></p>
                                </ul>
                               
                            </div>
                        </div>
                        <div class="col-md-6 no_pad">
                            <div class="input_wrap kolom_kanan mobile_left_pad">
                                <ul class="about_short_contact_wrap">
                                    <b>Jalur Masuk</b>
                                    <p><?php echo $dpes['jalurNama'] ?></p>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 no_pad">
                        <div class="col-md-6 no_pad">
                            <div class="input_wrap mobile_left_pad">
                                <ul class="about_short_contact_wrap">
                                    <b>Program Studi</b>
                                    <p><?php echo $dpes['prodiNamaResmi'] ?></p>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 no_pad">
                            <div class="input_wrap kolom_kanan mobile_left_pad">
                                <ul class="about_short_contact_wrap">
                                    <b>Fakultas</b>
                                    <p><?php echo $dpes['fakNamaResmi'] ?></p>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 no_pad">
                        <div class="input_wrap mobile_left_pad">
                            <ul class="about_short_contact_wrap">
                                <b>Nama</b>
                                <br><input name="pesertaNama" value="<?php echo $dpes['pesertaNama'] ?>" type="text" placeholder="nama" class="az_input" />
                                <div id="pesertaNama-v" name="inVal" style="margin:0px" hidden></div>
                            </ul>
                            <ul class="about_short_contact_wrap">
                                <b>Tempat Lahir</b>
                                <br><input name="pesertaTempatlahir" value="<?php echo $dpes['pesertaTempatlahir'] ?>" type="text" placeholder="tempat lahir" class="az_input" />
                                <div id="pesertaTempatlahir-v" name="inVal" style="margin:0px" hidden></div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 no_pad">
                        <div class="input_wrap kolom_kanan mobile_left_pad">

                            <ul class="about_short_contact_wrap">
                                <b>Nomor Handphone</b>
                                <br><input name="pesertaNohp" id="pesertaNohp" value="<?php echo $dpes['pesertaNohp'] ?>" type="text" placeholder="nomor telepon" class="az_input" />
                                <div id="pesertaNohp-v" name="inVal" style="margin:0px" hidden></div>
                            </ul>
                            <ul class="about_short_contact_wrap">
                                <b>Tanggal Lahir</b>
                                <div id="datepicker" class="date">
                                    <input name="pesertaTanggallahir" value="<?php echo $dpes['pesertaTanggallahir'] ?>" type="text" placeholder="dd-mm-yyyy" class="az_input" onkeydown="return false" disabled />
                                </div>

                                <div id="pesertaTanggallahir-v" name="inVal" style="margin:0px" hidden></div>
                            </ul>
                        </div>
                    </div>
                    <div class="input_wrap mobile_left_pad" style="margin-bottom:10px;">
                        <div class="about_short_contact_wrap" style="padding-bottom: 0px !important;">
                            <b>Jenis Kelamin</b><br>
                            <input type="radio" id="male" name="pesertaJK" value="L" <?php if ($dpes['pesertaJK'] == 'L') echo 'checked="checked"' ?>>
                            <label for="male">Laki-Laki</label><br>
                            <input type="radio" id="female" name="pesertaJK" value="P" <?php if ($dpes['pesertaJK'] == 'P') echo 'checked="checked"' ?>>
                            <label for="female">Perempuan</label><br>
                        </div>
                    </div>
                    <div class="input_wrap mobile_left_pad">
                        <ul class="about_short_contact_wrap">
                            <b>Alamat</b>
                            <textarea name="pesertaAlamat" value="<?php echo $dpes['pesertaAlamat'] ?>" placeholder="Message" style="border:solid 1px #6F6F6F;resize: none;" rows="4" class="az_input"><?php echo $dpes['pesertaAlamat'] ?></textarea>
                            <div id="pesertaAlamat-v" name="inVal" style="margin:0px" hidden></div>
                        </ul>
                    </div>
                    <div class="arlo_tm_button input_wrap mobile_left_pad m_btn" style="padding-top:0px !important;" data-color="pink">
                        <a id="btnSimpan" class="a_white" href="#" onclick="bio_request()" style="padding:15px 120px"><span>Simpan</span> </a>
                        <!-- <div id="comment-v" name="inVal" style="margin-top:10px" hidden></div> -->

                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>

<script>
    function file_show(object) {
        $('#pesertaFoto').show('fast');
        $(object).hide('fast');
    }

    $(document).ready(function() {
        packg = <?php echo json_encode($dpes) ?>;
        console.log(packg);
        $("#pesertaNohp").inputFilter(function(value) {
            return /^-?\d*$/.test(value);
        });

        $("#datepicker input").datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
        }).attr('readonly', 'readonly');
        // .datepicker('update', new Date('<?php //echo $dpes['pesertaTanggallahir'] 
                                            ?> '))
        if (<?php echo $tidaklengkap; ?> == 1) {
            toastr.error('Anda belum bisa mengakses halaman Administrasi karena Biodata belum lengkap!');
        }
    });


    function success_response(data) {
        console.log(data);
        if (data.status == "validasi") {
            // $('#divPeserta').hide();
            // $('#divPeserta').html('');

            $('[name=inVal]').removeClass();
            //     $('#content-v').removeClass();
            $.each(data, function(key, value) {
                console.log(key);
                if (value == "") {
                    $('#' + key + '-v').hide('fast');
                    $('#' + key + '-v').html('');
                } else {
                    $('#' + key + '-v').addClass('alert alert-danger').html(value);
                    $('#' + key + '-v').show('fast');
                }
            });
            toastr.error(data.comment, 'Periksa kembali!')
            $('#btnSimpan').show('fast');

        } else {
            $('[name=inVal]').removeClass();
            toastr.success('Data pemeriksaan berhasil disimpan', 'Berhasil!')

            // $('[id=comment-v]').addClass('alert alert-success').html('Data pemeriksaan berhasil disimpan');
            // $('[id=comment-v]').show('fast');
            // $('#usrimg').hide();
            setTimeout(function() {
                window.location = "<?php echo base_url('peserta/biodata') ?>";
            }, 1000);

        }
    }

    function bio_request() {
        form_data = new FormData($('form')[0]);
        // change your delector here
        // form_data.append("pesertaFoto", imgFile.files[0]); // change filename field here
        console.log(form_data);
        // for (var pair of form_data.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }
        // DIsable temporary
        // $('#btnSimpan').hide('fast');

        $.ajax({
            url: "<?php echo base_url() ?>peserta/bio_update",
            type: 'POST',
            data: form_data,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: success_response
        });
        e.preventDefault();
    }
</script>