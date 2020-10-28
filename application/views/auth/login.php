<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Sistem Informasi - Warta Kalipucang Wetan</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Warta Kalipucang Wetan" name="description" />
        <meta content="Warta Kalipucang Wetan" name="author" />

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');?>" rel="stylesheet" type="text/css" />

        <link href="<?=base_url('assets_dashboard/global/plugins/select2/css/select2.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/plugins/select2/css/select2-bootstrap.min.css');?>" rel="stylesheet" type="text/css" />

        <link href="<?=base_url('assets_dashboard/global/css/components-md.min.css');?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/css/plugins-md.min.css');?>" rel="stylesheet" type="text/css" />

        <link href="<?=base_url('assets_dashboard/pages/css/login-2.css');?>" rel="stylesheet" type="text/css" />

        <link href="<?=base_url('assets_dashboard/batang.png');?>" rel="icon" type="image/x-icon">
    </head>
    <body class=" login" onload="getLocation()">
        <br>
        <div style='text-align:center;'><img src="<?=base_url('assets/logo.svg');?>" style="height: 270px;" alt="" /></div>
        <div class="content">
            <form class="login-form" action="<?= site_url('login_process'); ?>" method="post">
                <?= $this->session->flashdata('error') ?>
                <p id="getLocation"></p>
                <div class="form-title">
                    <span class="form-title">Selamat Datang.</span>
                </div>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Masukkan Username dan Password. </span>

                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Nama Pengguna</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Nama Pengguna" name="username" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Kata Sandi</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Kata Sandi" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn red btn-block uppercase">Masuk</button>
                </div>
                <div class="form-actions">
                    <div class="pull-left">
                        <label class="rememberme mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" name="remember" value="1" /> Ingat saya
                            <span></span>
                        </label>
                    </div>
                    <div class="pull-right forget-password-block">
                        <a href="javascript:;" id="forget-password" class="forget-password">Lupa kata sandi?</a>
                    </div>
                </div>
            </form>
            <script>
				var view = document.getElementById("getLocation");
				function getLocation() {
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(showPosition);
					} else {
						view.innerHTML = "";
					}
				}
				function showPosition(position) {
					view.innerHTML = "<input type='hidden' name='location' value='" + position.coords.latitude + "," + position.coords.longitude +"' />";
				}
			</script>
            <form class="forget-form" action="#" method="post">
                <div class="form-title">
                    <span class="form-title">Lupa kata sandi?</span>
                    <span class="form-subtitle">Masukkan email Anda.</span>
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">Kembali</button>
                    <button type="submit" class="btn btn-primary uppercase pull-right">Proses</button>
                </div>
            </form>
        </div>
        <div class="copyright"> 2020 © Warta Kalipucang Wetan - Batang. </div>
        <script src="<?=base_url('assets_dashboard/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/js.cookie.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js');?>" type="text/javascript"></script>
        
        <script src="<?=base_url('assets_dashboard/global/plugins/jquery-validation/js/jquery.validate.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/jquery-validation/js/additional-methods.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/select2/js/select2.full.min.js');?>" type="text/javascript"></script>

        <script src="<?=base_url('assets_dashboard/global/scripts/app.min.js');?>" type="text/javascript"></script>
       
        <script src="<?=base_url('assets_dashboard/pages/scripts/login.min.js');?>" type="text/javascript"></script>
    </body>
</html>