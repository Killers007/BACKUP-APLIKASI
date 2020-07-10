
<section id="content">

    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-6">
                         <?php 
                        $text = "Jalur $dataJalur->jalurNama Tahun $dataJalur->jalurTahun";
                        ?>
                        <h1 class="m-b-xs text-black hidden-xs"><small><span class="text-black">Tagihan |  </span><span style="font-size: 13px"><?php echo $text ?></span></small></h1>
                        <h2 class="m-b-xs text-black hidden-lg hidden-md hidden-sm"><small></small></h2>
                    </div>
                    <div class="col-xs-6 m-t-lg pull-right">
                        <?php if (!$isTagihan): ?>
                             <a  onclick="setTitle('Generate Tagihan <?php echo $text ?>', 'Generate')" data-toggle="modal" data-target="#modal-edit" class="btnShowModal btn btn-primary pull-right" style="margin-right:5px"><i class="fa  fa-cogs"></i> <span class="hidden-xs">Generate Tagihan</span></a>
                        <?php endif ?>
                        <a data-toggle="modal" class="btnModalSms btn btn-primary pull-right <?php echo (!$isTagihan)?'hide':'' ?>" style="margin-right:5px"><i class="fa  fa-envelope"></i> <span class="hidden-xs">Kirim SMS Notifikasi</span></a>
                     <br>

                   </div>
               </section>
           </header>
           <section class="scrollable padder space" > 
            <div class="box-body ">
                <div class="row">
                    <div class="col-md-4 pull-right">
                        <div class="input-group" >
                            <input  type="text" id="field-cari" class="form-control" name="field-cari" placeholderr="Pencarian">
                            <span class="input-group-btn" >
                                <a class="btn btn-primary" id="btn-cari" href="#" value="Cari"><i class="fa fa-search"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <table id="table" width="100%" class="table table-hover table-bordered" style="margin-top: -500px"  cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle" width="1%">No</th>
                            <th style="vertical-align: middle">Nomor Peserta</th>
                            <th style="vertical-align: middle">Nama Peserta</th>
                            <th style="vertical-align: middle">Prodi</th>
                            <th style="vertical-align: middle">Biaya</th>
                            <th style="vertical-align: middle">Waktu Berlaku</th>
                            <th style="vertical-align: middle">Waktu Berakhir</th>
                            <th style="vertical-align: middle">Voucher</th>
                            <th style="vertical-align: middle">Status</th>
                            <th style="vertical-align: middle; width:150px">SMS Notifikasi Diterima Peserta</th>
                            <!-- <th style="vertical-align: middle" width="60px">Opsi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                       
            </tbody>
        </table>
    </div>
</section>
</section>
</section>
<span class="text-center"></span>

  <!--begin::Modal-->

  <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><span class="modalLabel"></span> </h4>
            </div>
            <?php echo form_open_multipart('', 'id="formData" class="kt-form kt-form--label-right"'); ?> 
            <div class="modal-body">
                <div class="box-body">

                     <?php if ($isBiaya): ?>
                        <div class="alert alert-info">
                            Harap lengkapi <a href="<?php echo base_url('biaya') ?>">pengaturan</a> biaya terlebih dahulu
                        </div>
                    <?php endif ?>

                    <h4><b>Biaya Tagihan</b></h4>
                    <p>
                        <table>
                            <?php foreach ($dataBiaya as $key => $value): ?>
                                <tr>
                                    <td style="padding-right: 20px"><h6><?php echo $value->kategoriNama ?></h6></td>
                                    <td> : </td>
                                    <td style="padding-left: 20px"><b>Rp. <?php echo number_format($value->biayaHarga,2,',','.') ?></b></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </p>
                   
                    <?php if (!$isBiaya  && !$isTagihan): ?>
                           <div id="group-nama" class="form-group">
                            <label class="control-label">Waktu Berlaku </label>
                            <div class="kt-input-icon">
                                <input type="text" autocomplete="off"  class="form-control" id="datetimepicker1" name="waktu_berlaku" placeholder="">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError waktu_berlaku"></div>
                        </div>

                        <div id="group-nama" class="form-group">
                            <label class="control-label">Waktu Berakhir </label>
                            <div class="kt-input-icon">
                                <input type="text" autocomplete="off"  class="form-control" id="datetimepicker2" name="waktu_berakhir" placeholder="">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError waktu_berakhir"></div>
                        </div>

                    <?php endif ?>
                    
                   
                    <div class="alert alert-info modalMessage">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="margin-right: -50px">
                <?php if (!$isBiaya && !$isTagihan): ?>
                    <a data-dismiss='modal' id="btnSelesai" class="btn btn-default"><span class=""><span class=""></span> Selesai</span></a data-dismiss='modal'>
                    <button type="submit" class="btn btn-success btnSimpan"><span class=""><span class="fa  fa-cogs"></span> Generate</span></button>
                <?php endif ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!--end::Modal-->

 <!--begin::Modal-->

  <div class="modal fade" id="modal-sms" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kirim SMS Notifikasi </h4>
            </div>
            <div class="modal-body">
                <div class="progress progress-md progress-striped  active">
                  <div class="progress-bar bg-info lter" id="smsPersentase" data-toggle="tooltip" data-original-title="30%" style="width: 30%"> <b style="color: black">30%</b></div>
              </div>
                <h4><b>Status Pengiriman</b></h4>
                <p>
                    <table style="width: 100%">
                        <tr>
                            <td style="padding-right: 20px; width: 130px"><h6>Terkirim</h6></td>
                            <td width="1px"> : </td>
                            <td style="padding-left: 20px"><b id="lblSmsTerkirim">asdsa</b></td>
                        </tr>
                        <tr>
                            <td style="padding-right: 20px"><h6>Gagal</h6></td>
                            <td> : </td>
                            <td style="padding-left: 20px"><b id="lblSmsGagal">asdsa</b></td>
                        </tr>
                        <tr>
                            <td style="padding-right: 20px"><h6>Total Peserta</h6></td>
                            <td> : </td>
                            <td style="padding-left: 20px"><b id="lblSmsTotal">0</b></td>
                        </tr>
                        <tr id="trStatus">
                            <td style="padding-right: 20px"><h6>Status</h6></td>
                            <td> : </td>
                            <td style="padding-left: 20px"><b id="lblStatus" class="label label-info"></b></td>
                        </tr>
                    </table>
                </p>
            </div>
            <div class="modal-footer" style="margin-right: -50px">
                <a data-dismiss='modal' class="btnHideSms btn btn-default"><span class=""><span class=""></span> Tutup</span></a data-dismiss='modal'>
                <button type="submit" class="btn btn-success btnSendSms"><span class=""><span class="fa fa-location-arrow"></span> Kirim Sms</span></button>
            </div>
        </div>
    </div>
</div>

<!--end::Modal-->


</section>
<script type="text/javascript">
    function setTitle(title, button)
    {
        $('.modalSimpan').html(button);
        $('.modalLabel').html(title);
        $('.modalMessage').hide();
        $('#btnSelesai').hide();

    }

    $(document).ready(function() {

        var dataFull;
        var tanggal;
        var dataSms;
        $('#btnSelesai').hide();

        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }

        $(document).on('click', '.btnModalSms', function(event) {

            $.ajax({
                url: '<?php echo current_url() ?>/getDetailSms/',
                type: 'POST',
                dataType: 'JSON',
                beforeSend: function()
                {
                    btnLoading('.btnModalSms');
                    cleanError();
                },
                complete: function()
                {
                    btnNormal('.btnModalSms');
                },
                success: function(res)
                {
                    $('#modal-sms').modal('show');
                    $('#lblSmsGagal').text(addCommas(res.gagal));
                    $('#lblSmsTerkirim').text(addCommas(res.terkirim));
                    $('#lblSmsTotal').text(addCommas(res.total));

                    var percentage = (parseInt(res.terkirim) / parseInt(res.total) * 100).toFixed(2);
                    $('#smsPersentase').css('width', `${percentage}%`);;
                    $('#smsPersentase').find('b').text(`${percentage}%`);

                    if (percentage == 100) 
                    {
                        $('#trStatus').hide();
                        $('.btnSendSms').hide();
                        $('.btnHideSms').show();
                    }
                    else
                    {
                        $('#trStatus').show();
                        $('.btnSendSms').show();
                        // $('.btnHideSms').hide();
                    }

                }
            })

        });

         $(document).on('click', '.btnSendSms', function(event) {
            btnLoading('.btnSendSms');
            sendSms();
        });

         function sendSms(noRegis = null)
         {
            $.ajax({
                url: '<?php echo current_url() ?>/sendSms/',
                type: 'POST',
                dataType: 'JSON',
                data: {noRegis: noRegis},
                async: true,
                beforeSend: function()
                {
                    $('.btnHideSms').hide();
                    $('#lblStatus').html('Mengirim ... <span class="fa fa-spin fa-spinner"></span>');
                },
                success: function(res)
                {
                    $('#lblSmsTerkirim').text(addCommas(res.terkirim));
                    $('#lblSmsGagal').text(addCommas(res.gagal));

                    var percentage = (parseInt(res.terkirim) / parseInt(res.total) * 100).toFixed(2);
                    $('#smsPersentase').css('width', `${percentage}%`);
                    $('#smsPersentase').find('b').text(`${percentage}%`);

                    if (parseInt(res.total) == parseInt(res.terkirim)) 
                    {
                        $('.btnSendSms').hide();
                        $('.btnHideSms').show();
                    }

                    if (res.nextNoRegis) 
                    {
                        sendSms(res.nextNoRegis);
                        $('.btnHideSms').hide();
                    }
                    else
                    {
                        $('#lblStatus').html('Selesai');
                        oTable.api().ajax.reload();
                        btnNormal('.btnSendSms');
                        $('.btnHideSms').show();
                    }
                },
                error: function()
                {
                    toastr['error']('Periksa Koneksi anda');
                    btnNormal('.btnSendSms');
                },
            })
        };

        $('#datetimepicker1').datetimepicker(
        {
            minDate: new Date(),
            format: 'D MMMM Y HH:mm',
            locale: 'id',
        });
        
        $('#datetimepicker2').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            format: 'D MMMM Y HH:mm',
            locale: 'id',
        });

        $('#datetimepicker1, #datetimepicker2').bind('keydown',function(e){

            return false;
        });


        $("#datetimepicker1").on("dp.change", function (e) {
            $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker2").on("dp.change", function (e) {
            $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        });

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

        oTable = $('#table').dataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            lengthMenu: [15, 30],
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            columnDefs: [{"className": "dt-tengah", "targets": [0,8,9]}],
            order: [[0, "asc"], [1, "desc"]],
            'searching'   : true,
            pagingType: 'numbers',
            language:{
                "search":"Pencarian : ",
                "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ Data",

            },
            ajax: {
                'type' : 'GET',
                'url' : '<?php echo current_url();?>',
                'dataSrc': function(json)
                {
                    return dataFull = json.data;
                },
            },
            columns: [
            {
                data: 'tagihanNoRegis', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'tagihanNoRegis'},
            {data: 'tagihanPesertaNama'},
            {data: 'tagihanProdiNama'},
            {
                data: 'tagihanBiaya', render: function (data, type, row, meta) 
                {
                    if (data) 
                    {
                        return 'Rp. '+formatRupiah(data);
                    }

                    return '';
                }
            },
            {data: 'tagihanWaktuberlaku', render: function (data) {
                   
                   return moment(data).locale('id').format('D MMMM YYYY')+`
                    <a href="#" class="btn btn-default btn-xs">
                    <i class="glyphicon glyphicon-time text-muted"></i>&nbsp;`
                    +moment(data).locale('id').format('H:m')+`
                    </a>`;
                   
                }
            },
            {data: 'tagihanWaktuberakhir', render: function (data) {
                   
                   return moment(data).locale('id').format('D MMMM YYYY')+`
                    <a href="#" class="btn btn-default btn-xs">
                    <i class="glyphicon glyphicon-time text-muted"></i>&nbsp;`
                    +moment(data).locale('id').format('H:m')+`
                    </a>`;
                }
            },
            {data: 'tagihanVoucher'},
            {
                data: 'tagihanIslunas', searchable: true, orderable: true, render: function (data) {
                   
                   if (parseInt(data) == 1) 
                   {
                        return `<span class="label label-success">Lunas</span>`;
                   }

                   return `<span class="label label-danger">Belum Bayar</span>`;
                }
            },
            {
                data: 'tagihanPesanIsTerkirim', searchable: true, orderable: true, render: function (data) {
                   
                   if (data == null) 
                   {
                        return `<span class="label label-warning">BELUM DIKIRIM</span>`;
                   }
                   else if (parseInt(data) == 1) 
                   {
                        return `<span class="label label-success">YA</span>`;
                   }

                   return `<span class="label label-danger">TIDAK</span>`;
                }
            },
            // {
            //     data: null, searchable: false, orderable: false, render: function (data) {
                   
            //         var btnUbah =  `&nbsp;<a onclick="setTitle('Perbaharui', 'Perbaharui')" data-id="`+data.tagihanNoRegis+`" class="btnEdit btn btn-xs btn-default" title="View">
            //         <i style="color: #1aabbb;"class="i i-pencil2"></i>
            //         </a>` ;

            //         var btnHapus = `<a class="btn btn-xs btn-default btnDelete" data-toggle="tooltip" data-id='`+data.tagihanNoRegis+`' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' title='Hapus'><span style='color : #e33244' class='i i-trashcan'></span></a> `;
                    
            //         var btnDetail = `&nbsp;<a class="btn btn-xs btn-default btnDetail" data-toggle="tooltip" data-toggle='modal' data-id='`+data.tagihanNoRegis+`' data-target='#modal-detail' title='Detail'><span style='color : #177bbb' class='fa fa-search'></span></a> `;

            //             return btnUbah + btnHapus;
            //     }
            // },
            ],
        });

        // oTable.fnSetColumnVis(0,false,false);
        // oTable.fnSetColumnVis(1,false,false);

   
        $(document).on('click', '.btnShowModal', function(event) {
            id = '';

            cleanError();
            $('#formData').trigger('reset');
            $('.kt-select2').val(null).trigger('change');
        });

        var id = '';

        $(document).on('submit', 'form', function(event) {
            event.preventDefault();

            var data = new FormData(this);

            $.ajax({
                url: '<?php echo current_url() ?>/generateTagihan/',
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                processData : false,
                contentType: false,
                data: data,
                beforeSend: function()
                {
                    btnLoading('.btnSimpan');
                    cleanError();
                },
                complete: function()
                {
                    btnNormal('.btnSimpan');
                },
                success: function(res)
                {
                    if (!res.status) 
                    {
                        getError(res)
                    }
                    else if(res.status == 'success')
                    {
                        $('#btnSelesai').show();
                        $('.btnSimpan').hide();
                        $('.modalMessage').fadeIn();
                        oTable.api().ajax.reload();

                        $('.btnModalSms').removeClass('hide');

                        $('#modal-edit').find('.modalMessage').removeClass('alert-info').addClass('alert-success').html(res.message);
                    }
                    else
                    {
                        $('.modalMessage').fadeIn();

                        $('#modal-edit').find('.modalMessage').removeClass('alert-success').addClass('alert-info').html(res.message);
                    }


                }
            })

        });

      
        function getError(data)
        {
            $.each(data.error, function(index, el) 
            {
                $('.'+index).html(el);
            }); 
        }

        function cleanError()
        {
            $('.cleanError').html('');
        }

        var btnText;
        function btnLoading(selector)
        {
            btnText = $(selector).html();
            $(selector).html('<i class="fa fa-spinner fa-spin"></i> Loading .....');
            $(selector).attr('disabled', 'true');
        }

        function btnNormal(selector)
        {
            $(selector).html(btnText);
            $(selector).removeAttr('disabled');
        }

        function getError(data)
        {
            $.each(data.error, function(index, el) 
            {
                $('.'+index).html(el);
                $('.'+index).parent().removeClass('has-error');

                if (el != '') 
                {
                    $('.'+index).parent().addClass('has-error');
                }


            }); 
        }

        function cleanError()
        {
            $('.cleanError').html('');
            $('.cleanError').parent().removeClass('has-error');
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
