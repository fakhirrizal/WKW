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
    <style type="text/css">
      table {
        font-family: sans-serif;
      }
      th, td {
        padding: 10px;
      }

      thead th {
        text-align:left;
      }
      tbody tr:nth-of-type(odd) {
        background: #e0e0e0;
      }
      @media (max-width: 600px) {
            /* make tds into single column full width rows */
            tr,td {
              display: block;
              width: 100%;
               padding: 5px;
            }  
        
             /* hide table head */
            thead {
              display: none;
            }
        
            /* place data attribute before td as a label */
            td[data-header-title]:before {
              content: attr(data-header-title)'';
              display: block;
                color: #666;  
                /* labels will stack by default but optionally float to left */
                float:left;
                width:40%;
              
            }
            tbody {
                border-collapse: collapse;
              display:block;
            }
            tbody tr {
              margin-bottom:20px;
              border-bottom: 10px solid #222222;
              display:block;
           }
            /* unset background used on desktop view */
           tbody tr:nth-of-type(odd) {
              background: transparent;
            }
            tr td:nth-of-type(odd) {
                background:#eee;
            } 
      }

    </style>
</head>

<body
style="background: url(cek-data-pemilih.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;"
>

    <!-- Start your project here-->
    <div style="height: 80v">
        <div class="flex-center flex-column animated rubberBand mb-4">
            <br> <br> <br> 
            <center>
            <img src="logo.svg" alt="1" width="250px">
            </center>
            <br> 
            
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
              echo "SELAMAT !!!<br> Anda telah terdaftar dalam Daftar Pemilih Tetap (DPT) Pemilihan Umum Tahun 2019<br>Kabupaten Batang<br><br>";
              echo "<table class='table table-responsive' width='100%'>";
              echo "
              <thead>
              <tr bgcolor='orange'>
                <th width='30%'>Kecamatan</th>
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
                <td width='70%' valign='middle' data-header-title='Kecamatan'>".$data['kecamatan']."</td>
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
              echo "SELAMAT !!!<br> Anda telah terdaftar dalam Daftar Pemilih Tetap (DPT) Pemilihan Umum Tahun 2019<br>Kabupaten Batang<br><br>";
              echo "<table class='table table-responsive' width='100%'>";
              echo "
              <thead>
              <tr bgcolor='orange'>
                <th width='30%'>Kecamatan</th>
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
                <td width='70%' valign='middle' data-header-title='Kecamatan'>".$data['kecamatan']."</td>
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
              echo "SELAMAT !!!<br> Anda telah terdaftar dalam Daftar Pemilih Tetap (DPT) Pemilihan Umum Tahun 2019<br>Kabupaten Batang<br><br>";
              echo "<table class='table table-responsive' width='100%'>";
              echo "
              <thead>
              <tr bgcolor='orange'>
                <th width='30%'>Kecamatan</th>
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
                <td width='70%' valign='middle' data-header-title='Kecamatan'>".$data['kecamatan']."</td>
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
            echo "<div align='center'>
            Mohon maaf !, <br>Nama Anda Belum Terdaftar sebagai pemilih di Kabupaten Batang, <br>Silahkan cek / daftarkan diri anda di Desa/Kelurahan <br>maupun PPS setempat. <br></div>";
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
          <br>
          <a href="https://pcom.co.id/datapemilih">
            <button type="button" class="btn btn-success" width="50%">Kembali</button>
          </a>
          <br><br><br>
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
