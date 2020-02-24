<?php
include '../koneksi.php';
session_start();
$q_cek_user_account = "SELECT a.* FROM user a WHERE a.username='".$_POST['username']."' AND a.pass='".$_POST['password']."'"; 
$get_data_profil_pengguna = mysqli_query($mysqli,$q_cek_user_account);
$cek_profil_pengguna = mysqli_num_rows($get_data_profil_pengguna);
if($cek_profil_pengguna==NULL){
    header("location:login.html");
}else{
    $data = mysqli_fetch_array($get_data_profil_pengguna);
    $_SESSION['id'] = $data['id'];
    header("location:../app/beranda.html");
}
?>