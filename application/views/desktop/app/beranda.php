<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SID - Kalipucang Wetan - Batang</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="<?=base_url('assets_dashboard/css/styles.css');?>" rel="stylesheet" type="text/css" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">SID Kalipucang Wetan</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?php echo site_url('desktop'); ?>">BERANDA</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Signup-->
    <section class="signup-section" id="signup">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto text-center">
                    <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                    <h2 class="text-white mb-5">Anda Ingin Mengurus Surat apa ?</h2>
                </div>
            </div>
            <div class="row">
                <h4 class="text-white mb-5 text-center">SURAT PERMOHONAN</h4>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="<?php echo site_url('permohonan_ktp'); ?>">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="text-uppercase m-0">Pengantar KTP</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="<?php echo site_url('permohonan_kk'); ?>">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="text-uppercase m-0">Pengantar KK</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="#">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="text-uppercase m-0">Surat Kelahiran</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="<?php echo site_url('pengantar_kematian'); ?>">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="text-uppercase m-0">Surat Kematian</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 class="text-white mb-5 mt-5 text-center">SURAT KETERANGAN</h4>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="<?php echo site_url('pengantar_domisili'); ?>">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="m-0">Keterangan Domisili</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="<?php echo site_url('surat_keterangan_usaha'); ?>">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="m-0">Keterangan Usaha</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="#">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="m-0">SKTM Sekolah</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="#">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="m-0">SKTM Umum</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="<?php echo site_url('sim'); ?>">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="m-0">Pengantar SIM</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="<?php echo site_url('skck'); ?>">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="m-0">Pengantar SKCK</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="#">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="m-0">Pengantar / Keterangan</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="#">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="m-0">Keterangan Pindah</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 class="text-white mb-5 mt-5 text-center">DOKUMEN PERNIKAHAN</h4>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="#">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="m-0">Dokumen Pria</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <a href="#">
                            <div class="card-body text-center">
                                <i class="fas fa-file-signature fa-3x"></i>
                                <hr>
                                <h4 class="m-0">Dokumen Wanita</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact-->
    <section class="contact-section bg-black">
        <div class="container">
            <div class="social d-flex justify-content-center">
                <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container">SID Kalipucang Wetan - Batang</div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?=base_url('assets_dashboard/js/scripts.js');?>" type="text/javascript"></script>
</body>

</html>