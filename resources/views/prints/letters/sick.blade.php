<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
	<h3 align="center">SURAT KETERANGAN<br><small>Nomor : 1234567890</small></h3>
	<p>Yang bertanda tangan dibawah ini menerangkan bahwa :</p>
	<table width="100%">
		<tr>
			<td width="20%"><b>Nama</b></td>
			<td width="3%">:</td>
			<td width="77%">{{ $letter->patient->name }}</td>
		</tr>
		<tr>
			<td width="20%"><b>Usia</b></td>
			<td width="3%">:</td>
			<td width="77%">{{ $letter->patient->age }} tahun</td>
		</tr>
		<tr>
			<td width="20%"><b>Pekerjaan</b></td>
			<td width="3%">:</td>
			<td width="77%">Swasta</td>
		</tr>
		<tr>
			<td width="20%"><b>Alamat</b></td>
			<td width="3%">:</td>
			<td width="77%">{{ $letter->patient->address }}</td>
		</tr>
	</table>
	<p>Berdasarkan hasil pemeriksaan yang telah dilakukan, pasien tersebut dalam keadaan <b>S A K I T</b>, sehingga perlu beristirahat selama ... hari, terhitung mulai tanggal ... s.d ...</p>
	<p>Demikian surat keterangan ini diberikan untuk diketahui dan dipergunakan seperlunya.</p>
	<table width="100%">
		<tr>
			<td width="70%"></td>
			<td width="30%" align="center">Jakarta, 8 Juni 2020</td>
		</tr>
		<tr>
			<td width="70%"></td>
			<td width="30%" align="center">Dokter pemeriksa,</td>
		</tr>
	</table>
</body>

</html>