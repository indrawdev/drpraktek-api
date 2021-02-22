<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
	<h3 align="center">SURAT KETERANGAN<br><small>Nomor : {{ $letter->number }}</small></h3>
	<p>Dengan ini saya menerangkan bahwa :</p>
	<table width="100%">
		<tr>
			<td width="20%"><b>Nama</b></td>
			<td width="3%">:</td>
			<td width="77%">{{ $letter->patient->name }}</td>
		</tr>
		<tr>
			<td width="20%"><b>Jenis Kelamin</b></td>
			<td width="3%">:</td>
			<td width="77%">{{ $letter->patient->gender }}</td>
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
	<p>Pada pemeriksaan hari ini menyatakan dalam keadaan</p>
	<h3 align="center">S E H A T</h3>
	<table width="100%">
		<tr>
			<td width="20%"><b>Untuk keperluan</b></td>
			<td width="3%">:</td>
			<td width="77%">Melamar pekerjaan</td>
		</tr>
	</table>
	<br>
	<table width="100%">
		<tr>
			<td width="20%"><b>Berat badan</b></td>
			<td width="3%">:</td>
			<td width="77%">{{ $letter->patient->weight }} kg</td>
		</tr>
		<tr>
			<td width="20%"><b>Tinggi badan</b></td>
			<td width="3%">:</td>
			<td width="77%">{{ $letter->patient->height }} cm</td>
		</tr>
		<tr>
			<td width="20%"><b>Tensi</b></td>
			<td width="3%">:</td>
			<td width="77%">120/60 mmHg</td>
		</tr>
		<tr>
			<td width="20%"><b>Gol darah</b></td>
			<td width="3%">:</td>
			<td width="77%">{{ $letter->patient->blood }}</td>
		</tr>
	</table>
	<br>
	<table width="100%">
		<tr>
			<td width="70%"></td>
			<td width="30%" align="center">Jakarta, 8 Juni 2020</td>
		</tr>
		<tr>
			<td width="70%"></td>
			<td width="30%" align="center">Dokter pemeriksa,</td>
		</tr>
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="70%"></td>
			<td width="30%" align="center">{{ $letter->doctor->name }}</td>
		</tr>
	</table>
</body>

</html>