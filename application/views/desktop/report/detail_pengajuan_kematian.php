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
		<span><a href='<?= site_url('/pengantar_kematian'); ?>'>Surat Pengantar Kematian</a></span>
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
										<td> Umur </td>
										<td> : </td>
										<td>
											<?php
												$birthDate = new DateTime($data_utama->tanggal_lahir);
												$today = new DateTime($data_utama->tanggal_meninggal);
												if ($birthDate > $today) { 
													exit("0 tahun 0 bulan 0 hari");
												}
												$y = $today->diff($birthDate)->y;
												echo $y." tahun";
											?>
										</td>
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
										<td> Jenis Kelamin </td>
										<td> : </td>
										<td><?php echo $data_utama->jenis_kelamin; ?></td>
									</tr>
									<tr>
										<td> Tempat Meninggal </td>
										<td> : </td>
										<td><?php echo $data_utama->tempat_meninggal; ?></td>
									</tr>
									<tr>
										<td> Sebab Meninggal </td>
										<td> : </td>
										<td><?php echo $data_utama->sebab_kematian; ?></td>
									</tr>
									<tr>
										<td> RT/ RW </td>
										<td> : </td>
										<td><?php echo $data_utama->rt.'/ '.$data_utama->rw; ?></td>
									</tr>
									<tr>
										<td> Tanggal Meninggal </td>
										<td> : </td>
										<td><?php echo $this->Main_model->convert_tanggal($data_utama->tanggal_meninggal); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<hr size="3">
						<div class="col-md-6">
							<h4>Pelapor</h4>
							<table class="table">
								<tbody>
									<tr>
										<td> Nama </td>
										<td> : </td>
										<td><?php echo $data_utama->pelapor; ?></td>
									</tr>
									<tr>
										<td> Hubungan </td>
										<td> : </td>
										<td><?php echo $data_utama->hubungan_pelapor; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
                        <div class="col-md-6">
							<h4 style='color:white'>.</h4>
							<table class="table">
								<tbody>
									<tr>
										<td> RT/ RW </td>
										<td> : </td>
										<td><?php echo $data_utama->rt_pelapor.'/ '.$data_utama->rw_pelapor; ?></td>
									</tr>
									<tr>
										<td> Alamat </td>
										<td> : </td>
										<td><?php echo $data_utama->desa_pelapor.', '.$data_utama->kecamatan_pelapor.', '.$data_utama->kabupaten_pelapor; ?></td>
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
						<hr><a href="<?php echo base_url()."pengantar_kematian"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>