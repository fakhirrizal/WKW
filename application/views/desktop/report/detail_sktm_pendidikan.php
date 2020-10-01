<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Laporan</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span><a href='<?= site_url('/sktm'); ?>'>Pengajuan SKTM</a></span>
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
					<a href="<?php echo base_url()."ubah_pengajuan_sktm_pendidikan/".md5($data_utama->id_sktm_pendidikan); ?>" class="btn btn-success" role="button"><i class="icon-pencil"></i> Ubah Data</a><br><br>
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
										<td> NIK </td>
										<td> : </td>
										<td><?php echo $data_utama->nik; ?></td>
									</tr>
                                    <tr>
										<td> Kebangsaan </td>
										<td> : </td>
										<td><?php echo $data_utama->kebangsaan; ?></td>
									</tr>
                                    <tr>
										<td> Tempat Lahir </td>
										<td> : </td>
										<td><?php echo $data_utama->tempat_lahir; ?></td>
									</tr>
									<tr>
										<td> Tanggal Lahir </td>
										<td> : </td>
										<td><?php echo $this->Main_model->convert_tanggal($data_utama->tanggal_lahir); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
                        <div class="col-md-6">
							<table class="table">
								<tbody>
									<tr>
										<td> Pekerjaan </td>
										<td> : </td>
										<td><?php echo $data_utama->pekerjaan; ?></td>
									</tr>
									<tr>
										<td> Agama </td>
										<td> : </td>
										<td><?php echo $data_utama->agama; ?></td>
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
                                    <tr>
										<td> Nama Ayah </td>
										<td> : </td>
										<td><?php echo $data_utama->nama_ayah; ?></td>
									</tr>
                                    <tr>
										<td> Nama Ibu </td>
										<td> : </td>
										<td><?php echo $data_utama->nama_ibu; ?></td>
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
						<hr><a href="<?php echo base_url()."sktm"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>