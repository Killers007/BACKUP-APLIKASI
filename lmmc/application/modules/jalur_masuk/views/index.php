<section id="content">

    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-9">
                        <?php
                        $text = '';
                        ?>
                        <h1 class="m-b-xs hidden-xs"><small class="text-black">Jalur Masuk <span style="font-size: 13px"><?php echo ucwords(strtolower($text)); ?></span></small></h1>
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
                        <div class="col-md-4 pull-left">
                            <div class="input-group">
                                <?php echo ''; //form_dropdown('', $selectTahun, date('Y'), array('id' => 'selectTahun','class' => 'form-control', 'style' => 'width:100%')); 
                                ?>
                            </div>
                        </div>
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
                                <th style="vertical-align: middle">Nama Jalur</th>
                                <th style="vertical-align: middle">Tahun</th>
                                <th style="vertical-align: middle" width="1px">Status</th>
                                <th style="vertical-align: middle" width="100px">Opsi</th>
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
                <?php echo form_open_multipart('', 'id="formData" class="bs-example form-' . $formLayout . '"'); ?>
                <div class="modal-body">
                    <div class="box-body">

                        <?php echo $formInput ?>

                    </div>
                </div>
                <div class="modal-footer" style="margin-right: -50px">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btnSimpan"><span class="fa  fa-save"></span> Simpan</button>
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
    <div id="modal-aktif" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Aktifkan Jalur</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-info alert-block">
                        <!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
                        <!-- <h4><i class="fa fa-bell-alt"></i>A</h4> -->
                        <p>Apakah anda yakin mengaktifkan jalur <b id="jalurNama"></b> tahun <b id="jalurTahun"></b> ?</p>
                    </div>
                </div>
                <div class="modal-footer2" style="text-align: center">
                    <button type="submit" class="btn btn-success btnSimpanAktif"><span class=""><span class="fa  fa-key"></span> Aktifkan</span></button>
                </div>
            </div>
        </div>
    </div>



</section>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript">
    function setTitle(title, button) {
        $('.modalSimpan').html(button);
        $('.modalLabel').html(title);
    }

    $(document).ready(function() {

        var dataFull;
        var tanggal;
        var tahun = null; //'<?php echo date('Y') ?>';

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
                    'data': {
                        biayaTahun: tahun
                    },
                    'dataSrc': function(json) {
                        return dataFull = json.data;
                    },
                },
                columns: [{
                        data: 'jalurId',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'jalurNama'
                    },
                    {
                        data: 'jalurTahun'
                    },
                    {
                        data: 'jalurIsactive',
                        render: function(data, type, row, meta) {
                            if (parseInt(data) == 1) {
                                return `<span class="label label-success">Aktif</span>`;
                            }

                            return `<span class="label label-default">Tidak Aktif</span>`;

                        }
                    },
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data) {

                            var btnUbah = `&nbsp;<a onclick="setTitle('Perbaharui', 'Perbaharui')" data-id="` + data.jalurId + `" class="btnEdit btn btn-xs btn-default" title="View">
                        <i style="color: #1aabbb;"class="i i-pencil2"></i>
                        </a>`;

                            var btnHapus = `&nbsp;<a class="btn btn-xs btn-default btnDelete" data-toggle="tooltip" data-id='` + data.jalurId + `' data-nama='` + data.jalurId + `' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' title='Hapus'><span style='color : #e33244' class='i i-trashcan'></span></a> `;

                            var btnAktif = `&nbsp;<a class="btn btn-xs btn-default btnAktif" data-toggle='tooltip' data-id='` + data.jalurId + `' title='Akifkan jalur'><span style='color : #177bbb' class='fa fa-key'></span></a>`;

                            var btnUpload = `&nbsp;<a class="btn btn-xs btn-default btnUpload" data-toggle='tooltip' data-id='` + data.jalurId + `' title='Upload File Pengumuman'><span style='color : #55d67a' class='fa fa-upload'></span></a>`;

                            var btnLihatFile = `&nbsp;<a href="<?php echo base_url('jalur_masuk/file/path_pengumuman/') ?>` + data.jalurFileKelulusan + `" target="_blank" class="btn btn-xs btn-default btnLihatFile" data-toggle='tooltip' title='Lihat File'><span style='color : #fce044' class='fa fa-file'></span></a>`;
                            var returning = '';
                            if (parseInt(data.jalurIsactive) == 1) {
                                returning += btnUbah + btnUpload;
                            } else {

                                returning += btnAktif + btnUbah + btnHapus + btnUpload;
                            }

                            if (data.jalurFileKelulusan) {
                                returning += btnLihatFile;
                            }

                            if (returning !== '') {
                                return returning;
                            }

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
        });

        var id = '';
        $(document).on('click', '.btnEdit', function(event) {
            id = $(this).data('id');

            cleanError();

            $('#modal-edit').modal('show');

            find = dataFull.find(seep => seep.jalurId == id);


            $.each(find, function(index, el) {

                if (index == 'biayaHarga') {
                    // $('#pegawaiFoto').attr("style", 'background-image: url("<?php echo base_url('assets/upload/images') ?>/'+el+'")');
                    $('input[name="' + index + '"]').val(formatRupiah(el));
                } else {
                    $('input[name="' + index + '"]').val(el);
                    $('select[name="' + index + '"]').val(el).trigger('chosen:updated');
                }
            });

        });


        $(document).on('click', '.btnDelete', function(event) {
            id = $(this).data('id');
            $('#modal-delete').modal('show');

            find = dataFull.find(seep => seep.jalurId == id);

            template(find);
        });

        function upload(id) {

            form_data = new FormData();
            // File upload input
            if ($('#jalurFileKelulusan')[0].files[0]) {
                form_data.append(value.name, $('#jalurFileKelulusan')[0].files[0]);
            } else {
                return false;
            }

            form_data.append('upload_id', id);

            $.ajax({
                url: "<?php echo base_url() ?>jalur_masuk/upload_berkas",
                type: "POST",
                data: form_data,
                processData: false,
                contentType: false,
                async: false,
                dataType: 'json',
                success: function(data) {
                    return false;
                }
            });
        }

        $(document).on('click', '.btnUpload', function(event) {
            id = $(this).data('id');

            // find = dataFull.find(seep => seep.jalurId == id);
            // $.ajax({
            //     url: "<?php echo base_url() ?>jalur_masuk/cek_",
            //     type: "POST",
            //     data: form_data,
            //     processData: false,
            //     contentType: false,
            //     async: false,
            //     dataType: 'json',
            //     success: function(data) {
            //         if (data.status == 'validasi') {
            //             status = 0;
            //         } else {
            //             status = 1;
            //         }
            //     }
            // });
            // $('#jalurNama').html(find.jalurNama);
            // $('#jalurTahun').html(find.jalurTahun);
            // $('#modal-aktif').modal('show');
            Swal.fire({
                title: 'Unggah Berkas Kelulusan',
                text: 'Modal with a custom image.',
                allowOutsideClick: false,
                html: `<br>
                <input id="jalurFileKelulusan" name="jalurFileKelulusan" type="file">
                <p id="jalurFileKelulusans" name="inVal" style="padding:1px 1px;margin-bottom:0px;"></p><br>
                `,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                preConfirm: function() {
                    $('.swal2-confirm').hide();
                    $('.swal2-cancel').hide();


                    status = 0;
                    form_data = new FormData();
                    // File upload input
                    if ($('#jalurFileKelulusan')[0].files[0]) {
                        form_data.append('jalurFileKelulusan', $('#jalurFileKelulusan')[0].files[0]);
                    } else {
                        $('.swal2-confirm').show();
                        $('.swal2-cancel').show();
                        toastr['error']('Terjadi kesalahan');
                        return false;
                    }
                    form_data.append('upload_id', id);

                    msg = '';
                    $.ajax({
                        url: "<?php echo base_url() ?>jalur_masuk/upload_berkas",
                        type: "POST",
                        data: form_data,
                        processData: false,
                        contentType: false,
                        async: false,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 'validasi') {
                                status = 0;
                                msg = data.msg;
                            } else {
                                status = 1;
                            }
                        }
                    });
                    // request = false;
                    if (status == 0) {
                        $('.swal2-confirm').show();
                        $('.swal2-cancel').show();
                        toastr['error'](msg);
                        return false;
                    } else {
                        return true;
                    }
                }
            }).then((result) => {
                if (result.value) {
                    // location.reload(true);
                    oTable.api().ajax.reload();

                    toastr['success']('Upload Berhasil');
                } else {
                    duplicate_id = '';
                }
            })
            $('body').removeClass('swal2-shown swal2-height-auto');
            $("#jalurFileKelulusan").fileinput({
                allowedFileExtensions: ["pdf"],
                allowedFileTypes: ["pdf"],
                browseLabel: "&nbspPilih File..",
                maxFileSize: 10000,
                maxFileCount: 1,
                showRemove: false,
                showCaption: false,

                showUpload: false,

            });

            // $('.file-input-new').hide();

        });

        $(document).on('click', '.btnAktif', function(event) {
            id = $(this).data('id');

            find = dataFull.find(seep => seep.jalurId == id);

            $('#jalurNama').html(find.jalurNama);
            $('#jalurTahun').html(find.jalurTahun);
            $('#modal-aktif').modal('show');

        });

        function template(data) {
            var txt = `<div class="table-responsive">
            <table class="table table-hover" style="width:100%; display: table">
            <tbody>`;

            var label = ['Nama Jalur', 'Tahun'];
            var key = ['jalurNama', 'jalurTahun'];

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

            // var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            // data.append('<?php echo $this->security->get_csrf_token_name(); ?>', cct);

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

            // var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            // var data = {};
            // data.<?php echo $this->security->get_csrf_token_name(); ?> = cct;

            $.ajax({
                url: '<?php echo current_url() ?>/deleteData/' + id,
                type: 'GET',
                dataType: 'JSON',
                // data: data,
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

        $(document).on('click', '.btnSimpanAktif', function(event) {
            event.preventDefault();

            $.ajax({
                url: '<?php echo current_url() ?>/setActive/' + id,
                type: 'POST',
                dataType: 'JSON',
                beforeSend: function() {
                    btnLoading('.btnSimpanAktif');
                },
                complete: function() {
                    btnNormal('.btnSimpanAktif');
                },
                success: function(res) {
                    id = '';

                    toastr[res.status](res.message);

                    $('#modal-aktif').modal('hide');
                    oTable.api().ajax.reload();

                    if (res.status == 'success') {
                        setTimeout(function() {
                            window.location = '<?php echo base_url('jalur_masuk') ?>'
                        }, 1000);
                    }

                },
                error: function() {
                    toastr['error']('Terjadi kesalahan');
                }
            })
        });

        function getError(data) {
            $.each(data.error, function(index, el) {
                $('.' + index).html(el);
                $('.' + index).parents('.form-group').removeClass('has-error');

                if (el != '') {
                    $('.' + index).parents('.form-group').addClass('has-error');
                }


            });
        }

        function cleanError() {
            $('.cleanError').html('');
            $('.cleanError').parents('.form-group').removeClass('has-error');
        }

        var btnText;

        function btnLoading(selector) {
            btnText = $(selector).html();
            $(selector).html('<i class="fa fa-spinner fa-spin"></i> Loading .....');
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