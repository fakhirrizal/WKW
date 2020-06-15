<!DOCTYPE html>
<html>
<head>
<title> Hasil Pencarian </title>
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
style="background: url() no-repeat center center fixed; 
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

<div class="container">
	<br><br><center>
	<button type="button" class="btn btn-success" width="100%">HASIL PENCARIAN</button>
	</center><br>	
	
	<?php
//include kan koneksi ke database disini
include 'connect.php';

//jika form pencarian mengandung isi maka akan di proses
if ((isset($_POST['submit'])) AND ($_POST['namapemilih'] <> ""))
{ 
  //menerima dan membaca data yang di terima via form metode POST
  $namapemilih= $_POST['namapemilih'];
  
  //memilih table ke satu dari database mysql
  $sql1 = mysql_query("SELECT * FROM daftarpemilih WHERE nik LIKE '%$namapemilih%' ") or die(mysql_error());
  
  //membuat jumlah hasil pencarian pada table ke satu
  //dengan fungsi mysql_num_rows()
  $jumlah1 = mysql_num_rows($sql1); 
  
  //jika hasil pada table ke satu lebih dari pada 0 maka akan di proses
  if ($jumlah1 > 0)
  {
   //menampilkan jumlah hasil pencarian pada table ke satu
   //echo '<p>Ditemukan '.$jumlah1.' data yang sesuai pada table ke satu!</p>';
   
   //membuat pengulangan dengan fungsi while
   //untuk tampilan hasil table ke satu
    echo "<center>";
    echo "Selamat anda terdaftar di :";
    echo "<table cellpadding='0' cellspacing='0' width='100%'>";
    echo "
    <thead>
		<tr bgcolor='orange'>
			<th width='30px'>Kecamatan</th>
			<th>Desa/Kelurahan</th>
			<th>Nama Pemilih</th>
			<th>Tempat Lahir</th>
			<th>Jenis Kelamin</th>
			<th>Rt</th>
			<th>Rw</th>
			<th>TPS</th>
		</tr>
	</thead>";
      while ($data = mysql_fetch_array($sql1)) {  //fetch the result from query into an array
      echo "
		<tbody>
		<tr>
			<td width='70px' valign='middle' data-header-title='Kecamatan'>".$data['kecamatan']."</td>
			<td valign='middle' data-header-title='Desa/Kelurahan'>".$data['desa/kelurahan']."</td>
			<td valign='middle' data-header-title='Nama Pemilih'>".$data['namapemilih']."</td>
			<td valign='middle' data-header-title='Tempat Lahir'>".$data['tempatlahir']."</td>
			<td valign='middle' data-header-title='Jenis Kelamin'>".$data['lkpr']."</td>
			<td valign='middle' data-header-title='Rt'>".$data['rt']."</td>
			<td valign='middle' data-header-title='Rw'>".$data['rw']."</td>
			<td valign='middle' data-header-title='TPS'>".$data['tps']."</td>
		</tr>
		</tbody>";
      }
      echo "</table>";
  }

  //jika data tidak di temukan pada table ke satu
  //maka akan dilanjutkan ke table yang ke dua
  else 
  {
   //memilih table ke satu dari database mysql
   $sql2 = mysql_query("SELECT * FROM daftarpemilih2 WHERE nik LIKE '%$namapemilih%' ") or die(mysql_error());
   
   //membuat jumlah hasil pencarian pada table ke dua
   //dengan fungsi mysql_num_rows()
   $jumlah2 = mysql_num_rows($sql2); 
   
   //jika hasil pada table ke dua lebih dari pada 0 maka akan di proses
   if ($jumlah2 > 0)
   {
   //menampilkan jumlah hasil pencarian pada table ke dua
   // echo '<p>Ditemukan '.$jumlah2.' data yang sesuai pada table ke dua!</p>';
    
   //membuat pengulangan dengan fungsi while
   //untuk tampilan hasil table ke dua
    echo "<center>";
    echo "Selamat anda terdaftar di :";
    echo "<table cellpadding='0' cellspacing='0' width='100%'>";
    echo "
    <thead>
		<tr bgcolor='orange'>
			<th width='30px'>Kecamatan</th>
			<th>Desa/Kelurahan</th>
			<th>Nama Pemilih</th>
			<th>Tempat Lahir</th>
			<th>Jenis Kelamin</th>
			<th>Rt</th>
			<th>Rw</th>
			<th>TPS</th>
		</tr>
	</thead>";
      while ($data = mysql_fetch_array($sql2)) {  //fetch the result from query into an array
      echo "
      <tbody>
		<tr>
			<td width='70px' valign='middle' data-header-title='Kecamatan'>".$data['kecamatan']."</td>
			<td valign='middle' data-header-title='Desa/Kelurahan'>".$data['desa/kelurahan']."</td>
			<td valign='middle' data-header-title='Nama Pemilih'>".$data['namapemilih']."</td>
			<td valign='middle' data-header-title='Tempat Lahir'>".$data['tempatlahir']."</td>
			<td valign='middle' data-header-title='Jenis Kelamin'>".$data['lkpr']."</td>
			<td valign='middle' data-header-title='Rt'>".$data['rt']."</td>
			<td valign='middle' data-header-title='Rw'>".$data['rw']."</td>
			<td valign='middle' data-header-title='TPS'>".$data['tps']."</td>
		</tr>
		</tbody>";
      }
      echo "</table>";
    }
  
  //jika data tidak di temukan pada table ke dua, maka akan dilanjutkan ke table yang ke tiga
  else
  {
  //memilih table ke tiga dari database mysql
  $sql3 = mysql_query("SELECT * FROM daftarpemilih3 WHERE nik LIKE '%$namapemilih%' ") or die(mysql_error());
  
  //membuat jumlah hasil pencarian pada table ke tiga
  //dengan fungsi mysql_num_rows()
  $jumlah3 = mysql_num_rows($sql3); 
  
  //jika hasil pada table ke tiga lebih dari pada 0 maka akan di proses
  if ($jumlah3 > 0)
  {
   //menampilkan jumlah hasil pencarian pada table ke dua
   //echo '<p>Ditemukan '.$jumlah3.' data yang sesuai pada table ke tiga!</p>';
   
   //membuat pengulangan dengan fungsi while
   //untuk tampilan hasil table ke tiga
    echo "<center>";
    echo "Selamat anda terdaftar di :";
    echo "<table cellpadding='0' cellspacing='0' width='100%'>";
    echo "
    <thead>
		<tr bgcolor='orange'>
			<th width='30px'>Kecamatan</th>
			<th>Desa/Kelurahan</th>
			<th>Nama Pemilih</th>
			<th>Tempat Lahir</th>
			<th>Jenis Kelamin</th>
			<th>Rt</th>
			<th>Rw</th>
			<th>TPS</th>
		</tr>
	</thead>";
      while ($data = mysql_fetch_array($sql3)) {  //fetch the result from query into an array
      echo "
      <tbody>
		<tr>
			<td width='70px' valign='middle' data-header-title='Kecamatan'>".$data['kecamatan']."</td>
			<td valign='middle' data-header-title='Desa/Kelurahan'>".$data['desa/kelurahan']."</td>
			<td valign='middle' data-header-title='Nama Pemilih'>".$data['namapemilih']."</td>
			<td valign='middle' data-header-title='Tempat Lahir'>".$data['tempatlahir']."</td>
			<td valign='middle' data-header-title='Jenis Kelamin'>".$data['lkpr']."</td>
			<td valign='middle' data-header-title='Rt'>".$data['rt']."</td>
			<td valign='middle' data-header-title='Rw'>".$data['rw']."</td>
			<td valign='middle' data-header-title='TPS'>".$data['tps']."</td>
		</tr>
		</tbody>";
      }
      echo "</table>";
  }
   
  //jika semua data tidak di temukan pada ke 3 table
  else
  {
  echo "<center><img src='tanda.svg' width='30px'></center><br>";
  echo "<div align='center'>Mohon maaf !, Nama Anda Belum Terdaftar sebagai pemilih di Kabupaten Batang, Silahkan cek / daftarkan diri anda di Desa/Kelurahan maupun PPS setempat. <br><br><a href='formsearching.php'>Kembali</a></div>";
  }
  }
  }
  }
  
  //jika form pencarian kosong
  else
  {
  echo 'Silahkan masukkan kata kunci yang kamu cari!';
  }
?>
</div>
<link href="main.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="main.js"></script>
<link rel="stylesheet" type="text/css" href="table.css">
</body>
</html>
