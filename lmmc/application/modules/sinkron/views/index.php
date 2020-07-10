<section id="content">
    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-6">
                        <h1 class="m-b-xs text-black hidden-xs"><small>Sinkronisasi Pembayaran</small></h1>
                        <h2 class="m-b-xs text-black hidden-lg hidden-md hidden-sm"><small>Sinkronisasi Pembayaran</small></h2>
                    </div>
                    <div class="col-xs-6 m-t-md pull-right">
                        <button data-toggle="modal" data-target="#modal-range" type="button" class="btn btn-primary pull-right btn_add">Range Sinkron</button>
                        <button type="button" onclick="sinkron($(this))" id="btn-sinkron" class="btn btn-primary btn_add pull-right">Sinkron</button>
                        <h4 class="btn_add pull-right">
                            <input type="checkbox" id="otomatis" /> Auto Sinkron
                        </h4>
                        <span class="fa fa-spinner fa-spin fa-2x pull-right"></span>
                    </div>
                </section>
            </header>
            <section class="scrollable padder space">
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table" style="width: 100%">
                                <tr>
                                    <th>Terakhir Sinkron</th>
                                    <td>
                                        <input id="last" type="text" class="form-control" value="<?php echo $lastSinkron; ?>" readonly="true" />
                                    </td>
                                    <td class="text-right">
                                        <button id="simpan" type="button" class="btn btn-success">Simpan</button>
                                        <button id="ubah" type="button" class="btn btn-primary">Ubah Waktu Sinkron Terakhir</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table-sinkron" class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Nomor Peserta</th>
                                        <th>Nama</th>
                                        <th>Program Studi</th>
                                        <th>Tagihan Biaya</th>
                                        <th>Status Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($masuk) : ?>
                                        <?php foreach ($masuk as $row) : ?>
                                            <tr>
                                                <td><?php echo $row['tagihanNoRegis']; ?></td>
                                                <td><?php echo $row['tagihanPesertaNama']; ?></td>
                                                <td><?php echo $row['tagihanProdiNama']; ?></td>
                                                <td><?php echo $row['tagihanBiaya']; ?></td>
                                                <td><?php
                                                    if ($row['tagihanIslunas'] == "1") {
                                                        echo "Lunas";
                                                    } else if ($row['tagihanIslunas'] == "2") {
                                                        echo "Sudah dibayar namun bermasalah";
                                                    }
                                                    ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                Tidak ada data yang tersinkron !
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <div id="modal-range" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Range sinkron</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label class="control-label col-md-2">Waktu Awal</label>
                        <div class="col-md-3">
                            <input id="start-range" maxlength="19" type="text" class="form-control" value="<?= date("Y-m-d 00:00:00"); ?>" name="star_range" />
                        </div>
                        <label class="control-label col-md-2">Waktu Akhir</label>
                        <div class="col-md-3">
                            <input id="end-range" maxlength="19" type="text" class="form-control" value="<?= date("Y-m-d 23:59:59"); ?>" name="end_range" />
                        </div>
                        <div class="col-md-2">
                            <button id="btn-sinkron-range" class="btn btn-primary">Sinkron Range</button>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <table id="table-sinkron-range" class="table table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nomor Peserta</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Tagihan Biaya</th>
                                    <th>Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5`" class="text-center">
                                        Tidak ada data yang tersinkron !
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    function sinkron(btn) {
        // btn.attr("disabled", true);
        btn.append(" <i class='fa fa-spin fa-spinner'></i>");
        $.ajax({
            url: "<?php echo base_url('sinkron/ajax'); ?>",
            type: 'GET',
            dataType: 'JSON',
            success: function(r) {
                btn.find("i").remove();
                // btn.removeAttr("disabled");
                $("#table-sinkron tbody").empty();
                $("#last").val(r.last);
                if (r.data.length > 0) {
                    $.each(r.data, function(i, row) {
                        var status = "";
                        if (row.tagihanIslunas == "1") {
                            status = "Lunas";
                        } else if (row.tagihanIslunas == "2") {
                            status = "Sudah dibayar namun bermasalah";
                        }
                        $("#table-sinkron tbody").append($("<tr>")
                            .append($("<td>").html(row.tagihanNoRegis))
                            .append($("<td>").html(row.tagihanPesertaNama))
                            .append($("<td>").html(row.tagihanProdiNama))
                            .append($("<td>").html(row.tagihanBiaya))
                            .append($("<td>").html(status))
                        );
                    });
                } else {
                    $("#table-sinkron tbody").append('<tr><td colspan="5" class="text-center">Tidak ada data yang tersinkron !</td></tr>');
                }
            }
        });
    };
    $(function() {

        var timer;
        $(".fa-spin").hide();
        $("#simpan").hide();
        $("#ubah").click(function() {
            $(this).hide();
            $("#simpan").show();
            $("#last").removeAttr("readonly");
        });

        $("#btn-sinkron-range").click(function() {
            var start = $("#start-range").val();
            var end = $("#end-range").val();
            var btn = $(this);
            if (moment(start, 'YYYY-MM-DD H:mm:ss', true).isValid() && moment(end, 'YYYY-MM-DD H:mm:ss', true).isValid()) {
                // btn.attr("disabled",true);
                btn.append(" <i class='fa fa-spin fa-spinner'></i>");
                $.ajax({
                    url: "<?php echo base_url('sinkron/ajax'); ?>",
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        end: end,
                        start: start
                    },
                    success: function(r) {
                        btn.find("i").remove();
                        // btn.removeAttr("disabled");
                        $("#table-sinkron-range tbody").empty();
                        $("#last").val(r.last);
                        if (r.data.length > 0) {
                            $.each(r.data, function(i, row) {
                                var status = "";
                                if (row.tagihanIslunas == "1") {
                                    status = "Lunas";
                                } else if (row.tagihanIslunas == "2") {
                                    status = "Sudah dibayar namun bermasalah";
                                }
                                $("#table-sinkron-range tbody").append($("<tr>")
                                    .append($("<td>").html(row.tagihanNoRegis))
                                    .append($("<td>").html(row.tagihanPesertaNama))
                                    .append($("<td>").html(row.tagihanProdiNama))
                                    .append($("<td>").html(row.tagihanBiaya))
                                    .append($("<td>").html(status))
                                );
                            });
                        } else {
                            $("#table-sinkron-range tbody").append('<tr><td colspan="5" class="text-center">Tidak ada data yang tersinkron !</td></tr>');
                        }
                    }
                });
            } else {
                swal("Oops", "Format Range harus \nYYYY-MM-DD h:mm:ss => 2018-07-28 13:30:21", "warning");
            }
        });

        $("#simpan").click(function() {
            $.ajax({
                url: "<?php echo base_url('sinkron/set_last'); ?>",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    'last': $("#last").val()
                },
                success: function(r) {
                    if (r.status) {
                        $("#last").val(r.last);
                        $("#simpan").hide();
                        $("#ubah").show();
                        $("#last").prop("readonly", 'true');
                    } else {
                        alert("Format Waktu salah !");
                    }
                }
            })
        });
        $("#otomatis").click(function() {
            var check = $(this).is(":checked");
            if (check) {
                var btn = $("#btn-sinkron");
                timer = setInterval(function() {
                    sinkron(btn)
                }, (1000 * 30));
            } else {
                clearInterval(timer);
            }
        });
    });
</script>