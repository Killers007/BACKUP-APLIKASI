<section id="content">
    <section class="hbox stretch">
        <section class="vbox">
            <section class="scrollable">
                <section class="content">
                    <div class="box">
                        <div class="box-body">

                            <form action="javascript:void(0);" class="form-horizontal">
                                <section id="content">
                                    <section class="hbox stretch">
                                        <section class="vbox">
                                            <header class="header bg-white b-b b-light">
                                                <section class="row m-b-md" style="">
                                                    <div class="col-xs-8">
                                                        <h1 class="m-b-xs text-black hidden-xs"><small><?php echo $label ?> Jadwal Jaga Klinik<span style="font-size: 12px"></span></small></h1>
                                                    </div>
                                                    <div class="col-xs-4 m-t-md pull-right">
                                                        <a href="javascript: history.go(-1)" type="button" class="btn btn-default pull-right" style="margin-right:5px"><i class="fa  fa-reply"></i> <span class="hidden-xs">Kembali</span></a>
                                                    </div>
                                                </section>
                                            </header>
                                            <div class="panel-body">
                                                <div class="panel-body">
                                                    <form class="form-horizontal" method="get">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Klinik</label>
                                                            <div class="col-sm-10 ">
                                                                <?php if (isset($dataKlinik)): ?>
                                                                    <input type="text" name="jagaKlinikid" class="hidden btn form-control" value="<?php echo $dataKlinik->jagaKlinikid ?>" style="text-align: left">
                                                                    <input type="text" readonly class="btn form-control" value="<?php echo $dataKlinik->klinikNama ?>" style="text-align: left">
                                                                <?php else: ?>
                                                                    <?php echo form_dropdown('jagaKlinikid', $selectKlinik, null, array('class' => 'form-control chosen-select', 'style' => 'width:100%')); ?>
                                                                <?php endif ?>
                                                            <div class="cleanError jagaKlinikid"></div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Tanggal Jaga</label>
                                                            <div class="col-sm-10 ">
                                                            <?php $now = date('d-m-Y'); ?>
                                                             <div class="input-group date">
                                                                <?php if (isset($dataKlinik)): ?>
                                                                    <input type="text" readonly name="jagaTanggal" class="btn form-control" value="<?php echo date('d-m-Y', strtotime($dataKlinik->jagaTanggal)) ?>" style="text-align: left">
                                                                <?php else: ?>
                                                                    <input type="text" readonly name="jagaTanggal" class="btn datePicker form-control" value="" style="text-align: left">
                                                                <?php endif ?>
                                                                <div class="input-group-addon">
                                                                    <span class="fa fa-calendar"></span>
                                                                </div>
                                                            </div>
                                                            <div class="cleanError jagaTanggal"></div>
                                                            </div>
                                                        </div>

                                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Dokter Jaga</label>
                                                            <div class="col-sm-10">
                                                                <table class="table-responsive table table-hover table-bordered" style="width: 100%; display: table" id="nipTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <td style="text-align: center; width: 1px"><input type="checkbox" id="check-all" /></td>
                                                                            <th>Nama Dokter</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="listDokter">

                                                                    </tbody>

                                                                </table>
                                                                <div class="cleanError dokterNip"></div>
                                                            </div>
                                                        </div>

                                                        <div class="line line-dashed b-b line-lg pull-in" id="pengelolaanKelompok"></div>
                                                        <div class="form-group">
                                                            <div class="pull-left"></div>
                                                            <div class="pull-right">
                                                                <button type="submit" id="btnSimpan"  class="btn btn-success pull-right" style="margin-right:5px"><i class="fa  fa-save"></i> <span class="hidden-xs">Simpan</span></button>
                                                                <a href="javascript: history.go(-1)" type="button" class="btn btn-default pull-right" style="margin-right:5px"><i class="fa  fa-times-circle"></i> <span class="hidden-xs">Batal</span></a>
                                                                <br>
                                                            </div>
                                                        </div>


                                                    </form>
                                                </div>
                                            </div>
                                            <br />
                                        </section>
                                    </section>
                                </section>
                            </form>
                        </div>
                    </div>
                </section>
            </section>
        </section>
    </section>
</section>

<script type="text/javascript">

    $(document).ready(function() {

        var jagaKlinikid = '<?php echo @($dataKlinik->jagaKlinikid) ?>';
        var jagaTanggal = '<?php echo @($dataKlinik->jagaTanggal) ?>';

        $('.datePicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
        }).on('hide', function(e) {
            // $('.datePicker').val(moment(tanggal).locale('id').format('dddd, D MMMM YYYY'));
        });

        function listDokter()
        {
            $.ajax({
                url: '<?php echo current_url() ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    status: 'getListDokter',
                    klinikId: jagaKlinikid,
                    tanggal: jagaTanggal,
                },
                error: function()
                {
                    toastr['error']('Periksa Koneksi anda');
                },
                success: function(res)
                {
                   var text = '';

                   $.each(res.dokter, function(index, val) {

                    find = res.jagaKlinik.find(seep => seep.jagaDokterid == val.dokterNip);

                        var checked = (find)?'checked':'';

                        text += `<tr>
                            <td><input type="checkbox" `+checked+` name='dokterNip[]' value = '`+val.dokterNip+`'></td>
                            <td>`+val.dokterNama+`<br><span class="form-text text-danger cleanError `+val.dokterNip+`"></span></td>
                        </tr>`
                   });

                   $('#listDokter').html(text);
                }
            })
        }

        $(document).on('change', 'select[name="jagaKlinikid"]', function(event) {
            jagaKlinikid = $(this).val();

            listDokter();
        });

        $(document).on('change', 'input[name="jagaTanggal"]', function(event) {
            jagaTanggal = $(this).val();

            listDokter();
        });

        listDokter();
        $('form').submit(function(e) 
        {
            e.preventDefault();

            var data = new FormData(this);

            $.ajax({
                url: '<?php echo current_url() ?>',
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                processData : false,
                contentType: false,
                data: data,
                beforeSend: function()
                {
                    btnLoading('#btnSimpan')
                    cleanError();
                    
                },
                complete: function()
                {
                     btnNormal('#btnSimpan')
                },
                error: function()
                {
                    btnNormal('#btnSimpan')
                    toastr['error']('Periksa Koneksi anda');
                },
                success: function(res)
                {
                    if (!res.status) 
                    {
                        getError(res)
                    }
                    else
                    {
                        listDokter();
                        toastr[res.status](res.message);
                        id = '';
                        window.location = '<?php echo base_url('jaga_klinik') ?>';
                    }
                }
            })

        });

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
      /* ----------------------   END  ----------------------*/

  });

</script>