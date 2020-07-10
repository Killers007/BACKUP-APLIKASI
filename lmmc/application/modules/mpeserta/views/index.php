
<section id="content">

    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-6 col-md-6 col-lg-6">
                        <?php 
                        $text = "Jalur $dataJalur->jalurNama Tahun $dataJalur->jalurTahun";
                        ?>
                        <h1 class="m-b-xs text-black hidden-xs"><small><span class="m-b-xs text-black">Peserta | </span> <span style="font-size: 13px"><?php echo $text ?></span></small></h1>
                        <h2 class="m-b-xs text-black hidden-lg hidden-md hidden-sm"><small></small></h2>
                    </div>
                    <div class="col-xs-6 col-md-6 col-lg-6 m-t-lg pull-right">
                        <a href="<?php echo base_url('mpeserta/download') ?>" class="btn btn-primary pull-right" style="margin-right:5px" target="_blank">
                            <i class="fa  fa-download"></i> 
                            <span class="hidden-xs">
                                Download Template
                            </span>
                        </a>

                        <a data-toggle="modal" data-target="#modal-import" class="btnShowModal btn btn-primary pull-right" style="margin-right:5px">
                            <i class="fa  fa-upload"></i> 
                            <span class="hidden-xs">
                               Import Peserta
                            </span>
                        </a>

                        <a  onclick="setTitle('Tambah', 'Tambah')" data-toggle="modal" data-target="#modal-edit" class="btnShowModal btn btn-primary pull-right" style="margin-right:5px"><i class="fa  fa-plus"></i> <span class="hidden-xs">Tambah Data</span></a>

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
                                <th style="vertical-align: middle">Nama</th>
                                <th style="vertical-align: middle">No Hp</th>
                                <th style="vertical-align: middle">Fakultas</th>
                                <th style="vertical-align: middle">Program Studi</th>
                                <th style="vertical-align: middle" width="90px">Opsi</th>
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
                    <h4 class="modal-title"><span class="modalLabel"></span> Data</h4>
                </div>
                <?php echo form_open_multipart('', 'id="formData" class="formData kt-form kt-form--label-right"'); ?> 
                <div class="modal-body">
                    <div class="box-body">
                        <div id="pesertaNoregis" class="form-group">
                            <label class="control-label">Nomor Peserta <span class="text-danger">*</span></label>
                            <div class="kt-input-icon">
                                <input type="text" class="form-control" name="pesertaNoregis" placeholder="">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError pesertaNoregis"></div>
                        </div>
                        <div id="group-nama" class="form-group">
                            <label class="control-label">Nama Peserta <span class="text-danger">*</span></label>
                            <div class="kt-input-icon">
                                <input type="text" class="form-control" name="pesertaNama" placeholder="">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError pesertaNama"></div>
                        </div>
                        <div id="group-nama" class="form-group">
                            <label class="control-label">No Hp <span class="text-danger">*</span></label>
                            <div class="kt-input-icon">
                                <input type="number" class="form-control" name="pesertaNohp" placeholder="" >
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError pesertaNohp"></div>
                        </div>
                        <div id="group-nama" class="form-group">
                            <label class="control-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <?php foreach ($selectJK as $key => $value): ?>
                                <div class="radio i-checks"> <label> <input type="radio" name="pesertaJK" value="<?php echo $key ?>"> <i></i> <?php echo $value ?> </label> 
                                </div> 
                            <?php endforeach ?>
                            <div class="cleanError pesertaJK"></div>
                        </div>
                     <!--    <div id="group-nama" class="form-group">
                            <label class="control-label">Alamat <span class="text-danger">*</span></label>
                            <div class="kt-input-icon">
                                <input type="text" class="form-control" name="pesertaAlamat" placeholder="">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError pesertaAlamat"></div>
                        </div>
                        <div id="group-nama" class="form-group">
                            <label class="control-label">No Hp <span class="text-danger">*</span></label>
                            <div class="kt-input-icon">
                                <input type="text" class="form-control" name="pesertaNohp" placeholder="">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError pesertaNohp"></div>
                        </div> -->
                        <div id="group-nama" class="form-group">
                            <label class="control-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <div class="kt-input-icon">
                                <input type="text" class="datePicker form-control" name="pesertaTanggallahir" placeholder="">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError pesertaTanggallahir"></div>
                        </div>
                        <div id="group-nama" class="form-group">
                            <label class="control-label">Program Studi <span class="text-danger">*</span></label>
                            <div class="kt-input-icon">
                                <?php echo form_dropdown('pesertaProdiid', $selectProdi, '', array('class' => 'form-control', 'style' => 'width:100%')); ?>
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError pesertaProdiid"></div>
                        </div>
                        <div id="group-nama" class="form-group">
                            <label class="control-label">Nomor KIP <span class="text-danger"></span></label>
                            <div class="kt-input-icon">
                                <input type="text" class="form-control" name="pesertaNomorKIP" placeholder="">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError pesertaNomorKIP"></div>
                        </div>
                         <div id="group-nama" class="form-group">
                            <label class="control-label">Email</label>
                            <div class="kt-input-icon">
                                <input type="text" class="form-control" name="pesertaEmail" placeholder="">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError pesertaEmail"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="margin-right: -50px">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btnSimpan"><span class=""><span class="fa  fa-save"></span> Simpan</span></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Import data peserta</h4>
                </div>
                <?php echo form_open_multipart('', 'id="formUpload" class="formUpload kt-form kt-form--label-right"'); ?> 
                <div class="modal-body">
                    <div class="box-body">
                        <label>*Pilih file excel data peserta</label>
                        <div style='color:red'></div>               
                        <input id="file-0a" class="file" type="file" name="file" multiple data-min-file-count="1" style="margin-bottom: 50px">

                        <table id="tablePreview" width="100%" class="hidden table table-hover table-bordered" style="margin-top: 50px"  cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle" width="1%">No</th>
                                    <th style="vertical-align: middle">Nomor Peserta</th>
                                    <th style="vertical-align: middle">Nama</th>
                                    <th style="vertical-align: middle">No Hp</th>
                                    <th style="vertical-align: middle">Tanggal Lahir</th>
                                    <th style="vertical-align: middle">Program Studi</th>
                                    <th style="vertical-align: middle">Nomor KIP</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="modal-footer" style="margin-right: -50px">
                    <button type="button" class="btn btn-default btnCancelImport" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success saveImport hidden"><span class=""><span class="fa  fa-save"></span> Simpan</span></button>
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
                <div class="modal-header"><h4>Detail Peserta</h4></div>
                <div class="modal-body">

                    <div class="modalBody">
                        
                    </div>
                </div>
                <div class="modal-footer2" style="text-align: center">
                    <button id="btn-batal" data-dismiss="modal" class="btn btn-default">Tutup</button>
                </div>
            </div>
        </div>
    </div>



</section>
<link href="<?php echo base_url('assets') ?>/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets') ?>/js/fileinput.min.js"></script>
<style type="text/css">
    .file-preview{
        display: none;
    }
    .fileinput-remove{
        display: none;
    }
    #tablePreview_wrapper{
        margin-top: 20px;
    }
</style>
<script type="text/javascript">
    function setTitle(title, button)
    {
        $('.modalSimpan').html(button);
        $('.modalLabel').html(title);
    }

    $(document).ready(function() {

        var dataFull;
        var tanggal;

        $('.datePicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: false,
        })

        $('select[name="pesertaProdiid"]').chosen({width: "100%"})

        oTable = $('#table').dataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            lengthMenu: [15, 30],
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            columnDefs: [{"className": "dt-tengah", "targets": [0]}],
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
                data: 'pesertaNoregis', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'pesertaNoregis'},
            {data: 'pesertaNama'},
            {data: 'pesertaNohp'},
            // {
            //     data: 'pesertaJK', render: function (data, type, row, meta) {
            //         if (data == 'L') 
            //         {
            //             return 'Laki - Laki';
            //         }
            //         else if (data == 'P') 
            //         {
            //             return 'Perempuan';
            //         }

            //         return '';
            //     }
            // },
            {data: 'fakNamaResmi'},
            {
                data: 'prodiNamaResmi', render: function (data, type, row, meta) 
                {
                    return row.prodiJjarKode+' - '+data;
                },
            },
            {
                data: null, searchable: false, orderable: false, render: function (data) {

                    var btnUbah =  `&nbsp;<a onclick="setTitle('Perbaharui', 'Perbaharui')" data-id="`+data.pesertaNoregis+`" class="btnEdit btn btn-xs btn-default" title="View">
                    <i style="color: #1aabbb;"class="i i-pencil2"></i>
                    </a>` ;

                    var btnHapus = `&nbsp;<a class="btn btn-xs btn-default btnDelete" data-toggle="tooltip" data-id='`+data.pesertaNoregis+`' data-nama='`+data.pasienNama+`' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' title='Hapus'><span style='color : #e33244' class='i i-trashcan'></span></a>`;
                    
                    var btnDetail = `&nbsp;<a class="btn btn-xs btn-default btnDetail" data-toggle="tooltip" data-toggle='modal' data-id='`+data.pesertaNoregis+`' data-target='#modal-detail' title='Detail'><span style='color : #177bbb' class='fa fa-search'></span></a>`;

                    return btnUbah + btnDetail + btnHapus ;
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
            $('#pesertaNoregis').removeClass('hidden');

            $('select[name="pesertaProdiid"]').val(null).trigger('chosen:updated');
        });

        $(document).on('click', '.btnDetail', function(event) {
            id = $(this).data('id');
            $('#modal-detail').modal('show');

            find = dataFull.find(seep => seep.pesertaNoregis == id);

            var txt = preview(find);

            $('#modal-detail .modalBody').html(txt);
        });

        function preview(find)
        {
            var txt = `<div class="table-responsive">
            <table class="table table-hover" style="width:100%; display: table">
            <tbody>`;

            var key   = {
            'pesertaFoto' : 'Peserta Foto', 
            'pesertaNoregis' : 'Nomor Peserta',
            'pesertaNama' :  'Nama',
            'fakNamaResmi' :  'Nama Fakultas',
            'prodiNamaResmi' :  'Program Studi',
            'pesertaNohp' :  'Nomor Hp',
            'pesertaAlamat' :  'Alamat',
            'pesertaTempatlahir' :  'Tempat Tanggal Lahir',
            'pesertaJK' : 'Jenis Kelamin',
            'pesertaNomorKIP' : 'Nomor KIP',
            'pesertaEmail' : 'Email',
            };

            $.each(key, function(index, el) 
            {
                if (true) 
                {
                    if (index == 'pesertaFoto') 
                    { 
                        image = (find[index] == null)?'<?php echo base_url('assets/data/images/no_pict.png') ?>':'<?php echo base_url('mpeserta/image') ?>/'+find[index];
                        txt += `
                        <tr class="text-center">
                        <td colspan='3'><img style="width: 200px; border: 0px solid #ddd;"class="img-thumbnail" src="`+image+`"></td>
                        </tr>
                        `;
                    }
                    else if (index == 'pesertaTempatlahir') 
                    { 
                        var isi = (find[index] == null)?'':find[index]+`, `;
                        var tlahir = (find['pesertaTanggallahir'] == null)?'':find['pesertaTanggallahir'];

                        txt += `
                        <tr>
                        <th width="">`+el+`</th>
                        <td width="1px">:</td>
                        <td>`+isi+moment(tlahir).format('DD MMMM YYYY')+`</td>
                        </tr>
                        `;
                    }
                    else if (index == 'pesertaJK') 
                    { 
                        var jk = (find[index] == 'P')?'Perempuan':'';
                        var jk = (find[index] == 'L')?'Laki-laki':jk;

                        txt += `
                        <tr>
                        <th width="">`+el+`</th>
                        <td width="1px">:</td>
                        <td>`+jk+`</td>
                        </tr>
                        `;
                    }
                    else
                    {
                        var isi = (find[index] == null)?'':find[index];

                        txt += `
                        <tr>
                        <th width="">`+el+`</th>
                        <td width="1px">:</td>
                        <td>`+isi+`</td>
                        </tr>
                        `;
                    }

                }
            }); 

            txt += ` </tbody>
            </table>
            </div>`;

            return txt;
        }

        var id = '';
        $(document).on('click', '.btnEdit', function(event) {
            id = $(this).data('id');
            
            cleanError();

            $('#modal-edit').modal('show');
            $('#pesertaNoregis').addClass('hidden');

            find = dataFull.find(seep => seep.pesertaNoregis == id);


            $.each(find, function(index, el) 
            {

                if (index == 'pesertaProdiid') {
                    $('select[name="pesertaProdiid"]').val(el).trigger('chosen:updated')
                }
                else if (index == 'pesertaJK') 
                {
                    if (el) 
                    {
                        $('input[name="pesertaJK"][value="'+el+'"]').prop('checked', true);
                    }
                    else
                    {
                        $('input[name="pesertaJK"]').prop('checked', false);
                    }
                }
                else if (index == 'pesertaTanggallahir') 
                {
                    // $('input[name="'+index+'"]').val(moment(el).format('DD-MM-YYYY'));
                    $('.datePicker').datepicker('setDate', moment(el).format('DD-MM-YYYY'));
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

            find = dataFull.find(seep => seep.pesertaNoregis == id);

            var txt = preview(find);

            $('.modalDeleteBody').html(txt);
        });

        $(document).on('submit', '.formUpload', function(event) {
            event.preventDefault();

            var data = new FormData(this);

            $.ajax({
                url: '<?php echo current_url() ?>/uploadData/',
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                processData : false,
                contentType: false,
                data: data,
                beforeSend: function()
                {
                    btnLoading('.fileinput-upload');
                    cleanError();
                },
                complete: function()
                {
                    btnNormal('.fileinput-upload');
                },
                success: function(res)
                {
                    if (res.status == 'success') 
                    {
                        $('.saveImport').removeClass('hidden');
                        $('#tablePreview').removeClass('hidden');
                        preview_data();   
                        toastr[res.status](res.message);
                    }
                    else
                    {
                        toastr[res.status](res.message);
                    }
                }
            })

        });

        var pTable;
        function preview_data()
        {
            pTable = $('#tablePreview').dataTable({
                processing: true,
                destroy: true,
                scrollX: false,
                lengthMenu: [15, 30],
                dom: '<"top">frt<"bottom"ip>',
                columnDefs: [{"className": "dt-tengah", "targets": [0]}],
                order: [[0, "asc"], [1, "desc"]],
                'searching'   : true,
                pagingType: 'numbers',
                language:{
                    "search":"Pencarian : ",
                    "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ Data",

                },
                ajax: {
                    'type' : 'GET',
                    'url' : '<?php echo current_url();?>/view_data_import',
                    'dataSrc': function(json)
                    {
                        return json.data;
                    },
                },
                columns: [
                {
                    data: 'pesertaNoregis', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'pesertaNoregis', render: function (data, type, row, meta) {
                        var availabe = (row.availabeInDatabase)?'</br> <span class="label label-info"> Sudah ada di database</span>':'';

                        return row.pesertaNoregis+availabe;
                    }
                },
                {data: 'pesertaNama'},
                {data: 'pesertaNohp'},
                // {
                //     data: 'pesertaJK', render: function (data, type, row, meta) {
                //         if (data == 'L') 
                //         {
                //             return 'Laki - Laki';
                //         }
                //         else if (data == 'P') 
                //         {
                //             return 'Perempuan';
                //         }

                //         return '';
                //     }
                // },
                {data: 'pesertaTanggallahir'},
                {data: 'pesertaProdiid'},
                {data: 'pesertaNomorKIP'},
                ],
            });
        }

        $(document).on('click', '.saveImport', function(event) {
            event.preventDefault();

            $.ajax({
                url: '<?php echo current_url() ?>/saveImport/',
                type: 'POST',
                dataType: 'JSON',
                beforeSend: function()
                {
                    btnLoading('.saveImport');
                },
                complete: function()
                {
                    btnNormal('.saveImport');
                },
                success: function(res)
                {
                    if (res.status == 'success') 
                    {
                        pTable.fnClearTable();
                        pTable.fnDraw();
                        $('.fileinput-remove').trigger('click');
                        $('#modal-import').modal('hide');
                        oTable.api().ajax.reload();
                        toastr[res.status](res.message);
                    }
                    else
                    {
                        toastr[res.status](res.message);
                    }
                }
            })

        });

        $(document).on('submit', '.formData', function(event) {
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
                        oTable.api().ajax.reload( null, false );
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
                    oTable.api().ajax.reload( null, false );
                },
                error: function()
                {
                    toastr['error']('Periksa Koneksi anda');
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
