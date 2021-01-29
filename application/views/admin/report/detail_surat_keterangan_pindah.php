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
		<span><a href='<?= site_url('/admin_side/surat_keterangan_pindah'); ?>'>Pengajuan Surat Keterangan Pindah</a></span>
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
					<a href="<?php echo base_url()."admin_side/ubah_surat_keterangan_pindah/".md5($data_utama->id_surat_keterangan_pindah); ?>" class="btn btn-success" role="button"><i class="icon-pencil"></i> Ubah Data</a><br><br>
					<div class='row'>
						<?php
						$pisah_tanggal_lahir = explode(';',$data_utama->tanggal_lahir);
						$pisah_nama = explode(';',$data_utama->nama);
						$pisah_nik = explode(';',$data_utama->nik);
						$pisah_pendidikan = explode(';',$data_utama->pendidikan);
						$pisah_jenis_kelamin = explode(';',$data_utama->jenis_kelamin);
						$pisah_status_perkawinan = explode(';',$data_utama->status_perkawinan);
						?>
						<div class="col-md-6">
							<table class="table">
								<tbody>
									<tr>
										<td> Nama </td>
										<td> : </td>
										<td><?php echo $pisah_nama[0]; ?></td>
									</tr>
                                    
									<tr>
										<td> NIK </td>
										<td> : </td>
										<td><?php echo $pisah_nik[0]; ?></td>
									</tr>
                                    
									<tr>
										<td> Pendidikan </td>
										<td> : </td>
										<td><?php echo $pisah_pendidikan[0]; ?></td>
									</tr>
                                    <tr>
										<td> Tempat Lahir </td>
										<td> : </td>
										<td><?php echo $data_utama->tempat_lahir; ?></td>
									</tr>
									<tr>
										<td> Tanggal Lahir </td>
										<td> : </td>
										<td><?php echo $this->Main_model->convert_tanggal($pisah_tanggal_lahir[0]); ?></td>
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
										<td> Jenis Kelamin </td>
										<td> : </td>
										<td><?php echo $pisah_jenis_kelamin[0]; ?></td>
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
										<td> Status Perkawinan </td>
										<td> : </td>
										<td><?php echo $pisah_status_perkawinan[0]; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
                        <div class="col-md-6">
							<table class="table">
								<thead>
                                    <tr>
										<th colspan="3">Pindah Ke</th>
									</tr>
                                </thead>
								<tbody>
									<tr>
										<td> Desa </td>
										<td> : </td>
										<td><?php echo $data_utama->desa_pindah; ?></td>
									</tr>
									<tr>
										<td> Kecamatan </td>
										<td> : </td>
										<td><?php echo $data_utama->kecamatan_pindah; ?></td>
									</tr>
                                    
									<tr>
										<td> Kab./Kota </td>
										<td> : </td>
										<td><?php echo $data_utama->kabkota_pindah; ?></td>
									</tr>
                                    <tr>
										<td> Provinsi </td>
										<td> : </td>
										<td><?php echo $data_utama->provinsi_pindah; ?></td>
									</tr>
									<tr>
										<td> Pada Tanggal </td>
										<td> : </td>
										<td><?php echo $this->Main_model->convert_tanggal($data_utama->tanggal_pindah); ?></td>
									</tr>
                                    <tr>
										<td> Alasan Pindah </td>
										<td> : </td>
										<td><?php echo $data_utama->alasan_pindah; ?></td>
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
						<hr><a href="<?php echo base_url()."admin_side/surat_keterangan_pindah"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>