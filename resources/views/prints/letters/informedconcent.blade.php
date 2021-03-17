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
			<td></td>
		</tr>
	</table>
</body>

</html>