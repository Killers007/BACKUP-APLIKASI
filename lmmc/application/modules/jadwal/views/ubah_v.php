
<section id="content">

    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-9">
                        <?php 
                        $text = "";
                        ?>
                        <h1 class="m-b-xs text-black hidden-xs"> <small class="m-b-xs text-black">Jadwal Pemeriksaan<span style="font-size: 13px"><?php echo ucwords(strtolower($text)); ?></span></small></h1>
                        <h2 class="m-b-xs text-black hidden-lg hidden-md hidden-sm"><small></small></h2>
                    </div>
                    <div class="col-xs-3 m-t-lg pull-right">
                     <br>
                 </div>
             </section>
         </header>
         <section class="scrollable padder space" > 
            <div class="box-body ">
                <section class="panel panel-default">

                <div class="panel-body">

                    <div id="box-cetak">


                        <table width="100%">
                            <tbody><tr>
                                <td align="center" style="font-size:17px;"><div class="font-bold">Jadwal Pemeriksaan</div></td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:14px;"><?php echo strtoupper("Jalur $dataJalur->jalurNama Tahun $dataJalur->jalurTahun") ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:14px;" id="d_cetak_semester"></td>

                            </tr>

                        </tbody></table><br>

                        <form>

                            <table id="tableJadwal" class="table table-bordered table-hover gridtable" style="" border="1">
                                <thead>
                                  <tr>
                                    <td rowspan="2" style="width:10%;vertical-align:middle;">Tanggal</td>
                                    <td colspan="4" style="vertical-align: middle" width="10%" align="center">Jumlah Peserta</td>
                                    <td rowspan="2" style="width:1%;vertical-align:middle;" align="center">Aksi</td>
                                </tr>
                                <tr>
                                    <?php foreach ($dataBiaya as $key => $value): ?>
                                        <?php $jumlah = number_format($value->jumPeserta) ?>
                                        <td align="center"><?php echo "$value->kategoriNama" ?><br> ( <span id="totPeserta_<?php echo $value->kategoriId ?>"></span> / <?php echo $jumlah ?> Peserta)</td>
                                    <?php endforeach ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataTable as $key => $value): ?>
                                    <?php $uuid = uuidV4() ?>
                                    <tr valign="center">
                                        <td>
                                            <input type="text" class="datePicker form-control input-sm " value="<?php echo date('d-m-Y', strtotime($value['tanggalPeriksa'])); ?>" name="data[<?php echo $uuid ?>][tanggalPemeriksaan]">
                                        </td>
                                        <?php foreach ($dataBiaya as $keys => $values): ?>
                                            <td><input type="number" class="form-control input-sm kategori_<?php echo $values->kategoriId ?>" data-id="<?php echo $values->kategoriId ?>" value="<?php echo $value[$values->kategoriId] ?>" name="data[<?php echo $uuid ?>][jumlahPeserta][<?php echo $values->kategoriId ?>]"></td>
                                        <?php endforeach ?>
                                        <td  align="center" style="vertical-align: middle"><a data-dismiss="alert" class="btnDelete"><i style='color : red' class="fa fa-trash-o"></i></a></td>

                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr valign="center" style="background-color: beige">
                                    <td><input type="text" autocomplete="off"  class="datePicker form-control input-sm" placeholder=""></td>
                                    <?php foreach ($dataBiaya as $key => $value): ?>
                                        <td><input type="number"  class="form-control input-sm kategori_<?php echo $value->kategoriId ?>" data-id="<?php echo $value->kategoriId ?>"  value="0"></td>
                                    <?php endforeach ?>
                                    <td align="center" style="vertical-align: middle">
                                        <a data-dismiss="alert" class="btnAdd"><i style='color : #177bbb' class="fa fa-plus"></i></a>
                                    </td> 
                                </tr>
                            </tfoot>
                        </table>
                        <span class="pesanError pull-left"></span>

                        <button class="btn btn-success pull-right btnSimpan" style="margin-right:5px"><i class="fa fa-save"></i> <span class="hidden-xs">Selesai</span></button>
                    </form>

                </div>
                </div>
                </section>
            </div>
        </section>
    </section>
</section>
<span class="text-center"></span>


</section>
 <style>
    .borderless td {
        border-top: 0px solid #eaeef1;
    }
    .progress{
        margin-bottom: 0px;
    }
    a[disabled]{
        pointer-events: none;
        cursor: default;
    }
    .ui-state-holiday{
        background-color: lavender;
    }
</style>   
<script type="text/javascript">
 
    var dataBiaya = <?php echo json_encode($dataBiaya) ?>

    $(document).ready(function() {

        var tanggal = '';

        // $(document).on('change', '.datePicker', function(event) {
        //     event.preventDefault();

        //     tanggal = $(this);
        // });

        var datesArray =  [];

        function getTanggal()
        {
            datesArray = [];
            $('.datePicker').each(function() {
                if ($(this).val() != '')
                {
                    datesArray.push($(this).val());
                }
            });

            console.log(datesArray)
        }

        date();
        function date()
        {
            getTanggal();
            $('.datePicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: false,
                beforeShowDay: function (date) {
                    for (var i = 0; i < datesArray.length; i++) {
                        if (datesArray[i] ==  moment(date).format('DD-MM-YYYY')) {
                            return 'ui-state-holiday';
                        }
                    }
                    return [true];
                },
            }).on('hide', function(e) {
                // getTanggal();
            });
        }

        function uuidv4() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

        $(document).on('change', '.datePicker', function(event) {
            // date();
        });

        $(document).on('click', '.btnAdd', function(event) {
            event.preventDefault();

            var tanggal = $(this).parents('tfoot').find('input:eq(0)').val();
            count();

            var sum = 0;
            $.each(dataBiaya, function(index, val) {
                sum += $(this).parents('tfoot').find('input:eq('+(index + 1)+')').val();
            });

            if (tanggal != '') 
            {
                template(tanggal, $(this).parents('tfoot'));
                $(this).parents('tfoot').find('input').val(0);
                $(this).parents('tfoot').find('input:eq(0)').val('');
                date();
            }


        });

         $(document).on('click', '.btnDelete', function(event) {
            event.preventDefault();

            $(this).parents('tr').remove();
            count();
        });

         var before;
         $(document).on('keyup change', 'input[type="number"]', function(event) {
            event.preventDefault();

            var id = $(this).data('id');

            find = dataBiaya.find(seep => seep.kategoriId == id);

            var sum = 0;
            $('.kategori_'+id).each(function() {
                sum += Number($(this).val());
            });

            if (sum > find.jumPeserta) 
            {
                before = (before == '')?0:before;
                $(this).val(0);
            }
            else
            {
                count();
                before = $(this).val();
            }

        });

        function template(tanggal, data)
        {
            var uuid = uuidv4();
            var txt = '<tr>';

            txt += `<td><input type="text" class="form-control datePicker input-sm" value="`+tanggal+`" name="data[`+uuid+`][tanggalPemeriksaan]"></td>`;

            $.each(dataBiaya, function(index, val) {
                txt += `<td><input type="number" class="form-control input-sm kategori_`+val.kategoriId+`" data-id="`+val.kategoriId+`" value="`+data.find('input:eq('+(index + 1)+')').val()+`" name="data[`+uuid+`][jumlahPeserta][`+val.kategoriId+`]"></td>`;
                // data.find('input:eq('+(index + 1)+')').val(12);
            });

            txt += `<td  align="center" style="vertical-align: middle"><a data-dismiss="alert" class="btnDelete"><i style='color : #e33244' class="fa fa-trash-o"></i></a></td>`;

            txt += '</tr>';

            $('#tableJadwal').find('tbody').append(txt);
        }

        $('#datetimepicker1').datetimepicker(
        {
            minDate: new Date(),
            format: 'D MMMM Y HH:mm',
            locale: 'id',
        });

     
        $(document).on('submit', 'form', function(event) {
            event.preventDefault();
            $('.btnAdd').trigger('click');

            var data = new FormData(this);

            $.ajax({
                url: '<?php echo current_url() ?>/',
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
                    if (res.status == 'error') 
                    {
                        $('.pesanError').html('<span class="text-danger">'+res.message+'</span>');
                    }
                    else
                    {
                        $('.pesanError').html('');
                        toastr[res.status](res.message);
                        setTimeout(function(){
                            window.location = '<?php echo base_url('jadwal') ?>'
                        }, 1000);
                    }
                }
            })

        });

        count();
        function count()
         {
             $.each(dataBiaya, function(index, val) {
                var sum = 0;

                $('#tableJadwal').find('.kategori_'+val.kategoriId).each(function() {
                    sum += parseInt(this.value) || 0;
                    $('#totPeserta_'+val.kategoriId).html(sum);
                });
            });
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
