<?php
$nama_file='Form KK'; // Beri nama file PDF hasil.
define('_MPDF_PATH','mpdf60/');
include(_MPDF_PATH . "mpdf.php");
// $mpdf=new mPDF('utf-8', 'A4-L');
$mpdf = new mPDF(['mode' => 'utf-8', 'format' => [190, 236]]);
$mpdf = new mPDF(['orientation' => 'L']);
ob_start(); 
$mpdf->useGraphs = false;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Form KK</title>
    </head>
    <body>
        <?php
        include "../koneksi.php";
        ?>
        <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="100%">
            <p align="center"><b><font face="Arial" size="4">FORMULIR ISIAN BIODATA PENDUDUK UNTUK 
            WNI ( PER KELUARGA ) </font></b></td>
        </tr>
        <tr>
            <td width="100%">&nbsp;</td>
        </tr>
        <tr>
            <td width="100%">&nbsp;</td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0" height="198">
        <tr>
            <td width="9%" rowspan="6" height="168" valign="top">
            <p align="center"><font face="Arial"><img border="0" src="../assets/logo-batang.png" width="105" height="128"></font></td>
            <td width="37%" height="33" style="border: 3px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1" colspan="3">
            <p align="center"><b><font face="Arial">PERHATIAN : Formulir ini diisi 
            dengan huruf catak (Balok)</font></b></td>
            <td width="31%" height="33">
            <p align="right"><font face="Arial">Nomor Kartu Keluarga&nbsp;&nbsp;&nbsp;&nbsp;
            </font></td>
            <td width="23%" height="33" style="border: 3px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <p align="center">&nbsp;</td>
        </tr>
        <tr>
            <td width="15%" height="32">&nbsp;</td>
            <td width="2%" height="32">&nbsp;</td>
            <td width="20%" height="32">&nbsp;</td>
            <td width="31%" height="32">&nbsp;</td>
            <td width="23%" height="32">&nbsp;</td>
        </tr>
        <tr>
            <td width="15%" height="28"><font face="Arial">Data Kepala Keluarga</font></td>
            <td width="2%" height="28" align="center"><font face="Arial">:</font></td>
            <td width="74%" height="28" colspan="3"><font face="Arial">............
            </font></td>
        </tr>
        <tr>
            <td width="15%" height="28"><font face="Arial">Nama Kepala Keluarga</font></td>
            <td width="2%" height="28" align="center"><font face="Arial">:</font></td>
            <td width="74%" height="28" colspan="3"><font face="Arial">............
            </font></td>
        </tr>
        <tr>
            <td width="15%" height="26"><font face="Arial">Alamat Lengkap</font></td>
            <td width="2%" height="26" align="center"><font face="Arial">:</font></td>
            <td width="74%" height="26" colspan="3"><font face="Arial">............
            </font></td>
        </tr>
        <tr>
            <td width="15%" height="26">&nbsp;</td>
            <td width="2%" height="26" align="center">&nbsp;</td>
            <td width="74%" height="26" colspan="3"><font face="Arial">RT ............ 
            RW ............ Dusun/Dukuh/Kampung : ............ </font></td>
        </tr>
        <tr>
            <td width="9%" height="31">&nbsp;</td>
            <td width="91%" height="31" colspan="5"><font face="Arial">Desa/Kelurahan : 
            KALIPUCANG WETAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            Kecamatan : BATANG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            Kabupaten : BATANG</font></td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0" height="35">
        <tr>
            <td width="100%" height="35"><b><font face="Arial">Data Keluarga </font></b>
            </td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0" height="1">
        <tr>
            <td width="4%" align="center" height="50" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <b><font face="Arial">No.</font></b></td>
            <td width="16%" align="center" height="50" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <b><font face="Arial">Nama Lengkap</font></b></td>
            <td width="15%" align="center" height="50" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <b><font face="Arial">Nomor NIK</font></b></td>
            <td width="8%" align="center" height="50" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <b><font face="Arial">Jenis Kelamin</font></b></td>
            <td width="9%" align="center" height="50" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <b><font face="Arial">Tempat Lahir</font></b></td>
            <td width="11%" align="center" height="50" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <b><font face="Arial">Provinsi</font></b></td>
            <td width="11%" align="center" height="50" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <b><font face="Arial">Tgl/Bulan/Tahun Lahir</font></b></td>
            <td width="10%" align="center" height="50" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <b><font face="Arial">Akta Kelahiran<br>(Ada / Tidak)</font></b></td>
            <td width="7%" align="center" height="50" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <b><font face="Arial">Golongan Darah</font></b></td>
            <td width="9%" align="center" height="50" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <b><font face="Arial">Agama</font></b></td>
        </tr>
        <tr>
            <td width="4%" height="1" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
            <font face="Arial">1</font></td>
            <td width="16%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="15%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="8%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="10%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="7%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
        </tr>
        <tr>
            <td width="4%" height="1" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
            <font face="Arial">2</font></td>
            <td width="16%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="15%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="8%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="10%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="7%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
        </tr>
        <tr>
            <td width="4%" height="1" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
            <font face="Arial">3</font></td>
            <td width="16%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="15%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="8%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="10%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="7%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
        </tr>
        <tr>
            <td width="4%" height="1" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
            <font face="Arial">4</font></td>
            <td width="16%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="15%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="8%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="10%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="7%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
        </tr>
        <tr>
            <td width="4%" height="1" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
            <font face="Arial">5</font></td>
            <td width="16%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="15%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="8%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="10%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="7%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
        </tr>
        <tr>
            <td width="4%" height="1" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
            <font face="Arial">6</font></td>
            <td width="16%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="15%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="8%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="10%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="7%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
        </tr>
        <tr>
            <td width="4%" height="1" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
            <font face="Arial">7</font></td>
            <td width="16%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="15%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="8%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="10%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="7%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
        </tr>
        <tr>
            <td width="4%" height="1" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
            <font face="Arial">8</font></td>
            <td width="16%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="15%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="8%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="11%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="10%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="7%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
            <td width="9%" height="1" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3"></td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="100%">&nbsp;</td>
        </tr>
        <tr>
            <td width="100%">&nbsp;</td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0" height="71">
        <tr>
            <td width="4%" align="center" height="52" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial"><b>No.</b></font></td>
            <td width="16%" align="center" height="52" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial"><b>Status Perkawinan<br>(Kawin/Belum/CH/CM)</b></font></td>
            <td width="11%" align="center" height="52" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial"><b>Status Hubungan<br>
            Dalam Keluarga</b></font></td>
            <td width="12%" align="center" height="52" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial"><b>Penyandang <br>
            Cacat</b></font></td>
            <td width="9%" align="center" height="52" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial"><b>Pendidikan <br>
            Terakhir</b></font></td>
            <td width="15%" align="center" height="52" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial"><b>Pekerjaan</b></font></td>
            <td width="17%" align="center" height="52" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial"><b>Nama Lengkap Ibu</b></font></td>
            <td width="16%" align="center" height="52" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial"><b>Nama Lengkap Ayah</b></font></td>
        </tr>
        <tr>
            <td width="4%" height="19" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">
            <font face="Arial">1</font></td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="11%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="12%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="9%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="15%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="17%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
        </tr>
        <tr>
            <td width="4%" height="19" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">
            <font face="Arial">2</font></td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="11%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="12%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="9%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="15%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="17%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
        </tr>
        <tr>
            <td width="4%" height="19" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">
            <font face="Arial">3</font></td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="11%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="12%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="9%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="15%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="17%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
        </tr>
        <tr>
            <td width="4%" height="19" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">
            <font face="Arial">4</font></td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="11%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="12%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="9%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="15%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="17%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
        </tr>
        <tr>
            <td width="4%" height="19" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">
            <font face="Arial">5</font></td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="11%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="12%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="9%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="15%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="17%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
        </tr>
        <tr>
            <td width="4%" height="19" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">
            <font face="Arial">6</font></td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="11%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="12%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="9%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="15%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="17%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
        </tr>
        <tr>
            <td width="4%" height="19" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">
            <font face="Arial">7</font></td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="11%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="12%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="9%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="15%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="17%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
        </tr>
        <tr>
            <td width="4%" height="19" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">
            <font face="Arial">8</font></td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="11%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="12%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="9%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="15%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="17%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
            <td width="16%" height="19" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" dir="ltr">&nbsp;</td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="33%">&nbsp;</td>
            <td width="33%">&nbsp;</td>
            <td width="34%">&nbsp;</td>
        </tr>
        <tr>
            <td width="33%" align="center"><font face="Arial">Mengetahui</font></td>
            <td width="33%" align="center"><font face="Arial">Mengetahui Ketua RT ...... 
            RW ...... </font></td>
            <td width="34%" align="center"><font face="Arial">Batang, 
            ...................................... 2020</font></td>
        </tr>
        <tr>
            <td width="33%" align="center"><font face="Arial">Kepala Desa Kalipucang 
            Wetan</font></td>
            <td width="33%" align="center"><font face="Arial">Desa Kalipucang Wetan</font></td>
            <td width="34%" align="center"><font face="Arial">Kepala Keluarga</font></td>
        </tr>
        <tr>
            <td width="33%" align="center">&nbsp;</td>
            <td width="33%" align="center">&nbsp;</td>
            <td width="34%" align="center">&nbsp;</td>
        </tr>
        <tr>
            <td width="33%" align="center">&nbsp;</td>
            <td width="33%" align="center">&nbsp;</td>
            <td width="34%" align="center">&nbsp;</td>
        </tr>
        <tr>
            <td width="33%" align="center">&nbsp;</td>
            <td width="33%" align="center">&nbsp;</td>
            <td width="34%" align="center">&nbsp;</td>
        </tr>
        <tr>
            <td width="33%" align="center">&nbsp;</td>
            <td width="33%" align="center">&nbsp;</td>
            <td width="34%" align="center">&nbsp;</td>
        </tr>
        <tr>
            <td width="33%" align="center"><b><font face="Arial">( 
            .......................................... )</font></b></td>
            <td width="33%" align="center"><b><font face="Arial">( 
            .......................................... )</font></b></td>
            <td width="34%" align="center"><b><font face="Arial">( 
            .......................................... )</font></b></td>
        </tr>
        </table>
        <?php

        $html = ob_get_contents(); // Proses untuk mengambil data
        ob_end_clean();
        // Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        // LOAD a stylesheet
        // $stylesheet = file_get_contents('mpdfstyletables.css');
        $mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
        $mpdf->WriteHTML($html,1);
        $mpdf->Output($nama_file.".pdf" ,'I');
        exit; 
        ?>
    </body>
</html>