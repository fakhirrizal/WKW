<script src="<?=base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
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
	})
</script>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Peta</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span><a href='<?= site_url('/admin_side/data_kelurahan'); ?>'>Data Kelurahan/ Desa</a></span>
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
		<p> 1. Kolom isian dengan tanda bintang (<font color='red'>*</font>) adalah wajib untuk di isi</p>
		<p> 2. Untuk marker disini merupakan titik ibu kota dari suatu Kelurahan/ Desa</p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_data_kelurahan');?>" method="post" enctype='multipart/form-data'>
						<input type="hidden" name="id_kecamatan" value="<?= md5($data_utama->id_kecamatan); ?>">
						<div class="form-body">
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
								<label class="col-md-2 control-label" for="form_control_1">Nama Kelurahan/ Desa <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nm_desa" value="<?= $data_utama->nm_desa; ?>" required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-map"></i>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Marker <span class="required"> * </span></label>
								<div class="col-md-10">
									<div id="map"></div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1"></label>
								<div class="col-md-5">
									<div class="input-icon">
										<input type="text" class="form-control" name='latitude' id='latitude' >
										<div class="form-control-focus"> </div>
										<span class="help-block">Garis lintang</span>
										<i class="icon-pin"></i>
									</div>
								</div>
								<div class="col-md-5">
									<div class="input-icon">
									<input type="text" class="form-control" name='longitude' id='longitude' >
										<div class="form-control-focus"> </div>
										<span class="help-block">Garis Bujur</span>
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
<style type="text/css">
	#map {
		height: 300px;
	}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize&key=AIzaSyCnjlDXASsyIUKAd1QANakIHIM8jjWWyNU"></script>

<script type="text/javascript">
	function updateMarkerPosition(latLng) {
		document.getElementById('latitude').value = [latLng.lat()]
		document.getElementById('longitude').value = [latLng.lng()]
	}

	var map = new google.maps.Map(document.getElementById('map'), {
	zoom: 7,
	center: new google.maps.LatLng(<?= $data_utama->lintang.','.$data_utama->bujur; ?>),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	var latLng = new google.maps.LatLng(<?= $data_utama->lintang.','.$data_utama->bujur; ?>);

	var marker = new google.maps.Marker({
		position : latLng,
		title : 'lokasi',
		map : map,
		draggable : true
	});

	updateMarkerPosition(latLng);
	google.maps.event.addListener(marker, 'drag', function() {
		updateMarkerPosition(marker.getPosition());
	});
</script>