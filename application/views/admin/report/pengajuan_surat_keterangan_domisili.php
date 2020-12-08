<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Laporan</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Pengajuan Surat Keterangan Domisili</span>
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
							</div>
						</div>
					</div>
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
						<thead>
							<tr>
								<th style="text-align: center;" width="4%"> # </th>
								<th style="text-align: center;"> Nomor Surat </th>
								<th style="text-align: center;"> Nama </th>
								<th style="text-align: center;"> TTL </th>
								<th style="text-align: center;"> Alamat </th>
								<th style="text-align: center;"> RT/ RW </th>
								<th style="text-align: center;"> Waktu </th>
                                <th style="text-align: center;" width="1%"> Aksi </th>
							</tr>
						</thead>
					</table>
					<script type="text/javascript" language="javascript" >
						$(document).ready(function(){
							$('#tbl').dataTable({
								"order": [[ 0, "asc" ]],
								"bProcessing": true,
								"ajax" : {
									url:"<?= site_url('admin/Report/json_domisili'); ?>"
								},
								"aoColumns": [
											{ mData: 'no', sClass: "alignCenter" },
											{ mData: 'nomor_surat', sClass: "alignCenter" },
											{ mData: 'nama', sClass: "alignCenter" } ,
											{ mData: 'ttl', sClass: "alignCenter" },
											{ mData: 'alamat', sClass: "alignCenter" },
											{ mData: 'rtrw', sClass: "alignCenter" },
											{ mData: 'waktu', sClass: "alignCenter" },
											{ mData: 'aksi' }
										]
							});
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>