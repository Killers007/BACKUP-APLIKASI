<style>
    .az_input {
        border: solid 1px #6F6F6F !important;
        width: 100% !important;
    }
</style>
<div class="arlo_tm_contact valign" id="rightpart" hidden>
    <div class="container" style="padding:0 50px 0 50px" id="mainContent">
        <div class="arlo_title_holder">
            <h3>Masuk</span></h3>
        </div>
        <div class="contact_inner" style="padding:20px 0 0 0">
            <div class="right wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
                <form action="/" method="post" class="contact_form" id="formMasuk">
                    <div class="input_wrap">
                        <div class="col-md-9 pad_bot">
                            <div class="col-md-12 no_pad">
                                <ul style="margin-bottom:0px">
                                    <b>Nomor Peserta</b>
                                    <li style="margin-bottom:10px"><input name="noreg" type="text" placeholder="Nomor Pendaftaran <?php echo $jalur_aktif; ?>" /><br>
                                        <div id="noreg-v" name="inVal" style="margin:0px" hidden></div>
                                    </li>
                                </ul>

                                <ul>
                                    <b>Tanggal Lahir</b>
                                    <div id="datepicker" class="date">
                                        <input name="tgl" type="text" placeholder="dd-mm-yyyy" class="az_input" onkeydown="return false" />
                                    </div>
                                    <div id="tgl-v" name="inVal" style="margin:0px" hidden></div>
                                </ul>
                                <br>
                                <div class="arlo_tm_button" data-color="pink">
                                    <a id="btnMasuk" class="a_white" href="#" onclick="btnMasuk()"><span>Masuk</span> </a>

                                    <div id="content-v" style="margin-top:10px" hidden></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {

        $("#datepicker input").datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",

        }).datepicker('update', new Date()).attr('readonly','readonly');
    });

    function btnMasuk() {
        $('#btnMasuk').hide();
        var login = false;
        $.ajax({
            url: "<?php echo base_url() ?>peserta/masuk_request",
            type: "POST",
            data: $('#formMasuk').serialize(),
            dataType: 'JSON',
            success: function(data) {

                console.log(data);
                if (data.status == "validasi") {
                    $('[name=inVal]').removeClass();
                    $('#content-v').removeClass();

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
                    login = true;
                    $('[name=inVal]').removeClass();
                    $('[name=inVal]').hide('fast');
                    $('#content-v').hide('fast');
                    $('#content-v').removeClass();
                    // $('#content-v').addClass('alert alert-success').html(data.content);
                    setTimeout(function() {
                        window.location = "<?php echo base_url('peserta/beranda') ?>";
                    }, 500);
                }
                $('#simpan').html('Simpan');
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText
                toastr.error(errorMessage, 'Telah terjadi kesalahan!')
                $('#btnMasuk').show()

            }
        }).done(function() {
            if (login == false) {
                $('#btnMasuk').show('fast');
            } else {
                $('#mainContent').fadeOut('fast');
            }
        });
    }
</script>
