<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- <script src="<?=base_url('assets/pages/scripts/components-editors.min.js');?>" type="text/javascript"></script> -->
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Berita</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Detail Data</span>
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
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light ">
				<div class="portlet-body">
					<form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_berita');?>" method="post"  enctype='multipart/form-data'>
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
						<input type="hidden" name="id" value="<?= md5($data_utama->id_berita); ?>">
						<div class="form-body">
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Judul Berita <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="judul" placeholder="Type something" value='<?= $data_utama->judul; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Isi Berita <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<textarea class="form-control" name="isi" rows='6' placeholder="Type something" required><?= $data_utama->isi; ?></textarea>
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
                                        <input type="file" accept="application/image" class="form-control" name="file" placeholder="Type something">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Some help goes here...</span>
                                        <i class="icon-pin"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
                                <label class="col-md-2 control-label" for="form_control_1"> </label>
                                <div class="col-md-10">
                                   <img src='<?=base_url('data_upload/berita/'.$data_utama->foto);?>' width='100px'/>
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
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
</div>