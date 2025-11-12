@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
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

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered text-center align-middle"
					style="border:2px solid black; width:100%;">
					<thead style="background-color: #8CC63E; color: black;">
						<tr>
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Nilai Performance</th>
							<th>Nilai Sikap Kerja</th>
							<th>Kategori</th>
							<th>Keterangan</th>
							<th style="width: 30%;">Improvement</th>
						</tr>
					</thead>
					<tbody>
						@forelse($questions as $q)
						@php
						$answers = json_decode($q->answers, true) ?? [];
						$nilaiPerformance = $answers[0]['score'] ?? 0;
						$nilaiSikap = collect($answers)->skip(1)->sum('score');
						@endphp
						<tr>
							<td>{{ $q->name ?? '-' }}</td>
							<td>{{ $q->jabatan ?? '-' }}</td>
							<td>{{ $nilaiPerformance }}</td>
							<td>{{ $nilaiSikap }}</td>
							<td>{{ $matrixTitle ?? '-' }}</td>
							<td>-</td>
							<td class="text-start">
								@include('matrix.partials.improvement', ['matrixTitle' => $matrixTitle])
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="7" class="text-center">Tidak ada data ditemukan untuk filter ini.</td>
						</tr>
						<tr>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $matrixTitle ?? '-' }}</td>
							<td>-</td>
							<td class="text-start">
								@include('matrix.partials.improvement', ['matrixTitle' => $matrixTitle])
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection