<?php
if(($this->session->userdata('id'))==NULL){
	echo "<script>alert('Harap login terlebih dahulu')</script>";
	echo "<script>window.location='".base_url('Auth/logout')."'</script>";
}else{
	if($this->session->userdata('role_id')=='0' OR $this->session->userdata('role_id')=='1'){
		echo'';
	}else{
		echo "<script>alert('Harap login terlebih dahulu')</script>";
		echo "<script>window.location='".base_url('Auth/logout')."'</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Warta Kalipucang Wetan</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<meta content="Warta Kalipucang Wetan" name="description" />
		<meta content="Warta Kalipucang Wetan" name="author" />

		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');?>" rel="stylesheet" type="text/css" />

		<link href="<?=base_url('assets_dashboard/global/plugins/datatables/datatables.min.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/plugins/select2/css/select2.min.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/plugins/select2/css/select2-bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/plugins/cubeportfolio/css/cubeportfolio.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/plugins/ladda/ladda-themeless.min.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/css/components-md.min.css');?>" rel="stylesheet" id="style_components" type="text/css" />
		<link href="<?=base_url('assets_dashboard/global/css/plugins-md.min.css');?>" rel="stylesheet" type="text/css" />

		<link href="<?=base_url('assets_dashboard/layouts/layout3/css/layout.min.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets_dashboard/layouts/layout3/css/themes/default.min.css');?>" rel="stylesheet" type="text/css" id="style_color" />
		<link href="<?=base_url('assets_dashboard/layouts/layout3/css/custom.min.css');?>" rel="stylesheet" type="text/css" />

		<link href="<?=base_url('assets_dashboard/batang.png');?>" rel="icon" type="image/x-icon">
	</head>

		<body class="page-container-bg-solid page-md">
		<div class="page-header">
			<div class="page-header-top">
				<div class="container">
					<div id="logo" class="pull-left">
						<h3><img src="<?=base_url('assets_dashboard/batang.png');?>" width='6%'>           Warta Kalipucang Wetan</h4>
					</div>
					<a href="javascript:;" class="menu-toggler"></a>
					<div class="top-menu">
						<ul class="nav navbar-nav pull-right">
							<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
								<?php
									$data_notif = 0;
								?>
								<a href="javascript:void(0)" class="dropdown-toggle" title="Notifikasi">
								</a>
							</li>
							<li class="dropdown dropdown-user dropdown-dark">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<img alt="" class="img-circle" src="<?=site_url('assets/logo.svg');?>">
									<span class="username username-hide-mobile">Administrator</span>
								</a>
								<ul class="dropdown-menu dropdown-menu-default">
									<li>
										<a href="<?php echo site_url('admin_side/bantuan'); ?>">
											<i class="icon-rocket"></i> Bantuan
										</a>
									</li>
									<li class="divider"> </li>
									<li>
										<a href="<?php echo site_url('Auth/logout'); ?>">
											<i class="icon-key"></i> Keluar </a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="page-header-menu">
				<div class="container">
					<div class="hor-menu  ">
						<ul class="nav navbar-nav">
							<li class="menu-dropdown classic-menu-dropdown <?php if($parent=='home'){echo 'active';}else{echo '';} ?>">
								<a href="<?php echo site_url('admin_side/beranda'); ?>"><i class="icon-home"></i> Beranda
								</a>
							</li>
							<li class="menu-dropdown classic-menu-dropdown <?php if($parent=='master'){echo 'active';}else{echo '';} ?>">
								<a href="javascript:;"><i class="icon-drawer"></i> Master
									<span class="arrow <?php if($parent=='master'){echo 'open';}else{echo '';} ?>"></span>
								</a>
								<ul class="dropdown-menu pull-left">
									<li class=" <?php if($child=='pengguna'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/data_anggota'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Data Pengguna
										</a>
									</li>
									<li class=" <?php if($child=='berita'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/berita'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Berita
										</a>
									</li>
									<li class=" <?php if($child=='potensi_desa'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/potensi_desa'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Potensi Desa
										</a>
									</li>
									<li class=" <?php if($child=='slider'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/slider'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Slider
										</a>
									</li>
									<li class=" <?php if($child=='ttd'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/ttd'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> TTD
										</a>
									</li>
								</ul>
							</li>
							<li class="menu-dropdown classic-menu-dropdown <?php if($parent=='laporan_masyarakat'){echo 'active';}else{echo '';} ?>">
								<a href="javascript:;"><i class="icon-layers"></i> Layanan Masyarakat
									<span class="arrow <?php if($parent=='laporan_masyarakat'){echo 'open';}else{echo '';} ?>"></span>
								</a>
								<ul class="dropdown-menu pull-left">
									<li class=" <?php if($child=='permohonan_ktp'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/permohonan_ktp'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Permohonan KTP
										</a>
									</li>
									<li class=" <?php if($child=='permohonan_kk'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/permohonan_kk'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Permohonan KK
										</a>
									</li>
									<li class=" <?php if($child=='pengantar_domisili'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/pengantar_domisili'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Pengantar Domisili
										</a>
									</li>
									<li class=" <?php if($child=='surat_keterangan_usaha'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/surat_keterangan_usaha'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Keterangan Usaha
										</a>
									</li>
									<li class=" <?php if($child=='kematian'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/kematian'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Surat Kematian
										</a>
									</li>
									<li class=" <?php if($child=='surat_keterangan_pindah'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/surat_keterangan_pindah'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Surat Keterangan Pindah
										</a>
									</li>
									<li class=" <?php if($child=='surat_pengantar'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/surat_pengantar'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Surat Keterangan/ Pengantar
										</a>
									</li>
									<li class=" <?php if($child=='sktm'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/sktm'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> SKTM
										</a>
									</li>
									<li class=" <?php if($child=='sim'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/sim'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Pengantar SIM
										</a>
									</li>
									<li class=" <?php if($child=='skck'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/skck'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Pengantar SKCK
										</a>
									</li>
									<li class=" <?php if($child=='permohonan_informasi'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/permohonan_informasi'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Permohonan Informasi
										</a>
									</li>
								</ul>
							</li>
							<li class="menu-dropdown classic-menu-dropdown <?php if($parent=='tentang_desa'){echo 'active';}else{echo '';} ?>">
								<a href="javascript:;"><i class="icon-map"></i> Tentang Desa
									<span class="arrow <?php if($parent=='tentang_desa'){echo 'open';}else{echo '';} ?>"></span>
								</a>
								<ul class="dropdown-menu pull-left">
									<li class=" <?php if($child=='apbdesa'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/apbdesa'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> APBDESA
										</a>
									</li>
									<li class=" <?php if($child=='data_kependudukan'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/data_kependudukan'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Data Kependudukan
										</a>
									</li>
									<li class=" <?php if($child=='ppid'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/ppid'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> PPID
										</a>
									</li>
									<li class=" <?php if($child=='jdih'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/jdih'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> JDIH
										</a>
									</li>
									<li class=" <?php if($child=='lembaga_desa'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/lembaga_desa'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Lembaga Desa
										</a>
									</li>
									<li class=" <?php if($child=='umkm'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/umkm'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> UMKM
										</a>
									</li>
									<li class=" <?php if($child=='pemberitahuan'){echo 'active';}else{echo '';} ?>">
										<a href="<?php echo site_url('admin_side/pemberitahuan'); ?>" class="nav-link nav-toggle ">
											<i class="icon-pin"></i> Pemberitahuan
										</a>
									</li>
								</ul>
							</li>
							<li class="menu-dropdown classic-menu-dropdown <?php if($parent=='log_activity'){echo 'active';}else{echo '';} ?>">
								<a href="<?php echo site_url('admin_side/log_aktifitas'); ?>"><i class="fa fa-rss"></i> Log Aktifitas
								</a>
							</li>
							<li class="menu-dropdown classic-menu-dropdown <?php if($parent=='about'){echo 'active';}else{echo '';} ?>">
								<a href="<?php echo site_url('admin_side/tentang_aplikasi'); ?>"><i class="icon-bulb"></i> Tentang Aplikasi
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="page-container">
			<div class="page-content-wrapper">
				<div class="page-head">
					<div class="container">
						<div class="page-title">
							<h1>Dashboard
								<small>Sistem Informasi</small>
							</h1>
						</div>
						<div class="page-toolbar">
							<div class="btn-group btn-theme-panel">
								<script type="text/javascript">function startTime(){var today=new Date(),curr_hour=today.getHours(),curr_min=today.getMinutes(),curr_sec=today.getSeconds();curr_hour=checkTime(curr_hour);curr_min=checkTime(curr_min);curr_sec=checkTime(curr_sec);document.getElementById('clock').innerHTML=curr_hour+":"+curr_min+":"+curr_sec;}function checkTime(i){if(i<10){i="0"+i;}return i;}setInterval(startTime,500);</script>
								<span class="tanggalwaktu">
								<?= $this->Main_model->convert_hari(date('Y-m-d')).', '.$this->Main_model->convert_tanggal(date('Y-m-d')) ?>  -  Pukul  <span id="clock">13:53:45</span>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="page-content">
					<div class="container">