<form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_data_anggota_lembaga_desa');?>" method="post" enctype='multipart/form-data'>
    <input type="hidden" name="id_anggota_lembaga_desa" value="<?= md5($data_utama->id_anggota_lembaga_desa); ?>">
    <input type="hidden" name="id_lembaga_desa" value="<?= md5($data_utama->id_lembaga_desa); ?>">
    <div class="form-body">
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Nama <span class="required"> * </span></label>
            <div class="col-md-10">
                <div class="input-icon">
                    <input type="text" class="form-control" name='nama' value='<?= $data_utama->nama; ?>' required>
                    <div class="form-control-focus"> </div>
                    <span class="help-block">Some help goes here...</span>
                    <i class="icon-pin"></i>
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Jabatan <span class="required"> * </span></label>
            <div class="col-md-10">
                <div class="input-icon">
                    <input type="text" class="form-control" name='jabatan' value='<?= $data_utama->jabatan; ?>' required>
                    <div class="form-control-focus"> </div>
                    <span class="help-block">Some help goes here...</span>
                    <i class="icon-pin"></i>
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Foto </label>
            <div class="col-md-10">
                <div class="input-icon">
                    <input type="file" class="form-control" name="file" >
                    <div class="form-control-focus"> </div>
                    <span class="help-block">Some help goes here...</span>
                    <i class="icon-pin"></i>
                </div>
            </div>
        </div>
        <?php
        if($data_utama->foto=='' OR $data_utama->foto==NULL){
            echo'';
        }else{
            echo'
            <div class="form-group form-md-line-input has-danger">
                <label class="col-md-2 control-label" for="form_control_1"> </label>
                <div class="col-md-10">
                    <img src="'.base_url().'data_upload/anggota_lembaga_desa/'.$data_utama->foto.'" width="100px" height="150px"/>
                </div>
            </div>
            ';
        }
        ?>
    </div>
    <br>
    <div class="form-actions margin-top-10">
        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                <button type="reset" class="btn default">Batal</button>
                <button type="submit" class="btn blue">Perbarui</button>
            </div>
        </div>
    </div>
</form>