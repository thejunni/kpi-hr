@extends('layouts.app')

@section('content')
<div class="container mt-4">
	{{-- 🔹 Data Karyawan --}}
	<div class="card shadow-sm border-0 mb-4">
		<div class="card shadow-sm border-0 mb-4"
			style="background: linear-gradient(135deg, #000000, #C9A227); color: white;">
			<div class="card-body d-flex justify-content-between align-items-center">
				<h4 class="mb-0 fw-bold">Detail Karyawan</h4>
				<div>
					<a href="{{ route('users.index') }}" class="btn btn-dark fw-bold">
						<i class="fa fa-arrow-left"></i> Kembali ke Daftar Karyawan
					</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<p><strong>Nama:</strong> {{ $user->name }}</p>
			<p><strong>NIK:</strong> {{ $user->nik }}</p>
			<p><strong>Email:</strong> {{ $user->email }}</p>
			<p><strong>Jabatan:</strong> {{ $user->jabatan ?? '-' }}</p>
			<p><strong>Divisi:</strong> {{ $user->divisi ?? '-' }}</p>
		</div>
	</div>

	{{-- 🔹 Riwayat Nilai --}}
	<div class="card shadow-sm border-0 mb-4">
		<div class="card-header bg-warning text-dark">
			<i class="fa-solid fa-chart-line me-2"></i>
			<strong>Riwayat Nilai Perbulan</strong>
		</div>
		<div class="card-body">
			@if($nilaiBulanan->isEmpty())
			<p class="text-muted">Belum ada data penilaian untuk karyawan ini.</p>
			@else
			<table class="table table-striped align-middle">
				<thead>
					<tr>
						<th>Bulan</th>
						<th>Total Nilai</th>
						<th class="text-center">Detail</th>
					</tr>
				</thead>
				<tbody>
					@foreach($nilaiBulanan as $i => $nilai)
					<tr>
						<td>{{ $nilai->periode }}</td>
						<td><span class="badge bg-success">{{ $nilai->total_score }}</span></td>
						<td class="text-center">
							<button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#detail-{{ $i }}">
								<i class="fa-solid fa-eye"></i> Lihat
							</button>
							<a href="{{ route('employees.download', $nilai->id) }}" class="btn btn-danger btn-sm">
                			    <i class="bi bi-file-earmark-pdf"></i> Download PDF
                			</a>
						</td>
					</tr>
					<tr class="collapse bg-light" id="detail-{{ $i }}">
						<td colspan="3">
							@if(!empty($nilai->decoded_answers))
							<table class="table table-bordered table-sm mb-0">
								<thead class="table-light">
									<tr>
										<th style="width:80px;">Pilihan</th>
										<th>Deskripsi</th>
										<th style="width:80px;">Skor</th>
									</tr>
								</thead>
								<tbody>
									@foreach($nilai->decoded_answers as $ans)
									<tr>
										<td class="text-center">{{ $ans['choice'] ?? '-' }}</td>
										<td>{{ $ans['text'] ?? '-' }}</td>
										<td class="text-center">{{ $ans['score'] ?? 0 }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							Surat Peringatan : {{ $nilai->sp ? $nilai->sp : 0}}
							@else
							<p class="text-muted mb-0">Tidak ada detail jawaban.</p>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			{{-- 🔹 Chart Nilai --}}
			<div class="mt-4">
				<canvas id="nilaiChart" height="100"></canvas>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const ctx = document.getElementById('nilaiChart').getContext('2d');

		// ✅ ambil dari controller (sudah compact $labels & $scores)
		const labels = JSON.parse(String.raw`@json($labels)`);
		const data = JSON.parse(String.raw`@json($scores)`);
		new Chart(ctx, {
			type: 'line',
			data: {
				labels: labels,
				datasets: [{
					label: 'Nilai Bulanan',
					data: data,
					borderColor: 'rgba(75, 192, 192, 1)',
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
					borderWidth: 2,
					tension: 0.4,
					fill: true,
				}]
			},
			options: {
				responsive: true,
				plugins: {
					legend: {
						display: true,
					}
				},
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	});
</script>
@endsection