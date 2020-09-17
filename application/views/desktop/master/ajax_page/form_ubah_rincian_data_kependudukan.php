<form role="form" class="form-horizontal" action="<?=base_url('perbarui_rincian_data_kependudukan');?>" method="post" enctype='multipart/form-data'>
    <input type="hidden" name="id" value="<?= md5($data_utama->id); ?>">
    <div class="form-body">
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Tahun </label>
            <div class="col-md-10">
                <div class="input-icon">
                    <input type="text" class="form-control" name="tahun" value='<?= $data_utama->tahun; ?>' readonly>
                    <div class="form-control-focus"> </div>
                    <span class="help-block">Some help goes here...</span>
                    <i class="icon-pin"></i>
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Monografi Kependudukan </label>
            <div class="col-md-10">
                <div class="input-icon">
                    <input type="text" class="form-control" name="kategori" value='<?= $data_utama->kategori; ?>' readonly>
                    <div class="form-control-focus"> </div>
                    <span class="help-block">Some help goes here...</span>
                    <i class="icon-pin"></i>
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Keterangan <span class="required"> * </span></label>
            <div class="col-md-10">
                <div class="input-icon">
                    <input type="text" class="form-control" name="keterangan" value='<?= $data_utama->keterangan; ?>' required>
                    <div class="form-control-focus"> </div>
                    <span class="help-block">Some help goes here...</span>
                    <i class="icon-pin"></i>
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Jumlah <span class="required"> * </span></label>
            <div class="col-md-10">
                <div class="input-icon">
                    <input type="number" class="form-control" name="jumlah" value='<?= $data_utama->jumlah; ?>' required>
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