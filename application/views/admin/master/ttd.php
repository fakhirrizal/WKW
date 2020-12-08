<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>JDIH</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Ubah Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<p> 1. Kolom isian dengan tanda bintang (<font color='red'>*</font>) adalah wajib untuk di isi.</p>
        <p> 2. Ketentuan file yang diupload:</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Format berupa file <b>.pdf</b></p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ukuran maksimum file <b>3 MB</b></p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_jdih');?>" method="post" enctype='multipart/form-data'>
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
						<input type="hidden" name="id" value="<?=md5($data_utama->id_jdih);?>">
						<div class="form-body">
						    <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nomor <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nomor" placeholder="Type something" value='<?= $data_utama->nomor; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Tahun <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="tahun" placeholder="Type something" value='<?= $data_utama->tahun; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Tentang <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="tentang" placeholder="Type something" value='<?= $data_utama->tentang; ?>' required>
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
										<select name='jenis' class="form-control " required>
											<option value=''>-- Pilih --</option>
                                            <option value='Peraturan Pusat' <?php if($data_utama->jenis=='Peraturan Pusat'){echo'selected';}else{echo'';} ?>>Peraturan Pusat</option>
											<option value='Peraturan Provinsi' <?php if($data_utama->jenis=='Peraturan Provinsi'){echo'selected';}else{echo'';} ?>>Peraturan Provinsi</option>
											<option value='Peraturan Kabupaten' <?php if($data_utama->jenis=='Peraturan Kabupaten'){echo'selected';}else{echo'';} ?>>Peraturan Kabupaten</option>
											<option value='Peraturan Desa' <?php if($data_utama->jenis=='Peraturan Desa'){echo'selected';}else{echo'';} ?>>Peraturan Desa</option>
                                        </select>
                                        <i class="icon-pin"></i>
									</div>
								</div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">File </label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="file" class="form-control" name="file" placeholder="Type something" >
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-paperclip"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1"> </label>
								<div class="col-md-10">
									<iframe src='<?= base_url().'data_upload/jdih/'.$data_utama->file; ?>' width='100%' height='500px'></iframe>
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
				</div>
			</div>
		</div>
	</div>
</div>