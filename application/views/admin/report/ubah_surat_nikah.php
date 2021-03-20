<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Laporan</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span><a href='<?= site_url('/admin_side/surat_nikah'); ?>'>Pengajuan Surat Nikah</a></span>
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
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_surat_nikah');?>" method="post" enctype='multipart/form-data'>
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
						<input type="hidden" name="id" value="<?= md5($data_utama->id_surat_nikah); ?>">
						<input type="hidden" name="user" value="<?= md5($data_utama->created_by); ?>">
						<input type="hidden" name="file_lama" value="<?= $data_utama->file; ?>">
						<input type="hidden" name="jenis_kelamin" value="<?= $data_utama->jenis_kelamin; ?>">
						<input type="hidden" name="jenis_kelamin_pasangan" value="<?= $data_utama->jenis_kelamin_pasangan; ?>">
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
                            <hr>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Calon Laki-laki </label>
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
								<label class="col-md-2 control-label" for="form_control_1">Bin <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="bin" placeholder="Type something" value='<?= $data_utama->bin; ?>' required>
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
								<label class="col-md-2 control-label" for="form_control_1">Tanggal Lahir <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="date" class="form-control" name="tanggal_lahir" placeholder="Type something" value='<?= $data_utama->tanggal_lahir; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Kebangsaan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="kebangsaan" placeholder="Type something" value='<?= $data_utama->kebangsaan; ?>' required>
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
								<label class="col-md-2 control-label" for="form_control_1">Status <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="status" placeholder="Type something" value='<?= $data_utama->status; ?>' required>
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
								<label class="col-md-2 control-label" for="form_control_1">Pekerjaan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="pekerjaan" placeholder="Type something" value='<?= $data_utama->pekerjaan; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <hr>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-4 control-label" for="form_control_1" style="text-align: left;">Ayah dari Calon Laki-laki </label>
								<div class="col-md-8">
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nama <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="ayah_nama" placeholder="Type something" value='<?= $data_utama->ayah_nama; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Bin <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="ayah_bin" placeholder="Type something" value='<?= $data_utama->ayah_bin; ?>' required>
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
										<input type="text" class="form-control" name="ayah_tempat_lahir" placeholder="Type something" value='<?= $data_utama->ayah_tempat_lahir; ?>' required>
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
										<input type="date" class="form-control" name="ayah_tanggal_lahir" placeholder="Type something" value='<?= $data_utama->ayah_tanggal_lahir; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Kebangsaan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="ayah_kebangsaan" placeholder="Type something" value='<?= $data_utama->ayah_kebangsaan; ?>' required>
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
										<input type="text" class="form-control" name="ayah_agama" placeholder="Type something" value='<?= $data_utama->ayah_agama; ?>' required>
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
										<input type="text" class="form-control" name="ayah_rt" placeholder="Type something" value='<?= $data_utama->ayah_rt; ?>' required>
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
										<input type="text" class="form-control" name="ayah_rw" placeholder="Type something" value='<?= $data_utama->ayah_rw; ?>' required>
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
										<input type="text" class="form-control" name="ayah_nik" placeholder="Type something" value='<?= $data_utama->ayah_nik; ?>' required>
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
										<input type="text" class="form-control" name="ayah_pekerjaan" placeholder="Type something" value='<?= $data_utama->ayah_pekerjaan; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Desa/ Kelurahan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="ayah_desa" placeholder="Type something" value='<?= $data_utama->ayah_desa; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Kecamatan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="ayah_kecamatan" placeholder="Type something" value='<?= $data_utama->ayah_kecamatan; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Kabupaten/ Kota <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="ayah_kabupaten" placeholder="Type something" value='<?= $data_utama->ayah_kabupaten; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <hr>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Perempuan </label>
								<div class="col-md-10">
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nama <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nama_pasangan" placeholder="Type something" value='<?= $data_utama->nama_pasangan; ?>' required>
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
										<input type="text" class="form-control" name="tempat_lahir_pasangan" placeholder="Type something" value='<?= $data_utama->tempat_lahir_pasangan; ?>' required>
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
										<input type="date" class="form-control" name="tanggal_lahir_pasangan" placeholder="Type something" value='<?= $data_utama->tanggal_lahir_pasangan; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Kewarganegaraan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="kebangsaan_pasangan" placeholder="Type something" value='<?= $data_utama->kebangsaan_pasangan; ?>' required>
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
										<input type="text" class="form-control" name="agama_pasangan" placeholder="Type something" value='<?= $data_utama->agama_pasangan; ?>' required>
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
										<input type="text" class="form-control" name="rt_pasangan" placeholder="Type something" value='<?= $data_utama->rt_pasangan; ?>' required>
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
										<input type="text" class="form-control" name="rw_pasangan" placeholder="Type something" value='<?= $data_utama->rw_pasangan; ?>' required>
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
										<input type="text" class="form-control" name="nik_pasangan" placeholder="Type something" value='<?= $data_utama->nik_pasangan; ?>' required>
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
										<input type="text" class="form-control" name="pekerjaan_pasangan" placeholder="Type something" value='<?= $data_utama->pekerjaan_pasangan; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Binti <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="binti" placeholder="Type something" value='<?= $data_utama->binti; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
						</div>
                        <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Desa/ Kelurahan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="desa_pasangan" placeholder="Type something" value='<?= $data_utama->desa_pasangan; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Kecamatan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="kecamatan_pasangan" placeholder="Type something" value='<?= $data_utama->kecamatan_pasangan; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Kabupaten <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="kabupaten_pasangan" placeholder="Type something" value='<?= $data_utama->kabupaten_pasangan; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
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