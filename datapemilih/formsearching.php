<html>
<head>
<title> Halaman Pencarian </title>
</head>
<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
<style type="text/css">
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
    }
    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 14px arial;
    }
</style>
<script>
    $(document).ready(function(){
      $(".preloader").fadeOut();
    })
</script>

<body
style="background: url(cek-data-pemilih.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;"
>
<div class="preloader">
  <div class="loading">
    <img src="poi.gif" width="80">
  </div>
</div>
<br>
<br>
<br>
<br>
<br>
<div class="container">
  <form name="formcari" method="post" action="search_exe.php">
  	<div class="alert alert-success">
  	  <center>
	  <strong>LINDUNGI HAK PILIHMU</strong><br>
	  <strong>CEK DATA ANDA</strong>
	  <p>PEMILIHAN UMUM TAHUN 2019</p>
	  </center>
	  	<div class="form-group">
		  <input type="text" class="form-control" name="namapemilih" placeholder="Masukkan NIK Anda" required pattern=".{16}" min="16" title="Masukkan 16 Digit Nomor KTP Anda">
		</div>

	  <right><button type="submit" class="btn btn-success" name="submit" id="submit" >Cari Data</button></right>
	</div>
  </form>
</div>
<link href="main.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="main.js"></script>
</body>
</html>