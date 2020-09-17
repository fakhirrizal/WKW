<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Tentang Desa</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Kependudukan</span>
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
		<!-- <p> 1. Soal yang sudah terjawab berwarna biru.</p>
		<p> 2. Jika merasa telah selesai silahkan klik tombol <b>Selesai Ujian</b>.</p> -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<div class='row'>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td> Tahun Anggaran </td>
                                        <td><?php echo $data_utama->tahun; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Monografi Kependudukan </td>
                                        <td><?php echo $data_utama->kategori; ?></td>
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
                                        <i class="icon-share font-red-sunglo"></i>
                                        <span class="caption-subject font-red-sunglo bold">Rincian Data</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <a class="btn btn-success" data-toggle="modal" data-target="#tambahdata">Tambah Rincian Data</a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;" width="1%"> # </th>
                                                <th style="text-align: center;"> Keterangan </th>
                                                <th style="text-align: center;"> Jumlah </th>
                                                <th style="text-align: center;" width="1%"> Aksi </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $return_on_click = "return confirm('Anda yakin?')";
                                            foreach ($data_detail as $key => $value) {
                                                echo'
                                                <tr>
                                                    <td style="text-align: center;"> '.$no++.'. </td>
                                                    <td > '.$value->keterangan.' </td>
                                                    <td style="text-align: center;"> '.number_format($value->jumlah,0).' </td>
                                                    <td style="text-align: center;">
                                                        <div class="btn-group" style="text-align: center;">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a class="ubahdata" id="'.md5($value->id).'">
                                                                        <i class="icon-note"></i> Ubah Data </a>
                                                                </li>
                                                                <li>
                                                                    <a onclick="'.$return_on_click.'" href="'.site_url('hapus_item_data_kependudukan/'.md5($value->id)).'">
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
						<hr><a href="<?php echo base_url()."data_kependudukan"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
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
                    <form role="form" class="form-horizontal" action="<?=base_url('simpan_data_rincian_kependudukan');?>" method="post" enctype='multipart/form-data'>
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
                                <label class="col-md-2 control-label" for="form_control_1">Monografi Kependudukan </label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" name="kategori" value='<?= $data_utama->kategori; ?>' readonly>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Some help goes here...</span>
                                        <i class="icon-pin"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
                                <label class="col-md-2 control-label" for="form_control_1">Keterangan <span class="required"> * </span></label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" name="keterangan" required>
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Some help goes here...</span>
                                        <i class="icon-pin"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
                                <label class="col-md-2 control-label" for="form_control_1">Jumlah <span class="required"> * </span></label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <input type="number" class="form-control" name="jumlah" required>
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
<script>
	$(document).ready(function(){
		$.ajaxSetup({
			type:"POST",
			url: "<?php echo site_url(); ?>Master/ajax_function",
			cache: false,
		});
		$('a.ubahdata').click(function(e){
		var id = $(this).attr("id");
		var modul = 'modul_ubah_rincian_data_kependudukan';
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