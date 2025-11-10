<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<title>Laporan Penilaian KPI Karyawan</title>
	<style>
		body {
			font-family: DejaVu Sans, sans-serif;
			font-size: 12px;
		}

		h3 {
			text-align: center;
			text-transform: uppercase;
			margin-bottom: 5px;
		}

		.info {
			margin-bottom: 15px;
		}

		.info p {
			margin: 2px 0;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 10px;
		}

		th,
		td {
			border: 1px solid #000;
			padding: 6px;
			text-align: center;
		}

		th {
			background-color: #f2f2f2;
		}

		.total {
			font-weight: bold;
			background-color: #f9f9f9;
		}

		.signature {
			width: 100%;
			margin-top: 40px;
			text-align: right;
		}
	</style>
</head>

<body>
	<h3>LAPORAN PENILAIAN KPI KARYAWAN</h3>

	<div class="info">
		<p><strong>Nama :</strong> {{ $penilaian->name ?? '-' }}</p>
		<p><strong>NIP :</strong> {{ $penilaian->nik ?? '-' }}</p>
		<p><strong>Jabatan :</strong> {{ $penilaian->jabatan ?? '-' }}</p>
		<p><strong>Divisi :</strong> {{ $penilaian->divisi ?? '-' }}</p>
		<p><strong>Periode :</strong> {{ ucfirst($penilaian->bulan) }} {{ $penilaian->tahun }}</p>
		<p><strong>Jumlah SP :</strong> {{ $penilaian->sp ?? 0 }}</p>
	</div>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Pilihan</th>
				<th>Deskripsi</th>
				<th>Skor</th>
			</tr>
		</thead>
		<tbody>
			@php $total = 0; @endphp
			@foreach($answers as $i => $ans)
			<tr>
				<td>{{ $i + 1 }}</td>
				<td>{{ $ans['choice'] ?? '-' }}</td>
				<td style="text-align:left;">{{ $ans['text'] ?? '-' }}</td>
				<td>{{ $ans['score'] ?? 0 }}</td>
			</tr>
			@php $total += $ans['score'] ?? 0; @endphp
			@endforeach
			<tr class="total">
				<td colspan="3" style="text-align:right;">Total Nilai</td>
				<td>{{ $penilaian->total_score ?? $total }}</td>
			</tr>
		</tbody>
	</table>

	<div class="signature">
		<p>Tanggal : {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
		<p>Dibuat Oleh,</p>
		<br><br><br>
		<p><u>HRM</u></p>
	</div>
</body>

</html>