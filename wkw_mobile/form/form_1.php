<?php
$nama_file='Form Permohonan KTP'; // Beri nama file PDF hasil.
define('_MPDF_PATH','mpdf60/');
include(_MPDF_PATH . "mpdf.php");
$mpdf=new mPDF('utf-8', 'A4-L'); // Create new mPDF Document
ob_start(); 
$mpdf->useGraphs = false;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Form Permohonan KTP</title>
    </head>
    <body>
        <?php
        include "../koneksi.php";
        ?>
        <table border="0" cellspacing="1" width="100%">
        <tr>
            <td width="76%">&nbsp;</td>
            <td width="24%" style="border-style: solid; border-width: 1" bordercolor="#000000">
            <p align="center"><font face="Arial">F-05/DAFDUK/2003</font></td>
        </tr>
        </table>
        <p align="center"><b><font face="Arial">FORMULIR PERMOHONAN KARTU TANDA PENDUDUK</font></b></p>
        <table border="1" cellspacing="1" width="100%" style="border: 0px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1" height="1">
        <tr>
            <td width="2%" style="border-style: none; border-width: medium" height="17"></td>
            <td width="92%" style="border-style: none; border-width: medium" height="17"></td>
        </tr>
        <tr>
            <td width="2%" style="border-left:2px solid #000000; border-top:2px solid #000000; border-bottom:2px solid #000000; border-right:0px solid #000000; padding:0; " height="1" bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#000000">
            <p align="center">
            <font face="Arial">
            <br>1.<br>2.<br>3.<br>
            </font>
            </td>
            <td width="92%" style="border-left:0px solid #000000; border-top:2px solid #000000; border-bottom:2px solid #000000; border-right:2px solid #000000; padding:0; " height="1" bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#000000">
            <p>
            <font face="Arial">Perhatian :<br>
            Harap diisi dengan huruf cetak dan menggunakan tinta hitam<br>
            Untuk kolom pilihan, harap memberi tanda silang (x) pada kotak pilihan<br>
            Setelah formulir ini diisi dan ditanda tangani, harap diserahkan kembali 
            ke Kantor Desa / Kelurahan </font>
            </p>
            </td>
        </tr>
        <tr>
            <td width="2%" style="border-style: none; border-width: medium" height="17"></td>
            <td width="92%" style="border-style: none; border-width: medium" height="17"></td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" style="border-top-width: 0; border-bottom-width:0" height="1" cellpadding="0">
        <tr>
            <td width="33%" height="24"><font face="Arial">PEMERINTAH PROPINSI</font></td>
            <td width="3%" align="center" height="24"><font face="Arial">:</font></td>
            <td width="3%" style="border-style: solid; border-width: 1; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" bordercolor="#000000" align="center" height="24">
            <font face="Arial">3</font></td>
            <td width="3%" style="border-style: solid; border-width: 1; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" bordercolor="#000000" align="center" height="24">
            <font face="Arial">3</font></td>
            <td width="3%" style="padding-top: 3; padding-bottom: 3" height="24">&nbsp;</td>
            <td width="3%" style="padding-top: 3; padding-bottom: 3" height="24">&nbsp;</td>
            <td width="3%" height="24">&nbsp;</td>
            <td width="49%" height="24"><font face="Arial">JAWA TENGAH</font></td>
        </tr>
        <tr>
            <td width="33%" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" height="1"></td>
            <td width="3%" align="center" style="border: 0px solid #000000; padding: 0" height="1"></td>
            <td width="3%" style="border:0px solid #000000; padding:0; " bordercolor="#000000" align="center" height="1">
            </td>
            <td width="3%" style="border:0px solid #000000; padding:0; " bordercolor="#000000" align="center" height="1">
            </td>
            <td width="3%" style="border:0px solid #000000; padding:0; " height="1"></td>
            <td width="3%" style="border:0px solid #000000; padding:0; " height="1"></td>
            <td width="3%" style="border: 0px solid #000000; padding: 0" height="1"></td>
            <td width="49%" style="border: 0px solid #000000; padding: 0" height="1"></td>
        </tr>
        <tr>
            <td width="33%" height="24"><font face="Arial">PEMERINTAH KABUPATEN/KOTA</font></td>
            <td width="3%" align="center" height="24"><font face="Arial">:</font></td>
            <td width="3%" style="border-style: solid; border-width: 1; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" bordercolor="#000000" align="center" height="24">
            <font face="Arial">2</font></td>
            <td width="3%" style="border-style: solid; border-width: 1; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" bordercolor="#000000" align="center" height="24">
            <font face="Arial">5</font></td>
            <td width="3%" style="padding-top: 3; padding-bottom: 3" height="24">&nbsp;</td>
            <td width="3%" style="padding-top: 3; padding-bottom: 3" height="24">&nbsp;</td>
            <td width="3%" height="24">&nbsp;</td>
            <td width="49%" height="24"><font face="Arial">BATANG</font></td>
        </tr>
        <tr>
            <td width="33%" height="1" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5"></td>
            <td width="3%" align="center" height="1" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5"></td>
            <td width="3%" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" align="center" height="1">
            </td>
            <td width="3%" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" align="center" height="1">
            </td>
            <td width="3%" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" align="center" height="1"></td>
            <td width="3%" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" align="center" height="1"></td>
            <td width="3%" height="1" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5"></td>
            <td width="49%" height="1" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5"></td>
        </tr>
        <tr>
            <td width="33%" height="25"><font face="Arial">KECAMATAN</font></td>
            <td width="3%" align="center" height="25"><font face="Arial">:</font></td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="25">
            <font face="Arial">1</font></td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="25">
            <font face="Arial">1</font></td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="25">&nbsp;</td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="25">&nbsp;</td>
            <td width="3%" height="25">&nbsp;</td>
            <td width="49%" height="25"><font face="Arial">BATANG</font></td>
        </tr>
        <tr>
            <td width="33%" height="1" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" dir="ltr"></td>
            <td width="3%" align="center" height="1" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" dir="ltr"></td>
            <td width="3%" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" align="center" height="1" dir="ltr"></td>
            <td width="3%" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" align="center" height="1" dir="ltr"></td>
            <td width="3%" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" align="center" height="1" dir="ltr"></td>
            <td width="3%" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" align="center" height="1" dir="ltr"></td>
            <td width="3%" height="1" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" dir="ltr"></td>
            <td width="49%" height="1" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" dir="ltr"></td>
        </tr>
        <tr>
            <td width="33%" height="25" dir="ltr"><font face="Arial">DESA</font></td>
            <td width="3%" align="center" height="25" dir="ltr"><font face="Arial">:</font></td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="25" dir="ltr">&nbsp;</td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="25" dir="ltr">&nbsp;</td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="25" dir="ltr">&nbsp;</td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="25" dir="ltr">&nbsp;</td>
            <td width="3%" height="25" dir="ltr">&nbsp;</td>
            <td width="49%" height="25" dir="ltr"><font face="Arial">KALIPUCANG WETAN</font></td>
        </tr>
        <tr>
            <td width="33%" height="23">&nbsp;</td>
            <td width="3%" align="center" style="border-right-style: none; border-right-width: medium" height="23">&nbsp;</td>
            <td width="3%" style="border: medium none #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="23">&nbsp;</td>
            <td width="3%" style="border: medium none #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="23">&nbsp;</td>
            <td width="3%" style="border: medium none #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="23">&nbsp;</td>
            <td width="3%" style="border: medium none #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3" align="center" height="23">&nbsp;</td>
            <td width="3%" style="border-left-style: none; border-left-width: medium" height="23">&nbsp;</td>
            <td width="49%" height="23">&nbsp;</td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="14%" style="padding-top: 3; padding-bottom: 3">&nbsp;</td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
            <p align="center">&nbsp;</td>
            <td width="3%" style="padding-top: 3; padding-bottom: 3">&nbsp;</td>
            <td width="3%" style="padding-top: 3; padding-bottom: 3">&nbsp;</td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 0; padding-right: 0; padding-top: 3; padding-bottom: 3">&nbsp;</td>
            <td width="14%" style="border: 1px solid #000000; padding-left: 0; padding-right: 0; padding-top: 3; padding-bottom: 3">
            <p align="left"><font face="Arial">&nbsp; A. Baru</font></td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3">&nbsp;</td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">&nbsp;</td>
            <td width="14%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
            <font face="Arial">&nbsp; B. Perpanjangan</font></td>
            <td width="9%" style="padding-top: 3; padding-bottom: 3">&nbsp;</td>
            <td width="3%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">&nbsp;</td>
            <td width="13%" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
            <font face="Arial">&nbsp; C. Penggantian</font></td>
            <td width="53%" style="padding-top: 3; padding-bottom: 3">
            <font face="Arial">&nbsp; </font></td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" height="6" cellpadding="0">
        <tr>
            <td width="14%" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" height="1">
            </td>
            <td width="86%" style="padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" height="1">
            </td>
        </tr>
        <tr>
            <td width="14%" style="padding-top: 4; padding-bottom: 4" height="32">
            <font face="Arial">PERMOHONAN KTP</font></td>
            <td width="86%" style="border: 1px solid #000000; padding: 4" height="32">&nbsp;</td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0" height="1">
        <tr>
            <td width="25%" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" height="1"></td>
            <td width="25%" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" height="1"></td>
            <td width="25%" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" height="1"></td>
            <td width="25%" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" height="1"></td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0" height="1">
        <tr>
            <td width="2%" height="33">
            <p align="center"><font face="Arial">1.</font></td>
            <td width="12%" height="33"><font face="Arial">Nama Lengkap</font></td>
            <td width="86%" style="border: 1px solid #000000; padding-top: 3; padding-bottom: 3" height="33">&nbsp;</td>
        </tr>
        <tr>
            <td width="2%" height="1" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5">
            </td>
            <td width="12%" height="1" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5">
            </td>
            <td width="86%" style="border: 0px solid #000000; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" height="1">
            </td>
        </tr>
        <tr>
            <td width="2%" height="33">
            <p align="center"><font face="Arial">2.</font></td>
            <td width="12%" height="33"><font face="Arial">No. KK</font></td>
            <td width="86%" style="border: 1px solid #000000; padding-top: 3; padding-bottom: 3" height="33">&nbsp;</td>
        </tr>
        <tr>
            <td width="2%" height="1" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5">
            </td>
            <td width="12%" height="1" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5">
            </td>
            <td width="86%" style="border: 0px solid #000000; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" height="1">
            </td>
        </tr>
        <tr>
            <td width="2%" height="33">
            <p align="center"><font face="Arial">3.</font></td>
            <td width="12%" height="33"><font face="Arial">NIK</font></td>
            <td width="86%" style="border: 1px solid #000000; padding-top: 3; padding-bottom: 3" height="33">&nbsp;</td>
        </tr>
        <tr>
            <td width="2%" height="1" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5">
            </td>
            <td width="12%" height="1" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5">
            </td>
            <td width="86%" style="border: 0px solid #000000; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" height="1">
            </td>
        </tr>
        <tr>
            <td width="2%" height="33">
            <p align="center"><font face="Arial">4.</font></td>
            <td width="12%" height="33"><font face="Arial">Alamat</font></td>
            <td width="86%" style="border: 1px solid #000000; padding-top: 3; padding-bottom: 3" height="33">&nbsp;</td>
        </tr>
        <tr>
            <td width="2%" height="1" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5">
            </td>
            <td width="12%" height="1" style="border-style: solid; border-width: 0; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5">
            </td>
            <td width="86%" style="border: 0px solid #000000; padding-left: 0; padding-right: 0; padding-top: -5; padding-bottom: -5" height="1">
            </td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0" height="35">
        <tr>
            <td width="14%" dir="ltr" height="35">&nbsp;</td>
            <td width="3%" dir="ltr" height="35" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial">R</font></td>
            <td width="3%" dir="ltr" height="35" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial">T</font></td>
            <td width="3%" dir="ltr" height="35">&nbsp;</td>
            <td width="7%" dir="ltr" height="35" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <p align="center">&nbsp;</td>
            <td width="3%" dir="ltr" height="35">&nbsp;</td>
            <td width="3%" dir="ltr" height="35" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial">R</font></td>
            <td width="3%" dir="ltr" height="35" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial">W</font></td>
            <td width="3%" dir="ltr" height="35">&nbsp;</td>
            <td width="7%" dir="ltr" height="35" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">&nbsp;</td>
            <td width="3%" dir="ltr" height="35">&nbsp;</td>
            <td width="8%" dir="ltr" height="35" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <p align="center"><font face="Arial">Kode Pos</font></td>
            <td width="3%" dir="ltr" height="35">&nbsp;</td>
            <td width="7%" dir="ltr" height="35" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <p align="center">&nbsp;</td>
            <td width="31%" dir="ltr" height="35">&nbsp;</td>
        </tr>
        <tr>
            <td width="14%" dir="ltr" height="35" style="border-style: solid; border-width: 0; padding: 0">&nbsp;</td>
            <td width="3%" dir="ltr" height="35" align="center" style="border: 0px solid #000000; padding: 0">&nbsp;</td>
            <td width="3%" dir="ltr" height="35" align="center" style="border: 0px solid #000000; padding: 0">&nbsp;</td>
            <td width="3%" dir="ltr" height="35" style="border-style: solid; border-width: 0; padding: 0">&nbsp;</td>
            <td width="7%" dir="ltr" height="35" style="border: 0px solid #000000; padding: 0">&nbsp;</td>
            <td width="3%" dir="ltr" height="35" style="border-style: solid; border-width: 0; padding: 0">&nbsp;</td>
            <td width="3%" dir="ltr" height="35" align="center" style="border: 0px solid #000000; padding: 0">&nbsp;</td>
            <td width="3%" dir="ltr" height="35" align="center" style="border: 0px solid #000000; padding: 0">&nbsp;</td>
            <td width="3%" dir="ltr" height="35" style="border-style: solid; border-width: 0; padding: 0">&nbsp;</td>
            <td width="7%" dir="ltr" height="35" style="border: 0px solid #000000; padding: 0">&nbsp;</td>
            <td width="3%" dir="ltr" height="35" style="border-style: solid; border-width: 0; padding: 0">&nbsp;</td>
            <td width="8%" dir="ltr" height="35" style="border: 0px solid #000000; padding: 0">&nbsp;</td>
            <td width="3%" dir="ltr" height="35" style="border-style: solid; border-width: 0; padding: 0">&nbsp;</td>
            <td width="7%" dir="ltr" height="35" style="border: 0px solid #000000; padding: 0">&nbsp;</td>
            <td width="31%" dir="ltr" height="35" style="border-style: solid; border-width: 0; padding: 0">&nbsp;</td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0" height="7">
        <tr>
            <td width="13%" height="31" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial">PAS FOTO (2 X 3)</font></td>
            <td width="11%" height="31" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial">CAP JEMPOL</font></td>
            <td width="22%" height="31" align="center" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial">SPECIMENT TANDA TANGAN</font></td>
            <td width="54%" height="31" align="center">&nbsp;</td>
        </tr>
        <tr>
            <td width="13%" height="156" align="center" valign="top" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1" rowspan="2">&nbsp;</td>
            <td width="11%" height="156" align="center" valign="top" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1" rowspan="2">&nbsp;</td>
            <td width="22%" height="142" align="center" valign="top" style="border: 1px solid #000000; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">&nbsp;</td>
            <td width="54%" height="142" valign="top">
            <p dir="ltr" align="center"><font face="Arial">Batang, 
            .......................................... 2020</font></p>
            <p dir="ltr" align="center"><font face="Arial">Pemohon,</font></p>
            <p dir="ltr" align="center">&nbsp;</p>
            <p dir="ltr" align="center">&nbsp;</p>
            <p dir="ltr" align="center"><font face="Arial">
            ......................................................................</font></td>
        </tr>
        <tr>
            <td width="22%" height="14" align="center" style="border-left-style: solid; border-left-width: 1; border-top-style: solid; border-top-width: 1; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1">
            <font face="Arial">Ket : Cap Jempol / Tanda Tangan</font></td>
            <td width="54%" height="14"></td>
        </tr>
        </table>
        <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="46%">&nbsp;</td>
            <td width="54%">
            <p align="center"><font face="Arial">Mengetahui<br>Kepala Desa Kalipucang Wetan</font></p>
            <p align="center"><font face="Arial">
            <br>
            <br>
            <br>
            <br>
            <b>( ...................................... )</b></font></font></td>
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