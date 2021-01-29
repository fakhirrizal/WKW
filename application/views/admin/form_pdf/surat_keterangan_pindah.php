<html lang="en">

<head>
    <title>Pindah Domisili</title>
</head>
<style>
    .table-border,
    .table-border tr td {
        border: solid #000000 1px;
        border-collapse: collapse;
    }

    font {
        font-size: 10pt;
    }
</style>

<body>
    <?php
    $pisah_nama = explode(';',$nama);
    $pisah_jenis_kelamin = explode(';',$jenis_kelamin);
    $pisah_tanggal_lahir = explode(';',$tanggal_lahir);
    $pisah_status_perkawinan = explode(';',$status_perkawinan);
    $pisah_pendidikan = explode(';',$pendidikan);
    $pisah_nik = explode(';',$nik); 
    ?>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="70%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td class="table-border" width="30%" style="padding-top: 3; padding-bottom: 3;" align="center">
                <font face="Arial">LAMPIRAN A. 6</font>
            </td>
        </tr>
        <tr>
            <td width="70%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td class="table-border" width="30%" style="padding-top: 3; padding-bottom: 3;" align="center">
                <font face="Arial">Lembar I / II / III / IV / V</font>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="100%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">&nbsp;</font>
            </td>
        </tr>
        <tr>
            <td width="100%" style="padding-top: 1; padding-bottom: 1" align="center">
                <b>
                    <font face="Arial">SURAT KETERANGAN PINDAH</font>
                </b>
            </td>
        </tr>
        <tr>
            <td width="100%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial">Nomor : <?= $nomor_surat; ?></font>
            </td>
        </tr>
        <tr>
            <td width="100%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">&nbsp;</font>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">1.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Nama</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $pisah_nama[0]; ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">2.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Jenis Kelamin</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $pisah_jenis_kelamin[0]; ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">3.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Dilahirkan</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $tempat_lahir.', '.$this->Main_model->convert_tanggal($pisah_tanggal_lahir[0]); ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">4.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Kewarganegaraan</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">WNI</font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">5.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Agama</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $agama; ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">6.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Status Perkawinan</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $pisah_status_perkawinan[0]; ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">7.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Pekerjaan</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $pekerjaan; ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">8.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Pendidikan</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $pisah_pendidikan[0]; ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">9.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Alamat asal</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">RT <?= $rt; ?> RW <?= $rw; ?> Desa Kalipucang Wetan</font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Kecamatan Batang, Kabupaten Batang</font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">10.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">No KTP</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $pisah_nik[0]; ?></font>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">11.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Pindah Ke</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Desa</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $desa_pindah; ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Kecamatan</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $kecamatan_pindah; ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Kab./Kota</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $kabkota_pindah; ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Provinsi</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $provinsi_pindah; ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Pada Tanggal</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $this->Main_model->convert_tanggal($tanggal_pindah); ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Alasan Pindah</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">:</font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"><?= $alasan_pindah; ?></font>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">12.</font>
            </td>
            <td width="17%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Pengikut</font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="77%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
        </tr>
    </table>
    <table cellspacing="0" width="100%" cellpadding="0" class="table-border">
        <tr>
            <td width="4%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">No</font>
            </td>
            <td width="30%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">Nama</font>
            </td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">JK</font>
            </td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">Umur</font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">Status Perkawinan</font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">Pendidikan</font>
            </td>
            <td width="25%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">No. KTP</font>
            </td>
            <td width="7%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">Ket</font>
            </td>
        </tr>
        <?php
        $no = 1;
        for ($i=0; $i < count($pisah_nama); $i++) {
        ?>
        <tr>
            <td width="4%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"><?= $no++; ?></font>
            </td>
            <td width="30%" style="padding-top: 3; padding-bottom: 3; padding-left: 3">
                <font face="Arial"><?= $pisah_nama[$i]; ?></font>
            </td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"><?= substr($pisah_jenis_kelamin[$i],0,1); ?></font>
            </td>
            <?php
            // Tanggal Lahir
            $tgl_lahir = $pisah_tanggal_lahir[$i];
                
            // ubah ke format Ke Date Time
            $lahir = new DateTime($tgl_lahir);
            $hari_ini = new DateTime();
                
            $diff = $hari_ini->diff($lahir);
            ?>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"><?= $diff->y; ?></font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"><?= $pisah_status_perkawinan[$i]; ?></font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"><?= $pisah_pendidikan[$i]; ?></font>
            </td>
            <td width="25%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"><?= $pisah_nik[$i]; ?></font>
            </td>
            <td width="7%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">-</font>
            </td>
        </tr>
        <?php } ?>
        <!-- <tr>
            <td width="4%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">2</font>
            </td>
            <td width="30%" style="padding-top: 3; padding-bottom: 3; padding-left: 3">
                <font face="Arial">Hanif</font>
            </td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">L</font>
            </td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">23</font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">Belum Kawin</font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">SLTA</font>
            </td>
            <td width="25%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">3325102304940002</font>
            </td>
            <td width="7%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">-</font>
            </td>
        </tr>
        <tr>
            <td width="4%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">3</font>
            </td>
            <td width="30%" style="padding-top: 3; padding-bottom: 3; padding-left: 3">
                <font face="Arial">Maskur</font>
            </td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">L</font>
            </td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">26</font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">Pernah Kawin</font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">D3</font>
            </td>
            <td width="25%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">3325102304940002</font>
            </td>
            <td width="7%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">-</font>
            </td>
        </tr> -->
        <tr>
            <td width="4%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">&nbsp;</font>
            </td>
            <td width="30%" style="padding-top: 3; padding-bottom: 3" ; padding-left: 3>
                <font face="Arial"></font>
            </td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
            <td width="25%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
            <td width="7%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
        </tr>
        <tr>
            <td width="4%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial">&nbsp;</font>
            </td>
            <td width="30%" style="padding-top: 3; padding-bottom: 3; padding-left: 3">
                <font face="Arial"></font>
            </td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
            <td width="6%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
            <td width="11%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
            <td width="25%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
            <td width="7%" style="padding-top: 3; padding-bottom: 3" align="center">
                <font face="Arial"></font>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="100%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Tembusan :</font>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">1.</font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Lembar ke I untuk yang bersangkutan</font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" rowspan="6" align="center">
                <font face="Arial"><?= $gambar_qr; ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">2.</font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Lembar ke II untuk Bupati Batang cq. Kantor</font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Kependudukan dan Capil Batang</font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">3.</font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Lembar III untuk Camat Batang</font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">4.</font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Lembar IV untuk Desa Cepokokuning</font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">5.</font>
            </td>
            <td width="57%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Lembar ke V arsip</font>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="100%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">&nbsp;</font>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="100%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Tembusan :</font>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">1.</font>
            </td>
            <td width="47%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Untuk WNI dan WNA pada waktu Surat Keterangan</font>
            </td>
            <td width="10%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial">Batang, <?= $this->Main_model->convert_tanggal(date('Y-m-d')); ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="47%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Pindah ini diberikan , nama yang bersangkutan pada</font>
            </td>
            <td width="10%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial"><?= $this->Main_model->get_jabatan_ttd();  ?></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="47%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">KK dicoret dan KTP tersebut</font>
            </td>
            <td width="10%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial"></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">2.</font>
            </td>
            <td width="47%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Surat Keterangan Pindah ini ditandatangani Camat,</font>
            </td>
            <td width="10%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial"></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="47%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">kecuali untuk WNA</font>
            </td>
            <td width="10%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial"></font>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">-</font>
            </td>
            <td width="44%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Pindah keluar Kabupaten/Kota ditanda tangani </font>
            </td>
            <td width="10%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial"></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="44%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Bupati/Walikota</font>
            </td>
            <td width="10%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial"></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">-</font>
            </td>
            <td width="44%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Pindah keluar Propinsi ditandatangani Gubernur</font>
            </td>
            <td width="10%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial"><?= $this->Main_model->get_nama_ttd();  ?></font>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">3.</font>
            </td>
            <td width="47%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Tembusan Nomor 3, 4 dan 5 hanya untuk daerah</font>
            </td>
            <td width="10%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial"></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="47%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">tujuan dan atau pindah antar propinsi</font>
            </td>
            <td width="10%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial"></font>
            </td>
        </tr>
        <tr>
            <td width="3%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="47%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial">Kode Pos : 51217</font>
            </td>
            <td width="10%" style="padding-top: 1; padding-bottom: 1">
                <font face="Arial"></font>
            </td>
            <td width="40%" style="padding-top: 1; padding-bottom: 1" align="center">
                <font face="Arial"></font>
            </td>
        </tr>
    </table>
</body>

</html>