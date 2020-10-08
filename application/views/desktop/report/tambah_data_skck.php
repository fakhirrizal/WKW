<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Laporan</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span><a href='<?= site_url('/skck'); ?>'>Pengajuan SKCK</a></span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Tambah Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
        <h3>Catatan</h3>
        <p> 1. Kolom isian dengan tanda bintang (<font color='red'>*</font>) adalah wajib untuk di isi.</p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<form role="form" class="form-horizontal" action="<?=base_url('simpan_permohonan_skck');?>" method="post" enctype='multipart/form-data'>
						<div class="form-body">
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nama <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nama" placeholder="Nama sesuai dengan KTP" required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nomor Identitas <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nik" placeholder="NIK" maxlength="16" minlength="16" required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">TTL <span class="required"> * </span></label>
								<div class="col-md-5">
									<div class="input-icon">
										<input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
                                </div>
                                <div class="col-md-5">
									<div class="input-icon">
										<input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Pekerjaan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan" required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Agama <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
                                        <select class='form-control' name='agama' required>
                                            <option value=''>-- Pilih --</option>
                                            <option value='Islam'>Islam</option>
                                            <option value='Protestan'>Protestan</option>
                                            <option value='Katolik'>Katolik</option>
                                            <option value='Hindu'>Hindu</option>
                                            <option value='Buddha'>Buddha</option>
                                            <option value='Khonghucu'>Khonghucu</option>
                                        </select>
                                        <i class="icon-pin"></i>
									</div>
								</div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Alamat <span class="required"> * </span></label>
								<div class="col-md-5">
									<div class="input-icon">
										<input type="text" class="form-control" name="rt" placeholder="RT" required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
                                </div>
                                <div class="col-md-5">
									<div class="input-icon">
										<input type="text" class="form-control" name="rw" placeholder="RW" required>
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
									<button type="submit" class="btn blue">Simpan</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>