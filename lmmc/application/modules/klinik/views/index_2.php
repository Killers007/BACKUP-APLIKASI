<section id="content">

    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-9">
                        <?php
                        $text = '';
                        ?>
                        <h1 class="m-b-xs text-black hidden-xs"><small class="m-b-xs text-black">Klinik <span style="font-size: 13px"><?php echo ucwords(strtolower($text)); ?></span></small></h1>
                        <h2 class="m-b-xs text-black hidden-lg hidden-md hidden-sm"><small></small></h2>
                    </div>
                    <div class="col-xs-3 m-t-lg pull-right">
                        <a onclick="setTitle('Tambah', 'Tambah')" data-toggle="modal" data-target="#modal-edit" class="btnShowModal btn btn-primary pull-right" style="margin-right:5px"><i class="fa  fa-plus"></i> <span class="hidden-xs">Tambah Data</span></a>
                        <br>

                    </div>
                </section>
            </header>

            <section class="scrollable padder space">
                <div class="box-body ">
                    <div class="row">
                        <!--  <div class="col-md-4 pull-left">
                        <div class="input-group" >
                            <?php echo form_dropdown('', $selectTahun, date('Y'), array('id' => 'selectTahun', 'class' => 'form-control', 'style' => 'width:100%')); ?>
                        </div>
                    </div> -->
                        <div class="col-md-4 pull-right">
                            <div class="input-group">
                                <input type="text" id="field-cari" class="form-control" name="field-cari" placeholderr="Pencarian">
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" id="btn-cari" href="#" value="Cari"><i class="fa fa-search"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <table id="table" width="100%" class="table table-hover table-bordered" style="margin-top: -500px" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle" width="1%">No</th>
                                <th style="vertical-align: middle">Klinik</th>
                                <th style="vertical-align: middle">Nama Formulir</th>
                                <th style="vertical-align: middle">Hasil</th>
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
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label class="control-label">Nama Klinik <span class="text-danger">*</span></label>
                            <div class="kt-input-icon">
                                <input type="text" class="form-control" name="klinikNama" placeholder="">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError klinikNama"></div>
                        </div>

                        <div id="group-nama" class="form-group">
                            <label class="control-label">Nama Form <span class="text-danger">*</span></label>
                            <div class="kt-input-icon">
                                <input type="text" class="form-control" name="klinikFormnama" placeholder="">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                            </div>
                            <div class="cleanError klinikFormnama"></div>
                        </div>

                        <hr>
                        <h4><b>Keterangan Bobot Hasil Pemeriksaan</b></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Peserta Bermasalah</h5>
                                <p>
                                    1 = <span class="label label-danger">Sangat Buruk</span> <br>
                                    2 = <span class="label label-warning">Buruk</span> <br>
                                    3 = <span class="label label-default">Cukup</span> <br>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h5>Peserta Tidak Bermasalah</h5>
                                <p>
                                    4 = <span class="label label-info">Baik</span> <br>
                                    5 = <span class="label label-success">Sangat Baik</span> <br>
                                </p>
                            </div>
                        </div>

                        <div id="group-nama" class="form-group">
                            <label class="control-label">Hasil Pemeriksaan <span class="text-danger">*</span></label>
                            <div class="kt-input-icon">
                                <table class="table table-striped m-b-none text-sm" style="width:100%; display: table">
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>
                                                <input type="" class="input-sm form-control" placeholder="Keterangan hasil" name="">
                                            </td>
                                            <?php $select = array('' => '-- Pilih Bobot --', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5') ?>
                                            <td width="150px">
                                                <?php echo form_dropdown('', $select, '', array('class' => 'form-control input-sm', 'style' => 'width:100%')); ?>
                                            </td>
                                            <td class="text-right" style="width : 1px; vertical-align: middle">
                                                <a class="btnHasilAdd" data-dismiss="alert"><i style='color : #177bbb' class="fa fa-plus"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="txtKeterangan text text-danger"></div>
                                            </td>
                                            <td>
                                                <div class="txtBobot text text-danger"></div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="cleanError hasil"></div>
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
                <div class="modal-header">
                    <h4>Detail Dokter</h4>
                </div>
                <div class="modal-body">

                    <div class="modalBody"></div>
                </div>
                <div class="modal-footer2" style="text-align: center">
                    <button id="btn-batal" data-dismiss="modal" class="btn btn-default">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <!--Modal detail-->
    <!-- <div id="modal-hasil" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header"><h4>Hasil Pemeriksaan</h4></div>
            <div class="modal-body">
                
                <table class="table m-b-none text-sm" style="width:100%">
                    
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>                    
                            <td><input type="" class="input-sm form-control" name=""></td>
                            <td class="text-right">
                                <a class="btnHasilAdd" data-dismiss="alert"><i style='color : #177bbb' class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </div>
            <div class="modal-footer2" style="text-align: center">
                <button type="" class="btn btn-success btnSimpanHasil"><span class="hidden-xs"><span class="fa  fa-save"></span> Simpan</span></button>
            </div>
        </div>
    </div>
</div>
 -->

</section>
<script type="text/javascript">
    function setTitle(title, button) {
        $('.modalSimpan').html(button);
        $('.modalLabel').html(title);
    }

    $(document).ready(function() {

        var dataFull;
        var tanggal;
        var tahun = '<?php echo date('Y') ?>';

        $('select[name="biayaKategoriid"]').chosen({
            width: "100%"
        })

        $(document).on('change', '#selectTahun', function(event) {
            tahun = $(this).val();
            _initialDatatable();
        });

        $('.chosen-container').css('width', '100%');

        _initialDatatable();

        function _initialDatatable() {
            oTable = $('#table').dataTable({
                processing: true,
                destroy: true,
                serverSide: true,
                scrollX: false,
                lengthMenu: [15, 30],
                "sDom": "<'row'<'col-sm-6'l><'col-sm-6'>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                columnDefs: [{
                    "className": "dt-tengah",
                    "targets": [0, 4]
                }],
                order: [
                    [0, "asc"],
                    [1, "desc"]
                ],
                'searching': true,
                pagingType: 'numbers',
                language: {
                    "search": "Pencarian : ",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ Data",

                },
                ajax: {
                    'type': 'GET',
                    'url': '<?php echo current_url(); ?>',
                    // 'data': {biayaTahun: tahun},
                    'dataSrc': function(json) {
                        return dataFull = json.data;
                    },
                },
                columns: [{
                        data: 'klinikId',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'klinikNama'
                    },
                    {
                        data: 'klinikFormnama'
                    },
                    {
                        data: 'klinikHasil',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row, meta) {

                            return data;
                        }
                    },
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data) {

                            var btnUbah = `&nbsp;<a onclick="setTitle('Perbaharui', 'Perbaharui')" data-id="` + data.klinikId + `" class="btnEdit btn btn-xs btn-default" title="View">
                    <i style="color: #1aabbb;"class="i i-pencil2"></i>
                    </a>`;

                            var btnHapus = `&nbsp;<a class="btn btn-xs btn-default btnDelete" data-toggle="tooltip" data-id='` + data.klinikId + `' data-nama='` + data.klinikId + `' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' title='Hapus'><span style='color : #e33244' class='i i-trashcan'></span></a>`;

                            var btnTambahHasil = `&nbsp;<a class="btn btn-xs btn-default btnDetailhasil" data-toggle="tooltip" data-id='` + data.klinikId + `' data-nama='` + data.klinikId + `' title='Hapus'><span style='color : #177bbb' class='fa fa-plus'></span></a>`;

                            return /*btnTambahHasil + */ btnUbah + btnHapus;
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

            $('#modal-edit').find('tbody').html('');

        });

        function uuidv4() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0,
                    v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

        $(document).on('click', '.btnHasilAdd', function(event) {
            var text = $(this).parents('tr').find('input').val();
            var kriteria = $(this).parents('tr').find('select').val();
            var _uuid = uuidv4();

            if (text == '' || kriteria == '') return false;

            var kriterias = <?php echo json_encode($select) ?>;
            var select = `<select class="input-sm form-control" name="hasil[` + _uuid + `][bobotKriteria]">`;

            $.each(kriterias, function(indexs, values) {
                if (indexs != '') {
                    var checked = (kriteria == values) ? 'selected' : '';
                    select += `<option value="` + indexs + `" ` + checked + `>` + values + `</option>`
                }
            });

            select += `</select>`;

            var _tempText = `<tr id="` + _uuid + `">
                                <td><input type="text" class="input-sm form-control" name="hasil[` + _uuid + `][value]" value="` + text + `"></td>

                                <td>` + select + `</td>
                                <td class="text-right" style="width : 1px">
                                    <a href="#` + _uuid + `" data-dismiss="alert"><i style='color : #e33244' class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>`;

            $('#modal-edit').find('tbody').append(_tempText);
            $(this).parents('tr').find('input').val('');
            $(this).parents('tr').find('select').val('');

            // var data =  $('#formData').serializeArray();
            // console.log(data);

        });

        var id = '';
        $(document).on('click', '.btnEdit', function(event) {
            id = $(this).data('id');
            var ini = $(this);

            cleanError();


            find = dataFull.find(seep => seep.klinikId == id);


            $.each(find, function(index, el) {

                if (index == 'biayaHarga') {
                    // $('#pegawaiFoto').attr("style", 'background-image: url("<?php echo base_url('assets/upload/images') ?>/'+el+'")');
                    $('input[name="' + index + '"]').val(formatRupiah(el));
                } else {
                    $('input[name="' + index + '"]').val(el);
                    $('select[name="' + index + '"]').val(el).trigger('chosen:updated');
                }
            });

            $.ajax({
                url: '<?php echo current_url() ?>/getHasil/' + id,
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    btnLoading(ini, false);
                    cleanError();
                },
                complete: function() {
                    btnNormal(ini);
                },
                error: function(res) {
                    console.log(res.statusCode())
                },
                success: function(res) {
                    // $('#modal-hasil').modal('show');
                    $('#modal-edit').modal('show');

                    var text = '';

                    $.each(res, function(index, val) {
                        var _uuid = uuidv4();

                        var kriteria = <?php echo json_encode($select) ?>;

                        var select = `<select class="input-sm form-control" name="hasil[` + _uuid + `][bobotKriteria]">`;

                        $.each(kriteria, function(indexs, values) {
                            if (indexs != '') {
                                var checked = (val.knkdtKriteria == values) ? 'selected' : '';
                                select += `<option value="` + indexs + `" ` + checked + `>` + values + `</option>`
                            }
                        });


                        select += `</select>`;


                        text += `<tr id="` + _uuid + `">
                                    <td>
                                        <input type="text" class="input-sm form-control" name="hasil[` + _uuid + `][value]" value="` + val.knkdtNamahasil + `">
                                        <input type="hidden" name="hasil[` + _uuid + `][id]" value="` + val.knkdtId + `">
                                    </td>
                                    <td>
                                        ` + select + `
                                    </td>
                                    <td class="text-right">
                                        <a href="#` + _uuid + `" data-dismiss="alert"><i style='color : #e33244' class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>`;
                    });

                    $('#modal-edit').find('tbody').html(text);
                    $('#modal-edit').find('tfoot select').val('');
                }
            })

        });


        $(document).on('click', '.btnDelete', function(event) {
            id = $(this).data('id');
            $('#modal-delete').modal('show');

            find = dataFull.find(seep => seep.klinikId == id);

            template(find);
        });

        $(document).on('click', '.btnDetailhasil', function(event) {
            id = $(this).data('id');
            var ini = $(this);

            $.ajax({
                url: '<?php echo current_url() ?>/getHasil/' + id,
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    btnLoading(ini, false);
                    cleanError();
                },
                complete: function() {
                    btnNormal(ini);
                },
                success: function(res) {
                    $('#modal-hasil').modal('show');

                    var text = '';

                    $.each(res, function(index, val) {
                        var _uuid = uuidv4();
                        text += `<tr id="` + _uuid + `">
                                    <td>` + val.knkdtNamahasil + `<input type="hidden" name="hasil[]" value="` + val.knkdtNamahasil + `"></td>
                                    <td>` + val.knkdtNamahasil + `<input type="hidden" name="hasil[]" value="` + val.knkdtNamahasil + `"></td>
                                    <td class="text-right">
                                        <a href="#` + _uuid + `" data-dismiss="alert"><i style='color : #e33244' class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>`;
                    });


                    $('#modal-hasil').find('tbody').html(text);
                }
            })
        });

        function template(data) {
            var txt = `<div class="table-responsive">
            <table class="table table-hover" style="width:100%; display: table">
            <tbody>`;

            var label = ['Nama Klinik'];
            var key = ['klinikNama'];

            $.each(key, function(index, el) {
                if (data[el]) {
                    if (key[index] == 'biayaHarga') {
                        data[el] = 'Rp. ' + formatRupiah(data[el]);
                    }

                    txt += `
                    <tr>
                    <th width="">` + label[index] + `</th>
                    <td width="1px">:</td>
                    <td>` + data[el] + `</td>
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
                url: '<?php echo current_url() ?>/replaceData/' + id,
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                processData: false,
                contentType: false,
                data: data,
                beforeSend: function() {
                    btnLoading('.btnSimpan');
                    cleanError();
                },
                complete: function() {
                    btnNormal('.btnSimpan');
                },
                success: function(res) {
                    if (!res.status) {
                        getError(res)
                    } else {
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
                url: '<?php echo current_url() ?>/deleteData/' + id,
                type: 'POST',
                dataType: 'JSON',
                beforeSend: function() {
                    btnLoading('.btnConfirmDelete');
                },
                complete: function() {
                    btnNormal('.btnConfirmDelete');
                },
                success: function(res) {
                    id = '';

                    toastr[res.status](res.message);

                    $('#modal-delete').modal('hide');
                    oTable.api().ajax.reload();
                },
                error: function() {
                    // toastr['error']('');
                }
            })
        });

        function getError(data) {
            $.each(data.error, function(index, el) {
                $('.' + index).html(el);
                $('.' + index).parent().removeClass('has-error');

                if (el != '') {
                    $('.' + index).parent().addClass('has-error');
                }


            });
        }

        function cleanError() {
            $('.cleanError').html('');
            $('.cleanError').parent().removeClass('has-error');
        }

        var btnText;

        function btnLoading(selector, loading = true) {
            var txtLoading = ' Loading .....';
            txtLoading = (loading) ? txtLoading : '';

            btnText = $(selector).html();
            $(selector).html('<i class="fa fa-spinner fa-spin"></i>' + txtLoading);
            $(selector).attr('disabled', 'true');
        }

        function btnNormal(selector) {
            $(selector).html(btnText);
            $(selector).removeAttr('disabled');
        }

        toastConfig();

        function toastConfig() {
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

        $("#btn-cari").click(function() {
            oTable.fnFilter($("#field-cari").val());
        });

        $("#field-cari").on('keyup', function(e) {
            var key = e.which;
            if (key == 13) {
                $("#btn-cari").trigger('click');
            }
        });

    });
</script>