<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cek DPT Batang Online</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="kpu.png" type="image/png">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
    // fungsi yang dipanggil ketika form di submit
    // lihat baris 5 onSubmit
    function validasi()
        {
    //        menangkap variabel nip dari form, 
    //        my form adalah id dari form, lihat baris 5
    //        nip adalah id inputan, lihat baris 6
            var nik=document.forms["myform"]["nik"].value;
            
    //        membuat variabel numbers bernilai angka 0 s/d 9
            var numbers=/^[0-9]+$/;
            
    //        validasi nip tidak boleh kosong (required)
            if (nik==null || nik=="")
              {
              swal("NIK tidak boleh kosong !");
              return false;
              };
              
    //        validasi nip harus berupa angka
    //        dengan membandingkan dengan variabel number yang dibuat pada baris 21
            if (!nik.match(numbers))
              {
              swal("NIK harus angka !");
              return false;
              };
              
    //        validasi nip harus 18 digit pakai length javascript
            if (nik.length!=16)
              {
              swal("NIK harus 16 digit");
              return false;
              };
              
    //         jika ada validasi untuk inputan lain letakkan disini
    //        ...
         }
    </script>

    <style type="text/css">
    /*PRELOADING------------ */
    #overlayer {
      width:100%;
      height:100%;  
      position:absolute;
      z-index:1;
      background:#fff;
      padding: auto;
    }
    .loader {
      display: inline-block;
      width: 50px;
      height: 50px;
      position: absolute;
      z-index:3;
      border: 15px solid #ff6600;
      top: 50%;
      left: 45%;
      animation: loader 2s infinite ease;
    }

    .loader-inner {
      vertical-align: top;
      margin: auto;
      display: inline-block;
      width: 100%;
      background-color: #9f4000;
      animation: loader-inner 2s infinite ease-in;
    }

    @keyframes loader {
      0% {
        transform: rotate(0deg);
      }
      
      25% {
        transform: rotate(180deg);
      }
      
      50% {
        transform: rotate(180deg);
      }
      
      75% {
        transform: rotate(360deg);
      }
      
      100% {
        transform: rotate(360deg);
      }
    }

    @keyframes loader-inner {
      0% {
        height: 0%;
      }
      
      25% {
        height: 0%;
      }
      
      50% {
        height: 100%;
      }
      
      75% {
        height: 100%;
      }
      
      100% {
        height: 0%;
      }
    }

    .input-upper { text-transform: uppercase }
    .input-upper::-webkit-input-placeholder { text-transform: none }
    .input-upper::-moz-placeholder { text-transform: none }
    .input-upper:-moz-placeholder { text-transform: none }
    .input-upper:-ms-placeholder { text-transform: none }

    </style>
    <script type="text/javascript">
      $(window).load(function() {
        $(".loader").delay(2000).fadeOut("slow");
        $("#overlayer").delay(2000).fadeOut("slow");
      })
    </script>
</head>

<body
style="background: url(cek-data-pemilih.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;"
>
    <!-- Start your project here-->
    <div style="">
        <div class="flex-center flex-column animated fadeIn mb-4">
          <div class="row">
            <div class="col-sm">
            <center>
            <br>
            <img src="kpubatang.png" alt="1" width="90%">
            </center>
            <br><br>
            </div>
            <div class="col-sm">
            <form name="formcari" method="post" action="simpandata.php" onSubmit="return validasi()" id="myform">
            <div class="alert alert-success">
              <center>
              <strong>MASUKKAN DATA PEMILIH BARU</strong><br>
              <p>#jadilahsahabatkpu</p>
              <br>
              </center>
                <div class="form-group" class="animated fadeIn mb-4">
                  <input id="nik" type="number" class="form-control" name="nik" placeholder="Masukkan NIK" pattern="[0-9]{16}" title="Masukkan 16 Digit Nomor KTP Anda" required>
                  <br>
                  <input id="nama" type="text" class="form-control input-upper" name="namapemilih" placeholder="Nama Lengkap" title="Masukkan Nama Lengkap" required>
                  <br>
                  <input id="nama" type="text" class="form-control input-upper" name="tempatlahir" placeholder="Tempat Lahir" title="Masukkan Tempat Lahir Anda" required>
                  <br>
                  <label for="exampleFormControlSelect1">Tanggal Lahir</label>
                  <input id="nama" type="date" timezone="[[timezone]]" class="form-control" name="tanggallahir" placeholder="Tanggal Lahir" title="Masukkan Tempat Lahir Anda" required>
                  <br>
                  <div class="form-group">
                    <select class="form-control" id="exampleFormControlSelect1" name='jeniskelamin' required>
                      <option value=''>Jenis Kelamin</option>
                      <option value='L'>LAKI-LAKI</option>
                      <option value='P'>PEREMPUAN</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" id="exampleFormControlSelect1" name='statusnikah' required>
                      <option value=''>Status Nikah</option>
                      <option value='B'>BELUM</option>
                      <option value='S'>SUDAH</option>
                      <option value='P'>PERNAH</option>
                    </select>
                  </div>
                  <input id="nama" type="text" class="form-control input-upper" name="kecamatan" placeholder="Kecamatan" title="Kecamatan" required>
                  <br>
                  <input id="nama" type="text" class="form-control input-upper" name="desa" placeholder="Desa / Kelurahan" title="Desa / Kelurahan" required>
                </div>
                <div class="row">
                  <div class="col-6">
                  <input id="rt" type="number" class="form-control" name="rt" placeholder="RT" pattern="[0-9]" title="RT" required>
                  </div>
                  <div class="col-6">
                  <input id="rw" type="number" class="form-control" name="rw" placeholder="RW" pattern="[0-9]" title="RW" required>
                  </div>
                </div>
                <br>
              <right><button type="submit" class="btn btn-success" name="submit" id="submit" >Simpan Data</button></right>
            </div>
            </form>
            <br>
            </div>
          </div>
        </div>
    </div>
    
    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>