
<div class="panel-body">
  <div class="tab-content">
    <div class="tab-pane active" id="kont">
      <?php echo form_open(base_url('hak_akses/tambah'), array('id'=>'form-tambah','class' => 'form-horizontal')); ?>
        <div class="form-group" data-pg-collapsed>
          <label class="control-label col-sm-2">Role</label>
          <div class="col-sm-10">
              <?php echo form_dropdown('role',$listRole,$model['role'],array('class'=>'chosen-select','style'=>'width:60%;height:34px;'));?>
          </div>
        </div>
        <div class="form-group" data-pg-collapsed>
          <label class="control-label col-sm-2">Modul</label>
          <div class="col-sm-10">
              <?php echo form_dropdown('modul',$listModul,$model['modul'],array('class'=>'chosen-select','style'=>'width:60%;height:34px;'));?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Hak Akses</label>
          <div class="col-sm-10">
            <label class="checkbox-inline">
                <?php echo form_checkbox('hak[tulis]', TRUE, (isset($model['hak']['tulis'])) ? $model['hak']['tulis'] : FALSE); ?> Tulis
            </label>
            <label class="checkbox-inline">
                <?php echo form_checkbox('hak[baca]', TRUE, (isset($model['hak']['baca'])) ? $model['hak']['baca'] : FALSE); ?> Baca
            </label>
            <label class="checkbox-inline">
                <?php echo form_checkbox('hak[hapus]', TRUE, (isset($model['hak']['hapus'])) ? $model['hak']['hapus'] : FALSE); ?> Hapus
            </label>
            <label class="checkbox-inline">
                <?php echo form_checkbox('hak[update]', TRUE, (isset($model['hak']['update'])) ? $model['hak']['update'] : FALSE); ?> Update
            </label>
          </div>
        </div>
      <?php echo form_close(); ?> 
    </div>