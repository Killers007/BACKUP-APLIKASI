
<section id="content">

    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-8 col-md-8 col-lg-8">
                        <?php 
                        $text = '';
                        ?>
                        <h1 class="m-b-xs text-black hidden-xs"><small class="m-b-xs text-black">Verifikasi Peserta | <small>Jalur <?php echo $dataJalur->jalurNama ?> Tahun <?php echo $dataJalur->jalurTahun; ?></small></small></h1>
                        <h2 class="m-b-xs text-black hidden-lg hidden-md hidden-sm"><small></small></h2>
                    </div>
                </section>
            </header>
            <section class="scrollable space padder">

                <div class="box-body">

                    <div class="row panel-body" style="margin-bottom: 30px">

                        <div class="col-md-2"> </div>
                        <div class="col-md-8">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><span class="fa fa-qrcode"></span></span>
                                <input id="inputQrCode" type="text" class="form-control" placeholder="Nomor Peserta">
                            </div>
                        </div>
                        <div class="col-md-2"> </div>
                    </div>

                    <div class="row text-center" id="imageBarcode">
                        <!-- <img style="margin-top: " src="https://media1.tenor.com/images/f3300b1ad8320c61263cbd37e1072a7c/tenor.gif?itemid=15501310" width="400" alt="Barcode Scan GIF - Barcode Scan Scanning GIFs" style="max-width: 700px; background-color: rgb(63, 63, 63);"> -->
                        <div class="col-md-12">
                            <img src="<?php echo base_url('assets/images/form.png') ?>" width="70%" alt="Barcode Scan GIF - Barcode Scan Scanning GIFs" style="">
                        </div>
                    </div>

                    <div id="cover-spin"> </div>

                    <div class="row" id="box-peserta" style="margin: 0px; display: none"> 

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <img style="width: 200px; border: 0px solid #ddd;" id="pesertaFoto" class="img-thumbnail" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="spwid">
                                            <h4>
                                                <i class="i  i-user3"></i> Data Peserta
                                            </h4>
                                            <hr>
                                            <div class="form-group">
                                              <label>Nomor Peserta</label>
                                              <div id="pesertaNoregis" class="form-control1"></div>
                                          </div>
                                          <div class="form-group">
                                              <label>Nama</label>
                                              <div id="pesertaNama" class="form-control1"></div>
                                          </div>
                                          <div class="form-group">
                                              <label>Program Studi</label>
                                              <div id="prodiNamaResmi" class="form-control1"></div>
                                          </div>
                                          <div class="form-group">
                                              <label>No Hp</label>
                                              <div id="pesertaNohp" class="form-control1"></div>
                                          </div>
                                          <div class="form-group">
                                              <label>Jenis Kelamin</label>
                                              <div id="pesertaJK" class="form-control1"></div>
                                          </div>   
                                      </div>

                                  </div>

                                  <div class="col-md-6">
                                    <div class="spwid">
                                        <h4>
                                            <i class=" fa fa-align-left"></i> Lain - Lain
                                        </h4>
                                        <hr>

                                        <div class="form-group">
                                          <label>Kategori</label>
                                          <div id="kategoriNama" class="form-control1"></div>
                                      </div>  
                                      <div class="form-group">
                                          <label>Biaya</label>
                                          <div id="biayaHarga" class="form-control1"></div>
                                      </div>  

                                      <div class="form-group">
                                          <label>Status Pembayaran</label>
                                          <div id="tagihanIslunas" class="form-control1"></div>
                                      </div>  

                                      <div class="form-group">
                                          <label>Kelengkapan berkas</label>
                                          <div class="form-control1">
                                              <ul style="margin-left: -10px" id="klinikForm">
                                                  <li>as</li>
                                                  <li>as</li>
                                                  <li>as</li>
                                                  <li>as</li>
                                              </ul>
                                          </div>
                                      </div>   
                                  </div>
                              </div>

                          </div>

                      </div>
                      <div class="col-md-2"></div>
                  </div>
                  
                  <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                          <div class="row text-center showBtn">
                            <!-- <button type="submit" class="btn btn-rounded btn-success btnValid" data-id="" data-status='1'><span class="hidden-xs"><span class="fa  fa-check"></span> Verifikasi</span></button> -->
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

            </div>

            <br>
        </section>
    </section>
</section>
<span class="text-center"></span>

<!--begin::Modal-->
<!-- 
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Detail Peserta</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <section class="panel no-border  lt">
                        <div class="panel-body">
                            <div class="row m-t-xl">
                                <div class="col-xs-3 text-right padder-v">
                                </div>
                                <div class="col-xs-6 text-center">
                                    <div class="inline">
                                        <div class="text-center" >
                                            <div class="thumb-lg avatar">
                                                <img src="http://localhost/PTIK/lmmc/assets/data/images/no_pict.png" class="dker">
                                            </div>
                                        </div>
                                        <div class="h4 m-t m-b-xs font-bold text-lt" id="pesertaNama">John.Smith</div>
                                        <small class="text-muted m-b" id="prodiNamaResmi">Art director</small>
                                    </div>
                                </div>

                            </div>
                            <div class="wrapper m-t-xl m-b" style="margin-left: 25%; margin-right: 20%">
                                <div class="row" >
                                    <div class="col-xs-6">
                                        <small>Kategori</small>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="text-lt font-bold" id="kategoriNama">1243 0303 0333</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <small>Biaya</small>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="text-lt font-bold" id="biayaHarga">+32(0) 3003 234 543</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <small>Status Bayar</small>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="text-lt font-bold" id=""><span class="label label-success">Lunas</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
                <div class="modal-footer text-center" style="text-align-last: center; margin-right: -50px">
                    <button type="submit" class="btn btn-rounded btn-danger btnInvalid" data-id="" data-status='0'><span class="hidden-xs"><span class="fa  fa-times"></span> Tidak Valid</span></button>
                    <button type="submit" class="btn btn-rounded btn-success btnValid" data-id="" data-status='1'><span class="hidden-xs"><span class="fa  fa-check"></span> Valid</span></button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!--end::Modal-->

</section>

<style type="text/css">
    .form-control1
    {
        font-weight: bold;
    }

    #cover-spin {
        position:absolute;
        width:100%;
        left:0;right:0;top:0;bottom:0;
        background-color: rgba(255,255,255,0.6);
        z-index:9999;
        display:none;
    }

    @-webkit-keyframes spin {
        from {-webkit-transform:rotate(0deg);}
        to {-webkit-transform:rotate(360deg);}
    }

    @keyframes spin {
        from {transform:rotate(0deg);}
        to {transform:rotate(360deg);}
    }

    #cover-spin::after {
        content:'';
        display:block;
        position:absolute;
        left:48%;top:40%;
        width:40px;height:40px;
        border-style:solid;
        border-color:black;
        border-top-color:transparent;
        border-width: 4px;
        border-radius:50%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }
</style>

<script type="text/javascript">

    $(document).ready(function() {

        setInterval(function(){
            $('#inputQrCode').trigger( "focus" );
        }, 100)

        function formatRupiah(angka, prefix = '')
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }

        $(document).on('keyup', '#inputQrCode', function(e) 
        {
            var key = e.which;
            if (key == 13) 
            { 
                getPesertaDetail($(this).val());
                $(this).val('');
            }

        });


        function getPesertaDetail(keys)
        {
            $.ajax({
                url: '<?php echo current_url() ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {status: 'getPeserta', key : keys},
                beforeSend: function()
                {
                    $('#cover-spin').show();
                    $('#box-peserta').hide();

                    btnLoading('.btnSimpan');
                },
                complete: function()
                {
                    btnNormal('.btnSimpan');
                    $('#cover-spin').hide();
                },
                success: function(res)
                {
                    if (res.status == 'success') 
                    {
                        $('#box-peserta').fadeIn(200);
                        $('#imageBarcode').hide();

                        var isValid = 0;
                        var isLunas = 0;
                        res = res.data;

                        $.each(res, function(index, val) 
                        {
                            if (index == 'tagihanIslunas') 
                            {
                                if (parseInt(res.tagihanIslunas) == 1) 
                                {
                                    isLunas = 1;
                                    $('#tagihanIslunas').html('<span class="label label-success">Lunas</span>');
                                }
                                else
                                {
                                    $('#tagihanIslunas').html('<span class="label label-danger">Belum Lunas</span>');
                                }
                            }
                            else if (index == 'biayaHarga') 
                            {
                                $('#'+index).html('Rp. '+formatRupiah(val));
                            }
                            else if (index == 'pesertaJK') 
                            {
                                var jk = (val == 'L')?'Laki - laki':'Perempuan';
                                $('#'+index).html(jk);
                            }

                            else if (index == 'pesertaFoto') 
                            {
                                var foto = (val != null)?'<?php echo base_url('verifikasi/image') ?>/'+val:'<?php echo base_url('assets/data/images/no_pict.png') ?>';
                                $('#'+index).attr('src', foto);
                            }
                            else if (index == 'klinikForm') 
                            {
                                var text = '';
                                $.each(val, function(indexs, klinikNama) {
                                   text += `<li>`+klinikNama.klinikFormnama+`</li>`
                               });

                                $('#'+index).html(text);
                            }
                            // else if (index == 'pesertaIsbayar') 
                            // {
                            //     var jk = (val == '0')?'<span cla></span>':'Perempuan';
                            //     $('#'+index).html(jk);
                            // }
                            else if (index == 'pesertaIsvalid') 
                            {
                                isValid = val;
                            }
                            else if(val == null)
                            {
                                $('#'+index).html('<span class="text-danger">Belum di isi</span>');
                            }
                            else
                            {
                                $('#'+index).html(val);
                            }
                        });

                        if (isLunas == 0) 
                        {
                            var btn = `<button disabled class=" btn btn-lg btn-default btn-block btn  btn-danger btnValid">Pembayaran belum lunas</button>`
                            $('.showBtn').html(btn);
                        }
                        else if (isValid == '1') 
                        {
                            var btn = `<button type="submit" disabled class=" btn btn-lg btn-default btn-block btn  btn-success btnValid" data-id="" data-status='1'><span class="fa  fa-check"></span> Sudah Diverifikasi</button>`
                            $('.showBtn').html(btn);
                        }
                        else
                        {
                            var btn = `<button type="submit" class="btn btn-lg btn-default btn-block btn  btn-success btnValid" data-id="" data-status='1'> Verifikasi</button>`
                            $('.showBtn').html(btn);   
                        }

                        $('.btnValid, .btnInvalid').data('id', res.pesertaNoregis);
                    }
                    else
                    {
                        $('#imageBarcode').show();

                        toastr[res.status](res.message);
                    }
                }
            })
        }

        $(document).on('click', '.btnValid, .btnInvalid', function(event) {
            id = $(this).data('id');
            status = $(this).data('status');
            _class = $(this).prop('class');

            $.ajax({
                url: '<?php echo current_url() ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {status: 'setValidasi', pesertaNoregis : id, value: status},
                beforeSend: function()
                {
                    btnLoading('.btnValid');
                },
                error: function()
                {
                    btnNormal('.btnValid', '<span class="hidden-xs"><span class="fa  fa-check"></span> Sudah Diverifikasi</span>');
                    var btn = `<button type="submit" class="btn btn-lg btn-block btn btn-success btnValid" data-id="" data-status='1'><span class="hidden-xs"> Verifikasi</span></button>`
                    $('.showBtn').html(btn);

                    toastr['error']('Terjadi kesalahan');
                },
                success: function(res)
                {
                    btnNormal('.btnValid', '<span class="hidden-xs"><span class="fa  fa-check"></span> Sudah Diverifikasi</span>');
                    if (res.status == 'success') 
                    {
                        var btn = `<button type="submit" disabled class="btn btn-lg btn-block btn btn-success btnValid" data-id="" data-status='1'><span class="hidden-xs"><span class="fa  fa-check"></span> Sudah Diverifikasi</span></button>`
                        $('.showBtn').html(btn);

                        toastr[res.status](res.message);
                    }
                    else
                    {
                        var btn = `<button type="submit" class="btn btn-lg btn-block btn btn-success btnValid" data-id="" data-status='1'><span class="hidden-xs"> Verifikasi</span></button>`
                        $('.showBtn').html(btn);

                        toastr[res.status](res.message);
                    }

                }
            })
        });

        var btnText;
        function btnLoading(selector)
        {
            btnText = $(selector).html();
            $(selector).html('<i class="fa fa-spinner fa-spin"></i> Loading .....');
            $(selector).attr('disabled', 'true');
        }

        function btnNormal(selector, text)
        {
            $(selector).html(text);
            $(selector).removeAttr('disabled');
        }

        toastConfig();
        function toastConfig(){
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

        $("#btn-cari").click(function () {
            oTable.fnFilter($("#field-cari").val());
        });

        $("#field-cari").on('keyup', function(e) {
            var key = e.which;
            if (key == 13) 
            { 
                $("#btn-cari").trigger('click');
            }
        });

    });
</script>
