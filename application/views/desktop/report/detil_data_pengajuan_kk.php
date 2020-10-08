<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Laporan</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span><a href='<?= site_url('/permohonan_kk'); ?>'>Pengajuan KK</a></span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Detil Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-green m-bordered">
		<h3>Catatan</h3>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<a href="<?php echo base_url()."ubah_pengajuan_kk/".md5($data_utama->id_data_kk); ?>" class="btn btn-success" role="button"><i class="icon-pencil"></i> Ubah Data</a><br><br>
					<div class='row'>
						<div class="col-md-6">
							<table class="table">
								<tbody>
									<tr>
										<td> Nama </td>
										<td> : </td>
										<td><?php echo $data_utama->nama; ?></td>
									</tr>
                                    <tr>
										<td> Nomor KK </td>
										<td> : </td>
										<td><?php echo $data_utama->kk; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
                        <div class="col-md-6">
							<table class="table">
								<tbody>
									<tr>
										<td> Alamat </td>
										<td> : </td>
										<td><?php echo $data_utama->alamat; ?></td>
									</tr>
									<tr>
										<td> Dusun/ Dukuh/ Kampung </td>
										<td> : </td>
										<td><?php echo $data_utama->dusun; ?></td>
									</tr>
									<tr>
										<td> RT/ RW </td>
										<td> : </td>
										<td><?php echo $data_utama->rt.'/ '.$data_utama->rw; ?></td>
									</tr>
									<tr>
										<td> Tanggal Pengajuan </td>
										<td> : </td>
										<td><?php echo $this->Main_model->convert_datetime($data_utama->created_at); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
                        <div class="col-md-12">
							<table class="table">
								<tbody>
									<tr>
										<td> File </td>
										<td colspan='2'> <iframe src='<?= $data_utama->file; ?>' width='100%' height='1000px'></iframe> </td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-12" >
						<hr><a href="<?php echo base_url()."permohonan_kk"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>