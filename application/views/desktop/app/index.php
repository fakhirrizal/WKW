<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SID - Kalipucang Wetan - Batang</title>
    <link rel="icon" type="image/x-icon" href="<?=base_url('assets_dashboard/batang.png');?>" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?=base_url('assets_dashboard/css/styles.css');?>" rel="stylesheet" />
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
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">TAUTAN</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#signup">TENTANG</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                <h1 class="mx-auto my-0 text-uppercase">SID KALIPUCANG WETAN</h1>
                <h2 class="text-white-50 mx-auto mt-2 mb-5">SISTEM INFORMASI DESA KALIPUCANG WETAN, BATANG</h2>
                <a class="btn btn-primary js-scroll-trigger" href="#about">MULAI</a>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-white mb-4">SISTEM INFORMASI DESA<br> KALIPUCANG WETAN</h2>
                    <!-- <p class="text-white-50">
                        <a href="https://startbootstrap.com/template-overviews/grayscale/">the preview page</a>
                        . The theme is open source, and you can use it for any purpose, personal or commercial.
                    </p> -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <a href="http://kalipucangwetan-batang.desa.id" target="_self">
                            <img class="card-img-top" src="<?= base_url(); ?>assets_dashboard/img/tombol1.png" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <p class="card-text text-black">WEBSITE DESA KALIPUCANG WETAN</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <a href="<?= base_url(); ?>beranda" target="_self">
                            <img class="card-img-top" src="<?= base_url(); ?>assets_dashboard/img/tombol2.png" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <p class="card-text text-black">LAYANAN ADMINISTRASI DESA</p>
                        </div>
                    </div>
                </div>
            </div>
            <img class="img-fluid" src="<?= base_url(); ?>assets_dashboard/img/" alt="" />
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
    <footer class="footer bg-black small text-center text-white-50" id="signup">
        <div class="container">SID Kalipucang Wetan - Batang</div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?=base_url('assets_dashboard/js/scripts.js');?>"></script>
</body>

</html>