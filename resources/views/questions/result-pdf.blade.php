<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<title>Laporan KPI Tahunan</title>
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

		.kategori {
			margin-top: 20px;
			width: 50%;
		}

		.kategori th,
		.kategori td {
			text-align: center;
		}

		.signature {
			width: 100%;
			margin-top: 40px;
			text-align: right;
		}
	</style>
</head>

<body>
	<h3>LAPORAN PENCAPAIAN POIN KPI RATA-RATA<br>TAHUNAN KARYAWAN</h3>

	<div class="info">
		<p><strong>Divisi :</strong> {{ $divisi ?? 'Semua Divisi' }}</p>
		<p><strong>Periode :</strong>
			@if($tahunMulai && $tahunAkhir)
			{{ $tahunMulai }} - {{ $tahunAkhir }}
			@elseif($tahunMulai)
			{{ $tahunMulai }}
			@else
			Semua Tahun
			@endif
		</p>
	</div>

	{{-- Tabel Hasil --}}
	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>NIK</th>
				<th>Jabatan</th>
				<th>Rata-rata Poin KPI</th>
				<th>Kategori</th>
			</tr>
		</thead>
		<tbody>
			@forelse($results as $i => $res)
			<tr>
				<td>{{ $i+1 }}</td>
				<td>{{ $res->name }}</td>
				<td>{{ $res->nik }}</td>
				<td>{{ $res->jabatan }}</td>
				<td>{{ number_format($res->avg_score, 2) }}</td>
				<td>{{ $res->kategori }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="6" style="text-align: center; color: #777;">
					Belum ada hasil penilaian.
				</td>
			</tr>
			@endforelse
		</tbody>
	</table>

	{{-- Kategori Poin --}}
	<table class="kategori" border="1">
		<thead>
			<tr>
				<th>Kategori</th>
				<th>Range Point KPI</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>A</td>
				<td>90 - 100</td>
			</tr>
			<tr>
				<td>B</td>
				<td>80 - 89</td>
			</tr>
			<tr>
				<td>C</td>
				<td>70 - 79</td>
			</tr>
			<tr>
				<td>D</td>
				<td>60 - 69</td>
			</tr>
			<tr>
				<td>E</td>
				<td>&lt; 59</td>
			</tr>
		</tbody>
	</table>

	{{-- Tanda Tangan --}}
	<div class="signature">
		<p>Tanggal : {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
		<p>Dibuat Oleh,</p>
		<br><br><br>
		<p><u>HRM</u></p>
	</div>
</body>

</html>