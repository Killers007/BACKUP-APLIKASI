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
                                                        <h1 class="m-b-xs text-black hidden-xs"><small><?php echo $label ?> Kategori Prodi<span style="font-size: 12px"></span></small></h1>
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
                                                            <label class="col-sm-2 control-label">Kategori</label>
                                                            <div class="col-sm-10 ">
                                                                    <?php echo form_dropdown('ktgprdKategoriId', $selectKategori, null, array('class' => 'form-control chosen-select', 'style' => 'width:100%')); ?>
                                                            <div class="cleanError ktgprdKategoriId"></div>
                                                            </div>
                                                        </div>

                                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Prodi</label>
                                                            <div class="col-sm-10">
                                                                <table class="table-responsive table table-hover table-bordered" style="width: 100%; display: table" id="nipTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <td style="text-align: center; width: 1px"><input type="checkbox" id="check-all" /></td>
                                                                            <th>Fakultas</th>
                                                                            <th>Program Studi</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="listDokter">

                                                                    </tbody>

                                                                </table>
                                                                <div class="cleanError ktgprdProdiId"></div>
                                                            </div>
                                                        </div>

                                                        <div class="line line-dashed b-b line-lg pull-in" id="pengelolaanKelompok"></div>
                                                        <div class="form-group">
                                                            <div class="pull-left"></div>
                                                            <div class="pull-right">
                                                                <button type="submit" id="btnSimpan"  class="btn btn-success pull-right" style="margin-right:5px"><i class="fa  fa-save"></i> <span class="hidden-xs">Simpan</span></button>
                                                                <!-- <a href="javascript: history.go(-1)" type="button" class="btn btn-default pull-right" style="margin-right:5px"><i class="fa  fa-times-circle"></i> <span class="hidden-xs">Batal</span></a> -->
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

        var ktgprdKategoriId = '<?php echo @($dataKlinik->ktgprdKategoriId) ?>';

        function listDokter()
        {
            $.ajax({
                url: '<?php echo current_url() ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    status: 'getListProdi',
                    kategoriId: ktgprdKategoriId,
                },
                error: function()
                {
                    toastr['error']('Periksa Koneksi anda');
                },
                success: function(res)
                {
                   var text = '';

                   $.each(res, function(index, val) {

                    var checked = parseInt(val.ktgprdId)?'checked':'';

                    text += `<tr>
                            <td><input type="checkbox" `+checked+` name='ktgprdProdiId[]' value = '`+val.prodiKode+`'></td>
                            <td>`+val.fakNamaResmi+`<br><span class="form-text text-danger`+val.prodiKode+`"></span></td>
                            <td> ${val.prodiJjarKode} - `+val.prodiNamaResmi+`<br><span class="form-text text-danger `+val.prodiKode+`"></span></td>
                        </tr>`
                   });

                   $('#listDokter').html(text);
                }
            })
        }

        $(document).on('change', 'select[name="ktgprdKategoriId"]', function(event) {
            ktgprdKategoriId = $(this).val();

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
                        toastr[res.status](res.message);
                        window.location = '<?php echo base_url('kategori_prodi') ?>';
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