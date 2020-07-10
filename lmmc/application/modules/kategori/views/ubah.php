<section id="content">
    <section class="hbox stretch">  
        <section class="vbox">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-8">
                        <h1 class="m-b-xs text-black hidden-xs"><small><b>Pasien</b><span style="font-size: 14px"> | <?php echo $label ?></span></small></h1>
                    </div>
                    <div class="col-xs-4 m-t-lg pull-right">
                        <a href="<?php echo base_url('pasien') ?>" type="button" class="btn btn-default pull-right" style="margin-right:5px"><i class="fa  fa-reply"></i> <span class="hidden-xs">Kembali</span></a>
                    </div>
                </section>
            </header> 
            <section class="scrollable space padder">

                <div class="box-body">
                    <div class="row" style="margin: 0px;"> 

                        <?php echo form_open_multipart('', 'class="form-horizontalEE"'); ?> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <?php $foto = isset($dataPasien->pasienFoto)? base_url('penilaian/blok/assets/'.$dataPasien->pasienFoto):base_url('assets/data/images/no_pict.png') ?>
                                <img style="size: 100px;" class="img-thumbnail" id="viewer" src="<?php echo $foto ?>">

                                <input type="file" name="pasienFoto" class="filestyle">
                                <div class="cleanlabel pasienFoto help-block text-danger"></div>
                            </div>
                        </div>

                        <div class="col-md-7">
                          <div class="form-group">
                            <label class="control-label col-sm-2EE">NIK </label>
                            <!-- <div class="col-sm-9"> -->
                                <input type="text" name="pasienNIK" value="<?php echo isset($dataPasien->pasienNIK)?$dataPasien->pasienNIK:'' ?>" class="form-control" placeholder="NIK">
                                <div class="cleanlabel pasienNIK"></div>
                            <!-- </div> -->
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2EEE">No Rekam Medis </label>
                            <input type="text" name="pasienRekmedis" value="<?php echo isset($dataPasien->pasienRekmedis)?$dataPasien->pasienRekmedis:'' ?>" autocomplete="false" class="form-control" placeholder="No Rekam Medis">
                            <div class="cleanlabel pasienRekmedis"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2EE">Nama </label>
                            <!-- <div class="col-sm-9"> -->
                                <input type="text" name="pasienNama"  value="<?php echo isset($dataPasien->pasienNama)?$dataPasien->pasienNama:'' ?>" class="form-control" placeholder="Nama">
                                <div class="cleanlabel pasienNama"></div>
                            <!-- </div> -->
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2EE">Alamat </label>
                            <!-- <div class="col-sm-9"> -->
                                <input type="text" name="pasienAlamat"  value="<?php echo isset($dataPasien->pasienAlamat)?$dataPasien->pasienAlamat:'' ?>" class="form-control" placeholder="Alamat">
                                <div class="cleanlabel pasienAlamat"></div>
                            <!-- </div> -->
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2EE">Tempat Tanggal Lahir </label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="paseinTempatlahir" value="<?php echo isset($dataPasien->paseinTempatlahir)?$dataPasien->paseinTempatlahir:'' ?>" class="form-control" placeholder="Tempat">
                                    <div class="cleanlabel paseinTempatlahir"></div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="paseinTgllahir" value="<?php echo isset($dataPasien->paseinTgllahir)?$dataPasien->paseinTgllahir:'' ?>" class="form-control datePicker" placeholder="Tanggal Lahir">
                                    <div class="cleanlabel paseinTgllahir"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2EE">No HP </label>
                            <!-- <div class="col-sm-9"> -->
                                <input type="text" name="pasienNohp" value="<?php echo isset($dataPasien->pasienNohp)?$dataPasien->pasienNohp:'' ?>" class="form-control" placeholder="No Hp">
                                <div class="cleanlabel pasienNohp"></div>
                            <!-- </div> -->
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2EE">Agama </label>
                            <!-- <div class="col-sm-9"> -->
                                <?php echo form_dropdown('paseinAgama', $selectAgama, isset($dataPasien->paseinAgama)?$dataPasien->paseinAgama:'', array('class' => 'form-control chosen-select input_table', 'style' => 'width:100%')); ?>
                                <div class="cleanlabel paseinAgama"></div>
                            <!-- </div> -->
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2EE">Golongan Darah </label>
                            <!-- <div class="col-sm-9"> -->
                                <?php echo form_dropdown('paseinGoldarah', $selectGolDarah, isset($dataPasien->paseinGoldarah)?$dataPasien->paseinGoldarah:'', array('class' => 'form-control chosen-select input_table', 'style' => 'width:100%')); ?>
                                <div class="cleanlabel paseinGoldarah"></div>
                            <!-- </div> -->
                        </div>

                        <!-- <div class="form-group">
                            <label class="control-label col-sm-2EE">Status </label>
                            <?php echo form_dropdown('paseinStatuskawin', $selectStatusKawin, isset($dataPasien->paseinStatuskawin)?$dataPasien->paseinStatuskawin:'', array('class' => 'form-control chosen-select input_table', 'style' => 'width:100%')); ?>
                            <div class="cleanlabel paseinStatuskawin"></div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label class="control-label col-sm-2EE">Jenis Kelamin </label>
                                <?php echo form_dropdown('paseinJK', $selectJK, isset($dataPasien->paseinJK)?$dataPasien->paseinJK:'', array('class' => 'form-control chosen-select input_table', 'style' => 'width:100%')); ?>
                                <div class="cleanlabel paseinJK"></div>
                        </div> -->

                        <div class="form-group">
                            <label class="control-label col-sm-2EE">Status </label>
                            <?php foreach ($selectStatusKawin as $key => $value): ?>
                                <?php $availabe = !isset($dataPasien->paseinStatuskawin) && $key == 0?'checked':'' ?>
                                <div class="radio i-checks"> <label> <input type="radio" name="paseinStatuskawin" value="<?php echo $key ?>" <?php echo isset($dataPasien->paseinStatuskawin)?$dataPasien->paseinStatuskawin == $key?'checked':'':''; ?> <?php echo $availabe ?>> <i></i> <?php echo $value ?> </label> </div> 
                            <?php endforeach ?>
                            <div class="cleanlabel paseinStatuskawin"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2EE">Jenis Kelamin </label>
                            <?php foreach ($selectJK as $keys => $values): ?>
                                <?php $availabe = !isset($dataPasien->paseinJK) && $keys == 'L'?'checked':'' ?>
                                <div class="radio i-checks"> <label> <input type="radio" name="paseinJK" value="<?php echo $keys ?>" <?php echo isset($dataPasien->paseinJK)?$dataPasien->paseinJK == $keys?'checked':'':''; ?> <?php echo $availabe ?>> <i></i> <?php echo $values ?> </label> </div> 
                            <?php endforeach ?>
                            <div class="cleanlabel paseinJK"></div>
                        </div>

                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="">
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-2">
                                <span class="pull-right">
                                    <button class="btn btn-success pull-right" type="submit"  id="btnSimpan" style="margin-right:5px">
                                        <span class="fa fa-save"></span><span class="hidden-xs"> Simpan</span></button>
                                        <!-- <span class="hidden-xs"><span class="fa  fa-save"></span> Simpan</span></button> -->
                                        <!-- <a href="<?php echo base_url('pasien') ?>" type="button" class="btn btn-default pull-right" style="margin-right:5px"><i class="fa  fa-reply"></i> <span class="hidden-xs">Kembali</span></a> -->
                                        <br>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </form>                    

                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
        </section>
    </section>          
</section>
</section>

<script type="text/javascript">

    $(document).ready(function() {

        $('input[name="pasienFoto"]').change(function(event) {
         pdffile= $(this).get(0).files[0];
         pdffile_url=URL.createObjectURL(pdffile);
         $('#viewer').attr('src',pdffile_url);
     });

        $('.datePicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });

         $( document ).on( 'focus', ':input', function(){
            $( this ).attr( 'autocomplete', 'off' );
        });

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

                },
                error: function()
                {
                    btnNormal('#btnSimpan')
                    toastr['error']('Periksa Koneksi anda');
                },
                success: function(res)
                {
                    if (res.status == 'validate') 
                    {
                        $.each(res.error, function(index, val) {
                           $('.'+index).html(val);
                       });
                        btnNormal('#btnSimpan')
                    }
                    else
                    {
                        cleanError();
                        // btnNormal('#btnSimpan')
                        toastr[res.status](res.message);

                        setTimeout(function(){
                            window.location = '<?php echo base_url('pasien') ?>'

                        }, 1000)

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

        function cleanError()
        {
            $('.cleanlabel').html('');
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