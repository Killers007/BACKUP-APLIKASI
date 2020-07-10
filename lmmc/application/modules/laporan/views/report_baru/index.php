
<section id="content">

    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-9">
                        <?php 
                        $text = "Jalur $dataJalur->jalurNama Tahun $dataJalur->jalurTahun";
                        ?>
                        <h1 class="m-b-xs text-black hidden-xs"><small><span class="text-black">Laporan  | </span><span style="font-size: 13px"><?php echo $text; ?></span></small></h1>
                        <h2 class="m-b-xs text-black hidden-lg hidden-md hidden-sm"><small></small></h2>
                    </div>
                    <div class="col-xs-3 m-t-lg pull-right">
                     <!-- <a  onclick="setTitle('Tambah', 'Tambah')" data-toggle="modal" data-target="#modal-edit" class="btnShowModal btn btn-primary pull-right" style="margin-right:5px"><i class="fa  fa-plus"></i> <span class="hidden-xs">Tambah Data</span></a> -->
                     <br>

                 </div>
             </section>
         </header>
         <section class="scrollable padder space" > 
            <div class="box-body ">

                <!-- <h4><b>Filter Data</b></h4> -->

                <div class="row">
                    <div class="col-md-2">
                        <?php echo form_dropdown('selectKategori', $selectKategori, '', array('class' => 'form-control chosen-select', 'style' => 'width:100%')); ?>
                        <div class="m-b"></div>
                    </div>
                    <div class="col-md-2">
                        <?php echo form_dropdown('selectKlinik', $selectKlinik, '', array('class' => 'form-control chosen-select', 'style' => 'width:100%')); ?>
                        <div class="m-b"></div>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success" id="lihat" name="lihat"><i class="fa fa-eye"></i> Fillter Data</button>
                        <button class="btn btn-success" id="cetak" name="cetak"><i class="fa fa-print"></i> Cetak</button>
                        <button class="btn btn-success" id="excel" name="excel"><i class="i i-file-excel"></i> Excel</button>
                    </div>
                    <div class="col-md-3 pull-right">
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
                            <th style="vertical-align: middle">Fakultas</th>
                            <th style="vertical-align: middle">Prodi</th>
                            <th style="vertical-align: middle">Jumlah Peserta</th>
                            <th style="vertical-align: middle">Sudah Periksa</th>
                            <th style="vertical-align: middle">Belum Periksa</th>
                            <th style="vertical-align: middle" width="60px">Cetak</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot align="right">
                        <tr>
                            <th colspan="3"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
    </section>
</section>
<span class="text-center"></span>


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

        var klinikId;
        var kategoriId;

        var ready = false;

        $(document).on('change', 'select[name="selectKategori"]', function(event) {

            kategoriId = $(this).val();
            $.ajax({
                url: '<?php echo current_url() ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {status: 'getKlinik', kategoriId : kategoriId},
                beforeSend: function()
                {
                    $('select[name="selectKlinik"]').addClass('disabled').trigger('chosen:updated');
                    // btnLoading('.btnSimpan');
                },
                complete: function()
                {
                    // $('select[name="selectKlinik"]').html('Loading ...').trigger('chosen:updated');
                },
                success: function(res)
                {
                    var text = '';

                    $.each(res, function(index, val) {
                     text += `<option value="`+index+`">`+val+`</option>`;
                 });

                    $('select[name="selectKlinik"]').html(text).trigger('chosen:updated');
                    $('select[name="selectKlinik"]').trigger('change');

                    ready = true;
                }
            })
            
            
        });

        $(document).on('change', 'select[name="selectKlinik"]', function(event) {
            klinikId = $(this).val();
        });

        $(document).on('click', '#lihat', function(event) {
            _initialDatatable();
        });

        $(document).on('click', '#cetak', function(event) {
            window.open('<?php echo base_url('laporan/report_jumlah') ?>/'+klinikId+'/'+kategoriId, '_blank');
        });

        $(document).on('click', '#excel', function(event) {
            window.open('<?php echo base_url('laporan/report_jumlah_excel') ?>/'+klinikId+'/'+kategoriId, '_blank');
        });

        // $(document).on('click', '#table_next', function(event) {
        //     btnLoading('#table_next');
        // });

        //  $(document).on('click', '#table_previous', function(event) {
        //     btnLoading('#table_previous');
        // });


        $('select[name="selectKategori"]').trigger('change');
        $('select[name="selectKlinik"]').trigger('change');
        $('#lihat').trigger('click');
        // _initialDatatable();
        function _initialDatatable()
        {
            btnLoading('#lihat');
            oTable = $('#table').dataTable({
                processing: true,
                serverSide: true,
                scrollX: false,
                destroy: true,
                // "sDom": "<'row'<'col-sm-6'l><'col-sm-6'>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                lengthMenu: [[-1, 15, 30, 50, 100], ['All', 15, 30, 50, 100]],
                // "dom": '<"top">rt<"row"<"col-md-6"l><"col-md-6"p>><"clear">',
                "dom": '<"top">rt<"row"<"col-md-6"><"col-md-6">><"clear">',
                columnDefs: [{"className": "dt-tengah", "targets": [0,3,4,5,6]}],
                order: [[0, "asc"], [1, "desc"]],
                'searching'   : true,
                // pagingType: 'numbers',
                language:{
                    "search":"Pencarian : ",
                    "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ Data",

                },
                ajax: {
                    'type' : 'GET',
                    'url' : '<?php echo current_url();?>',
                    'data': {klinikId: klinikId, kategoriId: kategoriId},
                    'dataSrc': function(json)
                    {
                        btnNormal('#lihat');
                        $('#table_filter').addClass('invisible');
                        return dataFull = json.data;
                    },
                },
                drawCallback: function()
                {
                    // btnNormal('#table_previous');
                    // btnNormal('#table_next');
                    $('.dataTables_length').removeClass('dataTables_length');
                    // $('div.dataTables_length select').css({'height':'35px', 'margin-top':'-5px'});
                },
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                        i : 0;
                    };

                    var jumPeserta = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    var jumBelum = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    var blmTtl = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );


                    $( api.column( 0 ).footer() ).html('Jumlah');
                    $( api.column( 3 ).footer() ).html(jumPeserta);
                    $( api.column( 4 ).footer() ).html(jumBelum);
                    $( api.column( 5 ).footer() ).html(blmTtl);

                    if (jumPeserta != 0) 
                    {
                        var klinikNama = $('select[name="selectKlinik"] option:selected').text();

                        var btnCetak = `&nbsp;<a target="_blank" href="<?php echo base_url('laporan/report') ?>/`+klinikId+`/`+kategoriId+`" class="btn btn-xs btnDetail" style="background-color: #1aabbb" data-toggle="tooltip" title='Cetak semua laporan klinik `+klinikNama+`'><span style='color : #FFFFFF' class=' fa fa-print'></span></a> `;
                        var btnExcel = `&nbsp;<a target="_blank" href="<?php echo base_url('laporan/report_excel') ?>/`+klinikId+`/`+kategoriId+`" class="btn btn-xs btnDetail" style="background-color: #1aabbb" data-toggle="tooltip" title='Cetak semua laporan klinik `+klinikNama+`'><span style='color : #FFFFFF' class='i i-file-excel'></span></a> `;

                        $( api.column( 6 ).footer() ).html(btnCetak + btnExcel);
                    }
                    else
                    {
                        $( api.column( 6 ).footer() ).html('');
                    }

                },
                columns: [
                {
                    data: 'prodiKode', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'fakNamaResmi'},
                {
                    data: 'prodiNamaResmi', render: function (data, type, row, meta) 
                    {
                        return row.prodiJjarKode+' - '+data;
                    },
                },
                {data: 'jumPeserta', searchable: false, orderable: false},
                {data: 'sudahPeriksa', searchable: false, orderable: false},
                {data: 'belumPeriksa', searchable: false, orderable: false},
                {
                    data: null, searchable: false, orderable: false, render: function (data) {

                        if (parseInt(data.jumPeserta) == 0) 
                        {
                            return '';
                        }

                        var btnCetak = `&nbsp;<a target="_blank" href="<?php echo base_url('laporan/report') ?>/`+klinikId+`/`+kategoriId+`/`+data.prodiKode+`" class="btn btn-xs btn-default btnDetail" data-toggle="tooltip" title='Cetak'><span style='color : #1aabbb' class='fa fa-print'></span></a> `;
                        var btnExcel = `&nbsp;<a target="_blank" href="<?php echo base_url('laporan/report_excel') ?>/`+klinikId+`/`+kategoriId+`/`+data.prodiKode+`" class="btn btn-xs btn-default btnDetail" data-toggle="tooltip" title='Cetak'><span style='color : #1aabbb' class='i i-file-excel'></span></a> `;

                        return btnCetak + btnExcel;
                    }
                },
                ],
            });
}

        // oTable.fnSetColumnVis(0,false,false);
        // oTable.fnSetColumnVis(1,false,false);

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
