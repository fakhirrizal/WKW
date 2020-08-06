<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Pengajuan KK</span>
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
								<!-- <a href="<?=base_url('admin_side/tambah_data_kk');?>" class="btn green uppercase">Tambah Data <i class="fa fa-plus"></i> </a> -->
							</div>
						</div>
					</div>
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
						<thead>
							<tr>
								<th style="text-align: center;" width="4%"> # </th>
								<th style="text-align: center;"> Pemohon </th>
								<th style="text-align: center;"> Jenis Permohonan </th>
								<th style="text-align: center;"> Status </th>
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
									url:"<?= site_url('admin/Report/json_kk'); ?>"
								},
								"aoColumns": [
											{ mData: 'no', sClass: "alignCenter" },
											{ mData: 'nama', sClass: "alignCenter" },
											{ mData: 'keterangan', sClass: "alignCenter" },
											{ mData: 'status', sClass: "alignCenter" },
											{ mData: 'pengajuan', sClass: "alignCenter" }
											,{ mData: 'action' }
										]
							});

						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>