<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span><a href='<?= site_url('/admin_side/permohonan_informasi'); ?>'>Permohonan Informasi</a></span>
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
										<td> Alamat </td>
										<td> : </td>
										<td><?php echo $data_utama->kategori; ?></td>
									</tr>
									<tr>
										<td> Tempat Lahir </td>
										<td> : </td>
										<td><?php echo $data_utama->alamat; ?></td>
                                    </tr>
                                    <tr>
										<td> Nomor HP </td>
										<td> : </td>
										<td><?php echo $data_utama->no_hp; ?></td>
                                    </tr>
                                    <tr>
										<td> Email </td>
										<td> : </td>
										<td><?php echo $data_utama->email; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
                        <div class="col-md-6">
							<table class="table">
								<tbody>
									<tr>
										<td> Rincian Informasi Yang Dibutuhkan </td>
										<td> : </td>
										<td><?php echo $data_utama->rincian_informasi_yang_dibutuhkan; ?></td>
									</tr>
									<tr>
										<td> Tujuan </td>
										<td> : </td>
										<td><?php echo $data_utama->tujuan; ?></td>
									</tr>
									<tr>
										<td> Cara Memperoleh </td>
										<td> : </td>
										<td><?php echo $data_utama->cara_memperoleh; ?></td>
                                    </tr>
                                    <tr>
										<td> Cara Mendapatkan </td>
										<td> : </td>
										<td><?php echo $data_utama->cara_mendapatkan; ?></td>
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
										<td> File KTP </td>
										<td colspan='2'> <iframe src='<?= $data_utama->file_ktp; ?>' width='100%' height='1000px'></iframe> </td>
									</tr>
								</tbody>
							</table>
                        </div>
                        <?php
                        if($data_utama->file_badan_hukum=='' OR $data_utama->file_badan_hukum==NULL){
                            echo'';
                        }else{
                            ?>
                            <div class="col-md-12">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td> File KTP </td>
                                            <td colspan='2'> <iframe src='<?= $data_utama->file_badan_hukum; ?>' width='100%' height='1000px'></iframe> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        ?>
						<div class="col-md-12" >
						<hr><a href="<?php echo base_url()."admin_side/permohonan_informasi"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>