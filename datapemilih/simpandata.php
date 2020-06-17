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
            if (isset($_POST['submit']))
            { 
                //menerima dan membaca data yang di terima via form metode POST
                $nik= $_POST['nik'];

                //memilih table ke satu dari database mysql
                $query_cek_1 = "SELECT * FROM daftarpemilih WHERE nik LIKE '%$nik%'";
                $sql1 = mysqli_query($mysqli,$query_cek_1);

                //membuat jumlah hasil pencarian pada table ke satu
                //dengan fungsi mysql_num_rows()
                $jumlah1 = mysqli_num_rows($sql1); 

                //jika hasil pada table ke satu lebih dari pada 0 maka akan di proses
                if ($jumlah1 > 0)
                {
                    //menampilkan jumlah hasil pencarian pada table ke satu
                    //echo '<p>Ditemukan '.$jumlah1.' data yang sesuai pada table ke satu!</p>';
                    
                    //membuat pengulangan dengan fungsi while
                    //untuk tampilan hasil table ke satu
                    echo "Data Anda telah terdaftar di sistem Kami.";
                }

                //jika data tidak di temukan pada table ke satu
                //maka akan dilanjutkan ke table yang ke dua
                else 
                {
                    //memilih table ke satu dari database mysql
                    $query_cek_2 = "SELECT * FROM daftarpemilih2 WHERE nik LIKE '%$nik%'";
                    $sql2 = mysqli_query($mysqli,$query_cek_2);
                    //membuat jumlah hasil pencarian pada table ke dua
                    //dengan fungsi mysql_num_rows()
                    $jumlah2 = mysqli_num_rows($sql2); 
                    
                    //jika hasil pada table ke dua lebih dari pada 0 maka akan di proses
                    if ($jumlah2 > 0)
                    {
                        //menampilkan jumlah hasil pencarian pada table ke dua
                        // echo '<p>Ditemukan '.$jumlah2.' data yang sesuai pada table ke dua!</p>';
                            
                        //membuat pengulangan dengan fungsi while
                        //untuk tampilan hasil table ke dua
                        echo "Data Anda telah terdaftar di sistem Kami.";
                    }

                    //jika data tidak di temukan pada table ke dua, maka akan dilanjutkan ke table yang ke tiga
                    else
                    {
                    //memilih table ke tiga dari database mysql
                    $query_cek_3 = "SELECT * FROM daftarpemilih3 WHERE nik LIKE '%$nik%'";
                    $sql3 = mysqli_query($mysqli,$query_cek_3);
                    //membuat jumlah hasil pencarian pada table ke tiga
                    //dengan fungsi mysql_num_rows()
                    $jumlah3 = mysqli_num_rows($sql3); 
                    
                    //jika hasil pada table ke tiga lebih dari pada 0 maka akan di proses
                    if ($jumlah3 > 0)
                    {
                        //menampilkan jumlah hasil pencarian pada table ke dua
                        //echo '<p>Ditemukan '.$jumlah3.' data yang sesuai pada table ke tiga!</p>';
                        
                        //membuat pengulangan dengan fungsi while
                        //untuk tampilan hasil table ke tiga
                        echo "Data Anda telah terdaftar di sistem Kami.";
                    }
                    
                    //jika semua data tidak di temukan pada ke 3 table
                    else
                    {
                        //memilih table ke tiga dari database mysql
                        $query_cek_4 = "SELECT * FROM daftarpemilih4 WHERE nik LIKE '%$nik%'";
                        $sql4 = mysqli_query($mysqli,$query_cek_4);
                        //membuat jumlah hasil pencarian pada table ke tiga
                        //dengan fungsi mysql_num_rows()
                        $jumlah4 = mysqli_num_rows($sql4); 
                        
                        //jika hasil pada table ke tiga lebih dari pada 0 maka akan di proses
                        if ($jumlah4 > 0)
                        {
                            //menampilkan jumlah hasil pencarian pada table ke dua
                            //echo '<p>Ditemukan '.$jumlah3.' data yang sesuai pada table ke tiga!</p>';
                            
                            //membuat pengulangan dengan fungsi while
                            //untuk tampilan hasil table ke tiga
                            echo "Data Anda telah terdaftar di sistem Kami.";
                        }
                        else{
                            $nama= $_POST['namapemilih'];
                            $tempatlahir= $_POST['tempatlahir'];
                            $tanggallahir= $_POST['tanggallahir'];
                            $jeniskelamin= $_POST['jeniskelamin'];
                            $statusnikah= $_POST['statusnikah'];
                            $kecamatan= $_POST['kecamatan'];
                            $desa= $_POST['desa'];
                            $rt= $_POST['rt'];
                            $rw= $_POST['rw'];
                            $tanggaldaftar= date('Y-m-d H:i:s');
                            $insertdatabaru="INSERT INTO `daftarpemilih4` (`dpid`, `kecamatan`, `desa/kelurahan`, `nkk`, `nik`, `namapemilih`, `tempatlahir`, `tanggallahir`, `status`, `lkpr`, `alamat`, `rt`, `rw`, `tps`, `created_at`) VALUES ('', '$kecamatan', '$desa', '$nik', '$nik', '$nama', '$tempatlahir', '$tanggallahir', '$statusnikah', '$jeniskelamin', '$desa', '$rt', '$rw', '', '$tanggaldaftar');";
                            mysqli_query($mysqli,$insertdatabaru);
                            include 'connect.php';
                            echo 'Terima kasih, data Anda akan Kami proses.';
                        }
                    }
                    }
                }
            }

            //jika form pencarian kosong
            else
            {
                echo 'Silahkan lengkapi data Anda terlebih dahulu!';
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