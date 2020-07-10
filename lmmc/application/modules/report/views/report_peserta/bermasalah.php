<section id="content">
    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-8">
                        <?php
                        $page_header = 'Ringkasan';
                        ?>
                        <h1 class="m-b-xs text-black hidden-xs"><small><b><?php echo $page_header ?></b><span style="font-size: 13px"></span> <span style="font-size: 13px"></span></small></h1>
                        <h2 class="m-b-xs text-black hidden-lg hidden-md hidden-sm"><small><?php echo $page_header ?></small></h2>
                    </div>
                    <div class="col-xs-4 m-t-md pull-right">
                        <a target="_blank" href="<?php echo base_url($modul . '/ringkasan/xls'); ?>" class="pull-right btn btn-default btn_add btn-primary"><i class="fa  fa-file-excel-o"></i> <span class="hidden-xs hidden-sm hidden-md">Download Excel</span></a>
                        <a target="_blank" href="<?php echo base_url($modul . '/ringkasan/pdf'); ?>" class="pull-right btn btn-default btn_add btn-primary"><i class="fa  fa-print"></i> <span class="hidden-xs hidden-sm hidden-md">Cetak PDF</span></a>
                    </div>
                </section>
            </header>
            <section class="scrollable padder space">
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-4 pull-right">
                            <div class="input-group">
                                <input type="text" id="field-cari" class="form-control" name="field-cari" placeholderr="Pencarian">
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" id="btn-cari" href="#" value="Cari"><i class="fa fa-search"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <table id="table-bagian" class="table table-hover table-bordered" style="margin-top: -500px" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr class="font-bold">
                                <td style="vertical-align: middle"> </td>
                                <td style="vertical-align: middle" width="20%">EKSAKTA</td>
                                <td style="vertical-align: middle">NON EKSAKTA</td>
                                <td style="vertical-align: middle" width="20%">JUMLAH</td>
                                <td style="vertical-align: middle" width="20%">CATATAN</td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div id="modal-hapus" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-xs">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>Konfirmasi</b></h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="idHapus">
                                <h4>Anda yakin ingin menghapus Data ?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                                <button class="btn btn-sm btn-primary" id="hapus" onclick="hapus()">Ya</button>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </section>
    </section>
</section>

<script>
    $(document).ready(function() {
        oTable = $('#table-bagian').dataTable({
            "ajax": {
                "url": '<?php echo base_url($modul . '/bermasalah_request') ?>',
                "type": "POST",
                "data": {}
            },
            processing: true,
            pagingType: 'numbers',
            scrollX: false,
            dom: '<"top">lrt<"bottom"ip>',
            "aaSorting": [],
            columnDefs: [{
                "className": "dt",
                "targets": [3]
            }]
        });

        $("#field-cari").on('keyup', function(e) {
            var code = e.which;
            if (code == 13)
                e.preventDefault();
            else
                oTable.fnFilter($("#field-cari").val());
        });


        $("#btn-cari").click(function() {
            oTable.fnFilter($("#field-cari").val());
        });

        $(document).on("click", ".open-ModalHapus", function() {
            var idJaga = $(this).data('id');
            $("#idJaga").val(idJaga);
            console.log(idJaga);
            // As pointed out in comments, 
            // it is unnecessary to have to manually call the modal.
            // $('#addBookDialog').modal('show');
        });
    });
</script>