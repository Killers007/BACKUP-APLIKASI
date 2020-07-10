
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
                     <a href="<?php echo base_url('jadwal/perbaharui') ?>" class="btn btn-primary pull-right" style="margin-right:5px"><i class="fa  fa-pencil"></i> <span class="hidden-xs">Perbaharui</span></a>
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

                        <table id="krs_table" class="table table-bordered table-hover gridtable" style="" border="1">
                            <thead>
                              <tr>
                                <td rowspan="2" style="width:1%;vertical-align:middle;" align="">NO</td>
                                <td rowspan="2" style="width:10%;vertical-align:middle;">Tanggal</td>
                                <td colspan="4" style="vertical-align: middle" width="10%" align="center">Jumlah Peserta</td>
                            </tr>
                            <tr>
                                <?php foreach ($dataBiaya as $key => $value): ?>
                                    <td align="center"><?php echo $value->kategoriNama ?></td>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $jumlah = []; ?>
                            <?php if (empty($dataTable)): ?>
                                <tr><td  colspan="7" class="text-center">Tidak ada data</td></tr>
                            <?php endif ?>

                            <?php foreach ($dataTable as $key => $value): ?>
                                <tr valign="center">
                                    <?php $date = date_convert($value['tanggalPeriksa']); ?>
                                    <td align="center"><?php echo ($key + 1) ?></td> 
                                    <td><?php echo $date->dayName.', '.$date->default ?></td>
                                    <?php foreach ($dataBiaya as $key => $values): ?>
                                        <?php $jumlah[$values->kategoriId][] = $value[$values->kategoriId]; ?> 
                                        <td align="center"><?php echo number_format($value[$values->kategoriId]); ?></td>
                                    <?php endforeach ?>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <?php if (!empty($dataTable)): ?>
                                <tr valign="center">
                                    <td colspan="2" class="text-center"><b>Jumlah</b></td>
                                    <?php foreach ($dataBiaya as $key => $values): ?>
                                        <td align="center"><b>(<?php echo @number_format(array_sum($jumlah[$values->kategoriId])) ?> / <?php echo number_format($values->jumPeserta) ?>)</b></td>
                                    <?php endforeach ?>
                                </tr>
                            <?php endif ?>
                        </tfoot>
                    </table>
                    </div>
                </div>


                </section>
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
                <h4 class="modal-title"><span class="modalLabel"></span> Data</h4>
            </div>
            <?php echo form_open_multipart('', 'id="formData" class="kt-form kt-form--label-right"'); ?> 
            <div class="modal-body">
                <div class="box-body">
                    <div id="group-nama" class="form-group">
                        <label class="control-label">NIP </label>
                        <div class="kt-input-icon">
                            <input type="text" class="form-control" name="dokterNip" placeholder="">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                        </div>
                        <div class="cleanError dokterNip"></div>
                    </div>
                    
                    <div id="group-nama" class="form-group">
                        <label class="control-label">Nama <span class="text-danger">*</span></label>
                        <div class="kt-input-icon">
                            <input type="text" class="form-control" name="dokterNama" placeholder="">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                        </div>
                        <div class="cleanError dokterNama"></div>
                    </div>

                </div>
            </div>
            <div class="modal-footer" style="margin-right: -50px">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success btnSimpan"><span class=""><span class="fa  fa-save"></span> Simpan</span></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!--end::Modal-->

<!--begin::Modal-->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Apakah anda yakin menghapus data?</h4>
            </div>
            <div class="modal-body modalDeleteBody">

            </div>
            <div class="modal-footer" style="margin-right: -50px">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btnConfirmDelete">Hapus</button>
            </div>
        </div>
    </div>


</div>
<!--end::Modal-->


<!--Modal detail-->
<div id="modal-detail" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h4>Detail Dokter</h4></div>
            <div class="modal-body">

                <div class="modalBody"></div>
            </div>
            <div class="modal-footer2" style="text-align: center">
                <button id="btn-batal" data-dismiss="modal" class="btn btn-default">Tutup</button>
            </div>
        </div>
    </div>
</div>



</section>
<script type="text/javascript">
    function setTitle(title, button)
    {
        $('.modalSimpan').html(button);
        $('.modalLabel').html(title);
    }

    $(document).ready(function() {

        var dataFull;
        var tanggal;

        oTable = $('#table').dataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            lengthMenu: [15, 30],
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            columnDefs: [{"className": "dt-tengah", "targets": [0,3]}],
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
                data: 'dokterId', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'dokterNip'},
            {data: 'dokterNama'},
            {
                data: null, searchable: false, orderable: false, render: function (data) {

                    var btnUbah =  `&nbsp;<a onclick="setTitle('Perbaharui', 'Perbaharui')" data-id="`+data.dokterId+`" class="btnEdit btn btn-xs btn-default" title="View">
                    <i style="color: #1aabbb;"class="i i-pencil2"></i>
                    </a>` ;

                    var btnHapus = `<a class="btn btn-xs btn-default btnDelete" data-toggle="tooltip" data-id='`+data.dokterId+`' data-nama='`+data.pasienNama+`' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' title='Hapus'><span style='color : #e33244' class='i i-trashcan'></span></a> `;
                    
                    var btnDetail = `&nbsp;<a class="btn btn-xs btn-default btnDetail" data-toggle="tooltip" data-toggle='modal' data-id='`+data.dokterId+`' data-target='#modal-detail' title='Detail'><span style='color : #177bbb' class='fa fa-search'></span></a> `;

                    return btnUbah + btnHapus;
                }
            },
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
        $(document).on('click', '.btnEdit', function(event) {
            id = $(this).data('id');
            
            cleanError();

            $('#modal-edit').modal('show');

            find = dataFull.find(seep => seep.dokterId == id);


            $.each(find, function(index, el) 
            {

                if (index == 'pegawaiFoto') {
                    $('#pegawaiFoto').attr("style", 'background-image: url("<?php echo base_url('assets/upload/images') ?>/'+el+'")');
                }
                else
                {
                    $('input[name="'+index+'"]').val(el);
                    $('textarea[name="'+index+'"]').val(el);
                }
            }); 

        });


        $(document).on('click', '.btnDelete', function(event) {
            id = $(this).data('id');
            $('#modal-delete').modal('show');

            find = dataFull.find(seep => seep.dokterId == id);

            template(find);
        });

        function template(data)
        {
            var txt = `<div class="table-responsive">
            <table class="table table-hover" style="width:100%; display: table">
            <tbody>`;

            var label = ['Nama Dokter'];
            var key   = ['dokterNama'];

            $.each(key, function(index, el) 
            {
                if (data[el]) 
                {
                    txt += `
                    <tr>
                    <th width="">`+label[index]+`</th>
                    <td width="1px">:</td>
                    <td>`+data[el]+`</td>
                    </tr>
                    `;
                }
            }); 

            txt += ` </tbody>
            </table>
            </div>`;

            $('.modalDeleteBody').html(txt);
        }

        $(document).on('submit', 'form', function(event) {
            event.preventDefault();

            var data = new FormData(this);

            $.ajax({
                url: '<?php echo current_url() ?>/replaceData/'+id,
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
                    else
                    {
                        toastr[res.status](res.message);

                        id = '';
                        $('#modal-edit').modal('hide');
                        oTable.api().ajax.reload();
                    }
                }
            })

        });

        $(document).on('click', '.btnConfirmDelete', function(event) {
            event.preventDefault();

            $.ajax({
                url: '<?php echo current_url() ?>/deleteData/'+id,
                type: 'POST',
                dataType: 'JSON',
                beforeSend: function()
                {
                    btnLoading('.btnConfirmDelete');
                },
                complete: function()
                {
                    btnNormal('.btnConfirmDelete');
                },
                success: function(res)
                {
                    id = '';

                    toastr[res.status](res.message);

                    $('#modal-delete').modal('hide');
                    oTable.api().ajax.reload();
                },
                error: function()
                {
                    // toastr['error']('');
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
