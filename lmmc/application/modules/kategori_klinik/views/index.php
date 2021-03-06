
<section id="content">

    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-9">
                        <?php 
                        $text = '';
                        ?>
                        <h1 class="m-b-xs text-black hidden-xs"><small><span class="text-black">Kategori Klinik </span><span style="font-size: 13px"><?php echo ucwords(strtolower($text)); ?></span></small></h1>
                        <h2 class="m-b-xs text-black hidden-lg hidden-md hidden-sm"><small></small></h2>
                    </div>
                    <div class="col-xs-3 m-t-lg pull-right">
                       <a href="<?php echo base_url('kategori_klinik') ?>/tambah" class="btnShowModal btn btn-primary pull-right" style="margin-right:5px"><i class="fa  fa-plus"></i> <span class="hidden-xs">Tambah Data</span></a>
                       <!-- <a  onclick="setTitle('Tambah', 'Tambah')" data-toggle="modal" data-target="#modal-edit" class="btnShowModal btn btn-primary pull-right" style="margin-right:5px"><i class="fa  fa-plus"></i> <span class="hidden-xs">Tambah Data</span></a> -->
                       <br>

                   </div>
               </section>
           </header>

           <section class="scrollable padder space" > 
            <div class="box-body ">
                <div class="row">
                     <div class="col-md-4 pull-left">
                        <div class="input-group" >
                            <?php echo form_dropdown('', $selectTahun, date('Y'), array('id' => 'selectTahun','class' => 'form-control', 'style' => 'width:100%')); ?>
                        </div>
                    </div>
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
                            <th style="vertical-align: middle">Kategori</th>
                            <th style="vertical-align: middle">Klinik</th>
                            <th style="vertical-align: middle" width="1%">Tahun</th>
                            <th style="vertical-align: middle" width="105px">Opsi</th>
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
            <?php echo form_open_multipart('', 'id="formData" class="kt-form kt-form--label-right"'); ?> 
            <div class="modal-body">
                <div class="box-body">
                    <div id="group-nama" class="form-group">
                        <label>Kategori <span class="text-danger">*</span></label>
                        <div class="kt-input-icon">
                            <?php echo form_dropdown('biayaKategoriid', $selectkategori, '', array('class' => 'form-control', 'style' => 'width:100%')); ?>
                            <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                        </div>
                        <div class="cleanError biayaKategoriid"></div>
                    </div>
                    <div id="group-nama" class="form-group">
                        <label>Kategori <span class="text-danger">*</span></label>
                        <div class="kt-input-icon">
                            <?php echo form_dropdown('biayaKategoriid', $selectKlinik, '', array('class' => 'form-control', 'style' => 'width:100%')); ?>
                            <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                        </div>
                        <div class="cleanError biayaKategoriid"></div>
                    </div>
                    <div id="group-nama" class="form-group">
                        <label>Tahun <span class="text-danger">*</span></label>
                        <div class="kt-input-icon">
                            <input type="text" class="form-control" name="biayaTahun" placeholder="">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                        </div>
                        <div class="cleanError biayaTahun"></div>
                    </div>

                    <div id="group-nama" class="form-group">
                        <label>Harga <span class="text-danger">*</span></label>
                        <div class="kt-input-icon">
                            <input type="text" class="form-control" name="biayaHarga" placeholder="">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                        </div>
                        <div class="cleanError biayaHarga"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="margin-right: -50px">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success btnSimpan"><span class="hidden-xs"><span class="fa  fa-save"></span> Simpan</span></button>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h4>Program Studi Kategori <span id="kategoriNama"></span></h4></div>
            <div class="modal-body">
                
                <table id="tablePreview" width="100%" class="table table-hover table-bordered" style="margin-top: -500px"  cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle">Fakultas</th>
                            <th style="vertical-align: middle">Prodi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
        var tahun = '<?php echo date('Y') ?>';

        $('select[name="biayaKategoriid"]').chosen({width: "100%"})

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

        $(document).on('keyup', 'input[name="biayaHarga"]', function(event) {
            var value = $(this).val();
            $(this).val(formatRupiah(value));
        });

        $(document).on('change', '#selectTahun', function(event) {
            tahun = $(this).val();
            _initialDatatable();
        });

        $('.chosen-container').css('width', '100%');

        _initialDatatable();
        function _initialDatatable()
        {
            oTable = $('#table').dataTable({
            processing: true,
            destroy: true,
            serverSide: true,
            scrollX: false,
            lengthMenu: [15, 30],
            "sDom": "<'row'<'col-sm-6'><'col-sm-6'>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            columnDefs: [{"className": "dt-tengah", "targets": [0,3,4]}],
            order: [[1, "asc"]],
            'searching'   : true,
            pagingType: 'numbers',
            language:{
                "search":"Pencarian : ",
                "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ Data",

            },
            ajax: {
                'type' : 'GET',
                'url' : '<?php echo current_url();?>',
                'data': {biayaTahun: tahun},
                'dataSrc': function(json)
                {
                    return dataFull = json.data;
                },
            },
            columns: [
            {
                data: 'tKategoriKlinikid', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'kategoriNama'},
            {
                data: 'klinikNama', render: function (data, type, row, meta) 
                {
                    return data;//'Rp. '+formatRupiah(data);
                }
            },
            {data: 'tKlinikTahun'},
            {
                data: null, searchable: false, orderable: false, render: function (data) {
                    
                    var btnUbah =  `&nbsp;<a href="<?php echo base_url('kategori_klinik') ?>/ubah/`+data.tKategoriId+`/`+data.tKlinikTahun+`" class=" btn btn-xs btn-default" title="View">
                    <i style="color: #1aabbb;"class="i i-pencil2"></i>
                    </a>` ;

                    var btnHapus = `&nbsp;<a class="btn btn-xs btn-default btnDelete" data-toggle="tooltip" data-kategoriid='`+data.tKategoriId+`' data-id='`+data.tKategoriKlinikid+`' data-tahun='`+data.tKlinikTahun+`' data-nama='`+data.tKategoriKlinikid+`' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' title='Hapus'><span style='color : #e33244' class='i i-trashcan'></span></a> `;
                    
                    var btnDetail = `&nbsp;<a class="btn btn-xs btn-default btnDetail" data-id='`+data.tKategoriId+`' title='Detail'><span style='color : #177bbb' class='fa fa-search'></span></a>`;

                        return btnUbah + btnHapus;
                }
            },
            ],
        });
        }

        var pTable;
        $(document).on('click', '.btnDetail', function(event) {
            var kategoriId = $(this).data('id');

            datatableFakultasProdi(kategoriId);

            find = dataFull.find(seep => seep.tKategoriId == kategoriId);

            $('#kategoriNama').html(find.kategoriNama);
            $('#modal-detail').modal('show');
        });

        function datatableFakultasProdi(kategoriId)
        {
            pTable = $('#tablePreview').dataTable({
                processing: true,
                destroy: true,
                scrollX: false,
                serverSide: true,
                lengthMenu: [15, 30],
                dom: '<"top">frt<"bottom"ip>',
                // columnDefs: [{"className": "dt-tengah", "targets": [-2]}],
                order: [[0, "asc"], [1, "desc"]],
                'searching'   : true,
                pagingType: 'numbers',
                language:{
                    "search":"Pencarian : ",
                    "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ Data",

                },
                ajax: {
                    'type' : 'GET',
                    'url' : '<?php echo current_url();?>/list_fakultas_prodi',
                    'data': {'kategoriId': kategoriId},
                    'dataSrc': function(json)
                    {
                        return json.data;
                    },
                },
                columns: [
                {data: 'fakNamaResmi'},
                {
                    data: 'prodiNamaResmi', render: function (data, type, row, meta) 
                    {
                        return row.prodiJjarKode+' - '+data;
                    },
                },
                ],
            });
        }

        // oTable.fnSetColumnVis(0,false,false);
        // oTable.fnSetColumnVis(1,false,false);

   
        $(document).on('click', '.btnShowModal', function(event) {
            id = '';

            cleanError();
            $('#formData').trigger('reset');
            $('select[name="biayaKategoriid"]').val(null).trigger('chosen:updated');
        });

        $(document).on('click', '.btnDelete', function(event) {
            kategoriId = $(this).data('kategoriid');
            id = $(this).data('id');
            $('#modal-delete').modal('show');

            find = dataFull.find(seep => seep.tKategoriKlinikid == id);
            template(find);
        });

        function template(data)
        {
            var txt = `<div class="table-responsive">
            <table class="table table-hover" style="width:100%; display: table">
            <tbody>`;

            var label = ['Nama Kategori', 'Tahun'];
            var key   = ['kategoriNama', 'tKlinikTahun'];

            $.each(key, function(index, el) 
            {
                if (data[el]) 
                {
                    if (key[index] == 'biayaHarga') 
                    {
                        data[el] = 'Rp. '+formatRupiah(data[el]);
                    }

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

                        $('#modal-edit').modal('hide');
                        oTable.api().ajax.reload();
                    }
                }
            })

        });

        var kategoriId;
        $(document).on('click', '.btnConfirmDelete', function(event) {
            event.preventDefault();

            $.ajax({
                url: '<?php echo current_url() ?>/deleteData/'+kategoriId+'/'+tahun,
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
                    kategoriId = '';

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
