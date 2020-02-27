<?php
$nama_file='Form Keterangan Domisili'; // Beri nama file PDF hasil.
define('_MPDF_PATH','mpdf60/');
include(_MPDF_PATH . "mpdf.php");
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
ob_start(); 
$mpdf->useGraphs = false;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Form Keterangan Domisili</title>
    </head>
    <body>
        <?php
        include "../koneksi.php";
        ?>
        <table border="1" cellspacing="1" width="100%" style="border-width:0; ">
            <tr>
                <td width="12%" rowspan="6" style="border-style:none; border-width:medium; ">
                    <p align="center">
                        <img border="0" src="../assets/logo-batang.png" width="105" height="128">
                </td>
                <td width="76%" style="border-style: none; border-width: medium">
                    <p align="center">
                        <b>
                            <font face="Arial" size="4">PEMERINTAH KABUPATEN BATANG</font>
                        </b>
                </td>
                <td width="12%" style="border-style: none; border-width: medium" rowspan="6">
                    <p align="center">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="76%" align="center" style="border-style: none; border-width: medium">
                    <b>
                        <font face="Arial" size="4">KECAMATAN BATANG</font>
                    </b></td>
            </tr>
            <tr>
                <td width="76%" align="center" style="border-style: none; border-width: medium">
                    <b>
                        <font face="Arial" size="5">DESA KALIPUCANG WETAN</font>
                    </b></td>
            </tr>
            <tr>
                <td width="76%" align="center" style="border-style: none; border-width: medium">
                    <font face="Arial">Alamat : Jl. Mataram No. 06 Batang</font>
                </td>
            </tr>
            <tr>
                <td width="76%" align="center" style="border-style: none; border-width: medium">
                    <font face="Arial">Email : kalipucangwetan5@gmail.com</font>
                </td>
            </tr>
            <tr>
                <td width="76%" align="center" style="border-style:none; border-width:medium; ">
                    <p style="line-height: 150%">
                        <font face="Arial">Website : www.kalipucangwetan-batang.desa.id </font>
                </td>
            </tr>
            <tr>
                <td width="100%" style="border-style:none; border-width:medium; " colspan="3">
                    <hr color="#000000" size="5">
                </td>
            </tr>
        </table>
        <p>&nbsp;</p>

        <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-width: 0"
            bordercolor="#000000" width="100%" height="7">
            <tr>
                <td width="100%" style="border-style: none; border-width: medium" align="center" height="1">
                    <p style="line-height: 150%"><b>
                            <font face="Arial">SURAT KETERANGAN DOMISILI</font>
                        </b>
                </td>
            </tr>
            <tr>
                <td width="100%" style="border-style: none; border-width: medium" align="center" height="1">
                    <p style="line-height: 150%">
                        <font face="Arial">Nomor : 474.1/ / ... / 2020</font>
                </td>
            </tr>
            <tr>
                <td width="100%" style="border-style: none; border-width: medium" align="center" height="17">
                    <p style="line-height: 150%">
                </td>
            </tr>
        </table>

        <table border="1" cellspacing="1" width="100%" style="border-width: 0" height="388">
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">1.</font>
                </td>
                <td width="97%" style="border-style: none; border-width: medium" colspan="4" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Yang bertanda tangan dibawah
                            ini :</font>
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="19">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="3%" style="border-style: none; border-width: medium" height="19">
                    <p style="line-height: 150%">
                        <font face="Arial">a.</font>
                </td>
                <td width="25%" style="border-style: none; border-width: medium" height="19">
                    <p style="line-height: 150%">
                        <font face="Arial">Nama </font>
                </td>
                <td width="2%" style="border-style: none; border-width: medium" height="19">
                    <p style="line-height: 150%">
                        <font face="Arial">:</font>
                </td>
                <td width="67%" style="border-style: none; border-width: medium" height="19">
                    <p style="line-height: 150%">
                        <span lang="IN" style="font-family: Arial,sans-serif">
                            BAMBANG EDY SUDARMANTO</span>
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">b.</font>
                </td>
                <td width="25%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Jabatan </font>
                </td>
                <td width="2%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">:</font>
                </td>
                <td width="67%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial,sans-serif">Sekretaris Desa</font>
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="97%" style="border-style: none; border-width: medium" colspan="4" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Dengan ini menerangkan,
                            bahwa :</font>
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">a.</font>
                </td>
                <td width="25%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Nama</font>
                </td>
                <td width="2%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">:</font>
                </td>
                <td width="67%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">b.</font>
                </td>
                <td width="25%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Tempat Tanggal Lahir</font>
                </td>
                <td width="2%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">:</font>
                </td>
                <td width="67%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">c.</font>
                </td>
                <td width="25%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Kebangsaan</font>
                </td>
                <td width="2%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">:</font>
                </td>
                <td width="67%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">d.</font>
                </td>
                <td width="25%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Pekerjaan</font>
                </td>
                <td width="2%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">:</font>
                </td>
                <td width="67%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">e.</font>
                </td>
                <td width="25%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Agama</font>
                </td>
                <td width="2%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">:</font>
                </td>
                <td width="67%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">f.</font>
                </td>
                <td width="25%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Alamat</font>
                </td>
                <td width="2%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">:</font>
                </td>
                <td width="67%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">g.</font>
                </td>
                <td width="25%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Keperluan</font>
                </td>
                <td width="2%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">:</font>
                </td>
                <td width="67%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">h.</font>
                </td>
                <td width="25%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Keterangan</font>
                </td>
                <td width="2%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">:</font>
                </td>
                <td width="67%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="97%" style="border-style: none; border-width: medium" colspan="4" height="21">
                    <p align="justify" style="line-height: 150%">
                        <font face="Arial">Bermaksud
                            menerangkan bahwa nama tersebut diatas benar-benar warga Desa Kalipucang
                            Wetan dan Berdomisili di Desa Kalipucang Wetan RT ... RW ... Kecamatan Batang
                            Kabupaten Batang.</font>
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">2.</font>
                </td>
                <td width="97%" style="border-style: none; border-width: medium" colspan="4" height="21">
                    <p align="justify" style="line-height: 150%">
                        <font face="Arial">Berhubung
                            dengan maksud yang bersangkutan, diminta agar instansi yang terkait dapat
                            memberikan bantuan serta fasilitas seperlunya.</font>
                </td>
            </tr>
            <tr>
                <td width="3%" style="border-style: none; border-width: medium" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">3.</font>
                </td>
                <td width="97%" style="border-style: none; border-width: medium" colspan="4" align="justify" height="21">
                    <p style="line-height: 150%">
                        <font face="Arial">Demikian surat keterangan
                            ini dibuat untuk dipergunakan seperlunya</font>
                </td>
            </tr>
        </table>
        <p style="line-height: 150%">&nbsp;</p>
        <table border="1" cellspacing="1" width="100%" style="border-width: 0">
            <tr>
                <td width="50%" style="border-style: none; border-width: medium">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="50%" style="border-style: none; border-width: medium" align="center">
                    <p style="line-height: 150%">
                        <font face="Arial">Batang, .... Februari 2020</font>
                </td>
            </tr>
            <tr>
                <td width="50%" style="border-style: none; border-width: medium">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="50%" style="border-style: none; border-width: medium" align="center">
                    <p style="line-height: 150%">
                        <font face="Arial">a.n KEPALA DESA</font>
                </td>
            </tr>
            <tr>
                <td width="50%" style="border-style: none; border-width: medium">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="50%" style="border-style: none; border-width: medium" align="center">
                    <p style="line-height: 150%">
                        <font face="Arial">KALIPUCANG WETAN</font>
                </td>
            </tr>
            <tr>
                <td width="50%" style="border-style: none; border-width: medium">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="50%" style="border-style: none; border-width: medium" align="center">
                    <p style="line-height: 150%">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="50%" style="border-style: none; border-width: medium">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="50%" style="border-style: none; border-width: medium" align="center">
                    <p style="line-height: 150%">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="50%" style="border-style: none; border-width: medium">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="50%" style="border-style: none; border-width: medium" align="center">
                    <p style="line-height: 150%">&nbsp;
                </td>
            </tr>
            <tr>
                <td width="50%" style="border-style: none; border-width: medium">
                    <p style="line-height: 150%">&nbsp;
                </td>
                <td width="50%" style="border-style: none; border-width: medium" align="center">
                    <p style="line-height: 150%">
                        <span lang="IN" style="font-family: Arial">BAMBANG EDY
                            SUDARMANTO</span>
                </td>
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