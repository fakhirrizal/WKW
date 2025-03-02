<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Surat Pengantar Kematian</span>
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
								<a href="<?=base_url('tambah_pengantar_kematian');?>" class="btn green uppercase">Tambah Data <i class="fa fa-plus"></i> </a>
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
								<th style="text-align: center;"> RT/ RW </th>
								<th style="text-align: center;"> Waktu Meninggal </th>
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
									url:"<?= site_url('desktop/Report/json_kematian'); ?>"
								},
								"aoColumns": [
											{ mData: 'no', sClass: "alignCenter" },
											{ mData: 'nomor_surat', sClass: "alignCenter" },
											{ mData: 'nama', sClass: "alignCenter" } ,
											{ mData: 'ttl', sClass: "alignCenter" },
											{ mData: 'rtrw', sClass: "alignCenter" },
											{ mData: 'waktu', sClass: "alignCenter" },
											{ mData: 'aksi', sClass: "alignCenter" }
										]
							});
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>