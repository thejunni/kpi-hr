@extends('layouts.app')

@section('content')
<div class="container mt-4">

	{{-- Header Card --}}
	<div class="card shadow-lg border-0 rounded-3 mb-4" style="background: linear-gradient(135deg, #000000, #C9A227); color: white;">
		<div class="card-body d-flex justify-content-between align-items-center">
			<div>
				<h2 class="fw-bold">Dashboard HRD</h2>
				<p class="mb-0">Selamat datang, <strong>{{ Auth::user()->name }}</strong> 🎉</p>
			</div>
		</div>
	</div>

	{{-- Menu --}}
	<div class="row g-4">
		{{-- Form Penilaian --}}
		<div class="col-md-4">
			<div class="card menu-card h-100">
				<div class="card-body text-center">
					<div class="icon-box bg-gold mb-3">
						<i class="fa-solid fa-clipboard-check fa-2x"></i>
					</div>
					<h5 class="fw-bold">Form Penilaian</h5>
					<p class="text-muted">Lakukan penilaian karyawan secara cepat & efisien.</p>
					<a href="{{ route('questions.index') }}" class="btn btn-dark text-gold">Tambah Penilaian</a>
				</div>
			</div>
		</div>

		{{-- Data Karyawan --}}
		<div class="col-md-4">
			<div class="card menu-card h-100">
				<div class="card-body text-center">
					<div class="icon-box bg-gold mb-3">
						<i class="fa-solid fa-users fa-2x"></i>
					</div>
					<h5 class="fw-bold">Data Karyawan</h5>
					<p class="text-muted">Kelola informasi karyawan, jabatan, dan divisi.</p>
					<a href="{{ route('users.index') }}" class="btn btn-dark text-gold">Lihat Data</a>
				</div>
			</div>
		</div>

		{{-- Hasil Penilaian --}}
		<div class="col-md-4">
			<div class="card menu-card h-100">
				<div class="card-body text-center">
					<div class="icon-box bg-gold mb-3">
						<i class="fa-solid fa-chart-line fa-2x"></i>
					</div>
					<h5 class="fw-bold">Hasil Penilaian</h5>
					<p class="text-muted">Lihat rekap & hasil evaluasi karyawan.</p>
					<a href="{{ route('questions.result') }}" class="btn btn-dark text-gold">Lihat Hasil</a>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Custom CSS --}}
<style>
	body {
		background-color: #f8f9fa;
	}

	.menu-card {
		border: none;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
		transition: 0.3s;
	}

	.menu-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
	}

	.icon-box {
		width: 70px;
		height: 70px;
		display: flex;
		align-items: center;
		justify-content: center;
		border-radius: 50%;
		margin: 0 auto;
	}

	.bg-gold {
		background-color: #C9A227;
		color: black;
	}

	.text-gold {
		color: #C9A227 !important;
		font-weight: bold;
	}
</style>
@endsection