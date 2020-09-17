<form role="form" class="form-horizontal" action="<?=base_url('perbarui_data_output');?>" method="post" enctype='multipart/form-data'>
    <input type="hidden" name="id_apbdesa" value="<?= md5($data_utama->id_apbdes); ?>">
    <input type="hidden" name="id_sub_output" value="<?= md5($data_utama->id_sub_output); ?>">
    <input type="hidden" name="id" value="<?= md5($data_utama->id_output); ?>">
    <div class="form-body">
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Sub Output </label>
            <div class="col-md-10">
                <div class="input-icon">
                    <input type="text" class="form-control" value='<?= $data_utama->sub_output; ?>' readonly>
                    <div class="form-control-focus"> </div>
                    <span class="help-block">Some help goes here...</span>
                    <i class="icon-pin"></i>
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Output <span class="required"> * </span></label>
            <div class="col-md-10">
                <div class="input-icon">
                    <input type="text" class="form-control" name='output' value='<?= $data_utama->output; ?>' required>
                    <div class="form-control-focus"> </div>
                    <span class="help-block">Some help goes here...</span>
                    <i class="icon-pin"></i>
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Nominal <span class="required"> * </span></label>
            <div class="col-md-10">
                <div class="input-icon">
                    <input type="number" class="form-control" name="nominal" value='<?= $data_utama->nominal; ?>' required>
                    <input type="hidden" name="lama" value='<?= $data_utama->nominal; ?>' >
                    <div class="form-control-focus"> </div>
                    <span class="help-block">Some help goes here...</span>
                    <i class="icon-pin"></i>
                </div>
            </div>
        </div>
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