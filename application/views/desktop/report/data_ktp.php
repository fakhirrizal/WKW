<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Laporan</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Pengajuan Cetak KTP</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Rekap Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<div class="table-toolbar">
						<div class="row">
							<div class="col-md-8">
								<a href="<?=base_url('tambah_permohonan_ktp');?>" class="btn green uppercase">Tambah Data <i class="fa fa-plus"></i> </a>
							</div>
						</div>
					</div>
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
						<thead>
							<tr>
								<th style="text-align: center;" width="4%"> # </th>
								<th style="text-align: center;"> Nama </th>
								<th style="text-align: center;"> Jenis Permohonan </th>
								<th style="text-align: center;"> NIK </th>
								<th style="text-align: center;"> RT/ RW </th>
								<th style="text-align: center;"> File </th>
								<th style="text-align: center;"> Waktu </th>
							</tr>
						</thead>
					</table>
					<script type="text/javascript" language="javascript" >
						$(document).ready(function(){
							$('#tbl').dataTable({
								"order": [[ 0, "asc" ]],
								"bProcessing": true,
								"ajax" : {
									url:"<?= site_url('desktop/Report/json_ktp'); ?>"
								},
								"aoColumns": [
											{ mData: 'no', sClass: "alignCenter" },
											{ mData: 'nama', sClass: "alignCenter" } ,
											{ mData: 'jenis', sClass: "alignCenter" },
											{ mData: 'nik', sClass: "alignCenter" },
											{ mData: 'rtrw', sClass: "alignCenter" },
											{ mData: 'file', sClass: "alignCenter" },
											{ mData: 'waktu', sClass: "alignCenter" }
										],
								"drawCallback": function(data) {
									$('.detaildata').click(function(){
									var id = $(this).attr("id");
									var modul = 'modul_file_permohonan_ktp';
									var nilai_token = '<?php echo $this->security->get_csrf_hash();?>';
									$.ajax({
										type:"POST",
										url: "<?php echo site_url(); ?>admin/Report/ajax_function",
										cache: false,
										data: {id:id,modul:modul,<?php echo $this->security->get_csrf_token_name();?>:nilai_token},
										success:function(data){
										$('#formdetaildata').html(data);
										$('#detaildata').modal("show");
										}
									});
									});
								}
							});

						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="detaildata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Form Detail Data</h4>
			</div>
			<div class="modal-body">
				<div class="box box-primary" id='formdetaildata' >
				</div>
			</div>
		</div>
	</div>
</div>