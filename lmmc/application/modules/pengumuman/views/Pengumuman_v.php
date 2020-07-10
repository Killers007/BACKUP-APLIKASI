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
                                                    <h1 class="m-b-xs text-black hidden-xs"><small>Pengumuman<span style="font-size: 12px"></span></small></h1>
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
                                                        <div class="col-sm-2">
                                                            Upload File Pengumuman
                                                        </div>
                                                        <div class="col-sm-8" style="padding:0">
                                                            <div class="input-group m-b">
                                                                <input id="jalurFileKelulusan" name="jalurFileKelulusan" type="file">
                                                            </div>
                                                            <div id="hasilBarcode-v" name="inVal" style="margin-bottom:0px !important;"></div>
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
    $(document).ready(function() {
        $('#hasilBarcode').focus();
        $("input[type=file]").fileinput({
            showCaption: false,
            dropZoneEnabled: true,
            allowedFileExtensions: ["pdf"],
            allowedFileTypes: ["pdf"],
            maxFileSize: 3000,
            maxFileCount: 1,

        });

    });

    function upload(id) {

        form_data = new FormData();
        // File upload input
        $('input[type=file]').each(function(index, value) {
            console.log(value.name);
            form_data.append(value.name, $('#' + value.name)[0].files[0]);

        });
        form_data.append('upload_satu_before', $('#upload_satu_before').val());
        form_data.append('upload_dua_before', $('#upload_dua_before').val());
        form_data.append('upload_id', id);



        $.ajax({
            url: "<?php echo base_url() ?>jadwal_perkuliahan/upload_berkas",
            type: 'POST',
            data: form_data,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function(data) {
                success_response(data)
            }
        });
    }
</script>