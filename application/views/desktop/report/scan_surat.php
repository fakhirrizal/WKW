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
    <link href="<?= base_url().'assets_dashboard/'; ?>css/styles.css" rel="stylesheet" />
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
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.html">BERANDA</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Signup-->
    <section class="signup-section" id="signup">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 mx-auto text-center">
                    <h2 class="text-white mb-5"><?= $judul; ?></h2>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container pt-5 pb-5 ">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        
                        <?php
                        if($data_utama->nomor_surat==''){
                            echo'
                            <div class="alert alert-danger" role="alert">
                                Surat tidak valid harap hubungi pihak desa
                            </div>';
                        }else{
                            echo'
                            ';
                        }
                        if($judul=='Surat Pengantar SIM'){
                            echo'
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->nama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">NIK: '.$data_utama->nik.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">TTL: '.$data_utama->tempat_lahir.', '.$this->Main_model->convert_tanggal($data_utama->tanggal_lahir).'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan: '.$data_utama->pekerjaan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Agama: '.$data_utama->agama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt.'/ '.$data_utama->rw.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pengajuan: '.$this->Main_model->convert_datetime($data_utama->created_at).'</label>
                                </div>
                            ';
                        }elseif($judul=='Surat Pengantar KK'){
                            echo'
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->nama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor KK: '.$data_utama->kk.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat: '.$data_utama->alamat.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Dusun/ Dukuh/ Kampung: '.$data_utama->dusun.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt.'/ '.$data_utama->rw.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pengajuan: '.$this->Main_model->convert_datetime($data_utama->created_at).'</label>
                                </div>
                            ';
                        }elseif($judul=='Surat Pengantar KTP'){
                            echo'
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->nama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">NIK: '.$data_utama->nik.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Permohonan: '.$data_utama->permohonan_ktp.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor KK: '.$data_utama->kk.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat: '.$data_utama->alamat.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt.'/ '.$data_utama->rw.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Kode Pos: '.$data_utama->kode_pos.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pengajuan: '.$this->Main_model->convert_datetime($data_utama->created_at).'</label>
                                </div>
                            ';
                        }elseif($judul=='Surat Keterangan Domisili'){
                            echo'
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->nama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Kebangsaan: '.$data_utama->kebangsaan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Keperluan: '.$data_utama->keperluan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">TTL: '.$data_utama->tempat_lahir.', '.$this->Main_model->convert_tanggal($data_utama->tanggal_lahir).'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan: '.$data_utama->pekerjaan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat: '.$data_utama->alamat.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt.'/ '.$data_utama->rw.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Agama: '.$data_utama->agama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan: '.$data_utama->keterangan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pengajuan: '.$this->Main_model->convert_datetime($data_utama->created_at).'</label>
                                </div>
                            ';
                        }elseif($judul=='Surat Keterangan Usaha'){
                            echo'
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->nama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Usaha: '.$data_utama->jenis_usaha.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">TTL: '.$data_utama->tempat_lahir.', '.$this->Main_model->convert_tanggal($data_utama->tanggal_lahir).'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan: '.$data_utama->pekerjaan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Usaha: '.$data_utama->nama_usaha.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt.'/ '.$data_utama->rw.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Agama: '.$data_utama->agama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pengajuan: '.$this->Main_model->convert_datetime($data_utama->created_at).'</label>
                                </div>
                            ';
                        }elseif($judul=='Surat Pengantar SKTM'){
                            echo'
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->nama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">NIK: '.$data_utama->nik.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">TTL: '.$data_utama->tempat_lahir.', '.$this->Main_model->convert_tanggal($data_utama->tanggal_lahir).'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan: '.$data_utama->pekerjaan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Kebangsaan: '.$data_utama->kebangsaan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt.'/ '.$data_utama->rw.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Agama: '.$data_utama->agama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pengajuan: '.$this->Main_model->convert_datetime($data_utama->created_at).'</label>
                                </div>
                            ';
                        }elseif($judul=='Pengajuan Surat Keterangan Pindah'){
                            echo'
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->nama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">NIK: '.$data_utama->nik.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">TTL: '.$data_utama->tempat_lahir.', '.$this->Main_model->convert_tanggal($data_utama->tanggal_lahir).'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan: '.$data_utama->pekerjaan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Pendidikan: '.$data_utama->pendidikan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt.'/ '.$data_utama->rw.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Agama: '.$data_utama->agama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pengajuan: '.$this->Main_model->convert_datetime($data_utama->created_at).'</label>
                                </div>
                            ';
                        }elseif($judul=='Pengajuan Surat Keterangan/ Pengantar'){
                            echo'
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->nama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">NIK: '.$data_utama->nik.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">TTL: '.$data_utama->tempat_lahir.', '.$this->Main_model->convert_tanggal($data_utama->tanggal_lahir).'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan: '.$data_utama->pekerjaan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Keperluan: '.$data_utama->keperluan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt.'/ '.$data_utama->rw.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Agama: '.$data_utama->agama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pengajuan: '.$this->Main_model->convert_datetime($data_utama->created_at).'</label>
                                </div>
                            ';
                        }elseif($judul=='Surat Pengantar SKTM Pendidikan'){
                            echo'
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->nama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">NIK: '.$data_utama->nik.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">TTL: '.$data_utama->tempat_lahir.', '.$this->Main_model->convert_tanggal($data_utama->tanggal_lahir).'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan: '.$data_utama->pekerjaan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Kebangsaan: '.$data_utama->kebangsaan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt.'/ '.$data_utama->rw.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Agama: '.$data_utama->agama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Ayah: '.$data_utama->nama_ayah.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Ibu: '.$data_utama->nama_ibu.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pengajuan: '.$this->Main_model->convert_datetime($data_utama->created_at).'</label>
                                </div>
                            ';
                        }elseif($judul=='Surat Pengantar SKCK'){
                            echo'
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->nama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">NIK: '.$data_utama->nik.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">TTL: '.$data_utama->tempat_lahir.', '.$this->Main_model->convert_tanggal($data_utama->tanggal_lahir).'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan: '.$data_utama->pekerjaan.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt.'/ '.$data_utama->rw.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Agama: '.$data_utama->agama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pengajuan: '.$this->Main_model->convert_datetime($data_utama->created_at).'</label>
                                </div>
                            ';
                        }elseif($judul=='Surat Pengantar Kematian'){
                            $birthDate = new DateTime($data_utama->tanggal_lahir);
                            $today = new DateTime($data_utama->tanggal_meninggal);
                            if ($birthDate > $today) { 
                                exit("0 tahun 0 bulan 0 hari");
                            }
                            $y = $today->diff($birthDate)->y;
                            echo'
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->nama.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Umur: '.$y.' tahun</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin: '.$data_utama->jenis_kelamin.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">TTL: '.$data_utama->tempat_lahir.', '.$this->Main_model->convert_tanggal($data_utama->tanggal_lahir).'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tempat Meninggal: '.$data_utama->tempat_meninggal.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt.'/ '.$data_utama->rw.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Sebab Meninggal: '.$data_utama->sebab_kematian.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Meninggal: '.$this->Main_model->convert_datetime($data_utama->tanggal_meninggal).'</label>
                                </div>
                                <hr>
                                Pelapor
                                <hr>
                                <div class="form-group">
                                    <label for="">Nama: '.$data_utama->pelapor.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Hubungan: '.$data_utama->hubungan_pelapor.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat: '.$data_utama->desa_pelapor.'</label>
                                </div>
                                <div class="form-group">
                                    <label for="">RT/ RW: '.$data_utama->rt_pelapor.'/ '.$data_utama->rw_pelapor.'</label>
                                </div>
                            ';
                        }else{
                            echo'';
                        }
                        ?>
                    </form>
                </div>
                <div class="col-md-6">
                    <embed type="application/pdf" src="<?= $data_utama->file; ?>" width="100%" height="700"></embed>
                </div>
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
    <script src="<?= base_url().'assets_dashboard/'; ?>js/scripts.js"></script>
</body>

</html>