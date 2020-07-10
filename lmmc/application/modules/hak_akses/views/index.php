<section id="content">
    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                    <section class="row m-b-md" style="">
                        <div class="col-xs-8">
                          <h1 class="m-b-xs text-black hidden-xs"><small>Hak Akses</small></h1>
                          <h2 class="m-b-xs text-black hidden-lg hidden-sm hidden-md"><small>Hak Akses</small></h2>
                        </div>
                    </section>
            </header>
                    <section class="scrollable padder space">
                        <div class="box-body">
                            <ul class="nav nav-tabs m-b-n-xxs bg-light">
                                <?php
                                $first = true;
                                foreach ($roleList as $role) {
                                    if ($role['role'] == 'superadmin') {
                                        continue;
                                    }
                                    $r = str_replace(" ", "_", $role['role']);
                                    echo "<li " . ($first ? "class='active'" : "") . ">" .
                                    anchor("#tab-$r", $role['roleNama'], array('data-toggle' => 'tab')) . "</li>";
                                    $first = false;
                                }
                                ?>
                            </ul>
                            
                            <div class="tab-content">
                                <?php
                                $first = true;
                                foreach ($roleList as $role):
                                    $r = str_replace(" ", "_", $role['role']);
                                    ?>
                                    <div id="tab-<?php echo $r; ?>" class="tab-pane fade <?php echo ($first) ? "active in" : ""; ?>">
                                        <form action="<?php echo base_url('hak_akses/simpan'); ?>" method="POST">
                                            <div class="row" style="margin-top: 10px">
                                                <!--<div class="col-xs-4 pull-right hak_akses_button2">
                                                    <div class="input-group">
                                                        <input type="text" id="field-cari-<?php echo $r; ?>" class="form-control" name="field-cari" placeholderr="Pencarian Modul">
                                                        <span class="input-group-btn" >
                                                            <a href="#" type="button" data-field="field-cari-<?php echo $r; ?>" data-var="<?php echo $r; ?>" class="btn btn-cari btn-primary" value="Cari"><i class="fa fa-search"></i></a>
                                                        </span>
                                                    </div>
                                                </div>-->
                                            </div>
<!--                                        <section class="scrollable padder">-->
                                            <table  style="margin : 0px 40px 0px 0px;" id="table-<?php echo $r; ?>" width="100%" class="table table-hover table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="35%">Role</th>
                                                        <th width="35%">Nama Modul</th>
                                                        <th width="30%">Hak Akses</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                                <div class="col-xs-0 pull-right hak_akses_button1">
                                                    <button type="submit" value="Simpan" name="Submit" class="btn btn-success"><i class="fa fa-save icon_padding" style="margin-right: 5px"></i>Simpan</button>
                                                </div>
                                        </form>
                                    </div>
                                <?php $first = false; endforeach; ?>
                            </div>
                            
                        </div>
                    </section>
                </section>
            </section>
    

<!--Modal Tambah--> 
<div id="modal-tambah" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h4>Tambah Hak Akses</h4></div>
            <div class="modal-body">
                <div class="alert alert-danger panel-body" id="pesan-error"></div>
                <?php
                $this->view('_form', array(
                    'model' => $model,
                    'listRole' => $listRole,
                    'listModul' => $listModul,
                    )
                );
                ?>
            </div>
        <div class="modal-footer">
            <button id="btn-tambah" class="btn btn-primary modalbtn" onclick="tambah();">
                <span class="fa fa-spinner fa-spin"></span> Tambah
            </button>
            <button id="btn-batal-tambah" data-dismiss="modal" class="btn btn-default modalbtn">Batal</button>
        </div>
        </div>
    </div>
</div>
<!--Modal Hapus-->
<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">Hapus User</div>
            <div class="modal-body">
                Anda yakin menghapus hak akses 
                <span id="role-delete"></span> 
                untuk modul <span id="modul-delete"></span>?
            </div>
            <div class="modal-footer2" style="text-align : center">
            <button id="btn-hapus" class="btn btn-danger" onclick="hapus();">
                <span class="fa fa-spinner fa-spin"></span> Hapus
            </button>
            <button id="btn-batal" data-dismiss="modal" class="btn btn-default">Batal</button>
        </div>
        </div>
    </div>
</div>

    </section>
<script>
    <?php 
    foreach($roleList as $role){
        $r = str_replace(" ","_",$role['role']);
        echo "var $r;";
    }
    ?>
    function setModal(dom){
        var data = dom.data();
        $(".fa-spinner").hide();
        $("#btn-hapus").show();
        $("#btn-batal").html("Batal");
        $("#modal-hapus .modal-body").html("Anda yakin menghapus hak akses <span id='role-delete'></span> untuk modul \"<span id='modul-delete'></span>\" ?");
        $("#role-delete").html(data['role']);
        $("#modul-delete").html(data['modul']);
    }
    function hapus() {
        var role = $("#role-delete").html();
        var modul = $("#modul-delete").html();
        var table = role.replace(" ","_");
        var get = {"role":role,"modul":modul};
        $.ajax({
            url: "<?php echo base_url('hak_akses/hapus'); ?>",
            data: get,
            dataType: 'JSON',
            beforeSend: function(){
                $(".fa-spinner").show();
                $("#btn-hapus").attr("disabled",true);
                $("#btn-batal").attr("disabled",true);
            },
            success: function (data) {
                $(".fa-spinner").hide();
                $("#btn-hapus").removeAttr("disabled");
                $("#btn-batal").removeAttr("disabled");
                if (data.hapus) {
                    $("#btn-hapus").hide();
                    $("#btn-batal").html("Tutup");
                    window[table].fnDraw();
                }
                $(".modal-body").html(data.pesan);
            },
        });
    }
    function createDataTable(obj,url){
        return $('#'+obj).dataTable({
            processing: true,
            serverSide: true,
            scrollX : false, 
            ajax: url,
            pagingType : 'numbers',
            lengthMenu: [1000],
            dom: '<"top">tr<"bottom"i>',
            columnDefs: [{"className": "dt-tengah", "targets": [2]}],
            columns: [
                {data: 'role',searchable: false,nama:"simdakar_user_role.role"},
                {data: 'modul',nama:"simdakar_modul.modul"},
                {data: 'hak', searchable: false, orderable: false, nama:"",
                    render: function (data, type, row) {
                        var listHak = ["BACA", "TULIS", "HAPUS", "UPDATE"];
                        var hak = data;
                        if (hak !== null) hak = data.split(",");
                        display = "";
                        var text = "";
                        for (i = 0; i < listHak.length; i++) {
                            text = listHak[i].charAt(0).toUpperCase() + listHak[i].slice(1).toLowerCase();
                            if ($.inArray(listHak[i], hak) >= 0)
                                display += "<input type='checkbox' name='Hak[" + row.role + "][" + row.modul + "][" + listHak[i] + "]' checked/> " + text +" ";
                            else
                                display += "<input type='checkbox' name='Hak[" + row.role + "][" + row.modul + "][" + listHak[i] + "]' /> " + text +" ";
                        }
                        return display;
                    }
                },
//                {data: 'role', searchable: false, orderable: false,
//                    render: function (data, type, row) {
//                        var hapus = "<a data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' data-role='"+data+"' data-modul='" + row.modul + "' onclick='return setModal($(this));' href='#'><span style='color : #e33244' class='i i-trashcan'></span></a> ";
//                        return hapus;
//                    }
//                }
            ]
        });
    }
    function tambah(){
       var dataForm = $("#form-tambah").serialize();
       var url = $("#form-tambah").attr("action");
       $.ajax({
           url:url,
           type:"POST",
           dataType:"JSON",
           data:dataForm,
           beforeSend:function(){
               $(".fa-spinner").show();
               $("#btn-tambah").attr("disabled",true);
               $("#btn-batal-tambah").attr("disabled",true);
           },
           success:function(message){
               $(".fa-spinner").hide();
               $("#btn-tambah").removeAttr("disabled");
               $("#btn-batal-tambah").removeAttr("disabled");
               if(message.tambah){
                   var table = message.role.replace(" ","_");
                   window[table].fnDraw();
                   $("#btn-tambah").hide();
                   $("#btn-batal-tambah").html("Tutup");
                   $("#modal-tambah .modal-body").html(message.pesan);
               }else{
                   $("#pesan-error").show();
                   $("#pesan-error").html(message.pesan);
               }
           }
       });
   };
    $(document).ready(function () {
        var formBody = $("#modal-tambah .modal-body").html();
        var formFooter = $("#modal-tambah .modal-footer").html();
        $("#modal-tambah").on("show.bs.modal",function(){
            $("#modal-tambah .modal-body").html(formBody);
            $("#modal-tambah .modal-footer").html(formFooter);
            $(".fa-spinner").hide();
            $("#pesan-error").hide(); 
        });
        $(".btn-cari").click(function () {
            var field = $(this).data('field');
            var value = $("#"+field).val();
            var table = $(this).data('var');
            window[table].fnFilter(value);
        });
        <?php 
        foreach($roleList as $role){
            $r = str_replace(" ","_",$role['role']);
            echo "$r = createDataTable('table-$r','".base_url('hak_akses/index/'.$role['role'])."');";
        }
        ?>
    });
</script>
