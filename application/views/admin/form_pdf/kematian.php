<html lang="en">

<head>

    <title>Surat Kematian</title>

</head>

<body>

    <table border="0" cellspacing="0" width="100%" cellpadding="0">
      <tr>
        <td width="86%">&nbsp;</td>
        <td width="14%" style="border: 2px solid #000000; padding-left: 4; padding-right: 4; padding-top: 3; padding-bottom: 3">
        <p align="center"><font face="Arial">LAMPIRAN A-5</font></td>
      </tr>
      <tr>
        <td width="86%">&nbsp;</td>
        <td width="14%">&nbsp;</td>
      </tr>
    </table>
    <table border="0" cellspacing="0" width="100%" cellpadding="0">
      <tr>
        <td width="33%" align="center" style="padding-right: 25; padding-top: 3; padding-bottom: 3">
        <font face="Arial">UNTUK ARSIP DESA/KELURAHAN</font></td>
        <td width="33%" align="center" style="padding-top: 3; padding-bottom: 3">
        <font face="Arial">UNTUK ARSIP KECAMATAN</font></td>
        <td width="34%" align="center" style="padding-left: 25; padding-top: 3; padding-bottom: 3">
        <font face="Arial">UNTUK YANG BERSANGKUTAN</font></td>
      </tr>
      <tr>
        <td width="33%" align="center" style="padding-right: 25; padding-top: 3; padding-bottom: 3">&nbsp;</td>
        <td width="33%" align="center" style="padding-top: 3; padding-bottom: 3">&nbsp;</td>
        <td width="34%" align="center" style="padding-left: 25; padding-top: 3; padding-bottom: 3">&nbsp;</td>
      </tr>
      <tr>
        <td width="33%" align="center" style="padding-right: 25; padding-top: 3; padding-bottom: 3">
        <b><font face="Arial">SURAT KEMATIAN</font></b></td>
        <td width="33%" align="center" style="padding-top: 3; padding-bottom: 3">
        <b><font face="Arial">SURAT KEMATIAN</font></b></td>
        <td width="34%" align="center" style="padding-left: 25; padding-top: 3; padding-bottom: 3">
        <b><font face="Arial">SURAT KEMATIAN</font></b></td>
      </tr>
      <tr>
        <td width="33%" align="center" style="padding-right: 25; padding-top: 3; padding-bottom: 3">
        <font face="Arial">NO. <?= $nomor_surat; ?></font></td>
        <td width="33%" align="center" style="padding-top: 3; padding-bottom: 3">
        <font face="Arial">NO. <?= $nomor_surat; ?></font></td>
        <td width="34%" align="center" style="padding-left: 25; padding-top: 3; padding-bottom: 3">
        <font face="Arial">NO. <?= $nomor_surat; ?></font></td>
      </tr>
      <tr>
        <td width="33%" style="padding-right: 25; padding-top: 3; padding-bottom: 3">&nbsp;</td>
        <td width="33%" style="border-bottom-style: none; border-bottom-width: medium; padding-top: 3; padding-bottom: 3">&nbsp;</td>
        <td width="34%" style="padding-left: 25; padding-top: 3; padding-bottom: 3">&nbsp;</td>
      </tr>
      <tr>
        <td width="33%" style="border-right-style: none; border-right-width: medium; padding-right: 25; padding-top: 3; padding-bottom: 3">&nbsp;</td>
        <td width="33%" style="border-left: 2px solid #000000; border-right: 2px solid #000000; border-top: 2px solid #000000; padding-top: 3; padding-bottom: 3">
        <p align="center"><b><font face="Arial">SURAT KEMATIAN</font></b></td>
        <td width="34%" style="border-left-style: none; border-left-width: medium; padding-left: 25; padding-top: 3; padding-bottom: 3">&nbsp;</td>
      </tr>
      <tr>
        <td width="33%" style="border-right-style: none; border-right-width: medium; padding-right: 25; padding-top: 3; padding-bottom: 3">
        <p align="center"><font face="Arial">Yang bertanda tangan dibawah ini 
        menerangkan bahwa :</font></td>
        <td width="33%" style="border-left: 2px solid #000000; border-right: 2px solid #000000; padding-left: 5; padding-right: 5; padding-top: 3; padding-bottom: 3">&nbsp;</td>
        <td width="34%" style="border-left-style: none; border-left-width: medium; padding-left: 25; padding-top: 3; padding-bottom: 3">
        <p align="center"><font face="Arial">Yang bertanda tangan dibawah ini 
        menerangkan bahwa :</font></td>
      </tr>
      <tr>
        <td width="33%" style="border-right-width: medium; padding-right: 25; padding-top: 3; padding-bottom: 3" valign="top">&nbsp;<table border="0" cellspacing="0" width="100%" cellpadding="0">
          <tr>
            <td width="29%"><font face="Arial">Nama</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $nama; ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Jenis Kelamin</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $jenis_kelamin; ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Alamat</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top"><font face="Arial">RT <?= $rt; ?> RW <?= $rw; ?> Desa 
            Kalipucang Wetan</font></td>
          </tr>
          <tr>
            <td width="29%">&nbsp;</td>
            <td width="4%" valign="top">&nbsp;</td>
            <td width="67%" valign="top"><font face="Arial">Kec. Batang, Kab. 
            Batang</font></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Umur</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;
              <?php
                $birthDate = new DateTime($tanggal_lahir);
                $today = new DateTime($tanggal_meninggal);
                if ($birthDate > $today) { 
                  exit("0 tahun 0 bulan 0 hari");
                }
                $y = $today->diff($birthDate)->y;
                echo $y." tahun";
              ?>
            </td>
          </tr>
          <tr>
            <td width="100%" colspan="3"><font face="Arial">Telah Meninggal 
            Dunia pada :</font></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Hari</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $this->Main_model->convert_hari($tanggal_meninggal); ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Tanggal</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $this->Main_model->convert_tanggal($tanggal_meninggal); ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Di</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $tempat_meninggal; ?></td>
          </tr>
          <tr>
            <td width="29%">&nbsp;</td>
            <td width="4%" valign="top">&nbsp;</td>
            <td width="67%" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Disebabkan karena</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $sebab_kematian; ?></td>
          </tr>
          <tr>
            <td width="100%" colspan="3"><font face="Arial">Surat keterangan ini 
            dibuat atas dasar yang sebenarnya.</font></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Nama yang melapor</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $pelapor; ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Hubungan dengan yang mati</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $hubungan_pelapor; ?></td>
          </tr>
        </table>
        </td>
        <td width="33%" style="border-left: 2px solid #000000; border-right: 2px solid #000000; border-top-width: medium; border-bottom: 2px solid #000000; padding-left: 6; padding-right: 6; padding-top: 3; padding-bottom: 3" valign="top">
        <table border="0" cellspacing="0" width="100%" cellpadding="0">
          <tr>
            <td width="29%"><font face="Arial">Nama</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $nama; ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Jenis Kelamin</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $jenis_kelamin; ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Tempat &amp; Tanggal Lahir</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $tempat_lahir.', '.$this->Main_model->convert_tanggal($tanggal_lahir); ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Alamat</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top"><font face="Arial">RT <?= $rt; ?> RW <?= $rw; ?> Desa 
            Kalipucang Wetan</font></td>
          </tr>
          <tr>
            <td width="29%">&nbsp;</td>
            <td width="4%" valign="top">&nbsp;</td>
            <td width="67%" valign="top"><font face="Arial">Kec. Batang, Kab. 
            Batang</font></td>
          </tr>
          <tr>
            <td width="100%" colspan="3"><font face="Arial">Meninggal Dunia pada 
            :</font></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Hari</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $this->Main_model->convert_hari($tanggal_lahir); ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Tanggal</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $this->Main_model->convert_tanggal($tanggal_lahir); ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Tempat meninggal</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $tempat_meninggal; ?></td>
          </tr>
          <tr>
            <td width="29%">&nbsp;</td>
            <td width="4%" valign="top">&nbsp;</td>
            <td width="67%" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Disebabkan karena</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $sebab_kematian; ?></td>
          </tr>
          <tr>
            <td width="100%" colspan="3">
            <p align="center"><font face="Arial">ORANG YANG MELAPOR.</font></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Nama </font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">
            <p dir="ltr">&nbsp;<?= $pelapor; ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Alamat</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top"><font face="Arial">RT <?= $rt_pelapor; ?> RW <?= $rw_pelapor; ?> 
            Desa <?= $desa_pelapor; ?></font></td>
          </tr>
          <tr>
            <td width="29%">&nbsp;</td>
            <td width="4%" valign="top">&nbsp;</td>
            <td width="67%" valign="top"><font face="Arial">Kec. 
            <?= $kecamatan_pelapor; ?> Kab. <?= $kabupaten_pelapor; ?></font></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Hubungan dengan yang meninggal</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $hubungan_pelapor; ?></td>
          </tr>
        </table>
        </td>
        <td width="34%" style="border-left-width: medium; padding-left: 25; padding-top: 3; padding-bottom: 3" valign="top">&nbsp;<table border="0" cellspacing="0" width="100%" cellpadding="0">
          <tr>
            <td width="29%"><font face="Arial">Nama</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $nama; ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Jenis Kelamin</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $jenis_kelamin; ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Alamat</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top"><font face="Arial">RT <?= $rt; ?> RW <?= $rw; ?> Desa 
            Kalipucang Wetan</font></td>
          </tr>
          <tr>
            <td width="29%">&nbsp;</td>
            <td width="4%" valign="top">&nbsp;</td>
            <td width="67%" valign="top"><font face="Arial">Kec. Batang, Kab. 
            Batang</font></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Umur</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;
              <?php
                $birthDate = new DateTime($tanggal_lahir);
                $today = new DateTime($tanggal_meninggal);
                if ($birthDate > $today) { 
                  exit("0 tahun 0 bulan 0 hari");
                }
                $y = $today->diff($birthDate)->y;
                echo $y." tahun";
              ?>
            </td>
          </tr>
          <tr>
            <td width="100%" colspan="3"><font face="Arial">Telah Meninggal 
            Dunia pada :</font></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Hari</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $this->Main_model->convert_hari($tanggal_meninggal); ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Tanggal</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $this->Main_model->convert_tanggal($tanggal_meninggal); ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Di</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $tempat_meninggal; ?></td>
          </tr>
          <tr>
            <td width="29%">&nbsp;</td>
            <td width="4%" valign="top">&nbsp;</td>
            <td width="67%" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Disebabkan karena</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $sebab_kematian; ?></td>
          </tr>
          <tr>
            <td width="100%" colspan="3"><font face="Arial">Surat keterangan ini 
            dibuat atas dasar yang sebenarnya.</font></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Nama yang melapor</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $pelapor; ?></td>
          </tr>
          <tr>
            <td width="29%"><font face="Arial">Hubungan dengan yang mati</font></td>
            <td width="4%" valign="top"><font face="Arial">:</font></td>
            <td width="67%" valign="top">&nbsp;<?= $hubungan_pelapor; ?></td>
          </tr>
        </table>
        <p>&nbsp;</td>
      </tr>
      <tr>
        <td width="33%" style="padding-top: 3; padding-bottom: 3">&nbsp;</td>
        <td width="33%" style="border-top-style: none; border-top-width: medium; padding-top: 3; padding-bottom: 3">&nbsp;</td>
        <td width="34%" style="padding-top: 3; padding-bottom: 3">&nbsp;</td>
      </tr>
      <tr>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial">Batang, <?= $this->Main_model->convert_tanggal(date('Y-m-d')); ?></font></td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial">Batang, <?= $this->Main_model->convert_tanggal(date('Y-m-d')); ?></font></td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial">Batang, <?= $this->Main_model->convert_tanggal(date('Y-m-d')); ?></font></td>
      </tr>
      <tr>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial"><?= $this->Main_model->get_jabatan_ttd();  ?> </font></td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial"><?= $this->Main_model->get_jabatan_ttd();  ?> </font></td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial"><?= $this->Main_model->get_jabatan_ttd();  ?> </font></td>
      </tr>
      <tr>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial">Kalipucang Wetan</font></td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial">Kalipucang Wetan</font></td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial">Kalipucang Wetan</font></td>
      </tr>
      <tr>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">&nbsp;</td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">&nbsp;</td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">&nbsp;</td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">&nbsp;</td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">&nbsp;</td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">&nbsp;</td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial"><?= $this->Main_model->get_nama_ttd();  ?></font></td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial"><?= $this->Main_model->get_nama_ttd();  ?></font></td>
        <td width="33%" style="padding-top: 3; padding-bottom: 3" align="center">
        <font face="Arial"><?= $this->Main_model->get_nama_ttd();  ?></font></td>
      </tr>
    </table>
    <div style="padding-top: 3;" align="center">
    <?= $gambar_qr; ?>
    </div>
</body>

</html>