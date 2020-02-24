<?php
$token = "734624626:AAHX1kg6PX_EvduhVdZszFEr6WkiaXR0ydk";
$usernamebot="@datum_telkom_bot";
define('BOT_TOKEN', $token); 

define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

$debug = false;

function exec_curl_request($handle)
{
    $response = curl_exec($handle);

    if ($response === false) {
        $errno = curl_errno($handle);
        $error = curl_error($handle);
        error_log("Curl returned error $errno: $error\n");
        curl_close($handle);

        return false;
    }

    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    curl_close($handle);

    if ($http_code >= 500) {
    sleep(10);

        return false;
    } elseif ($http_code != 200) {
        $response = json_decode($response, true);
        error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
        if ($http_code == 401) {
            throw new Exception('Invalid access token provided');
        }

        return false;
    } else {
        $response = json_decode($response, true);
        if (isset($response['description'])) {
            error_log("Request was successfull: {$response['description']}\n");
        }
        $response = $response['result'];
    }

    return $response;
}

function apiRequest($method, $parameters = null)
{
    if (!is_string($method)) {
        error_log("Method name must be a string\n");

        return false;
    }

    if (!$parameters) {
        $parameters = [];
    } elseif (!is_array($parameters)) {
        error_log("Parameters must be an array\n");

        return false;
    }

    foreach ($parameters as $key => &$val) {
    if (!is_numeric($val) && !is_string($val)) {
        $val = json_encode($val);
    }
    }
    $url = API_URL.$method.'?'.http_build_query($parameters);

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

    return exec_curl_request($handle);
}

function apiRequestJson($method, $parameters)
{
    if (!is_string($method)) {
        error_log("Method name must be a string\n");

        return false;
    }

    if (!$parameters) {
        $parameters = [];
    } elseif (!is_array($parameters)) {
        error_log("Parameters must be an array\n");

        return false;
    }

    $parameters['method'] = $method;

    $handle = curl_init(API_URL);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
    curl_setopt($handle, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    return exec_curl_request($handle);
}

if (strlen(BOT_TOKEN) < 20) {
    die(PHP_EOL."-> -> Token BOT API nya mohon diisi dengan benar!\n");
}

function getUpdates($last_id = null)
{
    $params = [];
    if (!empty($last_id)) {
        $params = ['offset' => $last_id + 1, 'limit' => 1];
    }
  return apiRequest('getUpdates', $params);
}

function sendMessage($idpesan, $idchat, $pesan, $menu)
{
    $data = [
    'chat_id'             => $idchat,
    'text'                => $pesan,
    'parse_mode'          => 'HTML',
    'reply_markup'        => $menu,
    'reply_to_message_id' => $idpesan,
  ];

    return apiRequest('sendMessage', $data);
}

function processMessage($message)
{
    global $database;
    if ($GLOBALS['debug']) {
        print_r($message);
    }

    if (isset($message['message'])) {
        $menu = '';
        $sumber = $message['message'];
        $idpesan = $sumber['message_id'];
        $idchat = $sumber['chat']['id'];
        $callback_query = $message['callback_query'];
        $data_callback = $callback_query['data'];
        
        $username = $sumber["from"]["username"];
        $nama = $sumber['from']['first_name'].' '.$sumber['from']['last_name'];
        $iduser = $sumber['from']['id'];

        include 'koneksi.php';
        $q_cek_token_user = "SELECT a.* FROM user a WHERE a.verification_token='$iduser'"; 
        $get_data_profil_pengguna = mysqli_query($mysqli,$q_cek_token_user);
        $cek_profil_pengguna = mysqli_num_rows($get_data_profil_pengguna);	
        if($cek_profil_pengguna==NULL){
            $pesan = $sumber['text'];
            if (preg_match("/^\/view_(\d+)$/i", $pesan, $cocok)) {
                $pesan = "/view $cocok[1]";
            }

            if (preg_match("/^\/hapus_(\d+)$/i", $pesan, $cocok)) {
                $pesan = "/hapus $cocok[1]";
            }

            $pecah2 = explode(' ', $pesan, 3);
            $katake1 = strtolower($pecah2[0]);
            $katake2 = strtolower($pecah2[1]);
            $katake3 = strtolower($pecah2[2]);
            
            $pecah = explode(' ', $pesan, 2);
            $katapertama = strtolower($pecah[0]);

            if($katapertama=='/login'){
                if (isset($pecah2[1])) {
                    $username = $pecah2[1];
                    $password = $pecah2[2];
                    
                    include 'koneksi.php';
                    $q_cek_username = "SELECT a.* FROM user a WHERE a.username='$username'"; 
                    $get_data_profil = mysqli_query($mysqli,$q_cek_username);
                    $cek_username = mysqli_num_rows($get_data_profil);	
                    if($cek_username==NULL){ 
                        $text = 'Akun Anda tidak terdaftar, silahkan hubungi admin!';
                    }else
                    {  
                        $q_cek_token = "SELECT a.*,b.fullname,b.phone_number,r.role_id,x.wo,x.ps,x.wo_terkendala,x.session_date FROM user a LEFT JOIN user_profile b ON a.id=b.user_id LEFT JOIN user_to_role r ON a.id=r.user_id LEFT JOIN resume_user x ON a.id=x.user_id WHERE a.username='$username' AND a.pass='$password'"; 
                        $get_data_pengguna = mysqli_query($mysqli,$q_cek_token);
                        $cek_profil = mysqli_num_rows($get_data_pengguna);	
                        if($cek_profil==NULL){ 
                            $text = 'Password yang Anda masukkan salah!';
                        }else
                        {  
                            $reset_data="UPDATE user SET 
                            verification_token='' WHERE verification_token='$iduser'";
                            mysqli_query($mysqli,$reset_data);
                            $upd_data="UPDATE user SET 
                            verification_token='$iduser' WHERE username='$username' AND pass='$password'";
                            mysqli_query($mysqli,$upd_data);
                            $data = mysqli_fetch_array($get_data_pengguna);
                            $nama = $data['fullname']; 
                            $nohp = $data['phone_number'];				

                            $text .= "\nNama: $nama\nNo. HP: $nohp\n\n";
                            $q_get_module = "SELECT a.*,b.judul FROM user_module a LEFT JOIN module b ON a.id_module=b.id_module WHERE a.user_id='".$data['id']."'"; 
                            $get_data_module = mysqli_query($mysqli,$q_get_module);
                            $row_cnt = mysqli_num_rows($get_data_module);
                            if($row_cnt>1){
                                $text .= "Modul :\n";
                                $no = 1;
                                while($data_module = mysqli_fetch_array($get_data_module)) {
                                    $text .= $no.". ".$data_module['judul']."\n";
                                    $no++;
                                }
                            }else{
                                $data_module = mysqli_fetch_array($get_data_module);
                                $text .= "Modul : ".$data_module['judul']."\n";
                            }
                            if($data['role_id']=='1' OR $data['role_id']=='0'){
                                $text .= "User Role : Admin\n\n";
                            }elseif($data['role_id']=='2'){
                                $text .= "User Role : Sales\n\n";
                            }elseif($data['role_id']=='3'){
                                $text .= "User Role : Organik\n\n";
                            }elseif($data['role_id']=='4'){
                                $text .= "User Role : Teknisi Provisioning\n\n";
                            }elseif($data['role_id']=='5'){
                                $text .= "User Role : Telkom Akses\n\n";
                            }
                            $tanggal_tampil = '';
                            $waktu = explode('-', $data['session_date']);
                            if ($waktu[0]=="01") {
                                $tanggal_tampil = "Januari ".$waktu[1];
                            }elseif ($waktu[0]=="02") {
                                $tanggal_tampil = "Februari ".$waktu[1];
                            }elseif ($waktu[0]=="03") {
                                $tanggal_tampil = "Maret ".$waktu[1];
                            }elseif ($waktu[0]=="04") {
                                $tanggal_tampil = "April ".$waktu[1];
                            }elseif ($waktu[0]=="05") {
                                $tanggal_tampil = "Mei ".$waktu[1];
                            }elseif ($waktu[0]=="06") {
                                $tanggal_tampil = "Juni ".$waktu[1];
                            }elseif ($waktu[0]=="07") {
                                $tanggal_tampil = "Juli ".$waktu[1];
                            }elseif ($waktu[0]=="08") {
                                $tanggal_tampil = "Agustus ".$waktu[1];
                            }elseif ($waktu[0]=="09") {
                                $tanggal_tampil = "September ".$waktu[1];
                            }elseif ($waktu[0]=="10") {
                                $tanggal_tampil = "Oktober ".$waktu[1];
                            }elseif ($waktu[0]=="11") {
                                $tanggal_tampil = "November ".$waktu[1];
                            }elseif ($waktu[0]=="12") {
                                $tanggal_tampil = "Desember ".$waktu[1];
                            }
                            $text .= "Rekap ".$tanggal_tampil."\n\n";
                            if($data['session_date']==date('m-Y')){
                                $text .= "Jumlah PS : ".number_format($data['ps'],0)."\n";
                                $text .= "Jumlah WO : ".number_format($data['wo'],0)."\n";
                                $text .= "Jumlah WO Terkendala : ".number_format($data['wo_terkendala'],0)."\n";
                            }else{
                                $nilai_wo = 0;
                                $nilai_ps = 0;
                                $nilai_wo_terkendala = 0;
                                if($data['role_id']=='1' OR $data['role_id']=='0'){
                                    $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.bulan='".$data['session_date']."'";
                                    $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                    $nilai_ps += mysqli_num_rows($get_data_ps);
                                    $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                    $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                    $nilai_wo += mysqli_num_rows($get_data_wo);
                                    while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                        $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                        $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                        $cek_ps = mysqli_num_rows($get_data_ps);	
                                        if($cek_ps==NULL){
                                            $nilai_wo_terkendala++;
                                        }else{echo'';}
                                    }
                                }elseif($data['role_id']=='2'){
                                    $q_get_ps = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_ps_mtd_3 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."'";
                                    $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                    $nilai_ps += mysqli_num_rows($get_data_ps);
                                    $q_get_wo = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_wo_2 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                    $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                    $nilai_wo += mysqli_num_rows($get_data_wo);
                                    while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                        $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                        $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                        $cek_ps = mysqli_num_rows($get_data_ps);	
                                        if($cek_ps==NULL){
                                            $nilai_wo_terkendala++;
                                        }else{echo'';}
                                    }
                                }elseif($data['role_id']=='3' OR $data['role_id']=='4' OR $data['role_id']=='5'){
                                    $q_get_module = "SELECT c.* FROM user_module a LEFT JOIN sto_module b ON a.id_module=b.id_module LEFT JOIN sto c ON b.id_sto=c.id_sto WHERE a.user_id='".$data['id']."' GROUP BY b.id_sto"; 
                                    $get_data_module = mysqli_query($mysqli,$q_get_module);
                                    $row_cnt = mysqli_num_rows($get_data_module);
                                    if($row_cnt==0){
                                        echo'';
                                    }else{
                                        while($data_sto = mysqli_fetch_array($get_data_module)) {
                                            $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."'";
                                            $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                            $nilai_ps += mysqli_num_rows($get_data_ps);
                                            $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                            $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                            $nilai_wo += mysqli_num_rows($get_data_wo);
                                            while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                                $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                                $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                                $cek_ps = mysqli_num_rows($get_data_ps);	
                                                if($cek_ps==NULL){
                                                    $nilai_wo_terkendala++;
                                                }else{echo'';}
                                            }
                                        }
                                    }
                                }else{
                                    echo"";
                                }
                                $text .= "Jumlah PS : ".number_format($nilai_ps,0)."\n";
                                $text .= "Jumlah WO : ".number_format($nilai_wo,0)."\n";
                                $text .= "Jumlah WO Terkendala : ".number_format($nilai_wo_terkendala,0)."\n";
                            }

                            $replyMarkup = array(
                                'keyboard' => array(
                                    array(array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                                    array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                                ),
                                'resize_keyboard' => true,
                                'one_time_keyboard' => false,
                                'selective' => true
                            );
                            $menu = json_encode($replyMarkup);
                        }
                    } 
                } else {
                    $text = '*ERROR:* _Username dan Password tidak boleh kosong!_';
                    $text .= "\n";
                    $text .= "Format: /login `username` `password`";
                }
            }
            else{
                $text = "Selamat datang!";
                $text .= ' Silahkan login terlebih dahulu!';
                $text .= "\n";
                $text .= 'gunakan perintah /login `username` `password` untuk login';
                $replyMarkup = array(
                    'keyboard' => array(
                        array(array("text" => "Bantuan", "callback_data" => "/bantuan"))
                    ),
                    'resize_keyboard' => true,
                    'one_time_keyboard' => false,
                    'selective' => true
                );
                $menu = json_encode($replyMarkup);
            }
        }
        else{
            if (isset($sumber['text'])) {
                $pesan = $sumber['text'];
                if($pesan=='Home'){
                    $q_cek_token = "SELECT a.*,b.fullname,b.phone_number,r.role_id,x.wo,x.ps,x.wo_terkendala,x.session_date FROM user a LEFT JOIN user_profile b ON a.id=b.user_id LEFT JOIN user_to_role r ON a.id=r.user_id LEFT JOIN resume_user x ON a.id=x.user_id WHERE a.verification_token='$iduser'";
                    $get_data_pengguna = mysqli_query($mysqli,$q_cek_token);
                        
                    $data = mysqli_fetch_array($get_data_pengguna);
                    $nama = $data['fullname']; 
                    $nohp = $data['phone_number'];				

                    $text .= "\nNama: $nama\nNo. HP: $nohp\n\n";
                    $q_get_module = "SELECT a.*,b.judul FROM user_module a LEFT JOIN module b ON a.id_module=b.id_module WHERE a.user_id='".$data['id']."'"; 
                    $get_data_module = mysqli_query($mysqli,$q_get_module);
                    $row_cnt = mysqli_num_rows($get_data_module);
                    if($row_cnt>1){
                        $text .= "Modul :\n";
                        $no = 1;
                        while($data_module = mysqli_fetch_array($get_data_module)) {
                            $text .= $no.". ".$data_module['judul']."\n";
                            $no++;
                        }
                    }else{
                        $data_module = mysqli_fetch_array($get_data_module);
                        $text .= "Modul : ".$data_module['judul']."\n";
                    }
                    if($data['role_id']=='1' OR $data['role_id']=='0'){
                        $text .= "User Role : Admin\n\n";
                    }elseif($data['role_id']=='2'){
                        $text .= "User Role : Sales\n\n";
                    }elseif($data['role_id']=='3'){
                        $text .= "User Role : Organik\n\n";
                    }elseif($data['role_id']=='4'){
                        $text .= "User Role : Teknisi Provisioning\n\n";
                    }elseif($data['role_id']=='5'){
                        $text .= "User Role : Telkom Akses\n\n";
                    }
                    $tanggal_tampil = '';
                    $waktu = explode('-', $data['session_date']);
                    if ($waktu[0]=="01") {
                        $tanggal_tampil = "Januari ".$waktu[1];
                    }elseif ($waktu[0]=="02") {
                        $tanggal_tampil = "Februari ".$waktu[1];
                    }elseif ($waktu[0]=="03") {
                        $tanggal_tampil = "Maret ".$waktu[1];
                    }elseif ($waktu[0]=="04") {
                        $tanggal_tampil = "April ".$waktu[1];
                    }elseif ($waktu[0]=="05") {
                        $tanggal_tampil = "Mei ".$waktu[1];
                    }elseif ($waktu[0]=="06") {
                        $tanggal_tampil = "Juni ".$waktu[1];
                    }elseif ($waktu[0]=="07") {
                        $tanggal_tampil = "Juli ".$waktu[1];
                    }elseif ($waktu[0]=="08") {
                        $tanggal_tampil = "Agustus ".$waktu[1];
                    }elseif ($waktu[0]=="09") {
                        $tanggal_tampil = "September ".$waktu[1];
                    }elseif ($waktu[0]=="10") {
                        $tanggal_tampil = "Oktober ".$waktu[1];
                    }elseif ($waktu[0]=="11") {
                        $tanggal_tampil = "November ".$waktu[1];
                    }elseif ($waktu[0]=="12") {
                        $tanggal_tampil = "Desember ".$waktu[1];
                    }
                    $text .= "Rekap ".$tanggal_tampil."\n\n";
                    if($data['session_date']==date('m-Y')){
                        $text .= "Jumlah PS : ".number_format($data['ps'],0)."\n";
                        $text .= "Jumlah WO : ".number_format($data['wo'],0)."\n";
                        $text .= "Jumlah WO Terkendala : ".number_format($data['wo_terkendala'],0)."\n";
                    }else{
                        $nilai_wo = 0;
                        $nilai_ps = 0;
                        $nilai_wo_terkendala = 0;
                        if($data['role_id']=='1' OR $data['role_id']=='0'){
                            $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.bulan='".$data['session_date']."'";
                            $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                            $nilai_ps += mysqli_num_rows($get_data_ps);
                            $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.bulan='".$data['session_date']."' AND c.canceled='0'";
                            $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                            $nilai_wo += mysqli_num_rows($get_data_wo);
                            while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                $cek_ps = mysqli_num_rows($get_data_ps);	
                                if($cek_ps==NULL){
                                    $nilai_wo_terkendala++;
                                }else{echo'';}
                            }
                        }elseif($data['role_id']=='2'){
                            $q_get_ps = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_ps_mtd_3 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."'";
                            $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                            $nilai_ps += mysqli_num_rows($get_data_ps);
                            $q_get_wo = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_wo_2 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                            $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                            $nilai_wo += mysqli_num_rows($get_data_wo);
                            while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                $cek_ps = mysqli_num_rows($get_data_ps);	
                                if($cek_ps==NULL){
                                    $nilai_wo_terkendala++;
                                }else{echo'';}
                            }
                        }elseif($data['role_id']=='3' OR $data['role_id']=='4' OR $data['role_id']=='5'){
                            $q_get_module = "SELECT c.* FROM user_module a LEFT JOIN sto_module b ON a.id_module=b.id_module LEFT JOIN sto c ON b.id_sto=c.id_sto WHERE a.user_id='".$data['id']."' GROUP BY b.id_sto"; 
                            $get_data_module = mysqli_query($mysqli,$q_get_module);
                            $row_cnt = mysqli_num_rows($get_data_module);
                            if($row_cnt==0){
                                echo'';
                            }else{
                                while($data_sto = mysqli_fetch_array($get_data_module)) {
                                    $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."'";
                                    $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                    $nilai_ps += mysqli_num_rows($get_data_ps);
                                    $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                    $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                    $nilai_wo += mysqli_num_rows($get_data_wo);
                                    while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                        $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                        $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                        $cek_ps = mysqli_num_rows($get_data_ps);	
                                        if($cek_ps==NULL){
                                            $nilai_wo_terkendala++;
                                        }else{echo'';}
                                    }
                                }
                            }
                        }else{
                            echo"";
                        }
                        $text .= "Jumlah PS : ".number_format($nilai_ps,0)."\n";
                        $text .= "Jumlah WO : ".number_format($nilai_wo,0)."\n";
                        $text .= "Jumlah WO Terkendala : ".number_format($nilai_wo_terkendala,0)."\n";
                    }

                    $replyMarkup = array(
                        'keyboard' => array(
                            array(array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                            array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                        ),
                        'resize_keyboard' => true,
                        'one_time_keyboard' => false,
                        'selective' => true
                    );
                    $menu = json_encode($replyMarkup);
                }
                elseif($pesan=='Bantuan'){
                    $text = "Berikut menu yang tersedia:\n\n";
                    $text .= "/start untuk memulai bot\n";
                    $text .= "/home untuk kembali ke menu awal\n";
                    $text .= "/set_bulan `MM-YYYY`\n";
                    $text .= "/help info bantuan ini\n";	 
                    $text .= "/search `SC-XXXX` atau `MYIR-XXXX`\n";	  
                    $text .= "/login `username` `password` untuk login\n";
                    $text .= "/logout";
                    $replyMarkup = array(
                        'keyboard' => array(
                            array(array("text" => "Home", "callback_data" => "/home"), array("text" => "Logout", "callback_data" => "/logout"))
                        ),
                        'resize_keyboard' => true,
                        'one_time_keyboard' => false,
                        'selective' => true
                    );
                    $menu = json_encode($replyMarkup);
                }
                elseif(substr($pesan,0,5)=='MYIR-'){
                    $pecahdata = explode('  ',$pesan);
                    include 'koneksi.php';
                    $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.myir='".$pecahdata[0]."'"; 
                    $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                    while($data_wo = mysqli_fetch_array($get_data_wo)) {
                        $text = 'MYIR : '.$data_wo['myir'];
                        $text .= "\n";
                        $text .= 'STO : '.$data_wo['sto'];
                        $text .= "\n";
                        $q_get_sales = "SELECT c.* FROM sales c WHERE c.kode_sf='".$data_wo['sales']."' LIMIT 1"; 
                        $get_data_sales = mysqli_query($mysqli,$q_get_sales);
                        $cek_sales = mysqli_num_rows($get_data_sales);
                        if($cek_sales==NULL){
                            $text .= 'Kode SF : '.$data_wo['sales'];
                            $text .= "\n";
                        }else{
                            while($data_sales = mysqli_fetch_array($get_data_sales)) {
                                // $text .= 'Kode SF : '.$data_sales['kode_sf'];
                                // $text .= "\n";
                                if($data_sales['username_telegram']==NULL){
                                    $text .= 'Sales : '.$data_sales['nama'];
                                    $text .= "\n";
                                }else{
                                    $text .= 'Sales : <a href="tg://user?id='.$data_sales['username_telegram'].'">'.$data_sales['nama'].'</a>';
                                    $text .= "\n";
                                }
                            }
                        }	
                        $text .= 'MOBI : '.$data_wo['mobi'];
                        $text .= "\n";
                        $text .= 'ODP : '.$data_wo['odp'];
                        $text .= "\n";
                        $text .= 'Customer : '.$data_wo['nama_customer'];
                        $text .= "\n";
                        $text .= 'Sales Action : '.$data_wo['sales_action'];
                        $text .= "\n";
                        $text .= 'Keterangan Sales : '.$data_wo['keterangan_sales'];
                        $text .= "\n";
                        $text .= 'Technical Action : '.$data_wo['technical_action'];
                        $text .= "\n";
                        $text .= 'Technical Information : '.$data_wo['technical_information'];
                        $text .= "\n";
                        $text .= 'Organik Action : '.$data_wo['organik_action'];
                        // $text .= "\n";
                        // $text .= "\n";
                        // $text .= '*untuk mengubah status dengan cara /ubah_wo `myir` `action` `keterangan`';
                    }
                    $replyMarkup = array(
                        'keyboard' => array(
                            // array(array("text" => "Home", "callback_data" => "/home"), array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                            array(array("text" => "Ubah  ".$pecahdata[0]."  Step-1", "callback_data" => "/ubah")),
                            array(array("text" => "Home", "callback_data" => "/home"), array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                        ),
                        'resize_keyboard' => true,
                        'one_time_keyboard' => false,
                        'selective' => true
                    );
                    $menu = json_encode($replyMarkup);
                }
                elseif(preg_match("/Technical Action/i", $pesan)){
                    $pecahdata = explode(' ',$pesan,3);
                    include 'koneksi.php';
                    $q_cek_token = "SELECT x.session_date,r.role_id,a.id FROM user a LEFT JOIN resume_user x ON a.id=x.user_id LEFT JOIN user_to_role r ON a.id=r.user_id WHERE a.verification_token='$iduser'";
                    $get_data_profil = mysqli_query($mysqli,$q_cek_token);
                    $data = mysqli_fetch_array($get_data_profil);
                    // if($data['role_id']=='2'){
                        
                    // }elseif($data['role_id']=='3'){
                        
                    // }elseif($data['role_id']=='5'){
                        
                    // }else{
                        
                    // }
                    $q_get_module = "SELECT c.* FROM user_module a LEFT JOIN sto_module b ON a.id_module=b.id_module LEFT JOIN sto c ON b.id_sto=c.id_sto WHERE a.user_id='".$data['id']."' GROUP BY b.id_sto"; 
                    $get_data_module = mysqli_query($mysqli,$q_get_module);
                    $row_cnt = mysqli_num_rows($get_data_module);
                    if($row_cnt==0){
                        $text = 'WO Terkendala Kosong!';
                    }else{
                        $jumlah_wo_terkendala = 0;
                        $data_tampil = array();
                        $menu_tambahan = array();
                        while($data_sto = mysqli_fetch_array($get_data_module)) {
                            $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."' AND c.technical_action='".$pecahdata[2]."' AND c.canceled='0'";
                            $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                            while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                $cek_ps = mysqli_num_rows($get_data_ps);	
                                if($cek_ps==NULL){
                                    $jumlah_wo_terkendala++;
                                    $data_isi = array();
                                    $isi['text'] =	$data_wo['myir'].'  '.$data_wo['nama_customer'].'   '.$data_wo['sto'];
                                    $isi['callback_data'] = '/menu';
                                    $data_isi[] = $isi;
                                    array_push($data_tampil,$data_isi);
                                }else{echo'';}
                            }
                        }
                        $tanggal_tampil = '';
                        $waktu = explode('-', $data['session_date']);
                        if ($waktu[0]=="01") {
                            $tanggal_tampil = "Januari ".$waktu[1];
                        }elseif ($waktu[0]=="02") {
                            $tanggal_tampil = "Februari ".$waktu[1];
                        }elseif ($waktu[0]=="03") {
                            $tanggal_tampil = "Maret ".$waktu[1];
                        }elseif ($waktu[0]=="04") {
                            $tanggal_tampil = "April ".$waktu[1];
                        }elseif ($waktu[0]=="05") {
                            $tanggal_tampil = "Mei ".$waktu[1];
                        }elseif ($waktu[0]=="06") {
                            $tanggal_tampil = "Juni ".$waktu[1];
                        }elseif ($waktu[0]=="07") {
                            $tanggal_tampil = "Juli ".$waktu[1];
                        }elseif ($waktu[0]=="08") {
                            $tanggal_tampil = "Agustus ".$waktu[1];
                        }elseif ($waktu[0]=="09") {
                            $tanggal_tampil = "September ".$waktu[1];
                        }elseif ($waktu[0]=="10") {
                            $tanggal_tampil = "Oktober ".$waktu[1];
                        }elseif ($waktu[0]=="11") {
                            $tanggal_tampil = "November ".$waktu[1];
                        }elseif ($waktu[0]=="12") {
                            $tanggal_tampil = "Desember ".$waktu[1];
                        }
                        $text = "Jumlah WO Terkendala ".$tanggal_tampil." (".$pecahdata[2].") : ".number_format($jumlah_wo_terkendala,0);
                        $to_home['text'] = 'Home';
                        $to_home['callback_data'] = '/menu';
                        $menu_tambahan[] = $to_home;
                        $to_logout['text'] = 'Logout';
                        $to_logout['callback_data'] = '/menu';
                        $menu_tambahan[] = $to_logout;
                        $data_tampil[] = $menu_tambahan;
                        $replyMarkup = array(
                            'keyboard' => $data_tampil,
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }
                }
                elseif(preg_match("/Step-1/i", $pesan)){
                    $pecahdata = explode('  ',$pesan);
                    include 'koneksi.php';
                    $q_cek_token = "SELECT a.*,r.role_id FROM user a LEFT JOIN user_to_role r ON a.id=r.user_id WHERE a.verification_token='$iduser'"; 
                    $get_data_profil = mysqli_query($mysqli,$q_cek_token);
                    $data = mysqli_fetch_array($get_data_profil);
                    if($data['role_id']=='2'){
                        // sales
                        $text = "Silahkan pilih sales action yang diinginkan!";
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Berminat", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Batal", "callback_data" => "/ubah")),
                                array(array("text" => "Home", "callback_data" => "/home"), array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }elseif($data['role_id']=='3'){
                        // organik
                        $text = "Silahkan pilih organik action yang diinginkan!";
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Lanjut", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Batal", "callback_data" => "/ubah")),
                                array(array("text" => "Home", "callback_data" => "/home"), array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }elseif($data['role_id']=='5'){
                        // ta
                        $text = "Silahkan pilih technical action yang diinginkan!";
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 -", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Batal", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 PS di SC lain", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Double Input", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Rukos", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Alamat tidak ditemukan", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Pending / Reschedule", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Izin Terkendala", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Tanam Tiang", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Under Ground", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 ODP Full", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 ODP Belum Golive", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 ODP Tidak Ada - PT2", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 ODP Tidak Ada - PT3", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 ODP Loss / Reti", "callback_data" => "/ubah")),
                                array(array("text" => "Ubah ".$pecahdata[1]." Step-2 Others", "callback_data" => "/ubah")),
                                array(array("text" => "Home", "callback_data" => "/home"), array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }else{
                        $text = 'Maaf Anda tidak diizinkan untuk mengubah data!';
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Home", "callback_data" => "/home"), array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                                array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }
                }
                elseif(preg_match("/Step-2/i", $pesan)){
                    $pecahdata = explode(' ',$pesan,4);
                    include 'koneksi.php';
                    $q_cek_token = "SELECT a.*,r.role_id FROM user a LEFT JOIN user_to_role r ON a.id=r.user_id WHERE a.verification_token='$iduser'"; 
                    $get_data_profil = mysqli_query($mysqli,$q_cek_token);
                    $data = mysqli_fetch_array($get_data_profil);
                    if($data['role_id']=='2'){
                        $ubah_data="UPDATE data_wo_2 SET sales_action='".$pecahdata[3]."' WHERE myir='".$pecahdata[1]."'";
                        mysqli_query($mysqli,$ubah_data);
                        include 'koneksi.php';
                        $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.myir='".$pecahdata[1]."'"; 
                        $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                        while($data_wo = mysqli_fetch_array($get_data_wo)) {
                            $text = 'MYIR : '.$data_wo['myir'];
                            $text .= "\n";
                            $text .= 'STO : '.$data_wo['sto'];
                            $text .= "\n";
                            $q_get_sales = "SELECT c.* FROM sales c WHERE c.kode_sf='".$data_wo['sales']."' LIMIT 1"; 
                            $get_data_sales = mysqli_query($mysqli,$q_get_sales);
                            $cek_sales = mysqli_num_rows($get_data_sales);
                            if($cek_sales==NULL){
                                $text .= 'Kode SF : '.$data_wo['sales'];
                                $text .= "\n";
                            }else{
                                while($data_sales = mysqli_fetch_array($get_data_sales)) {
                                    // $text .= 'Kode SF : '.$data_sales['kode_sf'];
                                    // $text .= "\n";
                                    if($data_sales['username_telegram']==NULL){
                                        $text .= 'Sales : '.$data_sales['nama'];
                                        $text .= "\n";
                                    }else{
                                        $text .= 'Sales : <a href="tg://user?id='.$data_sales['username_telegram'].'">'.$data_sales['nama'].'</a>';
                                        $text .= "\n";
                                    }
                                }
                            }	
                            $text .= 'MOBI : '.$data_wo['mobi'];
                            $text .= "\n";
                            $text .= 'ODP : '.$data_wo['odp'];
                            $text .= "\n";
                            $text .= 'Customer : '.$data_wo['nama_customer'];
                            $text .= "\n";
                            $text .= 'Sales Action : '.$data_wo['sales_action'];
                            $text .= "\n";
                            $text .= 'Keterangan Sales : '.$data_wo['keterangan_sales'];
                            $text .= "\n";
                            $text .= 'Technical Action : '.$data_wo['technical_action'];
                            $text .= "\n";
                            $text .= 'Technical Information : '.$data_wo['technical_information'];
                            $text .= "\n";
                            $text .= 'Organik Action : '.$data_wo['organik_action'];
                            // $text .= "\n";
                            // $text .= "\n";
                            // $text .= '*untuk mengubah status dengan cara /ubah_wo `myir` `action` `keterangan`';
                        }
                        // $text = 'Data telah berhasil diubah!';
                        // langkah selanjutnya gimana?
                        // $replyMarkup = array(
                        //     'keyboard' => array(
                        //         array(array("text" => "Home", "callback_data" => "/home"), array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                        //         array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                        //     ),
                        //     'resize_keyboard' => true,
                        //     'one_time_keyboard' => false,
                        //     'selective' => true
                        // );
                        // $menu = json_encode($replyMarkup);
                    }elseif($data['role_id']=='3'){
                        if($action=='Batal'){
                            $ubah_data="UPDATE data_wo_2 SET organik_action='".$pecahdata[3]."', canceled='0' WHERE myir='".$pecahdata[1]."'";
                        }else{
                            $ubah_data="UPDATE data_wo_2 SET organik_action='".$pecahdata[3]."' WHERE myir='".$pecahdata[1]."'";
                        }
                        mysqli_query($mysqli,$ubah_data);
                        $text = 'Data telah berhasil diubah!';
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Home", "callback_data" => "/home"), array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                                array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }elseif($data['role_id']=='5'){
                        $ubah_data="UPDATE data_wo_2 SET technical_action='".$pecahdata[3]."' WHERE myir='".$pecahdata[1]."'";
                        mysqli_query($mysqli,$ubah_data);
                        include 'koneksi.php';
                        $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.myir='".$pecahdata[1]."'"; 
                        $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                        while($data_wo = mysqli_fetch_array($get_data_wo)) {
                            $text = 'MYIR : '.$data_wo['myir'];
                            $text .= "\n";
                            $text .= 'STO : '.$data_wo['sto'];
                            $text .= "\n";
                            $q_get_sales = "SELECT c.* FROM sales c WHERE c.kode_sf='".$data_wo['sales']."' LIMIT 1"; 
                            $get_data_sales = mysqli_query($mysqli,$q_get_sales);
                            $cek_sales = mysqli_num_rows($get_data_sales);
                            if($cek_sales==NULL){
                                $text .= 'Kode SF : '.$data_wo['sales'];
                                $text .= "\n";
                            }else{
                                while($data_sales = mysqli_fetch_array($get_data_sales)) {
                                    // $text .= 'Kode SF : '.$data_sales['kode_sf'];
                                    // $text .= "\n";
                                    if($data_sales['username_telegram']==NULL){
                                        $text .= 'Sales : '.$data_sales['nama'];
                                        $text .= "\n";
                                    }else{
                                        $text .= 'Sales : <a href="tg://user?id='.$data_sales['username_telegram'].'">'.$data_sales['nama'].'</a>';
                                        $text .= "\n";
                                    }
                                }
                            }	
                            $text .= 'MOBI : '.$data_wo['mobi'];
                            $text .= "\n";
                            $text .= 'ODP : '.$data_wo['odp'];
                            $text .= "\n";
                            $text .= 'Customer : '.$data_wo['nama_customer'];
                            $text .= "\n";
                            $text .= 'Sales Action : '.$data_wo['sales_action'];
                            $text .= "\n";
                            $text .= 'Keterangan Sales : '.$data_wo['keterangan_sales'];
                            $text .= "\n";
                            $text .= 'Technical Action : '.$data_wo['technical_action'];
                            $text .= "\n";
                            $text .= 'Technical Information : '.$data_wo['technical_information'];
                            $text .= "\n";
                            $text .= 'Organik Action : '.$data_wo['organik_action'];
                            // $text .= "\n";
                            // $text .= "\n";
                            // $text .= '*untuk mengubah status dengan cara /ubah_wo `myir` `action` `keterangan`';
                        }
                        // $text = 'Data telah berhasil diubah!';
                        // langkah selanjutnya gimana?
                        // $replyMarkup = array(
                        //     'keyboard' => array(
                        //         array(array("text" => "Home", "callback_data" => "/home"), array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                        //         array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                        //     ),
                        //     'resize_keyboard' => true,
                        //     'one_time_keyboard' => false,
                        //     'selective' => true
                        // );
                        // $menu = json_encode($replyMarkup);
                    }else{
                        $text = 'Maaf Anda tidak diizinkan untuk mengubah data!';
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Home", "callback_data" => "/home"), array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                                array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }
                }
                elseif($pesan=='Logout'){
                    include 'koneksi.php';
                    $q_cek_verification_token_user = "SELECT a.* FROM user a WHERE a.verification_token='$iduser'"; 
                    $get_data_profil_user = mysqli_query($mysqli,$q_cek_verification_token_user);
                    $cek_profil_user = mysqli_num_rows($get_data_profil_user);	
                    if($cek_profil_user==NULL){ 
                        $text = "Selamat datang!";
                        $text .= ' Silahkan login terlebih dahulu!';
                        $text .= "\n";
                        $text .= 'gunakan perintah /login `username` `password` untuk login';
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Bantuan", "callback_data" => "/bantuan"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }else{
                        $reset_data1="UPDATE user SET verification_token='' WHERE verification_token='$iduser'";
                        mysqli_query($mysqli,$reset_data1);
                        $newdate = date('m-Y');
                        $reset_data2="UPDATE resume_user b RIGHT JOIN user a ON a.id=b.user_id SET b.session_date='$newdate' WHERE a.verification_token='$iduser'";
                        mysqli_query($mysqli,$reset_data2);
                        $text = "Selamat datang!";
                        $text .= ' Silahkan login terlebih dahulu!';
                        $text .= "\n";
                        $text .= 'gunakan perintah /login `username` `password` untuk login';
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Bantuan", "callback_data" => "/bantuan"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }
                }
                elseif($pesan=='PS'){
                    include 'koneksi.php';
                    
                    $q_get_data = "SELECT b.*,x.session_date FROM user a LEFT JOIN user_to_role b ON a.id=b.user_id LEFT JOIN resume_user x ON a.id=x.user_id WHERE a.verification_token='$iduser' LIMIT 1";
                    $get_data_pengguna = mysqli_query($mysqli,$q_get_data);
                    $data = mysqli_fetch_array($get_data_pengguna);
                    $tanggal_tampil = '';
                    $waktu = explode('-', $data['session_date']);
                    if ($waktu[0]=="01") {
                        $tanggal_tampil = "Januari ".$waktu[1];
                    }elseif ($waktu[0]=="02") {
                        $tanggal_tampil = "Februari ".$waktu[1];
                    }elseif ($waktu[0]=="03") {
                        $tanggal_tampil = "Maret ".$waktu[1];
                    }elseif ($waktu[0]=="04") {
                        $tanggal_tampil = "April ".$waktu[1];
                    }elseif ($waktu[0]=="05") {
                        $tanggal_tampil = "Mei ".$waktu[1];
                    }elseif ($waktu[0]=="06") {
                        $tanggal_tampil = "Juni ".$waktu[1];
                    }elseif ($waktu[0]=="07") {
                        $tanggal_tampil = "Juli ".$waktu[1];
                    }elseif ($waktu[0]=="08") {
                        $tanggal_tampil = "Agustus ".$waktu[1];
                    }elseif ($waktu[0]=="09") {
                        $tanggal_tampil = "September ".$waktu[1];
                    }elseif ($waktu[0]=="10") {
                        $tanggal_tampil = "Oktober ".$waktu[1];
                    }elseif ($waktu[0]=="11") {
                        $tanggal_tampil = "November ".$waktu[1];
                    }elseif ($waktu[0]=="12") {
                        $tanggal_tampil = "Desember ".$waktu[1];
                    }
                    $nilai_ps = 0;
                    if($data['role_id']=='1' OR $data['role_id']=='0'){
                        $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.bulan='".$data['session_date']."'";
                        $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                        $nilai_ps += mysqli_num_rows($get_data_ps);
                    }elseif($data['role_id']=='2'){
                        $q_get_ps = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_ps_mtd_3 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."'";
                        $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                        $nilai_ps += mysqli_num_rows($get_data_ps);
                    }elseif($data['role_id']=='3' OR $data['role_id']=='4' OR $data['role_id']=='5'){
                        $q_get_module = "SELECT c.* FROM user_module a LEFT JOIN sto_module b ON a.id_module=b.id_module LEFT JOIN sto c ON b.id_sto=c.id_sto WHERE a.user_id='".$data['id']."' GROUP BY b.id_sto"; 
                        $get_data_module = mysqli_query($mysqli,$q_get_module);
                        $row_cnt = mysqli_num_rows($get_data_module);
                        if($row_cnt==0){
                            echo'';
                        }else{
                            while($data_sto = mysqli_fetch_array($get_data_module)) {
                                $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."'";
                                $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                $nilai_ps += mysqli_num_rows($get_data_ps);
                            }
                        }
                    }else{
                        echo"";
                    }
                    $text = "Jumlah PS ".$tanggal_tampil." : ".number_format($nilai_ps,0)."\n";
                    $text .= 'Silahkan unduh rekap data PS Anda dengan mengklik link dibawah ini';
                    $text .= "\n";
                    if($data['role_id']=='2'){
                        $q_get_data_sales = "SELECT b.* FROM sales b WHERE b.user_id='".$data['user_id']."' LIMIT 1";
                        $get_data_pengguna_sales = mysqli_query($mysqli,$q_get_data_sales);
                        $data_sales = mysqli_fetch_array($get_data_pengguna_sales);
                        $text .= 'http://datum-telkom.id/sales_side/download_ps/'.md5($data_sales['kode_sf']);
                    }elseif($data['role_id']=='3'){
                        $text .= 'http://datum-telkom.id/organik_side/download_ps/'.md5($data['user_id']);
                    }elseif($data['role_id']=='5'){
                        $text .= 'http://datum-telkom.id/ta_side/download_ps/'.md5($data['user_id']);
                    }else{echo'';}
                }elseif($pesan=='WO'){
                    include 'koneksi.php';
                    $q_get_data = "SELECT b.*,x.session_date FROM user a LEFT JOIN user_to_role b ON a.id=b.user_id LEFT JOIN resume_user x ON a.id=x.user_id WHERE a.verification_token='$iduser' LIMIT 1";
                    $get_data_pengguna = mysqli_query($mysqli,$q_get_data);
                    $data = mysqli_fetch_array($get_data_pengguna);
                    $tanggal_tampil = '';
                    $waktu = explode('-', $data['session_date']);
                    if ($waktu[0]=="01") {
                        $tanggal_tampil = "Januari ".$waktu[1];
                    }elseif ($waktu[0]=="02") {
                        $tanggal_tampil = "Februari ".$waktu[1];
                    }elseif ($waktu[0]=="03") {
                        $tanggal_tampil = "Maret ".$waktu[1];
                    }elseif ($waktu[0]=="04") {
                        $tanggal_tampil = "April ".$waktu[1];
                    }elseif ($waktu[0]=="05") {
                        $tanggal_tampil = "Mei ".$waktu[1];
                    }elseif ($waktu[0]=="06") {
                        $tanggal_tampil = "Juni ".$waktu[1];
                    }elseif ($waktu[0]=="07") {
                        $tanggal_tampil = "Juli ".$waktu[1];
                    }elseif ($waktu[0]=="08") {
                        $tanggal_tampil = "Agustus ".$waktu[1];
                    }elseif ($waktu[0]=="09") {
                        $tanggal_tampil = "September ".$waktu[1];
                    }elseif ($waktu[0]=="10") {
                        $tanggal_tampil = "Oktober ".$waktu[1];
                    }elseif ($waktu[0]=="11") {
                        $tanggal_tampil = "November ".$waktu[1];
                    }elseif ($waktu[0]=="12") {
                        $tanggal_tampil = "Desember ".$waktu[1];
                    }
                    $nilai_wo = 0;
                    if($data['role_id']=='1' OR $data['role_id']=='0'){
                        $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.bulan='".$data['session_date']."' AND c.canceled='0'";
                        $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                        $nilai_wo += mysqli_num_rows($get_data_wo);
                    }elseif($data['role_id']=='2'){
                        $q_get_wo = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_wo_2 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                        $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                        $nilai_wo += mysqli_num_rows($get_data_wo);
                    }elseif($data['role_id']=='3' OR $data['role_id']=='4' OR $data['role_id']=='5'){
                        $q_get_module = "SELECT c.* FROM user_module a LEFT JOIN sto_module b ON a.id_module=b.id_module LEFT JOIN sto c ON b.id_sto=c.id_sto WHERE a.user_id='".$data['id']."' GROUP BY b.id_sto"; 
                        $get_data_module = mysqli_query($mysqli,$q_get_module);
                        $row_cnt = mysqli_num_rows($get_data_module);
                        if($row_cnt==0){
                            echo'';
                        }else{
                            while($data_sto = mysqli_fetch_array($get_data_module)) {
                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                $nilai_wo += mysqli_num_rows($get_data_wo);
                            }
                        }
                    }else{
                        echo"";
                    }
                    $text = "Jumlah WO ".$tanggal_tampil." : ".number_format($nilai_wo,0)."\n";
                    $text .= 'Silahkan unduh rekap data WO Anda dengan mengklik link dibawah ini';
                    $text .= "\n";
                    if($data['role_id']=='2'){
                        $q_get_data_sales = "SELECT b.* FROM sales b WHERE b.user_id='".$data['user_id']."' LIMIT 1";
                        $get_data_pengguna_sales = mysqli_query($mysqli,$q_get_data_sales);
                        $data_sales = mysqli_fetch_array($get_data_pengguna_sales);
                        $text .= 'http://datum-telkom.id/sales_side/download_wo/'.md5($data_sales['kode_sf']);
                    }elseif($data['role_id']=='3'){
                        $text .= 'http://datum-telkom.id/organik_side/download_wo/'.md5($data['user_id']);
                    }elseif($data['role_id']=='5'){
                        $text .= 'http://datum-telkom.id/ta_side/download_wo/'.md5($data['user_id']);
                    }else{echo'';}
                }elseif($pesan=='WO Terkendala'){
                    // $text = 'Ini menu WO Terkendala';
                    include 'koneksi.php';
                    $q_cek_token = "SELECT x.session_date,r.role_id,a.id FROM user a LEFT JOIN resume_user x ON a.id=x.user_id LEFT JOIN user_to_role r ON a.id=r.user_id WHERE a.verification_token='$iduser'"; 
                    $get_data_pengguna = mysqli_query($mysqli,$q_cek_token);
                    $data_date = mysqli_fetch_array($get_data_pengguna);
                    $session_date = $data_date['session_date'];
                    $tanggal_tampil = '';
                    $waktu = explode('-', $data_date['session_date']);
                    if ($waktu[0]=="01") {
                        $tanggal_tampil = "Januari ".$waktu[1];
                    }elseif ($waktu[0]=="02") {
                        $tanggal_tampil = "Februari ".$waktu[1];
                    }elseif ($waktu[0]=="03") {
                        $tanggal_tampil = "Maret ".$waktu[1];
                    }elseif ($waktu[0]=="04") {
                        $tanggal_tampil = "April ".$waktu[1];
                    }elseif ($waktu[0]=="05") {
                        $tanggal_tampil = "Mei ".$waktu[1];
                    }elseif ($waktu[0]=="06") {
                        $tanggal_tampil = "Juni ".$waktu[1];
                    }elseif ($waktu[0]=="07") {
                        $tanggal_tampil = "Juli ".$waktu[1];
                    }elseif ($waktu[0]=="08") {
                        $tanggal_tampil = "Agustus ".$waktu[1];
                    }elseif ($waktu[0]=="09") {
                        $tanggal_tampil = "September ".$waktu[1];
                    }elseif ($waktu[0]=="10") {
                        $tanggal_tampil = "Oktober ".$waktu[1];
                    }elseif ($waktu[0]=="11") {
                        $tanggal_tampil = "November ".$waktu[1];
                    }elseif ($waktu[0]=="12") {
                        $tanggal_tampil = "Desember ".$waktu[1];
                    }
                    $nilai_wo_terkendala = 0;
                    if($data_date['role_id']=='1' OR $data_date['role_id']=='0'){
                        $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.bulan='".$data_date['session_date']."' AND c.canceled='0'";
                        $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                        while($data_wo = mysqli_fetch_array($get_data_wo)) {
                            $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                            $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                            $cek_ps = mysqli_num_rows($get_data_ps);	
                            if($cek_ps==NULL){
                                $nilai_wo_terkendala++;
                            }else{echo'';}
                        }
                    }elseif($data_date['role_id']=='2'){
                        $q_get_wo = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_wo_2 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data_date['session_date']."' AND c.canceled='0'";
                        $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                        while($data_wo = mysqli_fetch_array($get_data_wo)) {
                            $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                            $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                            $cek_ps = mysqli_num_rows($get_data_ps);	
                            if($cek_ps==NULL){
                                $nilai_wo_terkendala++;
                            }else{echo'';}
                        }
                    }elseif($data_date['role_id']=='3' OR $data_date['role_id']=='4' OR $data_date['role_id']=='5'){
                        $q_get_module = "SELECT c.* FROM user_module a LEFT JOIN sto_module b ON a.id_module=b.id_module LEFT JOIN sto c ON b.id_sto=c.id_sto WHERE a.user_id='".$data_date['id']."' GROUP BY b.id_sto"; 
                        $get_data_module = mysqli_query($mysqli,$q_get_module);
                        $row_cnt = mysqli_num_rows($get_data_module);
                        if($row_cnt==0){
                            echo'';
                        }else{
                            while($data_sto = mysqli_fetch_array($get_data_module)) {
                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $nilai_wo_terkendala++;
                                    }else{echo'';}
                                }
                            }
                        }
                        
                    }else{
                        echo"";
                    }
                    $text .= "Jumlah WO Terkendala ".$tanggal_tampil." : ".number_format($nilai_wo_terkendala,0);
                    if($data_date['role_id']=='2'){
                        $data_tampil = array();
                        $menu_tambahan = array();
                        $q_get_wo = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_wo_2 c ON b.kode_sf=c.sales WHERE a.verification_token='$iduser' AND c.bulan='$session_date' AND c.canceled='0'"; 
                        $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                        while($data_wo = mysqli_fetch_array($get_data_wo)) {
                            $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                            $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                            $cek_ps = mysqli_num_rows($get_data_ps);	
                            if($cek_ps==NULL){
                                $data_isi = array();
                                $isi['text'] =	$data_wo['myir'].'  '.$data_wo['nama_customer'].'   '.$data_wo['sto'];
                                $isi['callback_data'] = '/menu';
                                $data_isi[] = $isi;
                                array_push($data_tampil,$data_isi);
                            }else{echo'';}
                        }
                        $to_home['text'] = 'Home';
                        $to_home['callback_data'] = '/menu';
                        $menu_tambahan[] = $to_home;
                        $to_logout['text'] = 'Logout';
                        $to_logout['callback_data'] = '/menu';
                        $menu_tambahan[] = $to_logout;
                        $data_tampil[] = $menu_tambahan;
                        $replyMarkup = array(
                            'keyboard' => $data_tampil,
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }elseif($data_date['role_id']=='5' OR $data_date['role_id']=='3'){
                        $jumlah_strip = 0;
                        $jumlah_batal = 0;
                        $jumlah_ps_di_sc_lain = 0;
                        $jumlah_double_input = 0;
                        $jumlah_rukos = 0;
                        $jumlah_alamat_tidak_ditemukan = 0;
                        $jumlah_pending = 0;
                        $jumlah_izin_terkendala = 0;
                        $jumlah_tanam_tiang = 0;
                        $jumlah_under_ground = 0;
                        $jumlah_odp_full = 0;
                        $jumlah_odp_belum_golive = 0;
                        $jumlah_pt2 = 0;
                        $jumlah_pt3 = 0;
                        $jumlah_loss = 0;
                        $jumlah_others = 0;
                        $q_get_module = "SELECT c.* FROM user_module a LEFT JOIN sto_module b ON a.id_module=b.id_module LEFT JOIN sto c ON b.id_sto=c.id_sto WHERE a.user_id='".$data_date['id']."' GROUP BY b.id_sto"; 
                        $get_data_module = mysqli_query($mysqli,$q_get_module);
                        $row_cnt = mysqli_num_rows($get_data_module);
                        if($row_cnt==0){
                            echo'';
                        }else{
                            while($data_sto = mysqli_fetch_array($get_data_module)) {
                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='-' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_strip++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='Batal' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_batal++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='PS di SC lain' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_ps_di_sc_lain++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='Double Input' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_double_input++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='Rukos' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_rukos++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='Alamat tidak ditemukan' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_alamat_tidak_ditemukan++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='Pending / Reschedule' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_pending++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='Izin Terkendala' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_izin_terkendala++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='Tanam Tiang' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_tanam_tiang++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='Under Ground' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_under_ground++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='ODP Full' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_odp_full++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='ODP Belum Golive' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_odp_belum_golive++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='ODP Tidak Ada - PT2' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_pt2++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='ODP Tidak Ada - PT3' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_pt3++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='ODP Loss / Reti' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_loss++;
                                    }else{echo'';}
                                }

                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data_date['session_date']."' AND c.technical_action='Others' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $jumlah_others++;
                                    }else{echo'';}
                                }
                            }
                        }
                        $text .= "\n\n";
                        $text .= "- : ".number_format($jumlah_strip,0)."\n";
                        $text .= "Batal : ".number_format($jumlah_batal,0)."\n";
                        $text .= "PS di SC lain : ".number_format($jumlah_ps_di_sc_lain,0)."\n";
                        $text .= "Double Input : ".number_format($jumlah_double_input,0)."\n";
                        $text .= "Rukos : ".number_format($jumlah_rukos,0)."\n";
                        $text .= "Alamat tidak ditemukan : ".number_format($jumlah_alamat_tidak_ditemukan,0)."\n";
                        $text .= "Pending / Reschedule : ".number_format($jumlah_pending,0)."\n";
                        $text .= "Izin Terkendala : ".number_format($jumlah_izin_terkendala,0)."\n";
                        $text .= "Tanam Tiang : ".number_format($jumlah_tanam_tiang,0)."\n";
                        $text .= "Under Ground : ".number_format($jumlah_under_ground,0)."\n";
                        $text .= "ODP Full : ".number_format($jumlah_odp_full,0)."\n";
                        $text .= "ODP Belum Golive : ".number_format($jumlah_odp_belum_golive,0)."\n";
                        $text .= "ODP Tidak Ada - PT2 : ".number_format($jumlah_pt2,0)."\n";
                        $text .= "ODP Tidak Ada - PT3 : ".number_format($jumlah_pt3,0)."\n";
                        $text .= "ODP Loss / Reti : ".number_format($jumlah_loss,0)."\n";
                        $text .= "Others : ".number_format($jumlah_others,0);
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Technical Action -", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action Batal", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action PS di SC lain", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action Double Input", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action Rukos", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action Alamat tidak ditemukan", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action Pending / Reschedule", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action Izin Terkendala", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action Tanam Tiang", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action Under Ground", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action ODP Full", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action ODP Belum Golive", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action ODP Tidak Ada - PT2", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action ODP Tidak Ada - PT3", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action ODP Loss / Reti", "callback_data" => "/menu")),
                                array(array("text" => "Technical Action Others", "callback_data" => "/menu")),
                                array(array("text" => "Home", "callback_data" => "/home"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }
                }else{
                    if (preg_match("/^\/view_(\d+)$/i", $pesan, $cocok)) {
                        $pesan = "/view $cocok[1]";
                    }

                    if (preg_match("/^\/hapus_(\d+)$/i", $pesan, $cocok)) {
                        $pesan = "/hapus $cocok[1]";
                    }

                    $pecah2 = explode(' ', $pesan, 4);
                    $katake1 = strtolower($pecah2[0]);
                    $katake2 = strtolower($pecah2[1]);
                    $katake3 = strtolower($pecah2[2]);
                    
                    $pecah = explode(' ', $pesan, 2);
                    $katapertama = strtolower($pecah[0]);

                    if($katapertama=='/start'){
                        $text = "Selamat datang!";
                        include 'koneksi.php';
                        $q_cek_token = "SELECT a.*,b.fullname,b.phone_number,r.role_id,x.wo,x.ps,x.wo_terkendala,x.session_date FROM user a LEFT JOIN user_profile b ON a.id=b.user_id LEFT JOIN user_to_role r ON a.id=r.user_id LEFT JOIN resume_user x ON a.id=x.user_id WHERE a.verification_token='$iduser'"; 
                        $get_data_profil = mysqli_query($mysqli,$q_cek_token);
                        $cek_profil = mysqli_num_rows($get_data_profil);	
                        if($cek_profil==NULL){ 
                            $text .= ' Silahkan login terlebih dahulu!';
                            $text .= "\n";
                            $text .= 'gunakan perintah /login `username` `password` untuk login';
                        }else
                        {  
                            $data = mysqli_fetch_array($get_data_profil);
                        
                            $nama = $data['fullname']; 
                            $nohp = $data['phone_number'];				

                            $text .= "\nNama: $nama\nNo. HP: $nohp\n\n";
                            $q_get_module = "SELECT a.*,b.judul FROM user_module a LEFT JOIN module b ON a.id_module=b.id_module WHERE a.user_id='".$data['id']."'"; 
                            $get_data_module = mysqli_query($mysqli,$q_get_module);
                            $row_cnt = mysqli_num_rows($get_data_module);
                            if($row_cnt>1){
                                $text .= "Modul :\n";
                                $no = 1;
                                while($data_module = mysqli_fetch_array($get_data_module)) {
                                    $text .= $no.". ".$data_module['judul']."\n";
                                    $no++;
                                }
                            }else{
                                $data_module = mysqli_fetch_array($get_data_module);
                                $text .= "Modul : ".$data_module['judul']."\n";
                            }
                            if($data['role_id']=='1' OR $data['role_id']=='0'){
                                $text .= "User Role : Admin\n\n";
                            }elseif($data['role_id']=='2'){
                                $text .= "User Role : Sales\n\n";
                            }elseif($data['role_id']=='3'){
                                $text .= "User Role : Organik\n\n";
                            }elseif($data['role_id']=='4'){
                                $text .= "User Role : Teknisi Provisioning\n\n";
                            }elseif($data['role_id']=='5'){
                                $text .= "User Role : Telkom Akses\n\n";
                            }
                            $tanggal_tampil = '';
                            $waktu = explode('-', $data['session_date']);
                            if ($waktu[0]=="01") {
                                $tanggal_tampil = "Januari ".$waktu[1];
                            }elseif ($waktu[0]=="02") {
                                $tanggal_tampil = "Februari ".$waktu[1];
                            }elseif ($waktu[0]=="03") {
                                $tanggal_tampil = "Maret ".$waktu[1];
                            }elseif ($waktu[0]=="04") {
                                $tanggal_tampil = "April ".$waktu[1];
                            }elseif ($waktu[0]=="05") {
                                $tanggal_tampil = "Mei ".$waktu[1];
                            }elseif ($waktu[0]=="06") {
                                $tanggal_tampil = "Juni ".$waktu[1];
                            }elseif ($waktu[0]=="07") {
                                $tanggal_tampil = "Juli ".$waktu[1];
                            }elseif ($waktu[0]=="08") {
                                $tanggal_tampil = "Agustus ".$waktu[1];
                            }elseif ($waktu[0]=="09") {
                                $tanggal_tampil = "September ".$waktu[1];
                            }elseif ($waktu[0]=="10") {
                                $tanggal_tampil = "Oktober ".$waktu[1];
                            }elseif ($waktu[0]=="11") {
                                $tanggal_tampil = "November ".$waktu[1];
                            }elseif ($waktu[0]=="12") {
                                $tanggal_tampil = "Desember ".$waktu[1];
                            }
                            $text .= "Rekap ".$tanggal_tampil."\n\n";
                            if($data['session_date']==date('m-Y')){
                                $text .= "Jumlah PS : ".number_format($data['ps'],0)."\n";
                                $text .= "Jumlah WO : ".number_format($data['wo'],0)."\n";
                                $text .= "Jumlah WO Terkendala : ".number_format($data['wo_terkendala'],0)."\n";
                            }else{
                                $nilai_wo = 0;
                                $nilai_ps = 0;
                                $nilai_wo_terkendala = 0;
                                if($data['role_id']=='1' OR $data['role_id']=='0'){
                                    $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.bulan='".$data['session_date']."'";
                                    $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                    $nilai_ps += mysqli_num_rows($get_data_ps);
                                    $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                    $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                    $nilai_wo += mysqli_num_rows($get_data_wo);
                                    while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                        $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                        $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                        $cek_ps = mysqli_num_rows($get_data_ps);	
                                        if($cek_ps==NULL){
                                            $nilai_wo_terkendala++;
                                        }else{echo'';}
                                    }
                                }elseif($data['role_id']=='2'){
                                    $q_get_ps = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_ps_mtd_3 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."'";
                                    $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                    $nilai_ps += mysqli_num_rows($get_data_ps);
                                    $q_get_wo = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_wo_2 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                    $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                    $nilai_wo += mysqli_num_rows($get_data_wo);
                                    while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                        $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                        $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                        $cek_ps = mysqli_num_rows($get_data_ps);	
                                        if($cek_ps==NULL){
                                            $nilai_wo_terkendala++;
                                        }else{echo'';}
                                    }
                                }elseif($data['role_id']=='3' OR $data['role_id']=='4' OR $data['role_id']=='5'){
                                    $q_get_module = "SELECT c.* FROM user_module a LEFT JOIN sto_module b ON a.id_module=b.id_module LEFT JOIN sto c ON b.id_sto=c.id_sto WHERE a.user_id='".$data['id']."' GROUP BY b.id_sto"; 
                                    $get_data_module = mysqli_query($mysqli,$q_get_module);
                                    $row_cnt = mysqli_num_rows($get_data_module);
                                    if($row_cnt==0){
                                        echo'';
                                    }else{
                                        while($data_sto = mysqli_fetch_array($get_data_module)) {
                                            $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."'";
                                            $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                            $nilai_ps += mysqli_num_rows($get_data_ps);
                                            $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                            $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                            $nilai_wo += mysqli_num_rows($get_data_wo);
                                            while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                                $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                                $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                                $cek_ps = mysqli_num_rows($get_data_ps);	
                                                if($cek_ps==NULL){
                                                    $nilai_wo_terkendala++;
                                                }else{echo'';}
                                            }
                                        }
                                    }
                                }else{
                                    echo"";
                                }
                                $text .= "Jumlah PS : ".number_format($nilai_ps,0)."\n";
                                $text .= "Jumlah WO : ".number_format($nilai_wo,0)."\n";
                                $text .= "Jumlah WO Terkendala : ".number_format($nilai_wo_terkendala,0)."\n";
                            }

                            $replyMarkup = array(
                                'keyboard' => array(
                                    array(array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                                    array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                                ),
                                'resize_keyboard' => true,
                                'one_time_keyboard' => false,
                                'selective' => true
                            );
                            $menu = json_encode($replyMarkup);
                        }
                    }elseif($katapertama=='/home'){
                        $q_cek_token = "SELECT a.*,b.fullname,b.phone_number,r.role_id,x.wo,x.ps,x.wo_terkendala,x.session_date FROM user a LEFT JOIN user_profile b ON a.id=b.user_id LEFT JOIN user_to_role r ON a.id=r.user_id LEFT JOIN resume_user x ON a.id=x.user_id WHERE a.verification_token='$iduser'";
                        $get_data_pengguna = mysqli_query($mysqli,$q_cek_token);
                            
                        $data = mysqli_fetch_array($get_data_pengguna);
                        $nama = $data['fullname']; 
                        $nohp = $data['phone_number'];				

                        $text .= "\nNama: $nama\nNo. HP: $nohp\n\n";
                        $q_get_module = "SELECT a.*,b.judul FROM user_module a LEFT JOIN module b ON a.id_module=b.id_module WHERE a.user_id='".$data['id']."'"; 
                        $get_data_module = mysqli_query($mysqli,$q_get_module);
                        $row_cnt = mysqli_num_rows($get_data_module);
                        if($row_cnt>1){
                            $text .= "Modul :\n";
                            $no = 1;
                            while($data_module = mysqli_fetch_array($get_data_module)) {
                                $text .= $no.". ".$data_module['judul']."\n";
                                $no++;
                            }
                        }else{
                            $data_module = mysqli_fetch_array($get_data_module);
                            $text .= "Modul : ".$data_module['judul']."\n";
                        }
                        if($data['role_id']=='1' OR $data['role_id']=='0'){
                            $text .= "User Role : Admin\n\n";
                        }elseif($data['role_id']=='2'){
                            $text .= "User Role : Sales\n\n";
                        }elseif($data['role_id']=='3'){
                            $text .= "User Role : Organik\n\n";
                        }elseif($data['role_id']=='4'){
                            $text .= "User Role : Teknisi Provisioning\n\n";
                        }elseif($data['role_id']=='5'){
                            $text .= "User Role : Telkom Akses\n\n";
                        }
                        $tanggal_tampil = '';
                        $waktu = explode('-', $data['session_date']);
                        if ($waktu[0]=="01") {
                            $tanggal_tampil = "Januari ".$waktu[1];
                        }elseif ($waktu[0]=="02") {
                            $tanggal_tampil = "Februari ".$waktu[1];
                        }elseif ($waktu[0]=="03") {
                            $tanggal_tampil = "Maret ".$waktu[1];
                        }elseif ($waktu[0]=="04") {
                            $tanggal_tampil = "April ".$waktu[1];
                        }elseif ($waktu[0]=="05") {
                            $tanggal_tampil = "Mei ".$waktu[1];
                        }elseif ($waktu[0]=="06") {
                            $tanggal_tampil = "Juni ".$waktu[1];
                        }elseif ($waktu[0]=="07") {
                            $tanggal_tampil = "Juli ".$waktu[1];
                        }elseif ($waktu[0]=="08") {
                            $tanggal_tampil = "Agustus ".$waktu[1];
                        }elseif ($waktu[0]=="09") {
                            $tanggal_tampil = "September ".$waktu[1];
                        }elseif ($waktu[0]=="10") {
                            $tanggal_tampil = "Oktober ".$waktu[1];
                        }elseif ($waktu[0]=="11") {
                            $tanggal_tampil = "November ".$waktu[1];
                        }elseif ($waktu[0]=="12") {
                            $tanggal_tampil = "Desember ".$waktu[1];
                        }
                        $text .= "Rekap ".$tanggal_tampil."\n\n";
                        if($data['session_date']==date('m-Y')){
                            $text .= "Jumlah PS : ".number_format($data['ps'],0)."\n";
                            $text .= "Jumlah WO : ".number_format($data['wo'],0)."\n";
                            $text .= "Jumlah WO Terkendala : ".number_format($data['wo_terkendala'],0)."\n";
                        }else{
                            $nilai_wo = 0;
                            $nilai_ps = 0;
                            $nilai_wo_terkendala = 0;
                            if($data['role_id']=='1' OR $data['role_id']=='0'){
                                $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.bulan='".$data['session_date']."'";
                                $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                $nilai_ps += mysqli_num_rows($get_data_ps);
                                $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                $nilai_wo += mysqli_num_rows($get_data_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $nilai_wo_terkendala++;
                                    }else{echo'';}
                                }
                            }elseif($data['role_id']=='2'){
                                $q_get_ps = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_ps_mtd_3 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."'";
                                $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                $nilai_ps += mysqli_num_rows($get_data_ps);
                                $q_get_wo = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_wo_2 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                $nilai_wo += mysqli_num_rows($get_data_wo);
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                    $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                    $cek_ps = mysqli_num_rows($get_data_ps);	
                                    if($cek_ps==NULL){
                                        $nilai_wo_terkendala++;
                                    }else{echo'';}
                                }
                            }elseif($data['role_id']=='3' OR $data['role_id']=='4' OR $data['role_id']=='5'){
                                $q_get_module = "SELECT c.* FROM user_module a LEFT JOIN sto_module b ON a.id_module=b.id_module LEFT JOIN sto c ON b.id_sto=c.id_sto WHERE a.user_id='".$data['id']."' GROUP BY b.id_sto"; 
                                $get_data_module = mysqli_query($mysqli,$q_get_module);
                                $row_cnt = mysqli_num_rows($get_data_module);
                                if($row_cnt==0){
                                    echo'';
                                }else{
                                    while($data_sto = mysqli_fetch_array($get_data_module)) {
                                        $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."'";
                                        $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                        $nilai_ps += mysqli_num_rows($get_data_ps);
                                        $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                        $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                        $nilai_wo += mysqli_num_rows($get_data_wo);
                                        while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                            $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                            $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                            $cek_ps = mysqli_num_rows($get_data_ps);	
                                            if($cek_ps==NULL){
                                                $nilai_wo_terkendala++;
                                            }else{echo'';}
                                        }
                                    }
                                }
                            }else{
                                echo"";
                            }
                            $text .= "Jumlah PS : ".number_format($nilai_ps,0)."\n";
                            $text .= "Jumlah WO : ".number_format($nilai_wo,0)."\n";
                            $text .= "Jumlah WO Terkendala : ".number_format($nilai_wo_terkendala,0)."\n";
                        }

                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                                array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }elseif($katapertama=='/help'){
                        $text = "Berikut menu yang tersedia:\n\n";
                        $text .= "/start untuk memulai bot\n";
                        $text .= "/home untuk kembali ke menu awal\n";
                        $text .= "/set_bulan `MM-YYYY`\n";
                        $text .= "/help info bantuan ini\n";	 	  
                        $text .= "/search `SC-XXXX` atau `MYIR-XXXX`\n";	 	  
                        $text .= "/login `username` `password` untuk login\n";
                        $text .= "/logout";
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Home", "callback_data" => "/home"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }elseif($katapertama=='/logout'){
                        include 'koneksi.php';
                        $q_cek_verification_token_user = "SELECT a.* FROM user a WHERE a.verification_token='$iduser'"; 
                        $get_data_profil_user = mysqli_query($mysqli,$q_cek_verification_token_user);
                        $cek_profil_user = mysqli_num_rows($get_data_profil_user);	
                        if($cek_profil_user==NULL){ 
                            $text = "Selamat datang!";
                            $text .= ' Silahkan login terlebih dahulu!';
                            $text .= "\n";
                            $text .= 'gunakan perintah /login `username` `password` untuk login';
                            $replyMarkup = array(
                                'keyboard' => array(
                                    array(array("text" => "Bantuan", "callback_data" => "/bantuan"))
                                ),
                                'resize_keyboard' => true,
                                'one_time_keyboard' => false,
                                'selective' => true
                            );
                            $menu = json_encode($replyMarkup);
                        }else{
                            $reset_data1="UPDATE user SET verification_token='' WHERE verification_token='$iduser'";
                            mysqli_query($mysqli,$reset_data1);
                            $newdate = date('m-Y');
                            $reset_data2="UPDATE resume_user b RIGHT JOIN user a ON a.id=b.user_id SET b.session_date='$newdate' WHERE a.verification_token='$iduser'";
                            mysqli_query($mysqli,$reset_data2);
                            $text = "Selamat datang!";
                            $text .= ' Silahkan login terlebih dahulu!';
                            $text .= "\n";
                            $text .= 'gunakan perintah /login `username` `password` untuk login';
                            $replyMarkup = array(
                                'keyboard' => array(
                                    array(array("text" => "Bantuan", "callback_data" => "/bantuan"))
                                ),
                                'resize_keyboard' => true,
                                'one_time_keyboard' => false,
                                'selective' => true
                            );
                            $menu = json_encode($replyMarkup);
                        }
                    }elseif($katapertama=='/password'){
                        if (isset($pecah[1])) {
                            $password = $pecah[1];
                            include 'koneksi.php';

                            $simpan="UPDATE user SET 
                            pass='$password' WHERE verification_token='$iduser'";
                            mysqli_query($mysqli,$simpan); 
                            
                            $text = "Password telah berhasil diubah!";
                        } else {
                            $text = '*ERROR:* _Password pengganti tidak boleh kosong!_';
                            $text .= "\n";
                            $text .= "Format: /password `passwordbaru`";
                        }
                    }elseif($katapertama=='/myakun'){
                        include 'koneksi.php';
                        $q_cek_token = "SELECT a.*,b.fullname,b.phone_number FROM user a LEFT JOIN user_profile b ON a.id=b.user_id WHERE a.verification_token='$iduser'"; 
                        $get_data_profil = mysqli_query($mysqli,$q_cek_token);
                        $cek_profil = mysqli_num_rows($get_data_profil);	
                        if($cek_profil==NULL){ 
                            $text = 'Silahkan login terlebih dahulu!';
                        }else
                        {  
                            $data = mysqli_fetch_array($get_data_profil);
                        
                            $nama = $data['fullname']; 
                            $nohp = $data['phone_number'];				
                            $username = $data['username'];
                            $pass = $data['pass'];

                            $text = "Akun anda adalah \nNama: $nama,  \nNo. HP: $nohp, \nUsername: $username, \nPassword: $pass\n\n";
                        }
                    }elseif($katapertama=='/login'){
                        if (isset($pecah2[1])) {
                            $username = $pecah2[1];
                            $password = $pecah2[2];
                            
                            include 'koneksi.php';
                            $q_cek_username = "SELECT a.* FROM user a WHERE a.username='$username'"; 
                            $get_data_profil = mysqli_query($mysqli,$q_cek_username);
                            $cek_username = mysqli_num_rows($get_data_profil);	
                            if($cek_username==NULL){ 
                                $text = 'Akun Anda tidak terdaftar, silahkan hubungi admin!';
                            }else
                            {  
                                $q_cek_token = "SELECT a.*,b.fullname,b.phone_number,r.role_id,x.wo,x.ps,x.wo_terkendala,x.session_date FROM user a LEFT JOIN user_profile b ON a.id=b.user_id LEFT JOIN user_to_role r ON a.id=r.user_id LEFT JOIN resume_user x ON a.id=x.user_id WHERE a.username='$username' AND a.pass='$password'"; 
                                $get_data_pengguna = mysqli_query($mysqli,$q_cek_token);
                                $cek_profil = mysqli_num_rows($get_data_pengguna);	
                                if($cek_profil==NULL){ 
                                    $text = 'Password yang Anda masukkan salah!';
                                }else
                                {  
                                    $reset_data="UPDATE user SET 
                                    verification_token='' WHERE verification_token='$iduser'";
                                    mysqli_query($mysqli,$reset_data);
                                    $upd_data="UPDATE user SET 
                                    verification_token='$iduser' WHERE username='$username' AND pass='$password'";
                                    mysqli_query($mysqli,$upd_data);
                                    $data = mysqli_fetch_array($get_data_pengguna);
                                    $nama = $data['fullname']; 
                                    $nohp = $data['phone_number'];				

                                    $text .= "\nNama: $nama\nNo. HP: $nohp\n\n";
                                    $q_get_module = "SELECT a.*,b.judul FROM user_module a LEFT JOIN module b ON a.id_module=b.id_module WHERE a.user_id='".$data['id']."'"; 
                                    $get_data_module = mysqli_query($mysqli,$q_get_module);
                                    $row_cnt = mysqli_num_rows($get_data_module);
                                    if($row_cnt>1){
                                        $text .= "Modul :\n";
                                        $no = 1;
                                        while($data_module = mysqli_fetch_array($get_data_module)) {
                                            $text .= $no.". ".$data_module['judul']."\n";
                                            $no++;
                                        }
                                    }else{
                                        $data_module = mysqli_fetch_array($get_data_module);
                                        $text .= "Modul : ".$data_module['judul']."\n";
                                    }
                                    if($data['role_id']=='1' OR $data['role_id']=='0'){
                                        $text .= "User Role : Admin\n\n";
                                    }elseif($data['role_id']=='2'){
                                        $text .= "User Role : Sales\n\n";
                                    }elseif($data['role_id']=='3'){
                                        $text .= "User Role : Organik\n\n";
                                    }elseif($data['role_id']=='4'){
                                        $text .= "User Role : Teknisi Provisioning\n\n";
                                    }elseif($data['role_id']=='5'){
                                        $text .= "User Role : Telkom Akses\n\n";
                                    }
                                    $tanggal_tampil = '';
                                    $waktu = explode('-', $data['session_date']);
                                    if ($waktu[0]=="01") {
                                        $tanggal_tampil = "Januari ".$waktu[1];
                                    }elseif ($waktu[0]=="02") {
                                        $tanggal_tampil = "Februari ".$waktu[1];
                                    }elseif ($waktu[0]=="03") {
                                        $tanggal_tampil = "Maret ".$waktu[1];
                                    }elseif ($waktu[0]=="04") {
                                        $tanggal_tampil = "April ".$waktu[1];
                                    }elseif ($waktu[0]=="05") {
                                        $tanggal_tampil = "Mei ".$waktu[1];
                                    }elseif ($waktu[0]=="06") {
                                        $tanggal_tampil = "Juni ".$waktu[1];
                                    }elseif ($waktu[0]=="07") {
                                        $tanggal_tampil = "Juli ".$waktu[1];
                                    }elseif ($waktu[0]=="08") {
                                        $tanggal_tampil = "Agustus ".$waktu[1];
                                    }elseif ($waktu[0]=="09") {
                                        $tanggal_tampil = "September ".$waktu[1];
                                    }elseif ($waktu[0]=="10") {
                                        $tanggal_tampil = "Oktober ".$waktu[1];
                                    }elseif ($waktu[0]=="11") {
                                        $tanggal_tampil = "November ".$waktu[1];
                                    }elseif ($waktu[0]=="12") {
                                        $tanggal_tampil = "Desember ".$waktu[1];
                                    }
                                    $text .= "Rekap ".$tanggal_tampil."\n\n";
                                    if($data['session_date']==date('m-Y')){
                                        $text .= "Jumlah PS : ".number_format($data['ps'],0)."\n";
                                        $text .= "Jumlah WO : ".number_format($data['wo'],0)."\n";
                                        $text .= "Jumlah WO Terkendala : ".number_format($data['wo_terkendala'],0)."\n";
                                    }else{
                                        $nilai_wo = 0;
                                        $nilai_ps = 0;
                                        $nilai_wo_terkendala = 0;
                                        if($data['role_id']=='1' OR $data['role_id']=='0'){
                                            $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.bulan='".$data['session_date']."'";
                                            $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                            $nilai_ps += mysqli_num_rows($get_data_ps);
                                            $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                            $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                            $nilai_wo += mysqli_num_rows($get_data_wo);
                                            while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                                $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                                $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                                $cek_ps = mysqli_num_rows($get_data_ps);	
                                                if($cek_ps==NULL){
                                                    $nilai_wo_terkendala++;
                                                }else{echo'';}
                                            }
                                        }elseif($data['role_id']=='2'){
                                            $q_get_ps = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_ps_mtd_3 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."'";
                                            $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                            $nilai_ps += mysqli_num_rows($get_data_ps);
                                            $q_get_wo = "SELECT c.* FROM user a LEFT JOIN sales b ON a.id=b.user_id LEFT JOIN data_wo_2 c ON b.kode_sf=c.sales WHERE a.verification_token='".$iduser."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                            $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                            $nilai_wo += mysqli_num_rows($get_data_wo);
                                            while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                                $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                                $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                                $cek_ps = mysqli_num_rows($get_data_ps);	
                                                if($cek_ps==NULL){
                                                    $nilai_wo_terkendala++;
                                                }else{echo'';}
                                            }
                                        }elseif($data['role_id']=='3' OR $data['role_id']=='4' OR $data['role_id']=='5'){
                                            $q_get_module = "SELECT c.* FROM user_module a LEFT JOIN sto_module b ON a.id_module=b.id_module LEFT JOIN sto c ON b.id_sto=c.id_sto WHERE a.user_id='".$data['id']."' GROUP BY b.id_sto"; 
                                            $get_data_module = mysqli_query($mysqli,$q_get_module);
                                            $row_cnt = mysqli_num_rows($get_data_module);
                                            if($row_cnt==0){
                                                echo'';
                                            }else{
                                                while($data_sto = mysqli_fetch_array($get_data_module)) {
                                                    $q_get_ps = "SELECT c.* FROM data_ps_mtd_3 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."'";
                                                    $get_data_ps = mysqli_query($mysqli,$q_get_ps);
                                                    $nilai_ps += mysqli_num_rows($get_data_ps);
                                                    $q_get_wo = "SELECT c.* FROM data_wo_2 c WHERE c.sto='".$data_sto['kode_sto']."' AND c.bulan='".$data['session_date']."' AND c.canceled='0'";
                                                    $get_data_wo = mysqli_query($mysqli,$q_get_wo);
                                                    $nilai_wo += mysqli_num_rows($get_data_wo);
                                                    while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                                        $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='".$data_wo['myir']."'"; 
                                                        $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                                                        $cek_ps = mysqli_num_rows($get_data_ps);	
                                                        if($cek_ps==NULL){
                                                            $nilai_wo_terkendala++;
                                                        }else{echo'';}
                                                    }
                                                }
                                            }
                                        }else{
                                            echo"";
                                        }
                                        $text .= "Jumlah PS : ".number_format($nilai_ps,0)."\n";
                                        $text .= "Jumlah WO : ".number_format($nilai_wo,0)."\n";
                                        $text .= "Jumlah WO Terkendala : ".number_format($nilai_wo_terkendala,0)."\n";
                                    }

                                    $replyMarkup = array(
                                        'keyboard' => array(
                                            array(array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                                            array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                                        ),
                                        'resize_keyboard' => true,
                                        'one_time_keyboard' => false,
                                        'selective' => true
                                    );
                                    $menu = json_encode($replyMarkup);
                                }
                            } 
                        } else {
                            $text = '*ERROR:* _Username dan Password tidak boleh kosong!_';
                            $text .= "\n";
                            $text .= "Format: /login `username` `password`";
                        }
                    }elseif($katapertama=='/ubah_wo'){
                        if (isset($pecah2[1]) AND isset($pecah2[2])) {
                            $myir = $pecah2[1];
                            $action = $pecah2[2];
                            $keterangan = $pecah2[3];
                            
                            include 'koneksi.php';
                            $q_cek_token = "SELECT a.*,r.role_id FROM user a LEFT JOIN user_to_role r ON a.id=r.user_id WHERE a.verification_token='$iduser'"; 
                            $get_data_profil = mysqli_query($mysqli,$q_cek_token);
                            $data = mysqli_fetch_array($get_data_profil);
                            if($data['role_id']=='2'){
                                $ubah_data="UPDATE data_wo_2 SET sales_action='$action', keterangan_sales='$keterangan' WHERE myir='$myir'";
                                mysqli_query($mysqli,$ubah_data);
                                $text = 'Data telah berhasil diubah!';
                            }elseif($data['role_id']=='3'){
                                if($action=='Batal'){
                                    $ubah_data="UPDATE data_wo_2 SET organik_action='$action', canceled='0' WHERE myir='$myir'";
                                }else{
                                    $ubah_data="UPDATE data_wo_2 SET organik_action='$action' WHERE myir='$myir'";
                                }
                                mysqli_query($mysqli,$ubah_data);
                                $text = 'Data telah berhasil diubah!';
                            }elseif($data['role_id']=='5'){
                                $ubah_data="UPDATE data_wo_2 SET technical_action='$action', technical_information='$keterangan' WHERE myir='$myir'";
                                mysqli_query($mysqli,$ubah_data);
                                $text = 'Data telah berhasil diubah!';
                            }else{
                                $text = 'Maaf Anda tidak diizinkan untuk mengubah data!';
                            }
                        } else {
                            $text = '*ERROR:* MYIR ataupun action tidak boleh kosong!';
                            $text .= "\n";
                            $text .= "Format: /ubah_wo `myir` `action` `keterangan`";
                        }
                    }elseif($katapertama=='/set_bulan'){
                        if (isset($pecah2[1])) {
                            $bln = $pecah2[1];
                            
                            include 'koneksi.php';
                            $q_cek_token = "SELECT a.* FROM user a WHERE a.verification_token='$iduser'"; 
                            $get_data_profil = mysqli_query($mysqli,$q_cek_token);
                            $data = mysqli_fetch_array($get_data_profil);
                            $user_id = $data['id'];
                            $ubah_data="UPDATE resume_user a SET a.session_date='".$bln."' WHERE a.user_id='".$user_id."'";
                            mysqli_query($mysqli,$ubah_data);
                            $text = 'Data telah berhasil diubah!';
                        } else {
                            $text = '*ERROR:* Bulan tidak boleh kosong tidak boleh kosong!';
                            $text .= "\n";
                            $text .= "Format: /set_bulan `MM-YYYY`";
                        }
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Home", "callback_data" => "/home"), array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                                array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }elseif($katapertama=='/search'){
                        $kata = $pecah2[1];
                        include 'koneksi.php';
                        $q_cek_wo = "SELECT a.* FROM data_wo_2 a WHERE a.myir='$kata'"; 
                        $get_data_wo = mysqli_query($mysqli,$q_cek_wo);
                        // $data_wo = mysqli_fetch_array($get_data_profil);
                        $cek_wo = mysqli_num_rows($get_data_wo);
                        if($cek_wo==NULL){
                            $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='$kata' OR a.sc='$kata' LIMIT 1"; 
                            $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                            // $data_ps = mysqli_fetch_array($get_data_ps);
                            $cek_ps = mysqli_num_rows($get_data_ps);
                            if($cek_ps==NULL){
                                $text = 'Data yang Anda cari tidak ditemukan!';
                            }else{
                                while($data_ps = mysqli_fetch_array($get_data_ps)) {
                                    $text = 'MYIR : '.$data_ps['myir'];
                                    $text .= "\n";
                                    $text .= 'Status : PS';
                                    $text .= "\n";
                                    $text .= 'STO : '.$data_ps['sto'];
                                    $text .= "\n";
                                    $text .= 'MOBI : '.$data_ps['mobi'];
                                    $text .= "\n";
                                    $text .= 'ODP : '.$data_ps['odp'];
                                    $text .= "\n";
                                    $text .= 'Customer : '.$data_ps['nama_customer'];
                                    $text .= "\n";
                                    $text .= 'SC : '.$data_ps['sc'];
                                    $text .= "\n";
                                    $text .= 'Nomor Internet : '.$data_ps['no_internet'];
                                    $text .= "\n";
                                    $text .= 'Paket : '.$data_ps['paket'];
                                }
                            }
                        }else{
                            $q_cek_ps = "SELECT a.* FROM data_ps_mtd_3 a WHERE a.myir='$kata' OR a.sc='$kata' LIMIT 1"; 
                            $get_data_ps = mysqli_query($mysqli,$q_cek_ps);
                            // $data_ps = mysqli_fetch_array($get_data_ps);
                            $cek_ps = mysqli_num_rows($get_data_ps);
                            if($cek_ps==NULL){
                                while($data_wo = mysqli_fetch_array($get_data_wo)) {
                                    $text = 'MYIR : '.$data_wo['myir'];
                                    $text .= "\n";
                                    $text .= 'Status : WO Terkendala';
                                    $text .= "\n";
                                    $text .= 'STO : '.$data_wo['sto'];
                                    $text .= "\n";
                                    $q_get_sales = "SELECT c.* FROM sales c WHERE c.kode_sf='".$data_wo['sales']."' LIMIT 1"; 
                                    $get_data_sales = mysqli_query($mysqli,$q_get_sales);
                                    $cek_sales = mysqli_num_rows($get_data_sales);
                                    if($cek_sales==NULL){
                                        $text .= 'Kode SF : '.$data_wo['sales'];
                                        $text .= "\n";
                                    }else{
                                        while($data_sales = mysqli_fetch_array($get_data_sales)) {
                                            // $text .= 'Kode SF : '.$data_sales['kode_sf'];
                                            // $text .= "\n";
                                            if($data_sales['username_telegram']==NULL){
                                                $text .= 'Sales : '.$data_sales['nama'];
                                                $text .= "\n";
                                            }else{
                                                $text .= 'Sales : <a href="tg://user?id='.$data_sales['username_telegram'].'">'.$data_sales['nama'].'</a>';
                                                $text .= "\n";
                                            }
                                        }
                                    }	
                                    $text .= 'MOBI : '.$data_wo['mobi'];
                                    $text .= "\n";
                                    $text .= 'ODP : '.$data_wo['odp'];
                                    $text .= "\n";
                                    $text .= 'Customer : '.$data_wo['nama_customer'];
                                    $text .= "\n";
                                    $text .= 'Sales Action : '.$data_wo['sales_action'];
                                    $text .= "\n";
                                    $text .= 'Keterangan Sales : '.$data_wo['keterangan_sales'];
                                    $text .= "\n";
                                    $text .= 'Technical Action : '.$data_wo['technical_action'];
                                    $text .= "\n";
                                    $text .= 'Technical Information : '.$data_wo['technical_information'];
                                    $text .= "\n";
                                    $text .= 'Organik Action : '.$data_wo['organik_action'];
                                }
                            }else{
                                while($data_ps = mysqli_fetch_array($get_data_ps)) {
                                    $text = 'MYIR : '.$data_ps['myir'];
                                    $text .= "\n";
                                    $text .= 'Status : PS';
                                    $text .= "\n";
                                    $text .= 'STO : '.$data_ps['sto'];
                                    $text .= "\n";
                                    $text .= 'MOBI : '.$data_ps['mobi'];
                                    $text .= "\n";
                                    $text .= 'ODP : '.$data_ps['odp'];
                                    $text .= "\n";
                                    $text .= 'Customer : '.$data_ps['nama_customer'];
                                    $text .= "\n";
                                    $text .= 'SC : '.$data_ps['sc'];
                                    $text .= "\n";
                                    $text .= 'Nomor Internet : '.$data_ps['no_internet'];
                                    $text .= "\n";
                                    $text .= 'Paket : '.$data_ps['paket'];
                                }
                            }
                        }
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Home", "callback_data" => "/home"), array("text" => "PS", "callback_data" => "/ps"), array("text" => "WO", "callback_data" => "/wo"), array("text" => "WO Terkendala", "callback_data" => "/wo_terkendala")),
                                array(array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }else{
                        $text = 'Perintah yang Anda masukkan tidak dikenali oleh sistem';
                        $replyMarkup = array(
                            'keyboard' => array(
                                array(array("text" => "Home", "callback_data" => "/home"), array("text" => "Bantuan", "callback_data" => "/bantuan"), array("text" => "Logout", "callback_data" => "/logout"))
                            ),
                            'resize_keyboard' => true,
                            'one_time_keyboard' => false,
                            'selective' => true
                        );
                        $menu = json_encode($replyMarkup);
                    }
                }
            } else {
                $text = 'Silahkan tulis pesan yang akan disampaikan..';
                $text .= "\n";
                $text .= "Format: /pesan `pesan`";
            }
        }

        $hasil = sendMessage($idpesan, $idchat, $text, $menu);
        if ($GLOBALS['debug']) {
            echo 'Pesan yang dikirim: '.$text.PHP_EOL;
            print_r($hasil);
        }
    }
}

echo 'Ver. '.myVERSI.' OK Start!'.PHP_EOL.date('d-m-Y H:i:s').PHP_EOL;

function printUpdates($result)
{
    foreach ($result as $obj) {
    processMessage($obj);
        $last_id = $obj['update_id'];
    }

    return $last_id;
}


$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (!$update) {
  exit;
} else {
  processMessage($update);
}
?>