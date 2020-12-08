<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
    .mini_width { width: 1px;text-align: center; }
    .action_width { width: 1px; }
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
<?php
$return_on_click = "return confirm('Anda yakin?')";
?>
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
                                        <td> Jenis </td>
                                        <td style='uppercase'><?php echo $data_utama->keterangan; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Kategori </td>
                                        <td><?php echo $data_utama->kategori; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Keterangan </td>
                                        <td><?php echo $data_utama->rincian; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Nominal </td>
                                        <td><?php echo 'Rp '.number_format($data_utama->nominal,2); ?></td>
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
                                                <a href="#tab_15_2" data-toggle="tab"> Sub Output </a>
                                            </li>
                                            <li>
                                                <a href="#tab_15_3" data-toggle="tab"> Output </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_15_2">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Sub Output </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                            <th style="text-align: center;" width="1%"> Aksi </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $get_pagu = $this->Main_model->getSelectedData('sub_output a', 'a.*',array('md5(a.id_apbdes)'=>$this->uri->segment(3)))->result();
                                                        foreach ($get_pagu as $key => $value) {
                                                            echo'
                                                            <tr>
                                                                <td style="text-align: center;"> '.$no++.'. </td>
                                                                <td > '.$value->sub_output.' </td>
                                                                <td style="text-align: center;"> Rp '.number_format($value->nominal,2).' </td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group" style="text-align: center;">
                                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a class="ubahdata1" id="'.md5($value->id_sub_output).'">
                                                                                    <i class="icon-note"></i> Ubah Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_sub_output/'.md5($value->id_sub_output)).'">
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
                                                <!-- <table class="table table-striped table-bordered table-hover" >
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Sub Output </th>
                                                            <th style="text-align: center;"> Output </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                            <th style="text-align: center;" width="1%"> Aksi </th>
                                                        </tr>
                                                    </thead>
                                                    
                                                </table> -->
                                                <table class="table table-striped table-bordered table-hover" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Sub Output </th>
                                                            <th style="text-align: center;"> Output </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                            <th style="text-align: center;" width="1%"> Aksi </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $get_pagu_output = $this->Main_model->getSelectedData('output a', 'a.*,b.sub_output', array('md5(a.id_apbdes)'=>$this->uri->segment(3)), 'a.id_sub_output ASC', '', '', '', array(
                                                            'table' => 'sub_output b',
                                                            'on' => 'a.id_sub_output=b.id_sub_output',
                                                            'pos' => 'LEFT'
                                                        ))->result();
                                                        foreach ($get_pagu_output as $key => $value) {
                                                            echo'
                                                            <tr>
                                                                <td style="text-align: center;"> '.$no++.'. </td>
                                                                <td > '.$value->sub_output.' </td>
                                                                <td > '.$value->output.' </td>
                                                                <td style="text-align: center;"> Rp '.number_format($value->nominal,2).' </td>
                                                                <td >
                                                                    <div class="btn-group" style="text-align: center;">
                                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a class="ubahdata2" id="'.md5($value->id_output).'">
                                                                                    <i class="icon-note"></i> Ubah Data </a>
                                                                            </li>
                                                                            <li>
                                                                                <a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_output/'.md5($value->id_output)).'">
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
                                                <!-- <script type="text/javascript" language="javascript" >
                                                    $(document).ready(function(){
                                                        $('#tbl').dataTable({
                                                            "order": [[ 0, "asc" ]],
                                                            "bProcessing": true,
                                                            "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                                                            "ajax" : {
                                                                url:"<?= site_url('admin/Master/json_output'); ?>",
                                                                data: {id_apbdes:<?php echo "'".$this->uri->segment(3)."'";?>}
                                                            },
                                                            "aoColumns": [
                                                                        { mData: 'number', sClass: "mini_width" },
                                                                        { mData: 'sub_output', sClass: "alignCenter" } ,
                                                                        { mData: 'output', sClass: "alignCenter" } ,
                                                                        { mData: 'nominal', sClass: "alignCenter" },
                                                                        { mData: 'aksi', sClass: "action_width" }
                                                                    ]
                                                        });
                                                    });
                                                </script> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="col-md-12" >
						<hr><a href="<?php echo base_url()."admin_side/detail_apbdesa/".md5($data_utama->tahun); ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
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
                    <form role="form" class="form-horizontal" action="<?=base_url('admin_side/simpan_detail_anggaran');?>" method="post" enctype='multipart/form-data'>
                        <input type="hidden" name="id_apbdesa" value="<?= $data_utama->id_apbdes; ?>">
                        <div class="form-body">
                            <script type="text/javascript">
                            function yesnoCheck() {
                                if (document.getElementById('radio15').checked) {
                                    document.getElementById('pil1').style.display = 'block';
                                    document.getElementById('pil2').style.display = 'none';
                                } else {
                                    document.getElementById('pil1').style.display = 'none';
                                    document.getElementById('pil2').style.display = 'block';
                                }
                            }
                            </script>
                            <div class="form-group form-md-line-input has-danger">
                                <label class="col-md-2 control-label" for="form_control_1"> </label>
                                <div class="col-md-10">
                                    <div class="md-radio-inline">
                                        <div class="md-radio has-error">
                                            <input type="radio" onclick="javascript:yesnoCheck();" id="radio15" name="radio2" class="md-radiobtn" value='sub_output' checked="">
                                            <label for="radio15">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Tambah Data Sub Output </label>
                                        </div>
                                        <div class="md-radio has-warning">
                                            <input type="radio" onclick="javascript:yesnoCheck();" id="radio16" name="radio2" class="md-radiobtn" value='output'>
                                            <label for="radio16">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span> Tambah Data Output </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id='pil1' style="display:block">
                                <div class="form-group form-md-line-input has-danger">
                                    <label class="col-md-2 control-label" for="form_control_1">Sub Output <span class="required"> * </span></label>
                                    <div class="col-md-10">
                                        <div class="input-icon">
                                            <input type="text" class="form-control" name="sub_output" >
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Some help goes here...</span>
                                            <i class="icon-pin"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id='pil2' style="display:none">
                                <div class="form-group form-md-line-input has-danger">
                                    <label class="col-md-2 control-label" for="form_control_1">Sub Output <span class="required"> * </span></label>
                                    <div class="col-md-10">
                                        <div class="input-icon">
                                            <select class='form-control' name='id_sub_output' >
                                                <option value=''>-- Pilih --</option>
                                                <?php
                                                foreach ($sub_output as $key => $value) {
                                                    echo"<option value='".$value->id_sub_output."'>".$value->sub_output."</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Some help goes here...</span>
                                            <i class="icon-pin"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input has-danger">
                                    <label class="col-md-2 control-label" for="form_control_1">Output <span class="required"> * </span></label>
                                    <div class="col-md-10">
                                        <div class="input-icon">
                                            <input type="text" class="form-control" name="output" >
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
                                            <input type="number" class="form-control" name="nominal" >
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">Some help goes here...</span>
                                            <i class="icon-pin"></i>
                                        </div>
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
		$('a.ubahdata1').click(function(e){
            var id = $(this).attr("id");
            var modul = 'modul_ubah_data_sub_output';
            $.ajax({
                data: {id:id,modul:modul},
                success:function(data){
                    $('#ubahdata').modal("show");
                    $('#formubahdata').html(data);
                }
            });
            e.preventDefault();
        });
        $('a.ubahdata2').click(function(e){
            var id = $(this).attr("id");
            var modul = 'modul_ubah_data_output';
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