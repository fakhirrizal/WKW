<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Warta Kalipucang Wetan - Dokumentasi API</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets_dashboard/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets_dashboard/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets_dashboard/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets_dashboard/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?= base_url(); ?>assets_dashboard/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?= base_url(); ?>assets_dashboard/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?= base_url(); ?>assets_dashboard/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets_dashboard/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?= base_url(); ?>assets_dashboard/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link href="<?=base_url('assets_dashboard/batang.png');?>" rel="icon" type="image/x-icon">
    </head>
    <body class="page-container-bg-solid page-md">
        <div class="page-container">
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                        <div class="page-content-inner">
							<div class="portlet light ">
								<div class="portlet-title tabbable-line">
									<div class="caption">
										<i class="icon-share font-dark"></i>
										<span class="caption-subject font-dark bold ">Dokumentasi API</span>
									</div>
									<ul class="nav nav-tabs">
										<li>
											<a href="#portlet_tab2_3" data-toggle="tab"> Administrasi Masyarakat </a>
										</li>
										<li>
											<a href="#portlet_tab2_2" data-toggle="tab"> Data Master </a>
                                        </li>
                                        <li>
											<a href="#portlet_tab2_4" data-toggle="tab"> Application </a>
										</li>
										<li class="active">
											<a href="#portlet_tab2_1" data-toggle="tab"> Authentication </a>
										</li>
									</ul>
								</div>
								<div class="portlet-body">
									<div class="tab-content">
										<div class="tab-pane active" id="portlet_tab2_1">
											<!-- Awal -->
											<div class="portlet-body">
												<div class="panel-group accordion" id="accordion3">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1" aria-expanded="false"> <span class="label label-primary"> POST </span>&nbsp;&nbsp;{URL}/api/auth/Login</a>
															</h4>
														</div>
														<div id="collapse_3_1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
															<div class="row">
																<div class="col-md-12">
																	<div class="portlet light ">
																		<div class="portlet-title">
																			<b>URL</b> : https://kalipucangwetan.id/api/auth/Login<br>
																			<b>Method</b> : POST<br>
																			<b>Deskripsi</b> : Untuk mengetahui status user apakah terdaftar di sistem atau tidak.<br><br>
																		</div>
																		<div class="portlet-body">
																			Berikut parameter yang harus diisi,<br><br>
																			<textarea class='form-control' rows='5' readonly>
																				{
																						"username": NIK,
																						"password": string,
																						"device_id": string
																				}
																			</textarea><br>
																			Balikannya sebagai berikut (jika berhasil/ atau dikenali oleh sistem),<br><br>
																			<textarea class='form-control' rows='15' readonly>
																				{
																						"user_id": int,
																						"nik": string,
																						"nama": string,
																						"alamat": string,
																						"rt": string,
																						"rw": string,
																						"id_desa": string,
																						"id_kecamatan": string,
																						"id_kabupaten": string,
																						"id_provinsi": string,
																						"email": string,
																						"no_hp": string,
																						"foto": {url}
																				}
																			</textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- Akhir -->
											<!-- Awal -->
											<div class="portlet-body">
												<div class="panel-group accordion" id="accordion3">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2" aria-expanded="false"> <span class="label label-primary"> POST </span>&nbsp;&nbsp;{URL}/api/auth/Register</a>
															</h4>
														</div>
														<div id="collapse_3_2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
															<div class="row">
																<div class="col-md-12">
																	<div class="portlet light ">
																		<div class="portlet-title">
																			<b>URL</b> : https://kalipucangwetan.id/api/auth/Register<br>
																			<b>Method</b> : POST<br>
																			<b>Deskripsi</b> : Untuk mendaftarkan data diri terhadap sistem, agar ketika masuk sistem dapat mengenali.<br><br>
																		</div>
																		<div class="portlet-body">
																			Berikut parameter yang harus diisi,<br><br>
																			<textarea class='form-control' rows='14' readonly>
																				{
																						"nik": string,
																						"password": string,
																						"nama": string,
																						"alamat": string,
																						"rt": string,
																						"rw": string,
																						"id_desa": string,
																						"id_kecamatan": string,
																						"id_kabupaten": string,
																						"id_provinsi": string,
																						"email": string,
																						"no_hp": string
																				}
																			</textarea><br>
																			Balikannya sebagai berikut (jika berhasil/ atau terdaftar di sistem),<br><br>
																			<textarea class='form-control' rows='15' readonly>
																				{
																						"user_id": int,
																						"nik": string,
																						"nama": string,
																						"alamat": string,
																						"rt": string,
																						"rw": string,
																						"id_desa": string,
																						"id_kecamatan": string,
																						"id_kabupaten": string,
																						"id_provinsi": string,
																						"email": string,
																						"no_hp": string,
																						"foto": {url}
																				}
																			</textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_23" aria-expanded="false"> <span class="label label-primary"> POST </span>&nbsp;&nbsp;{URL}/api/auth/Reset_password</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_23" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/auth/Reset_password<br>
                                                                            <b>Method</b> : POST<br>
                                                                            <b>Deskripsi</b> : Mengatur ulang kata sandi dari akun pengguna tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Berikut parameter yang harus diisi,<br><br>
                                                                            <textarea class='form-control' rows='3' readonly>
                                                                            {
                                                                                    "email": string
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_34" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/auth/Device?user_id={user_id}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_34" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/auth/Device?user_id={user_id}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data Device ID berdasarkan User ID tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='3' readonly>
                                                                            {
                                                                                    "device_id": string
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
											<div class="portlet-body">
												<div class="panel-group accordion" id="accordion3">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_35" aria-expanded="false"> <span class="label label-primary"> POST </span>&nbsp;&nbsp;{URL}/api/auth/Device</a>
															</h4>
														</div>
														<div id="collapse_3_35" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
															<div class="row">
																<div class="col-md-12">
																	<div class="portlet light ">
																		<div class="portlet-title">
																			<b>URL</b> : https://kalipucangwetan.id/api/auth/Device<br>
																			<b>Method</b> : POST<br>
																			<b>Deskripsi</b> : Untuk mengirimkan notifikasi ke Device pengguna.<br>
																			<b>Catatan</b> : Field yang wajib diisi adalah <b>api_key</b>, dan <b>registrationIds</b>.<br><br>
																		</div>
																		<div class="portlet-body">
																			Berikut parameter yang harus diisi,<br><br>
																			<textarea class='form-control' rows='12' readonly>
																				{
																						"api_key": string,
																						"registrationIds": string,
																						"message": string,
																						"title": string,
																						"subtitle": string,
																						"tickerText": string,
																						"vibrate": int,
																						"sound": int,
																						"largeIcon": string,
																						"smallIcon": string
																				}
																			</textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- Akhir -->
										</div>
										<div class="tab-pane" id="portlet_tab2_2">
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_3" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Provinsi</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Provinsi<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data Provinsi<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='6' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_provinsi": int,
                                                                                            "nm_provinsi": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_4" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Provinsi?id_provinsi={id_provinsi}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_4" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Provinsi?id_provinsi={id_provinsi}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan satu data Provinsi yang dipilih<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='4' readonly>
                                                                            {
                                                                                    "id_provinsi": int,
                                                                                    "nm_provinsi": string
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_5" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Kabupaten</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_5" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Kabupaten<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data Kabupaten/ Kota<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='7' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_kabupaten": int,
                                                                                            "id_provinsi": int,
                                                                                            "nm_kabupaten": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_6" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Kabupaten?id_kabupaten={id_kabupaten}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_6" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Kabupaten?id_kabupaten={id_kabupaten}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan satu data Kabupaten/ Kota yang dipilih<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='5' readonly>
                                                                            {
                                                                                    "id_kabupaten": int,
                                                                                    "id_provinsi": string,
                                                                                    "nm_kabupaten": string
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_7" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Kabupaten?id_provinsi={id_provinsi}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_7" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Kabupaten?id_provinsi={id_provinsi}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data Kabupaten/ Kota berdasarkan Provinsi tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='7' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_kabupaten": int,
                                                                                            "id_provinsi": int,
                                                                                            "nm_kabupaten": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_8" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Kecamatan</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_8" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Kecamatan<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data Kecamatan<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='8' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_kecamatan": int,
                                                                                            "nm_kecamatan": string,
                                                                                            "nm_kabupaten": string,
                                                                                            "nm_provinsi": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_9" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Kecamatan?id_kecamatan={id_kecamatan}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_9" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Kecamatan?id_kecamatan={id_kecamatan}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan satu data Kecamatan yang dipilih<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='6' readonly>
                                                                            {
                                                                                    "id_kecamatan": int,
                                                                                    "nm_kecamatan": string,
                                                                                    "nm_kabupaten": string,
                                                                                    "nm_provinsi": string
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_10" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Kecamatan?id_provinsi={id_provinsi}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_10" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Kecamatan?id_provinsi={id_provinsi}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data Kecamatan berdasarkan Provinsi tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='8' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_kecamatan": int,
                                                                                            "nm_kecamatan": string,
                                                                                            "nm_kabupaten": string,
                                                                                            "nm_provinsi": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_11" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Kecamatan?id_kabupaten={id_kabupaten}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_11" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Kecamatan?id_kabupaten={id_kabupaten}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data Kecamatan berdasarkan Kabupaten/ Kota tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='8' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_kecamatan": int,
                                                                                            "nm_kecamatan": string,
                                                                                            "nm_kabupaten": string,
                                                                                            "nm_provinsi": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_12" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Desa</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_12" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Desa<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data Kelurahan/ Desa<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='9' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_desa": int,
                                                                                            "nm_desa": string,
                                                                                            "nm_kecamatan": string,
                                                                                            "nm_kabupaten": string,
                                                                                            "nm_provinsi": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_13" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Desa?id_desa={id_desa}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_13" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Desa?id_desa={id_desa}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan satu data Kelurahan/ Desa yang dipilih<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='7' readonly>
                                                                            {
                                                                                "id_desa": int,
                                                                                "nm_desa": string,
                                                                                "nm_kecamatan": string,
                                                                                "nm_kabupaten": string,
                                                                                "nm_provinsi": string
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_14" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Desa?id_provinsi={id_provinsi}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_14" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Desa?id_provinsi={id_provinsi}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data Kelurahan/ Desa berdasarkan Provinsi tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='9' readonly>
                                                                            [
                                                                                    {
                                                                                        "id_desa": int,
                                                                                        "nm_desa": string,
                                                                                        "nm_kecamatan": string,
                                                                                        "nm_kabupaten": string,
                                                                                        "nm_provinsi": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_15" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Desa?id_kabupaten={id_kabupaten}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_15" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Desa?id_kabupaten={id_kabupaten}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data Kelurahan/ Desa berdasarkan Kabupaten/ Kota tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='9' readonly>
                                                                            [
                                                                                    {
                                                                                        "id_desa": int,
                                                                                        "nm_desa": string,
                                                                                        "nm_kecamatan": string,
                                                                                        "nm_kabupaten": string,
                                                                                        "nm_provinsi": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_16" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Desa?id_kecamatan={id_kecamatan}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_16" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Desa?id_kecamatan={id_kecamatan}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data Kelurahan/ Desa berdasarkan Kecamatan tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='9' readonly>
                                                                            [
                                                                                    {
                                                                                        "id_desa": int,
                                                                                        "nm_desa": string,
                                                                                        "nm_kecamatan": string,
                                                                                        "nm_kabupaten": string,
                                                                                        "nm_provinsi": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_17" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Apbdesa</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_17" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Apbdesa<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data APBDESA<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='10' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_apbdes": int,
                                                                                            "tahun": int,
                                                                                            "keterangan": pengeluaran, atau pendapatan, atau pembiayaan, atau silpa, atau defisit/ surplus,
                                                                                            "kategori": Rencana/ Realisasi,
                                                                                            "rincian": string,
                                                                                            "nominal": int,
                                                                                            "warna": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_18" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Apbdesa?tahun={tahun}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_18" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Apbdesa?tahun={tahun}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data APBDESA berdasarkan tahun anggaran tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='10' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_apbdes": int,
                                                                                            "tahun": int,
                                                                                            "keterangan": pengeluaran, atau pendapatan, atau pembiayaan, atau silpa, atau defisit/ surplus,
                                                                                            "kategori": Rencana/ Realisasi,
                                                                                            "rincian": string,
                                                                                            "nominal": int,
                                                                                            "warna": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_28" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Apbdesa?keterangan={keterangan}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_28" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Apbdesa?keterangan={keterangan}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data APBDESA berdasarkan keterangan (pendapatan atau pengeluaran) tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='10' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_apbdes": int,
                                                                                            "tahun": int,
                                                                                            "keterangan": pengeluaran, atau pendapatan, atau pembiayaan, atau silpa, atau defisit/ surplus,
                                                                                            "kategori": Rencana/ Realisasi,
                                                                                            "rincian": string,
                                                                                            "nominal": int,
                                                                                            "warna": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_29" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Apbdesa?kategori={kategori}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_29" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Apbdesa?kategori={kategori}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data APBDESA berdasarkan kategori (Rencana atau Realisasi) tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='10' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_apbdes": int,
                                                                                            "tahun": int,
                                                                                            "keterangan": pengeluaran, atau pendapatan, atau pembiayaan, atau silpa, atau defisit/ surplus,
                                                                                            "kategori": Rencana/ Realisasi,
                                                                                            "rincian": string,
                                                                                            "nominal": int,
                                                                                            "warna": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_30" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Apbdesa?tahun={tahun}&keterangan={keterangan}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_30" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Apbdesa?tahun={tahun}&keterangan={keterangan}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data APBDESA berdasarkan tahun dan keterangan (pendapatan atau pengeluaran) tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='10' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_apbdes": int,
                                                                                            "tahun": int,
                                                                                            "keterangan": pengeluaran, atau pendapatan, atau pembiayaan, atau silpa, atau defisit/ surplus,
                                                                                            "kategori": Rencana/ Realisasi,
                                                                                            "rincian": string,
                                                                                            "nominal": int,
                                                                                            "warna": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_31" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Apbdesa?tahun={tahun}&kategori={kategori}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_31" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Apbdesa?tahun={tahun}&kategori={kategori}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data APBDESA berdasarkan tahun dan kategori (Rencana atau Realisasi) tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='10' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_apbdes": int,
                                                                                            "tahun": int,
                                                                                            "keterangan": pengeluaran, atau pendapatan, atau pembiayaan, atau silpa, atau defisit/ surplus,
                                                                                            "kategori": Rencana/ Realisasi,
                                                                                            "rincian": string,
                                                                                            "nominal": int,
                                                                                            "warna": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_32" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Apbdesa?keterangan={keterangan}&kategori={kategori}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_32" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Apbdesa?keterangan={keterangan}&kategori={kategori}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data APBDESA berdasarkan keterangan (pendapatan atau pengeluaran) dan kategori (Rencana atau Realisasi) tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='10' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_apbdes": int,
                                                                                            "tahun": int,
                                                                                            "keterangan": pengeluaran, atau pendapatan, atau pembiayaan, atau silpa, atau defisit/ surplus,
                                                                                            "kategori": Rencana/ Realisasi,
                                                                                            "rincian": string,
                                                                                            "nominal": int,
                                                                                            "warna": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_33" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Apbdesa?tahun={tahun}&keterangan={keterangan}&kategori={kategori}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_33" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Apbdesa?tahun={tahun}&keterangan={keterangan}&kategori={kategori}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data APBDESA berdasarkan tahun anggaran, keterangan (pendapatan atau pengeluaran) dan kategori (Rencana atau Realisasi) tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='10' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_apbdes": int,
                                                                                            "tahun": int,
                                                                                            "keterangan": pengeluaran, atau pendapatan, atau pembiayaan, atau silpa, atau defisit/ surplus,
                                                                                            "kategori": Rencana/ Realisasi,
                                                                                            "rincian": string,
                                                                                            "nominal": int,
                                                                                            "warna": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_36" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Apbdesa?id_apbdes={id_apbdes}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_36" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Apbdesa?id_apbdes={id_apbdes}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan detil sub output anggaran berdasarkan id_apbdes<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='8' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_apbdes": string,
                                                                                            "id_sub_output": string,
                                                                                            "sub_output": string,
                                                                                            "nominal": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_37" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Apbdesa?id_sub_output={id_sub_output}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_37" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Apbdesa?id_sub_output={id_sub_output}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan detil output anggaran berdasarkan id_sub_output<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='9' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_apbdes": string,
                                                                                            "id_sub_output": string,
                                                                                            "id_output": string,
                                                                                            "output": string,
                                                                                            "nominal": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_19" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Berita</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_19" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Berita<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data Berita/ Warta<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='9' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_berita": int,
                                                                                            "judul": string,
                                                                                            "foto": {url},
                                                                                            "isi": string,
                                                                                            "created_at": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_20" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Berita?id_berita={id_berita}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_20" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Berita?id_berita={id_berita}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan satu data Berita/ Warta yang dipilih<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='7' readonly>
                                                                            {
                                                                                    "id_berita": int,
                                                                                    "judul": string,
                                                                                    "foto": {url},
                                                                                    "isi": string,
                                                                                    "created_at": string
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_21" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Potensi</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_21" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Potensi<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data Potensi Desa Kalipucang Wetan<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='9' readonly>
                                                                            [
                                                                                    {
                                                                                            "id_potensi_desa": int,
                                                                                            "judul": string,
                                                                                            "foto": {url},
                                                                                            "isi": string,
                                                                                            "created_at": string
                                                                                    }
                                                                            ]
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_22" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Potensi?id_potensi_desa={id_potensi_desa}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_22" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Potensi?id_potensi_desa={id_potensi_desa}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan satu data Potensi Desa Kalipucang Wetan yang dipilih<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='7' readonly>
                                                                            {
                                                                                    "id_potensi_desa": int,
                                                                                    "judul": string,
                                                                                    "foto": {url},
                                                                                    "isi": string,
                                                                                    "created_at": string
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_24" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Kependudukan</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_24" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Kependudukan<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan kumpulan data kependudukan yang ada di Desa Kalipucang Wetan<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='7' readonly>
                                                                            {
                                                                                    "id": int,
                                                                                    "kategori": string,
                                                                                    "keterangan": string,
                                                                                    "jumlah": int,
                                                                                    "tahun": int
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_25" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Kependudukan?tahun={tahun}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_25" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Kependudukan?tahun={tahun}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data kependudukan yang ada di Desa Kalipucang Wetan berdasarkan tahun yang dipilih<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='7' readonly>
                                                                            {
                                                                                    "id": int,
                                                                                    "kategori": string,
                                                                                    "keterangan": string,
                                                                                    "jumlah": int,
                                                                                    "tahun": int
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_26" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Kependudukan?kategori={kategori}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_26" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Kependudukan?kategori={kategori}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data kependudukan yang ada di Desa Kalipucang Wetan berdasarkan kategori yang dipilih<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='7' readonly>
                                                                            {
                                                                                    "id": int,
                                                                                    "kategori": string,
                                                                                    "keterangan": string,
                                                                                    "jumlah": int,
                                                                                    "tahun": int
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_27" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/master/Kependudukan?tahun={tahun}&kategori={kategori}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_27" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/master/Kependudukan?tahun={tahun}&kategori={kategori}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data kependudukan yang ada di Desa Kalipucang Wetan berdasarkan tahun yang dipilih dan kategori tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='7' readonly>
                                                                            {
                                                                                    "id": int,
                                                                                    "kategori": string,
                                                                                    "keterangan": string,
                                                                                    "jumlah": int,
                                                                                    "tahun": int
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
										</div>
										<div class="tab-pane" id="portlet_tab2_3">
											<!-- Awal -->
											<div class="portlet-body">
												<div class="panel-group accordion" id="accordion3">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_45" aria-expanded="false"> <span class="label label-primary"> POST </span>&nbsp;&nbsp;{URL}/api/administrasi_masyarakat/Sktm_pendidikan</a>
															</h4>
														</div>
														<div id="collapse_3_45" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
															<div class="row">
																<div class="col-md-12">
																	<div class="portlet light ">
																		<div class="portlet-title">
																			<b>URL</b> : https://kalipucangwetan.id/api/administrasi_masyarakat/Sktm_pendidikan<br>
																			<b>Method</b> : POST<br>
																			<b>Deskripsi</b> : Mendapatkan surat keterangan tidak mampu untuk pendidikan.<br><br>
																		</div>
																		<div class="portlet-body">
																			Berikut parameter yang harus diisi,<br><br>
																			<textarea class='form-control' rows='10' readonly>
																				{
																						"user_id": string,
																						"tempat_lahir": string,
																						"tanggal_lahir": YYYY-mm-dd,
																						"kebangsaan": string,
																						"pekerjaan": string,
																						"agama": string,
																						"nama_ayah": string,
																						"nama_ibu": string
																				}
																			</textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
											<div class="portlet-body">
												<div class="panel-group accordion" id="accordion3">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_46" aria-expanded="false"> <span class="label label-primary"> POST </span>&nbsp;&nbsp;{URL}/api/administrasi_masyarakat/Sktm</a>
															</h4>
														</div>
														<div id="collapse_3_46" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
															<div class="row">
																<div class="col-md-12">
																	<div class="portlet light ">
																		<div class="portlet-title">
																			<b>URL</b> : https://kalipucangwetan.id/api/administrasi_masyarakat/Sktm<br>
																			<b>Method</b> : POST<br>
																			<b>Deskripsi</b> : Untuk mendapatkan surat keterangan tidak mampu.<br><br>
																		</div>
																		<div class="portlet-body">
																			Berikut parameter yang harus diisi,<br><br>
																			<textarea class='form-control' rows='8' readonly>
																				{
																						"user_id": string,
																						"tempat_lahir": string,
																						"tanggal_lahir": YYYY-mm-dd,
																						"kebangsaan": string,
																						"pekerjaan": string,
																						"agama": string
																				}
																			</textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
											<div class="portlet-body">
												<div class="panel-group accordion" id="accordion3">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_47" aria-expanded="false"> <span class="label label-primary"> POST </span>&nbsp;&nbsp;{URL}/api/administrasi_masyarakat/Surat_keterangan_domisili</a>
															</h4>
														</div>
														<div id="collapse_3_47" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
															<div class="row">
																<div class="col-md-12">
																	<div class="portlet light ">
																		<div class="portlet-title">
																			<b>URL</b> : https://kalipucangwetan.id/api/administrasi_masyarakat/Surat_keterangan_domisili<br>
																			<b>Method</b> : POST<br>
																			<b>Deskripsi</b> : Untuk mendapatkan surat keterangan domisili.<br><br>
																		</div>
																		<div class="portlet-body">
																			Berikut parameter yang harus diisi,<br><br>
																			<textarea class='form-control' rows='10' readonly>
																				{
																						"user_id": string,
																						"tempat_lahir": string,
																						"tanggal_lahir": YYYY-mm-dd,
																						"kebangsaan": string,
																						"pekerjaan": string,
																						"agama": string,
																						"keperluan": string,
																						"keterangan": string
																				}
																			</textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
											<div class="portlet-body">
												<div class="panel-group accordion" id="accordion3">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_48" aria-expanded="false"> <span class="label label-primary"> POST </span>&nbsp;&nbsp;{URL}/api/administrasi_masyarakat/Surat_keterangan_usaha</a>
															</h4>
														</div>
														<div id="collapse_3_48" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
															<div class="row">
																<div class="col-md-12">
																	<div class="portlet light ">
																		<div class="portlet-title">
																			<b>URL</b> : https://kalipucangwetan.id/api/administrasi_masyarakat/Surat_keterangan_usaha<br>
																			<b>Method</b> : POST<br>
																			<b>Deskripsi</b> : Untuk mendapatkan surat keterangan usaha.<br><br>
																		</div>
																		<div class="portlet-body">
																			Berikut parameter yang harus diisi,<br><br>
																			<textarea class='form-control' rows='9' readonly>
																				{
																						"user_id": string,
																						"tempat_lahir": string,
																						"tanggal_lahir": YYYY-mm-dd,
																						"pekerjaan": string,
																						"agama": string,
																						"jenis_usaha": string,
																						"nama_usaha": string
																				}
																			</textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
											<div class="portlet-body">
												<div class="panel-group accordion" id="accordion3">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_49" aria-expanded="false"> <span class="label label-primary"> POST </span>&nbsp;&nbsp;{URL}/api/administrasi_masyarakat/Surat_pengantar_sim</a>
															</h4>
														</div>
														<div id="collapse_3_49" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
															<div class="row">
																<div class="col-md-12">
																	<div class="portlet light ">
																		<div class="portlet-title">
																			<b>URL</b> : https://kalipucangwetan.id/api/administrasi_masyarakat/Surat_pengantar_sim<br>
																			<b>Method</b> : POST<br>
																			<b>Deskripsi</b> : Untuk mendapatkan surat pengantar membuat SIM.<br><br>
																		</div>
																		<div class="portlet-body">
																			Berikut parameter yang harus diisi,<br><br>
																			<textarea class='form-control' rows='7' readonly>
																				{
																						"user_id": string,
																						"tempat_lahir": string,
																						"tanggal_lahir": YYYY-mm-dd,
																						"pekerjaan": string,
																						"agama": string
																				}
																			</textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
											<div class="portlet-body">
												<div class="panel-group accordion" id="accordion3">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_50" aria-expanded="false"> <span class="label label-primary"> POST </span>&nbsp;&nbsp;{URL}/api/administrasi_masyarakat/Surat_pengantar_skck</a>
															</h4>
														</div>
														<div id="collapse_3_50" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
															<div class="row">
																<div class="col-md-12">
																	<div class="portlet light ">
																		<div class="portlet-title">
																			<b>URL</b> : https://kalipucangwetan.id/api/administrasi_masyarakat/Surat_pengantar_skck<br>
																			<b>Method</b> : POST<br>
																			<b>Deskripsi</b> : Untuk mendapatkan surat pengantar membuat SKCK.<br><br>
																		</div>
																		<div class="portlet-body">
																			Berikut parameter yang harus diisi,<br><br>
																			<textarea class='form-control' rows='7' readonly>
																				{
																						"user_id": string,
																						"tempat_lahir": string,
																						"tanggal_lahir": YYYY-mm-dd,
																						"pekerjaan": string,
																						"agama": string
																				}
																			</textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- Akhir -->
                                        </div>
                                        <div class="tab-pane" id="portlet_tab2_4">
											<!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_38" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/apps/Profil_ppid</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_38" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/apps/Profil_ppid<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan teks dari Profil PPID<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='4' readonly>
                                                                            {
                                                                                    "id": int,
                                                                                    "teks": string
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
											<div class="portlet-body">
												<div class="panel-group accordion" id="accordion3">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_39" aria-expanded="false"> <span class="label label-primary"> POST </span>&nbsp;&nbsp;{URL}/api/apps/Permohonan_informasi</a>
															</h4>
														</div>
														<div id="collapse_3_39" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
															<div class="row">
																<div class="col-md-12">
																	<div class="portlet light ">
																		<div class="portlet-title">
																			<b>URL</b> : https://kalipucangwetan.id/api/apps/Permohonan_informasi<br>
																			<b>Method</b> : POST<br>
																			<b>Deskripsi</b> : Untuk mengetahui status user apakah terdaftar di sistem atau tidak.<br><br>
																		</div>
																		<div class="portlet-body">
																			Berikut parameter yang harus diisi,<br><br>
																			<textarea class='form-control' rows='13' readonly>
																				{
																						"user_id": string,
																						"nama": string,
																						"alamat": string,
																						"no_hp": string,
																						"email": string,
																						"rincian_informasi_yang_dibutuhkan": string,
																						"tujuan": string,
																						"cara_memperoleh": string,
																						"cara_mendapatkan": string,
																						"file_ktp": base64,
																						"file_badan_hukum": base64
																				}
                                                                            </textarea><br>
                                                                            <b>Keterangan</b><br>
                                                                            File badan hukum bersifat opsional, jika pemohonan mengatasnamakan lembaga
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_40" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/apps/Ppid</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_40" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/apps/Ppid<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data informasi PPID<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='6' readonly>
                                                                            {
                                                                                    "id_ppid": string,
                                                                                    "kategori": string,
                                                                                    "judul": string,
                                                                                    "file": {url}
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_41" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/apps/Ppid?kategori={kategori}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_41" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/apps/Ppid?kategori={kategori}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan semua data informasi PPID berdasarkan kategori tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='6' readonly>
                                                                            {
                                                                                    "id_ppid": string,
                                                                                    "kategori": string,
                                                                                    "judul": string,
                                                                                    "file": {url}
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_42" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/apps/Ppid?id_ppid={id_ppid}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_42" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/apps/Ppid?id_ppid={id_ppid}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data informasi PPID berdasarkan ID tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='6' readonly>
                                                                            {
                                                                                    "id_ppid": string,
                                                                                    "kategori": string,
                                                                                    "judul": string,
                                                                                    "file": {url}
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_43" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/apps/Lembaga_desa</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_43" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/apps/Lembaga_desa<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data Lembaga Desa yang ada di Kalipucang Wetan<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='5' readonly>
                                                                            {
                                                                                    "id_lembaga_desa": string,
                                                                                    "nama": string,
                                                                                    "keterangan": string
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
                                            <!-- Awal -->
                                            <div class="portlet-body">
                                                <div class="panel-group accordion" id="accordion3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_44" aria-expanded="false"> <span class="label label-success"> GET </span>&nbsp;&nbsp;{URL}/api/apps/Lembaga_desa?id_lembaga_desa={id_lembaga_desa}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse_3_44" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="portlet light ">
                                                                        <div class="portlet-title">
                                                                            <b>URL</b> : https://kalipucangwetan.id/api/apps/Anggota_lembaga_desa?id_lembaga_desa={id_lembaga_desa}<br>
                                                                            <b>Method</b> : GET<br>
                                                                            <b>Deskripsi</b> : Mendapatkan data anggota dari suatu Lembaga Desa tertentu<br><br>
                                                                        </div>
                                                                        <div class="portlet-body">
                                                                            Balikannya sebagai berikut,<br><br>
                                                                            <textarea class='form-control' rows='7' readonly>
                                                                            {
                                                                                    "id_anggota_lembaga_desa": string,
                                                                                    "lembaga_desa": string,
                                                                                    "nama": string,
                                                                                    "jabatan": string,
                                                                                    "foto": {url}
                                                                            }
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir -->
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-footer">
            <div class="container"> 2020 &copy; Warta Kalipucang Wetan - Batang.
            </div>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
        <script src="<?= base_url(); ?>assets_dashboard/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets_dashboard/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets_dashboard/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets_dashboard/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets_dashboard/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets_dashboard/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets_dashboard/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?= base_url(); ?>assets_dashboard/global/plugins/codemirror/lib/codemirror.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets_dashboard/global/plugins/codemirror/mode/javascript/javascript.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets_dashboard/global/plugins/codemirror/mode/htmlmixed/htmlmixed.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets_dashboard/global/plugins/codemirror/mode/css/css.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= base_url(); ?>assets_dashboard/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?= base_url(); ?>assets_dashboard/pages/scripts/components-code-editors.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?= base_url(); ?>assets_dashboard/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets_dashboard/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets_dashboard/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>