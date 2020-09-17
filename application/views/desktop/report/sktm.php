<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Laporan</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Pengajuan SKTM</span>
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
								<!-- <a href="<?=base_url('admin_side/tambah_data_ktp');?>" class="btn green uppercase">Tambah Data <i class="fa fa-plus"></i> </a> -->
							</div>
						</div>
					</div>
					<div class="tabbable-line">
						<ul class="nav nav-tabs ">
							<li class="active">
								<a href="#tab_15_1" data-toggle="tab" aria-expanded="true"> Untuk Umum </a>
							</li>
							<li class="">
								<a href="#tab_15_2" data-toggle="tab" aria-expanded="false"> Untuk Pelajar </a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_15_1">
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl_all">
									<thead>
										<tr>
											<th style="text-align: center;" width="4%"> # </th>
											<th style="text-align: center;"> NIK </th>
											<th style="text-align: center;"> Nama </th>
											<th style="text-align: center;"> TTL </th>
											<th style="text-align: center;"> Waktu Pengajuan </th>
											<th style="text-align: center;" width="7%"> Aksi </th>
										</tr>
									</thead>
								</table>
								<script type="text/javascript" language="javascript" >
									$(document).ready(function(){
										$('#tbl_all').dataTable({
											"order": [[ 0, "asc" ]],
											"bProcessing": true,
											"ajax" : {
												url:"<?= site_url('admin/Report/json_sktm_umum'); ?>"
											},
											"aoColumns": [
														{ mData: 'no', sClass: "alignCenter" },
														{ mData: 'nik', sClass: "alignCenter" } ,
														{ mData: 'nama' },
														{ mData: 'ttl', sClass: "alignCenter" },
														{ mData: 'waktu', sClass: "alignCenter" },
														{ mData: 'action', sClass: "alignCenter" }
													]
										});

									});
								</script>
							</div>
							<div class="tab-pane" id="tab_15_2">
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
									<thead>
										<tr>
											<th style="text-align: center;" width="4%"> # </th>
											<th style="text-align: center;"> NIK </th>
											<th style="text-align: center;"> Nama </th>
											<th style="text-align: center;"> TTL </th>
											<th style="text-align: center;"> Waktu Pengajuan </th>
											<th style="text-align: center;" width="7%"> Aksi </th>
										</tr>
									</thead>
								</table>
								<script type="text/javascript" language="javascript" >
									$(document).ready(function(){
										$('#tbl').dataTable({
											"order": [[ 0, "asc" ]],
											"bProcessing": true,
											"ajax" : {
												url:"<?= site_url('admin/Report/json_sktm_pelajar'); ?>"
											},
											"aoColumns": [
														{ mData: 'no', sClass: "alignCenter" },
														{ mData: 'nik', sClass: "alignCenter" } ,
														{ mData: 'nama' },
														{ mData: 'ttl', sClass: "alignCenter" },
														{ mData: 'waktu', sClass: "alignCenter" },
														{ mData: 'action', sClass: "alignCenter" }
													]
										});
									});
								</script>
							</div>
						</div>
					</div>
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
				<h4 class="modal-title" id="myModalLabel">Form Ubah Data</h4>
			</div>
			<div class="modal-body">
				<div class="box box-primary" id='formdetaildata' >
				</div>
			</div>
		</div>
	</div>
</div>