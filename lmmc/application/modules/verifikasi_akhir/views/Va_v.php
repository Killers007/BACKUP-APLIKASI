<style>
    .mar-bot {
        margin-bottom: 10px;
    }
</style>

<section id="content" style="background-color:#F2F4F8">
    <section class="hbox stretch">
        <section class="vbox">
            <section class="scrollable">
                <section class="content">
                    <div class="box">
                        <div class="box-body">

                            <section id="content">
                                <section class="hbox stretch">
                                    <section class="vbox">
                                        <header class="header bg-white b-b b-light">
                                            <section class="row m-b-md" style="">
                                                <div class="col-xs-8">
                                                    <h1 class="m-b-xs text-black hidden-xs"><small>Verifikasi Hasil Pemeriksaan<span style="font-size: 12px"></span></small></h1>
                                                </div>
                                                <div class="col-xs-4 m-t-md pull-right">
                                                    <a href="javascript: history.go(-1)" type="button" class="btn btn-default pull-right" style="margin-right:5px"><i class="fa  fa-reply"></i> <span class="hidden-xs">Kembali</span></a>
                                                </div>
                                            </section>
                                        </header>
                                        <div class="panel-body">
                                            <div class="panel-body">
                                                <form onsubmit="return(false)" method="post" class="form-horizontal" id="myForm">
                                                    <div class="form-group">
                                                        <!-- <label class="col-sm-2 control-label">Barcode</label> -->
                                                        <div class="col-sm-1">
                                                        </div>
                                                        <div class="col-sm-10" style="padding:0">
                                                            <div class="input-group m-b">
                                                                <span class="input-group-addon"><span class="fa fa-qrcode"></span></span>
                                                                <input type="text" id="hasilBarcode" name="hasilBarcode" class="btn form-control" style="text-align: left">
                                                            </div>
                                                            <div id="hasilBarcode-v" name="inVal" style="margin-bottom:0px !important;"></div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="line line-dashed b-b line-lg pull-in" id="pengelolaanKelompok"></div> -->
                                                    <!-- <div class="form-group">
                                                        <div class="pull-left"></div>
                                                        <div class="pull-right">
                                                            <a type="submit" id="btnSimpan" onclick="btnSimpan()" class="btn btn-success pull-right" style="margin-right:5px"><i class="fa  fa-search"></i> <span class="hidden-xs">Cari</span></a>
                                                            <br>
                                                        </div>
                                                    </div> -->
                                                </form>
                                                <!-- <div class="line line-dashed b-b line-lg pull-in" id="pengelolaanKelompok"></div> -->
                                                <form onsubmit="return(false)" method="post" class="form-horizontal" id="hasilForm">

                                                    <div class="form-group">
                                                        <section class="col-md-1">
                                                        </section>
                                                        <section class="panel col-md-10" style="padding:20px 20px 20px 20px" id="divPeserta" hidden>

                                                        </section>
                                                        <section class="col-md-1">
                                                        </section>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <br />
                                    </section>
                                </section>
                            </section>
                        </div>
                    </div>
                </section>
            </section>
        </section>
    </section>
</section>

<script>
    var kriteria = <?php echo $kriteria ?>;
    $(document).ready(function() {
        $('#hasilBarcode').focus();

    });

    function upd_hasil_status(id, kr) {
        $('[name=sehat_status]').removeClass();
        $('[name=sehat_status]').addClass('btn btn-s-md sehat-status btn-default');

        $('#klindet').val(id);


        for (const [key, value] of Object.entries(kriteria)) {
            console.log(kr + ' SAMA ' + key);
            if (kr == key) {
                console.log("ADA YANG SAMA");
                $('#sehat-' + id).addClass('btn-' + value);
            }
        }
        $('#sehat-' + id).removeClass('btn-default');

        $('[id=checkIcon]').remove();
        htmlSehat = $('#sehat-' + id).html();
        $('#sehat-' + id).html('<span id="checkIcon" class="fa  fa-check"></span>' + htmlSehat);
    }

    function updHasil() {
        console.log($('#hasilForm').serialize());
        // console.log($('#myForm').serialize());
        // $('#btnSimpan').hide();
        // $('#divPeserta').hide();
        // $('#divPeserta').html('');
        $('[name=inVal]').hide('fast');


        $.ajax({
            url: "<?php echo base_url($modul) ?>/update_hasil",
            type: "POST",
            data: $('#hasilForm').serialize(),
            dataType: 'JSON',
            success: function(data) {

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
                    $('[id=hasilBarcode-v]').addClass('alert alert-success').html('Verifikasi berhasil!');
                    $('[id=hasilBarcode-v]').show('fast');

                    // $('#divPeserta').html(data.html);
                    // $('#divPeserta').show();
                    //     login = true;
                    //     $('[name=inVal]').removeClass();
                    //     $('[name=inVal]').hide('fast');
                    //     $('#content-v').hide('fast');
                    //     $('#content-v').removeClass();
                    //     // $('#content-v').addClass('alert alert-success').html(data.content);
                    //     setTimeout(function() {
                    //     }, 500);
                }
                // $('#simpan').html('Simpan');
            }
        }).done(function() {
            // if (login == false) {
            //     $('#btnMasuk').show('fast');
            // } else {
            //     $('#mainContent').fadeOut('fast');
            // }
        });
        $('#hasilBarcode').val('');
        $('#hasilBarcode').focus();
    }

    function btnSimpan() {
        // console.log($('#myForm').serialize());
        // $('#btnSimpan').hide();
        $('#divPeserta').hide();
        $('#divPeserta').html('');
        $('[name=inVal]').hide('fast');


        $.ajax({
            url: "<?php echo base_url($modul) ?>/request_barcode",
            type: "POST",
            data: $('#myForm').serialize(),
            dataType: 'JSON',
            success: function(data) {

                console.log(data);
                if (data.status == "validasi") {
                    $('#divPeserta').hide();
                    $('#divPeserta').html('');

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

                    $('#divPeserta').html(data.html);
                    $('#divPeserta').show();
                    //     login = true;
                    //     $('[name=inVal]').removeClass();
                    //     $('[name=inVal]').hide('fast');
                    //     $('#content-v').hide('fast');
                    //     $('#content-v').removeClass();
                    //     // $('#content-v').addClass('alert alert-success').html(data.content);
                    //     setTimeout(function() {
                    //     }, 500);
                }
                // $('#simpan').html('Simpan');
            }
        }).done(function() {
            // if (login == false) {
            //     $('#btnMasuk').show('fast');
            // } else {
            //     $('#mainContent').fadeOut('fast');
            // }
        });
        $('#hasilBarcode').val('');
        $('#hasilBarcode').focus();
    }


    $('#hasilBarcode').keypress(function(e) {
        if (e.which == 13) {
            btnSimpan();
            return false; //<---- Add this line
        }
    });
</script>