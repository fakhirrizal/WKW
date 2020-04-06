<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

	$(function(){

		$.ajaxSetup({
			type:"POST",
			url: "<?php echo site_url('/admin/Master/ajax_function')?>",
			cache: false,
		});

		$("#id_provinsi").change(function(){
			var value=$(this).val();
			$.ajax({
				data:{id:value,modul:'get_kabupaten_by_id_provinsi'},
				success: function(respond){
					$("#id_kabupaten").html(respond);
				}
			})
		});

		$("#id_kabupaten").change(function(){
			var value=$(this).val();
			$.ajax({
				data:{id:value,modul:'get_kecamatan_by_id_kabupaten'},
				success: function(respond){
					$("#id_kecamatan").html(respond);
				}
			})
		});

		$("#id_kecamatan").change(function(){
			var value=$(this).val();
			$.ajax({
				data:{id:value,modul:'get_desa_by_id_kecamatan'},
				success: function(respond){
					$("#id_desa").html(respond);
				}
			})
		});

	})

</script>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Data Pengguna</span>
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
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Format berupa file <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b>, <b>.bmp</b></p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ukuran maksimum file <b>3 MB</b></p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_data_anggota');?>" method="post" enctype='multipart/form-data'>
						<input type="hidden" name="user_id" value="<?= md5($data_utama->user_id); ?>">
						<div class="form-body">
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Username/ NIK </label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="un" placeholder="Type something" value='<?= $data_utama->nik; ?>' readonly>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-user-following"></i>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Kata Sandi </label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="pass" placeholder="Type something" >
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-lock"></i>
									</div>
								</div>
							</div>
                            <hr>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nama Lengkap <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nama" placeholder="Type something" value='<?= $data_utama->nama; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-user"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Alamat (Nama Jalan) <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="alamat" placeholder="Type something" value='<?= $data_utama->alamat; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-map"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">RT/ RW <span class="required"> * </span></label>
								<div class="col-md-2">
									<div class="input-icon">
										<input type="text" class="form-control" name="rt" placeholder="Type something" value='<?= $data_utama->rt; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-map-pin"></i>
									</div>
								</div>
                                <div class="col-md-2">
									<div class="input-icon">
										<input type="text" class="form-control" name="rw" placeholder="Type something" value='<?= $data_utama->rw; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-map-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Provinsi <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<select name='id_provinsi' id='id_provinsi' class="form-control select2-allow-clear" required>
											<option value=''></option>
											<?php
											foreach ($provinsi as $key => $value) {
												if($value->id_provinsi==$data_utama->id_provinsi){
													echo '<option value="'.$value->id_provinsi.'" selected>'.$value->nm_provinsi.'</option>';
												}else{
													echo '<option value="'.$value->id_provinsi.'">'.$value->nm_provinsi.'</option>';
												}
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Kabupaten/ Kota <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<select name='id_kabupaten' id='id_kabupaten' class="form-control select2-allow-clear" required>
											<option value='<?= $data_utama->id_kabupaten; ?>'><?= $data_utama->nm_kabupaten; ?></option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Kecamatan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<select name='id_kecamatan' id='id_kecamatan' class="form-control select2-allow-clear" required>
											<option value='<?= $data_utama->id_kecamatan; ?>'><?= $data_utama->nm_kecamatan; ?></option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Kelurahan/ Desa <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<select name='id_desa' id='id_desa' class="form-control select2-allow-clear" required>
											<option value='<?= $data_utama->id_desa; ?>'><?= $data_utama->nm_desa; ?></option>
										</select>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Email <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="email" class="form-control" name="email" placeholder="Type something" value='<?= $data_utama->email; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-envelope"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nomor HP <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="no_hp" placeholder="Type something" value='<?= $data_utama->no_hp; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-phone"></i>
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
										<i class="fa fa-file-image-o"></i>
									</div>
								</div>
							</div>
                            <?php
                            if($data_utama->photo==NULL){
                                echo'';
                            }else{
                            ?>
                            <div class="form-group form-md-line-input has-danger">
                                <label class="col-md-2 control-label" for="form_control_1"> </label>
                                <div class="col-md-10">
                                   <img src='<?=base_url('data_upload/photo_profile/'.$data_utama->photo);?>' width='100px'/>
                                </div>
                            </div>
                            <?php } ?>
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
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
</div>