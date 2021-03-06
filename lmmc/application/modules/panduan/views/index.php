
<section id="content">

    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-9">
                        <?php 
                        $text = '';
                        ?>
                        <h1 class="m-b-xs text-black hidden-xs"><small class="m-b-xs text-black">Panduan <span style="font-size: 13px"><?php echo ucwords(strtolower($text)); ?></span></small></h1>
                        <h2 class="m-b-xs text-black hidden-lg hidden-md hidden-sm"><small></small></h2>
                    </div>
                    <div class="col-xs-3 m-t-lg pull-right">
                       <a  onclick="setTitle('Tambah', 'Tambah')" class="btnShowModal btn btn-primary pull-right" href="<?php echo base_url('panduan') ?>/tambah" style="margin-right:5px"><i class="fa  fa-plus"></i> <span class="hidden-xs">Tambah Data</span></a>
                       <br>

                   </div>
               </section>
           </header>

           <section class="scrollable padder space" > 
            <div class="box-body ">
                <div class="row">
                    <!--  <div class="col-md-4 pull-left">
                        <div class="input-group" >
                            <?php echo form_dropdown('', $selectTahun, date('Y'), array('id' => 'selectTahun','class' => 'form-control', 'style' => 'width:100%')); ?>
                        </div>
                    </div> -->
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
                            <th style="vertical-align: middle">Deskripsi</th>
                            <!-- <th style="vertical-align: middle" width="1%">Tahun</th> -->
                            <th style="vertical-align: middle" width="1%">Versi</th>
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
            <div class="modal-header"><h4>Panduan<!--  <span id="panduanTahun"> --> </span> Versi <span id="panduanVersi"></span></h4></div>
            <div class="modal-body">
                <div class="text-center">
                    <img style="size: 100px;" class="img-thumbnail" id="panduanGambar">
                </div>
                <div id="group-nama" class="form-group">
                    <br>
                    <h4 class="text-lt font-bold">Deskripsi</h4>
                    <div class="kt-input-icon" id="panduanDeskripsi">
                        
                    </div>
                </div>
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
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            columnDefs: [{"className": "dt-tengah", "targets": [0,2,3]}],
            order: [[0, "asc"]/*, [3, "desc"]*/],
            'searching'   : true,
            pagingType: 'numbers',
            language:{
                "search":"Pencarian : ",
                "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ Data",

            },
            ajax: {
                'type' : 'GET',
                'url' : '<?php echo current_url();?>',
                'data': {jagaTahun: tahun},
                'dataSrc': function(json)
                {
                    return dataFull = json.data;
                },
            },
            columns: [
            {
                data: 'panduanId', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'panduanDeskripsi'},
            // {data: 'panduanTahun'},
            {data: 'panduanVersi'},
            {
                data: null, searchable: false, orderable: false, render: function (data) {
                   
                    var btnUbah =  `&nbsp;<a href="<?php echo base_url('panduan') ?>/ubah/`+data.panduanId+`" data-id="`+data.panduanId+`" class="btn btn-xs btn-default" title="View">
                    <span style="color: #1aabbb;"class="i i-pencil2"></span>
                    </a>` ;

                    var btnHapus = `&nbsp;<a class="btn btn-xs btn-default btnDelete" data-toggle="tooltip" data-id='`+data.panduanId+`' data-nama='`+data.panduanId+`' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' title='Hapus'><span style='color : #e33244' class='i i-trashcan'></span></a> `;
                    
                    var btnDetail = `<a class="btn btn-xs btn-default btnDetail"  data-toggle='modal' data-id='`+data.panduanId+`' data-target='#modal-detail' title='Detail'><span style='color : #177bbb' class='fa fa-search'></span></a> `;

                        return btnDetail + btnUbah + btnHapus;
                }
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

        $(document).on('click', '.btnDetail', function(event) {
             id = $(this).data('id');
            
            cleanError();

            $('#modal-edit').modal('show');

            find = dataFull.find(seep => seep.panduanId == id);

            $('#panduanGambar').prop('src', '<?php echo base_url('panduan/image') ?>/'+find.panduanGambar);
            $('#panduanVersi').html(find.panduanVersi);
            $('#panduanTahun').html(find.panduanTahun);
            $('#panduanDeskripsi').html(find.panduanDeskripsi);
        });

        var id = '';
        $(document).on('click', '.btnEdit', function(event) {
            id = $(this).data('id');
            
            cleanError();

            $('#modal-edit').modal('show');

            find = dataFull.find(seep => seep.panduanId == id);


            $.each(find, function(index, el) 
            {

                if (index == 'biayaHarga') {
                    // $('#pegawaiFoto').attr("style", 'background-image: url("<?php echo base_url('assets/upload/images') ?>/'+el+'")');
                    $('input[name="'+index+'"]').val(formatRupiah(el));
                }
                else
                {
                    $('input[name="'+index+'"]').val(el);
                    $('select[name="'+index+'"]').val(el).trigger('chosen:updated');
                }
            }); 

        });


        $(document).on('click', '.btnDelete', function(event) {
            id = $(this).data('id');
            $('#modal-delete').modal('show');

            find = dataFull.find(seep => seep.panduanId == id);

            template(find);
        });

        function template(data)
        {
            var txt = `<div class="table-responsive">
            <table class="table table-hover" style="width:100%">
            <tbody>`;

            var label = ['Tahun', 'Deskripsi'];
            var key   = ['panduanTahun', 'panduanDeskripsi'];

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
                    toastr[res.status](res.message);
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
