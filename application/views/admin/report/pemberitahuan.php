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
		<span>Pemberitahuan</span>
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
								<div class="btn-group">
                                </div>
                                <?php
                                echo'<a href="'.base_url('admin_side/tambah_pemberitahuan').'" class="btn green uppercase">Tambah Data <i class="fa fa-plus"></i> </a>';
                                ?>
							</div>
						</div>
					</div>
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
						<thead>
							<tr>
								<th style="text-align: center;" width="1%"> # </th>
								<th style="text-align: center;"> Judul </th>
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
									url:"<?= site_url('admin/Report/json_pemberitahuan'); ?>"
								},
								"aoColumns": [
											{ mData: 'no', sClass: "alignCenter" },
											{ mData: 'judul' } ,
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