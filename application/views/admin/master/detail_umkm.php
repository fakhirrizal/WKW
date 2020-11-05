<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>UMKM</span>
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
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ekstensi file yang diizinkan: <b>.jpg</b>, <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b>, <b>.bmp</b></p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ukuran maksimum file <b>3 MB</b></p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_umkm');?>" method="post" enctype='multipart/form-data'>
						<input type="hidden" name="id" value="<?=md5($data_utama->id_umkm);?>">
						<div class="form-body">
						    <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nama Usaha <span class="required"> * </span></label>
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
								<label class="col-md-2 control-label" for="form_control_1">Nama Pemilik <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nama_pemilik" placeholder="Type something" value='<?= $data_utama->nama_pemilik; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Jenis Usaha <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="jenis" placeholder="Type something" value='<?= $data_utama->jenis; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
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
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Alamat </label>
								<div class="col-md-10">
									<div class="input-icon">
										<textarea class="form-control" name="alamat" placeholder="Type something"><?= $data_utama->alamat; ?></textarea>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Foto Pemilik Usaha </label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="file" class="form-control" name="foto" placeholder="Type something" >
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-paperclip"></i>
									</div>
								</div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1"></label>
								<div class="col-md-10">
									<img src='<?= base_url().'data_upload/umkm/'.$data_utama->pemilik; ?>' >
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Foto Produk </label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="file" class="form-control" name="file" placeholder="Type something" >
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-paperclip"></i>
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
        <?php
        if($foto_produk==NULL){
            echo'';
        }else{
        ?>
        <div class="col-md-12">
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Foto Produk
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-right" role="tablist">
                            <?php
                            $no = 1;
                            foreach ($foto_produk as $key => $value) {
                                if($no=='1'){
                                    echo'
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_tab_content" role="tab">
                                            <i class="flaticon2-image-file"></i> Gambar '.$no.'
                                        </a>
                                    </li>
                                    ';
                                }else{
                                    echo'
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_'.$no.'_tab_content" role="tab">
                                            <i class="flaticon2-image-file"></i> Gambar '.$no.'
                                        </a>
                                    </li>
                                    ';
                                }
                                $no++;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <?php
                        $flag = 1;
                        $return_on_click = "return confirm('Anda yakin?')";
                        foreach ($foto_produk as $key => $value) {
                            if($flag=='1'){
                        ?>
                            <div class="tab-pane active" id="kt_portlet_base_demo_1_tab_content" role="tabpanel">
                                <?php
                                echo'<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_gambar_produk_umkm/'.md5($value->id_foto_produk_umkm)).'">
                                <i class="icon-trash"></i> Hapus Gambar </a><br>';
                                ?>
                                <img src='<?= base_url().'data_upload/umkm/'.$value->file; ?>' />
                            </div>
                        <?php
                            }else{
                        ?>
                            <div class="tab-pane" id="kt_portlet_base_demo_<?= $flag; ?>_tab_content" role="tabpanel">
                                <?php
                                echo'<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_gambar_produk_umkm/'.md5($value->id_foto_produk_umkm)).'">
                                <i class="icon-trash"></i> Hapus Gambar </a><br>';
                                ?>
                                <img src='<?= base_url().'data_upload/umkm/'.$value->file; ?>' />
                            </div>
                        <?php
                            }
                            $flag++;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
	</div>
</div>