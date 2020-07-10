<style type="text/css">
    input {
        font-weight: bold;
    }
</style>

<div class="arlo_tm_contact" id="rightpart" style="" hidden>
    <div class="container isipad" style="padding:0px 0px 0px 0px !important;" id="mainContent">
        <div class="arlo_title_holder">
            <h3>Biodata</span></h3>
        </div>
        <div class="contact_inner" style="padding:20px 0 0 0">
            <div class="right wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
                <form id="form_id" class="form-horizontal" onsubmit="duar(this)" action="javascript:void(0);">
                    <div class="input_wrap">
                        <div class="col-md-12 pad_bot">
                            <div class="col-md-12 no_pad">
                                <?php
                                echo '
                                <ul style="margin-bottom:10px">
                                    <b>Nomor Peserta</b>
                                    <br>
                                    ' . $dpes['pesertaNoregis'] . '

                                </ul>';
                                ?>
                                <?php
                                foreach ($input as $k => $v) {
                                    if ($v == 'pesertaFoto') {
                                        echo '
                                        <ul style="margin-bottom:10px">
                                            <b>' . $k . '</b>
                                            <br>
                                            <input type="hidden"  value="' . $dpes[$v] . '" name="imgp">
                                            <input  name="' . $v . '" type="file" placeholder="' . $k . '" style="margin-bottom:10px"/>';
                                        echo '<img id="usrimg" src="' . base_url('peserta/image/path_foto_peserta/');

                                        if ($dpes[$v]) {
                                            echo  $dpes[$v];
                                        } else {
                                            echo  'default.png';
                                        }
                                        echo '" style="max-height:150px;">';

                                        echo '</ul>
                                        ';
                                    } else {
                                        echo '
                                        <ul>
                                            <b>' . $k . '</b>
                                            <li style="margin-bottom:15px">
                                                <input value="' . $dpes[$v] . '" name="' . $v . '" type="text" placeholder="' . $k . '" /><br>
                                            </li>
                                            <div id="' . $v . '-v" name="inVal" style="margin:0px" hidden></div>

                                        </ul>';
                                    }
                                }
                                ?>
                                <div class="arlo_tm_button" data-color="pink" style="margin-top:10px">
                                    <a id="btnSimpan" class="a_white" href="#" onclick="bio_request()"><span>Simpan</span> </a>
                                    <!-- <input type="submit" /> -->
                                    <div id="comment-v" name="inVal" style="margin-top:10px" hidden></div>
                                </div>

                                <div>
                                    <p style="color:red;margin-bottom:0px;">*Biodata wajib dilengkapi</p>

                                    <p style="color:red">**Pastikan nomor telepon yang dimasukkan benar karena akan ada info lanjutan untuk Tes Kesehatan</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
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
        } else {
            $('[name=inVal]').removeClass();
            $('[id=comment-v]').addClass('alert alert-success').html('Data pemeriksaan berhasil disimpan');
            $('[id=comment-v]').show('fast');
            $('#usrimg').hide();
            setTimeout(function() {
                window.location = "<?php echo base_url('peserta/asuransi_kesehatan') ?>";
            }, 1000);

        }
    }



    function bio_request() {
        form_data = new FormData($('form')[0]);
        var imgFile = $("[name=pesertaFoto]")[0]; // change your delector here
        // form_data.append("pesertaFoto", imgFile.files[0]); // change filename field here
        // console.log(imgFile);
        // for (var pair of form_data.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }

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