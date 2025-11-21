<!DOCTYPE html>
<html>

<head>
	<style>
		table {
			width: 100%;
			border-collapse: collapse;
			font-size: 12px;
		}

		th,
		td {
			padding: 6px;
			border: 1px solid #000;
		}

		h3 {
			text-align: center;
			margin-bottom: 20px;
		}

		.footer {
			margin-top: 20px;
			padding: 10px;
			background: #f9f9f9;
			border: 1px solid #ddd;
		}
	</style>
</head>

<body>

	@php
	function isDarkColor($hex) {
	$hex = str_replace('#', '', $hex);
	$r = hexdec(substr($hex, 0, 2));
	$g = hexdec(substr($hex, 2, 2));
	$b = hexdec(substr($hex, 4, 2));
	$luminance = (0.299*$r + 0.587*$g + 0.114*$b) / 255;
	return $luminance < 0.5;
		}

		$textColor=isDarkColor($color) ? '#ffffff' : '#000000' ;
		@endphp

		<h3 style="background: {{ $color }}; color: {{ $textColor }}; padding:10px; border-radius:5px;">
		Matrix {{ $matrixTitle }}
		@if($year) - Tahun {{ $year }} @endif
		@if($division) | Divisi: {{ $division }} @endif
		</h3>

		<table>
			<thead>
				<tr style="background: {{ $color }}; color: {{ $textColor }};">
					<th>Nama</th>
					<th>Jabatan</th>
					<th>Nilai Performance</th>
					<th>Nilai Sikap Kerja</th>
					<th>Kategori</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				@forelse($questions as $q)
				<tr>
					<td>{{ $q->name }}</td>
					<td>{{ $q->divisi }}</td>
					<td>{{ $q->performance }}</td>
					<td>{{ $q->potential }}</td>
					<td>{{ $q->category }}</td>
					<td>{{ $q->description }}</td>
				</tr>
				@empty
				<tr>
					<td colspan="6" style="text-align:center;">Tidak ada data</td>
				</tr>
				@endforelse
			</tbody>
		</table>

		<div class="footer">
			<strong>Improvement:</strong><br>
			@include('matrix.partials.improvement', ['matrixTitle' => $matrixTitle])
		</div>

</body>

</html>