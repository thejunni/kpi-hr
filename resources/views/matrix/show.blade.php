@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 1200px;">
	<div class="card shadow border-0">
		<div class="card-header d-flex justify-content-between align-items-center text-white"
			style="background-color: {{ $color ?? '#4CAF50' }};">
			<h5 class="mb-0 text-uppercase">
				Matrix {{ $matrixTitle ?? '' }}
				@if($year) - Tahun {{ $year }} @endif
				@if($division) | Divisi: {{ $division }} @endif
			</h5>
			<a href="{{ url()->previous() }}" class="btn btn-light btn-sm">← Kembali</a>
		</div>

		<div class="p-3">
			<a href="{{ route('questions.matrix-download', ['type' => $matrixTitle, 'year' => $year, 'division' => $division]) }}"
				class="btn btn-warning btn-sm mb-3">⬇ Download PDF</a>

			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-bordered text-center align-middle">
						<thead style="background-color: #8CC63E; color: black;">
							<tr>
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
								<td>{{ $q->name ?? '-' }}</td>
								<td>{{ $q->divisi ?? '-' }}</td>
								<td>{{ $q->performance ?? '-' }}</td>
								<td>{{ $q->potential ?? '-' }}</td>
								<td>{{ $q->category ?? '-' }}</td>
								<td>{{ $q->description ?? '-' }}</td>
							</tr>
							@empty
							<tr>
								<td colspan="6" class="text-center">Tidak ada data ditemukan untuk filter ini.</td>
							</tr>
							@endforelse
						</tbody>

						<tfoot>
							<tr>
								<td colspan="6" class="text-start" style="background-color: #f9f9f9;">
									<strong>Improvement:</strong><br>
									@include('matrix.partials.improvement', ['matrixTitle' => $matrixTitle])
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection