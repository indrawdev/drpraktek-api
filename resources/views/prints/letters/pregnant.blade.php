<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
	<table width="100%">
		<tr>
			<td width="100%" align="center">
				<b>{{ strtoupper($letter->clinic->name) }}</b>
				<br>
				<i><small>{{ $letter->clinic->address }}</small></i>
				<br>
				<i><small>phone : {{ $letter->clinic->phone }} - email : {{ $letter->clinic->email }}</small></i>
			</td>
		</tr>
	</table>
	<hr>
	<h3 align="center">SURAT KETERANGAN<br><small>Nomor : {{ $letter->number }}</small></h3>
	<p>Yang bertanda tangan dibawah ini :</p>
	<table width="100%">
		<tr>
			<td width="20%"><b>Nama</b></td>
			<td width="3%">:</td>
			<td width="77%">{{ $letter->doctor->name }}</td>
		</tr>
		<tr>
			<td width="20%"><b>Alamat</b></td>
			<td width="3%">:</td>
			<td width="77%">{{ $letter->clinic->address }}</td>
		</tr>
	</table>
	<p>Menerangkan bahwa :</p>
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
			<td width="20%"><b>Alamat</b></td>
			<td width="3%">:</td>
			<td width="77%">{{ $letter->patient->age }}</td>
		</tr>
	</table>
	<p>Pada waktu pemeriksaan dalam keadaan <b>H A M I L</b></p>
	<p>Demikian surat ini digunakan untuk keperluan Cuti</p>
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
	</table>
</body>

</html>