<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Tentang Desa</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Data Lembaga Desa</span>
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
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
						<thead>
							<tr>
								<th style="text-align: center;" width="1%"> # </th>
								<th style="text-align: center;"> Nama Lembaga </th>
								<th style="text-align: center;"> Jumlah Anggota </th>
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
									url:"<?= site_url('desktop/Master/json_lembaga_desa'); ?>"
								},
								"aoColumns": [
											{ mData: 'no', sClass: "alignCenter" },
											{ mData: 'judul', sClass: "alignCenter" } ,
											{ mData: 'isi', sClass: "alignCenter" },
											{ mData: 'action' }
										]
							});

						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>