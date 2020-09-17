<form role="form" class="form-horizontal" action="<?=base_url('perbarui_data_rincian_apbdesa');?>" method="post" enctype='multipart/form-data'>
    <input type="hidden" name="id" value="<?= md5($data_utama->id_apbdes); ?>">
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
            <label class="col-md-2 control-label" for="form_control_1">Jenis </label>
            <div class="col-md-10">
                <div class="input-icon">
                    <select class='form-control' name='keterangan' disabled>
                        <option value=''>-- Pilih --</option>
                        <option value='pendapatan' <?php if($data_utama->keterangan=='pendapatan'){echo'selected';}else{echo'';} ?>> Pendapatan </option>
                        <option value='pengeluaran' <?php if($data_utama->keterangan=='pengeluaran'){echo'selected';}else{echo'';} ?>> Belanja </option>
                        <option value='surplus / defisit' <?php if($data_utama->keterangan=='surplus / defisit'){echo'selected';}else{echo'';} ?>> Surplus / Defisit </option>
                        <option value='pembiayaan' <?php if($data_utama->keterangan=='pembiayaan'){echo'selected';}else{echo'';} ?>> Pembiayaan </option>
                        <option value='silpa' <?php if($data_utama->keterangan=='silpa'){echo'selected';}else{echo'';} ?>> Silpa / Silpa Tahun Berjalan </option>
                    </select>
                    <div class="form-control-focus"> </div>
                    <span class="help-block">Some help goes here...</span>
                    <i class="icon-pin"></i>
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Kategori <span class="required"> * </span></label>
            <div class="col-md-10">
                <div class="input-icon">
                    <select class='form-control' name='kategori' disabled>
                        <option value=''>-- Pilih --</option>
                        <option value='Rencana' <?php if($data_utama->kategori=='Rencana'){echo'selected';}else{echo'';} ?>> Rencana </option>
                        <option value='Realisasi' <?php if($data_utama->kategori=='Realisasi'){echo'selected';}else{echo'';} ?>> Realisasi </option>
                    </select>
                    <div class="form-control-focus"> </div>
                    <span class="help-block">Some help goes here...</span>
                    <i class="icon-pin"></i>
                </div>
            </div>
        </div>
        <div class="form-group form-md-line-input has-danger">
            <label class="col-md-2 control-label" for="form_control_1">Keterangan </label>
            <div class="col-md-10">
                <div class="input-icon">
                    <input type="text" class="form-control" name="rincian" value='<?= $data_utama->rincian; ?>' >
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
                    <input type="number" class="form-control" name="nominal" value='<?= $data_utama->nominal; ?>' readonly>
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