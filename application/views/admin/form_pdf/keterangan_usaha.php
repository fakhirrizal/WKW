<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Surat Keterangan Usaha</title>
</head>

<body>
	<table border="0" cellspacing="1" width="100%" style="border-width:0; ">
		<tr>
			<td width="12%" rowspan="6" style="border-style:none; border-width:medium; ">
				<p align="center">
					<img border="0" src="<?= base_url() ?>/assets_dashboard/batang.png" width="128" height="128">
			</td>
			<td width="76%" style="border-style: none; border-width: medium" align="center">
				<p align="center"><b>
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
					<font face="Arial">Website :
						www.kalipucangwetan-batang.desa.id </font>
			</td>
		</tr>
		<tr>
			<td width="100%" style="border-style:none; border-width:medium; " colspan="3">
				<hr color="#000000" size="5">
			</td>
		</tr>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-width: 0"
		bordercolor="#000000" width="100%" height="7">
		<tr>
			<td width="100%" style="border-style: none; border-width: medium" align="center" height="1">
				<p style="line-height: 150%"><b>
						<font face="Arial">SURAT KETERANGAN USAHA</font>
					</b>
			</td>
		</tr>
		<tr>
			<td width="100%" style="border-style: none; border-width: medium" align="center" height="1">
				<p style="line-height: 150%">
					<font face="Arial">Nomor : <?= $nomor_surat; ?></font>
			</td>
		</tr>
		<tr>
			<td width="100%" style="border-style: none; border-width: medium" align="center" height="17">
				<p style="line-height: 150%">
			</td>
		</tr>
	</table>
	<table border="0" cellspacing="1" width="100%" style="border-width: 0" height="388">
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">1.</font>
			</td>
			<td width="96%" style="border-style: none; border-width: medium" colspan="4" height="21">
				<p style="line-height: 150%">
					<font face="Arial">Yang bertanda tangan dibawah
						ini :</font>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="19">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="19">
				<p style="line-height: 150%">
					<font face="Arial">a.</font>
			</td>
			<td width="25%" style="border-style: none; border-width: medium" height="19">
				<p style="line-height: 150%">
					<font face="Arial">Nama </font>
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="19">
				<p style="line-height: 150%">
					<font face="Arial">:</font>
			</td>
			<td width="63%" style="border-style: none; border-width: medium" height="19">
				<p style="line-height: 150%">
					<span lang="IN" style="font-family: Arial,sans-serif"><?= $this->Main_model->get_nama_ttd();  ?></span>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">b.</font>
			</td>
			<td width="25%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">Jabatan </font>
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">:</font>
			</td>
			<td width="63%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial,sans-serif"><?= $this->Main_model->get_jabatan_ttd();  ?></font>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="96%" style="border-style: none; border-width: medium" colspan="4" height="21">
				<p style="line-height: 150%">
					<font face="Arial">Dengan ini menerangkan,
						bahwa :</font>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">a.</font>
			</td>
			<td width="25%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">Nama</font>
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">:</font>
			</td>
			<td width="63%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp; <font face="Arial,sans-serif"><?= $nama; ?></font>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">b.</font>
			</td>
			<td width="25%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">Tempat Tanggal Lahir</font>
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">:</font>
			</td>
			<td width="63%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp; <font face="Arial,sans-serif"><?= $tempat_lahir.', '.$this->Main_model->convert_tanggal($tanggal_lahir); ?></font>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">c.</font>
			</td>
			<td width="25%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">Pekerjaan</font>
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">:</font>
			</td>
			<td width="63%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp; <font face="Arial,sans-serif"><?= $pekerjaan; ?></font>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">d.</font>
			</td>
			<td width="25%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">Agama</font>
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">:</font>
			</td>
			<td width="63%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp; <font face="Arial,sans-serif"><?= $agama; ?></font>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">e.</font>
			</td>
			<td width="25%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">Alamat</font>
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">:</font>
			</td>
			<td width="63%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp; <font face="Arial">RT <?= $rt; ?> RW <?= $rw; ?>
						Desa Kalipucang Wetan</font>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="25%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">:</font>
			</td>
			<td width="63%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp; <font face="Arial">Kecamatan Batang,
						Kabupaten Batang</font>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				&nbsp;</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				&nbsp;</td>
			<td width="25%" style="border-style: none; border-width: medium" height="21">
				&nbsp;</td>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				&nbsp;</td>
			<td width="63%" style="border-style: none; border-width: medium" height="21">
				&nbsp;</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="96%" style="border-style: none; border-width: medium" colspan="4" height="21">
				<p align="justify" style="line-height: 150%">
					<font face="Arial">Dengan ini
						kami bermaksud
						menerangkan dengan sebenarnya, bahwa nama tersebut diatas mempunyai Usaha
						<?= $jenis_usaha; ?>, dengan nama Usaha <?= $nama_usaha; ?> , yang berlokasi RT <?= $rt; ?> RW <?= $rw; ?> Desa Kalipucang Wetan,
						Kecamatan
						Batang, Kabupaten Batang.</font>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21" valign="top">
				<p style="line-height: 150%">
					<font face="Arial">2.</font>
			</td>
			<td width="96%" style="border-style: none; border-width: medium" colspan="4" height="21">
				<p align="justify" style="line-height: 150%">
					<font face="Arial">Berhubung
						dengan maksud yang bersangkutan, diminta agar instansi / pihak yang terkait dapat
						memberikan bantuan serta fasilitas seperlunya.</font>
			</td>
		</tr>
		<tr>
			<td width="4%" style="border-style: none; border-width: medium" height="21">
				<p style="line-height: 150%">
					<font face="Arial">3.</font>
			</td>
			<td width="96%" style="border-style: none; border-width: medium" colspan="4" align="justify" height="21">
				<p style="line-height: 150%">
					<font face="Arial">Demikian surat keterangan
						ini dibuat untuk dipergunakan seperlunya</font>
			</td>
		</tr>
	</table>
	<p style="line-height: 150%">&nbsp;</p>
	<table border="0" cellspacing="1" width="100%" style="border-width: 0">
		<tr>
			<td width="50%" style="border-style: none; border-width: medium">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="50%" style="border-style: none; border-width: medium" align="center">
				<p style="line-height: 150%">
					<font face="Arial">Batang, <?= $this->Main_model->convert_tanggal(date('Y-m-d')); ?></font>
			</td>
		</tr>
		<tr>
			<td width="50%" style="border-style: none; border-width: medium">
				<p style="line-height: 150%">&nbsp;
			</td>
			<td width="50%" style="border-style: none; border-width: medium" align="center">
				<p style="line-height: 150%">
					<font face="Arial"><?= $this->Main_model->get_jabatan_ttd();  ?></font>
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
				<p style="line-height: 150%">&nbsp;<?= $gambar_qr; ?>
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
				<p style="line-height: 150%"><span lang="IN" style="font-family: Arial">
						<?= $this->Main_model->get_nama_ttd();  ?></span>
			</td>
		</tr>
	</table>

</body>

</html>
