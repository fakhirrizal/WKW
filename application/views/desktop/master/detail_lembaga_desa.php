<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Tentang Desa</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Lembaga Desa</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Detail Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<?php
$return_on_click = "return confirm('Anda yakin?')";
?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<p> 1. Ketentuan file yang diupload:</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Format berupa file <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b>, <b>.bmp</b></p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ukuran maksimum file <b>3 MB</b></p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<div class='row'>
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width='17%'> Nama Lembaga </td>
                                        <td><?php echo $data_utama->nama; ?></td>
                                    </tr>
                                    <tr>
                                        <td width='17%'> Keterangan </td>
                                        <td><?php if($data_utama->keterangan=='' OR $data_utama->keterangan==NULL){echo'-';}else{echo $data_utama->keterangan;}?>&nbsp;&nbsp;&nbsp;<a data-toggle="modal" data-target="#edit"><i class="icon-note"></a></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
					</div>
					<div class='row'>
						<div class="col-md-12" >
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-users font-red-sunglo"></i>
                                        <span class="caption-subject font-red-sunglo bold">Daftar Anggota</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <a class="btn btn-success" data-toggle="modal" data-target="#tambahdata">Tambah Anggota</a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;" width="1%"> # </th>
                                                <th style="text-align: center;"> Nama </th>
                                                <th style="text-align: center;"> Jabatan </th>
                                                <th style="text-align: center;"> Foto </th>
                                                <th style="text-align: center;" width="1%"> Aksi </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $getdata = $this->Main_model->getSelectedData('anggota_lembaga_desa a', 'a.*',array('md5(a.id_lembaga_desa)'=>$this->uri->segment(3)))->result();
                                            foreach ($getdata as $key => $value) {
                                                $foto = '';
                                                if($value->foto=='' OR $value->foto==NULL){
                                                    $foto = '';
                                                }else{
                                                    $foto = '<img src="'.base_url().'data_upload/anggota_lembaga_desa/'.$value->foto.'" width="100px" height="150px"/>';
                                                }
                                                echo'
                                                <tr>
                                                    <td style="text-align: center;"> '.$no++.'. </td>
                                                    <td style="text-align: left;"> '.$value->nama.' </td>
                                                    <td style="text-align: center;"> '.$value->jabatan.' </td>
                                                    <td style="text-align: center;"> '.$foto.' </td>
                                                    <td style="text-align: center;">
                                                        <div class="btn-group" style="text-align: center;">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a class="ubahdata" id="'.md5($value->id_anggota_lembaga_desa).'">
                                                                        <i class="icon-note"></i> Ubah Data </a>
                                                                </li>
                                                                <li>
                                                                    <a onclick="'.$return_on_click.'" href="'.site_url('hapus_data_anggota_lembaga_desa/'.md5($value->id_anggota_lembaga_desa)).'">
                                                                        <i class="icon-trash"></i> Hapus Data </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
						</div>
						<div class="col-md-12" >
						<hr><a href="<?php echo base_url()."lembaga_desa"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ubahdata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Form Ubah Data</h4>
			</div>
			<div class="modal-body">
				<div class="box box-primary" id='formubahdata' >
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Form Tambah Data</h4>
			</div>
			<div class="modal-body">
				<div class="box box-primary" >
                    <form role="form" class="form-horizontal" action="<?=base_url('simpan_data_anggota_lembaga_desa');?>" method="post" enctype='multipart/form-data'>
                        <input type="hidden" name="id_" value='<?= $data_utama->id_lembaga_desa; ?>'>
                        <div class="form-body">
                            <div class="form-group form-md-line-input has-danger">
                                <label class="col-md-2 control-label" for="form_control_1">Nama <span class="required"> * </span></label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" name="nama" required>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Some help goes here...</span>
                                        <i class="icon-pin"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
                                <label class="col-md-2 control-label" for="form_control_1">Jabatan <span class="required"> * </span></label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" name="jabatan" required>
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
                                        <input type="file" class="form-control" name="file" >
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
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Form Ubah Data</h4>
			</div>
			<div class="modal-body">
				<div class="box box-primary" >
                    <form role="form" class="form-horizontal" action="<?=base_url('perbarui_data_lembaga_desa');?>" method="post" enctype='multipart/form-data'>
                        <input type="hidden" name="id_" value='<?= $data_utama->id_lembaga_desa; ?>'>
                        <div class="form-body">
                            <div class="form-group form-md-line-input has-danger">
                                <label class="col-md-2 control-label" for="form_control_1">Nama Lembaga </label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" name="nama" value='<?= $data_utama->nama; ?>' readonly>
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
                                        <input type="text" class="form-control" name="ket" value='<?= $data_utama->keterangan; ?>'>
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
<script>
	$(document).ready(function(){
		$.ajaxSetup({
			type:"POST",
			url: "<?php echo site_url(); ?>Master/ajax_function",
			cache: false,
		});
		$('a.ubahdata').click(function(e){
		var id = $(this).attr("id");
		var modul = 'modul_ubah_data_anggota_lembaga_desa';
		$.ajax({
			data: {id:id,modul:modul},
			success:function(data){
                $('#ubahdata').modal("show");
                $('#formubahdata').html(data);
			}
		});
        e.preventDefault();
		});
	});
</script>