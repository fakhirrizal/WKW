<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<!-- <li>
		<span>Data Antrean</span>
		<i class="fa fa-circle"></i>
	</li> -->
	<li>
		<span>Data Berita</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<!-- <p> 1. Ketika mengklik <b>Atur Ulang Sandi</b>, maka kata sandi otomatis menjadi "<b>1234</b>"</p> -->
		<!-- <p> 2. Data ekspor berupa file excel (<b>.xls</b>)</p> -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light ">
				<div class="portlet-body">
					<!-- <div class="form-group select2-bootstrap-prepend" >
						<label class="control-label col-md-2">Opsi pencarian berdasarkan <b>Status</b></label>
						<div class="col-md-5">
							<select id='pilihan' class="form-control select2-allow-clear">
								<option value=""></option>
								<option value="2">Pendaftaran</option>
								<option value="0">Sedang Berlangsung</option>
								<option value="19">Tutup</option>
							</select>
						</div>
					</div>
					<br>
					<hr> -->
					<form action="#" method="post" onsubmit="return deleteConfirm();"/>
					<div class="table-toolbar">
						<div class="row">
							<div class="col-md-8">
								<div class="btn-group">
									<!-- <button type='submit' id="sample_editable_1_new" class="btn sbold red"> Hapus
										<i class="fa fa-trash"></i>
									</button> -->
								</div>
									<!-- <span class="separator">|</span> -->
									<a href="<?=base_url('admin_side/tambah_berita');?>" class="btn green uppercase">Tambah Data <i class="fa fa-plus"></i> </a>
							</div>
							<!-- <div class="col-md-4" style='text-align: right;'>
								<a href="<?=base_url('admin/Master/download_admin_data');?>" class="btn btn-default">Ekspor Data <i class="fa fa-cloud-download"></i></a>
							</div> -->
						</div>
					</div>
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
						<thead>
							<tr>
								<th style="text-align: center;" width="1%"> # </th>
								<th style="text-align: center;"> Judul Berita </th>
								<!-- <th style="text-align: center;"> Isi Berita </th> -->
								<th style="text-align: center;" width="1%"> Aksi </th>
							</tr>
						</thead>
					</table>
					</form>
					<script type="text/javascript" language="javascript" >
						$(document).ready(function(){
							$('#tbl').dataTable({
								"order": [[ 0, "asc" ]],
								"bProcessing": true,
								"ajax" : {
									url:"<?= site_url('admin/Master/json_berita'); ?>"
								},
								"aoColumns": [
											{ mData: 'no', sClass: "alignCenter" },
											{ mData: 'judul' } ,
											{ mData: 'action' }
										]
							});

						});
					</script>
					<script type="text/javascript">
					function deleteConfirm(){
						var result = confirm("Yakin akan menghapus data ini?");
						if(result){
							return true;
						}else{
							return false;
						}
					}
					</script>
				</div>
			</div>
		</div>
	</div>
</div>