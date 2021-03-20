<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Laporan</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span><a href='<?= site_url('admin_side/permohonan_kk'); ?>'>Pengajuan KK</a></span>
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
		<p> 2. <b>Daftar Anggota Keluarga</b> merupakan isian multi value, dengan pemisah karakter "<b>;</b>".</p>
		<p> 3. Isian paling depan merupakan kepala keluarga.</p>
		<p> 4. Jika isian tidak bernilai makan silahkan ganti dengan tanda "<b>-</b>".</p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_pengajuan_kk');?>" method="post" enctype='multipart/form-data'>
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
						<input type="hidden" name="id" value="<?= md5($data_utama->id_data_kk); ?>">
						<input type="hidden" name="user" value="<?= md5($data_utama->created_by); ?>">
						<input type="hidden" name="file_lama" value="<?= $data_utama->file; ?>">
						<div class="form-body">
                            
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nomor Surat <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nomor_surat" placeholder="Type something" value='<?= $data_utama->nomor_surat; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nomor KK <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="kk" placeholder="Type something" value='<?= $data_utama->kk; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Alamat <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="alamat" placeholder="Type something" value='<?= $data_utama->alamat; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">RT<span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="rt" placeholder="Type something" value='<?= $data_utama->rt; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">RW <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="rw" placeholder="Type something" value='<?= $data_utama->rw; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Dusun/ Dukuh/ Kampung <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="dusun" placeholder="Type something" value='<?= $data_utama->dusun; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							<hr>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Daftar Anggota Keluarga</label>
								<div class="col-md-10">
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nama <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nama" placeholder="Type something" value='<?= $data_utama->nama; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">NIK <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nik" placeholder="Type something" value='<?= $data_utama->nik; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Jenis Kelamin <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="jenis_kelamin" placeholder="Type something" value='<?= $data_utama->jenis_kelamin; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Tempat Lahir <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="tempat_lahir" placeholder="Type something" value='<?= $data_utama->tempat_lahir; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Provinsi <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="provinsi" placeholder="Type something" value='<?= $data_utama->provinsi; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Tanggal Lahir <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="tanggal_lahir" placeholder="Type something" value='<?= $data_utama->tanggal_lahir; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Akta Kelahiran (Ada/ Tidak) <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="akta_kelahiran" placeholder="Type something" value='<?= $data_utama->akta_kelahiran; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Golongan Darah <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="golongan_darah" placeholder="Type something" value='<?= $data_utama->golongan_darah; ?>' required>
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
										<input type="text" class="form-control" name="agama" placeholder="Type something" value='<?= $data_utama->agama; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Status Perkawinan (Kawin/ Belum/ CH/ CM) <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="status_perkawinan" placeholder="Type something" value='<?= $data_utama->status_perkawinan; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Tanggal Perkawinan/ Perceraian <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="tanggal_perkawinan" placeholder="Type something" value='<?= $data_utama->tanggal_perkawinan; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Status Hubungan Dalam Keluarga <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="status_hubungan_dalam_keluarga" placeholder="Type something" value='<?= $data_utama->status_hubungan_dalam_keluarga; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">No. Paspor <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nomor_paspor" placeholder="Type something" value='<?= $data_utama->nomor_paspor; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">No. KITAP <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="no_kitap" placeholder="Type something" value='<?= $data_utama->no_kitap; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nama Ayah <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="ayah" placeholder="Type something" value='<?= $data_utama->ayah; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nama Ibu <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="ibu" placeholder="Type something" value='<?= $data_utama->ibu; ?>' required>
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
				</div>
			</div>
		</div>
	</div>
</div>