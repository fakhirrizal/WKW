<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Sistem Informasi - Warta Kalipucang Wetan</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Warta Kalipucang Wetan" name="description" />
        <meta content="Warta Kalipucang Wetan" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=base_url('assets_dashboard/global/plugins/select2/css/select2.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/plugins/select2/css/select2-bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?=base_url('assets_dashboard/global/css/components-md.min.css');?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url('assets_dashboard/global/css/plugins-md.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?=base_url('assets_dashboard/pages/css/login-2.css');?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link href="<?=base_url('assets_dashboard/batang.png');?>" rel="icon" type="image/x-icon"> </head>
    <!-- END HEAD -->

    <body class=" login" onload="getLocation()">
        <!-- BEGIN LOGO -->
        <!-- <div class="logo">
            <a href="javascript:void(0)"> -->
                <div style='text-align:center;'><img src="<?=base_url('assets/logo.svg');?>" style="height: 270px;" alt="" /></div>
            <!-- </a>
        </div> -->
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="<?= site_url('login_process'); ?>" method="post">
                <?= $this->session->flashdata('error') ?>
                <p id="getLocation"></p>
                <div class="form-title">
                    <span class="form-title">Welcome.</span>
                    <span class="form-subtitle">Please log in to use the system.</span>
                </div>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Masukkan Username dan Password. </span>

                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn red btn-block uppercase">Login</button>
                </div>
                <div class="form-actions">
                    <div class="pull-left">
                        <label class="rememberme mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" name="remember" value="1" /> Remember me
                            <span></span>
                        </label>
                    </div>
                    <div class="pull-right forget-password-block">
                        <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
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
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="#" method="post">
                <div class="form-title">
                    <span class="form-title">Forget Password ?</span>
                    <span class="form-subtitle">Enter your e-mail to reset it.</span>
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">Back</button>
                    <button type="submit" class="btn btn-primary uppercase pull-right">Submit</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <div class="copyright"> 2020 © Warta Kalipucang Wetan - Batang. </div>
        <!-- END LOGIN -->
        <!--[if lt IE 9]>
<script src="../assets_dashboard/global/plugins/respond.min.js"></script>
<script src="../assets_dashboard/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?=base_url('assets_dashboard/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/js.cookie.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js');?>" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=base_url('assets_dashboard/global/plugins/jquery-validation/js/jquery.validate.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/jquery-validation/js/additional-methods.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets_dashboard/global/plugins/select2/js/select2.full.min.js');?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=base_url('assets_dashboard/global/scripts/app.min.js');?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?=base_url('assets_dashboard/pages/scripts/login.min.js');?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>