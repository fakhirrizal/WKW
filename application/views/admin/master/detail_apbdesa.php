<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Tentang Desa</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>APBDESA</span>
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
                                        <span class="caption-subject font-red-sunglo bold">Rincian Anggaran</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <a class="btn btn-success" data-toggle="modal" data-target="#tambahdata">Tambah Rincian Data</a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tabbable-line">
                                        <ul class="nav nav-tabs ">
                                            <li class="active">
                                                <a href="#tab_15_1" data-toggle="tab"> Pagu </a>
                                            </li>
                                            <li>
                                                <a href="#tab_15_2" data-toggle="tab"> Pemasukan </a>
                                            </li>
                                            <li>
                                                <a href="#tab_15_3" data-toggle="tab"> Pengeluaran </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_15_1">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Kategori </th>
                                                            <th style="text-align: center;"> Keterangan </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                            <th style="text-align: center;" width="1%"> Aksi </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $get_pagu = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.tahun)'=>$this->uri->segment(3),'a.keterangan'=>'pagu'))->result();
                                                        foreach ($get_pagu as $key => $value) {
                                                            echo'
                                                            <tr>
                                                                <td style="text-align: center;"> '.$no++.'. </td>
                                                                <td style="text-align: center;"> '.$value->kategori.' </td>
                                                                <td > '.$value->rincian.' </td>
                                                                <td style="text-align: center;"> Rp '.number_format($value->nominal,2).' </td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group" style="text-align: center;">
                                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a class="ubahdata" id="'.md5($value->id_apbdes).'">
                                                                                    <i class="icon-note"></i> Ubah Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="'.site_url('admin_side/hapus_item_apbdesa/'.md5($value->id_apbdes)).'">
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
                                            <div class="tab-pane" id="tab_15_2">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Kategori </th>
                                                            <th style="text-align: center;"> Keterangan </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                            <th style="text-align: center;" width="1%"> Aksi </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $get_pagu = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.tahun)'=>$this->uri->segment(3),'a.keterangan'=>'pemasukan'))->result();
                                                        foreach ($get_pagu as $key => $value) {
                                                            echo'
                                                            <tr>
                                                                <td style="text-align: center;"> '.$no++.'. </td>
                                                                <td style="text-align: center;"> '.$value->kategori.' </td>
                                                                <td > '.$value->rincian.' </td>
                                                                <td style="text-align: center;"> Rp '.number_format($value->nominal,2).' </td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group" style="text-align: center;">
                                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a class="ubahdata" id="'.md5($value->id_apbdes).'">
                                                                                    <i class="icon-note"></i> Ubah Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="'.site_url('admin_side/hapus_item_apbdesa/'.md5($value->id_apbdes)).'">
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
                                            <div class="tab-pane" id="tab_15_3">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Kategori </th>
                                                            <th style="text-align: center;"> Keterangan </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                            <th style="text-align: center;" width="1%"> Aksi </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $get_pagu = $this->Main_model->getSelectedData('apbdes a', 'a.*',array('md5(a.tahun)'=>$this->uri->segment(3),'a.keterangan'=>'pengeluaran'))->result();
                                                        foreach ($get_pagu as $key => $value) {
                                                            echo'
                                                            <tr>
                                                                <td style="text-align: center;"> '.$no++.'. </td>
                                                                <td style="text-align: center;"> '.$value->kategori.' </td>
                                                                <td > '.$value->rincian.' </td>
                                                                <td style="text-align: center;"> Rp '.number_format($value->nominal,2).' </td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group" style="text-align: center;">
                                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a class="ubahdata" id="'.md5($value->id_apbdes).'">
                                                                                    <i class="icon-note"></i> Ubah Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="'.site_url('admin_side/hapus_item_apbdesa/'.md5($value->id_apbdes)).'">
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
                                </div>
                            </div>
						</div>
						<div class="col-md-12" >
						<hr><a href="<?php echo base_url()."admin_side/apbdesa"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
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
                    <form role="form" class="form-horizontal" action="<?=base_url('admin_side/simpan_data_rincian_apbdesa');?>" method="post" enctype='multipart/form-data'>
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
                                <label class="col-md-2 control-label" for="form_control_1">Jenis <span class="required"> * </span></label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <select class='form-control' name='keterangan' required>
                                            <option value=''>-- Pilih --</option>
                                            <option value='pagu' > Pagu </option>
                                            <option value='pendapatan' > Pendapatan </option>
                                            <option value='pengeluaran' > Pengeluaran </option>
                                        </select>
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
                                        <input type="text" class="form-control" name="kategori" required>
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
                                        <input type="text" class="form-control" name="rincian" >
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">Some help goes here...</span>
                                        <i class="icon-pin"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
                                <label class="col-md-2 control-label" for="form_control_1">Nominal <span class="required"> * </span></label>
                                <div class="col-md-10">
                                    <div class="input-icon">
                                        <input type="number" class="form-control" name="nominal" required>
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
			url: "<?php echo site_url(); ?>admin/Master/ajax_function",
			cache: false,
		});
		$('a.ubahdata').click(function(e){
		var id = $(this).attr("id");
		var modul = 'modul_ubah_data_rincian_apbdesa';
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