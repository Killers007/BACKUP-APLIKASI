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
                                                        <h1 class="m-b-xs text-black hidden-xs"><small><?php echo $label ?> Panduan<span style="font-size: 12px"></span></small></h1>
                                                    </div>
                                                    <div class="col-xs-4 m-t-md pull-right">
                                                        <a href="javascript: history.go(-1)" type="button" class="btn btn-default pull-right" style="margin-right:5px"><i class="fa  fa-reply"></i> <span class="hidden-xs">Kembali</span></a>
                                                    </div>
                                                </section>
                                            </header>
                                            <div class="panel-body">
                                                <div class="panel-body">
                                                    <?php echo form_open_multipart('', 'id="formData" class="form-horizontal"'); ?> 
                                                        <div class="form-group">

                                                           <!--  <label class="col-sm-2 control-label">Tahun</label>
                                                            <div class="col-sm-10 ">
                                                                <input type="text" class="form-control" name="panduanTahun" value="<?php echo @($dataPanduan->panduanTahun) ?>" style="text-align: left">
                                                                <div class="cleanlabel panduanTahun"></div>
                                                            </div> -->

                                                            <label class="col-sm-2 control-label">Versi Panduan</label>
                                                            <div class="col-sm-10 ">
                                                                <input type="text" class="form-control" name="panduanVersi" value="<?php echo @($dataPanduan->panduanVersi) ?>" style="text-align: left">
                                                                <div class="cleanlabel panduanVersi"></div>
                                                            </div>
                                                        </div>

                                                        <div class="line line-dashed b-b line-lg pull-in"></div>
                                                      
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Deskripsi</label>
                                                            <div class="col-sm-10 ">
                                                                <textarea id="panduanKeterangan" name="panduanDeskripsi" class="form-control" rows="10" placeholder="Keterangan atau spesifikasi…"><?php echo @($dataPanduan->panduanDeskripsi) ?></textarea>
                                                                <div class="cleanlabel panduanDeskripsi"></div>
                                                            </div>
                                                        </div>

                                                         <div class="form-group">
                                                            <label class="col-sm-2 control-label">Gambar</label>
                                                            <div class="col-sm-10 ">
                                                                <?php $foto = isset($dataPanduan->panduanGambar)? base_url('panduan/image/'.$dataPanduan->panduanGambar):'' ?>
                                                                <img style="size: 100px;" class="img-thumbnail" id="viewer" src="<?php echo $foto ?>">
                                                                <input type="file" name="panduanGambar" class="filestyle" accept="image/*">
                                                                <div class="cleanlabel panduanGambar help-block text-danger"></div>
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



                                                        <?php echo form_close(); ?>
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

        tinymce.init({
            selector: 'textarea',
            theme: 'modern',
            // plugins: "lists",
            menubar: false,
            protect: [
              /\<!\[if !mso\]\>/g,   // Protect <![if !mso]>
              /\<!\[if !vml\]\>/g,   // Protect <![if !vml]>
              /\<!\[endif\]\>/g,     // Protect <![endif]>
              /<\?php[\s\S]*?\?>/g  
            ],
            plugins: 'paste',
            paste_remove_spans: true,
            paste_remove_styles: true,
            paste_auto_cleanup_on_paste: true
        });

        $('input[name="panduanGambar"]').change(function(event) {
           pdffile= $(this).get(0).files[0];
           pdffile_url=URL.createObjectURL(pdffile);
           $('#viewer').attr('src',pdffile_url);
       });

     
        $('form').submit(function(e) 
        {
           tinymce.triggerSave('#panduanKeterangan');

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
                        id = '';
                        window.location = '<?php echo base_url('panduan') ?>';
                    }
                }
            })

        });

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

        function getError(data)
        {
            $.each(data.error, function(index, el) 
            {
                $('.'+index).html(el);
                $('.'+index).parent().parent().removeClass('has-error');

                if (el != '') 
                {
                    $('.'+index).parent().parent().addClass('has-error');
                }


            }); 
        }

        function cleanError()
        {
            $('.cleanError').html('');
            $('.cleanError').parent().parent().removeClass('has-error');
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