@extends('layouts.app')

@section('content')
<div class="container mt-4">
	<div class="card shadow-sm border-0 mb-4"
		style="background: linear-gradient(135deg, #000000, #C9A227); color: white;">
		<div class="card-body d-flex justify-content-between align-items-center">
			<h4 class="mb-0 fw-bold">Hasil Penilaian KPI</h4>
			<div>
				<a href="{{ route('dashboard') }}" class="btn btn-dark fw-bold">
					<i class="fa fa-arrow-left"></i> Kembali ke Dashboard
				</a>
			</div>
		</div>
	</div>

	{{-- Filter --}}
	<div class="card shadow-sm border-0 mb-4">
		<div class="card-body">
			<h5 class="card-title mb-3">
				<i class="fa fa-filter text-primary"></i> Filter Data
			</h5>
			<form method="GET" action="{{ route('questions.result') }}" class="row g-3">
				{{-- Divisi --}}
				<div class="col-md-3">
					<select name="divisi" class="form-select select2">
						<option value="">-- Semua Divisi --</option>
						<option value="Team Leader Kredit Bumi" {{ request('divisi') == 'Team Leader Kredit Bumi' ? 'selected' : '' }}>Team Leader Kredit Bumi</option>
						<option value="Marketing Kredit Komersil Cabang Singaraja" {{ request('divisi') == 'Marketing Kredit Komersil Cabang Singaraja' ? 'selected' : '' }}>Marketing Kredit Komersil Cabang Singaraja</option>
						<option value="Marketing Kredit Mikro Cabang Singaraja" {{ request('divisi') == 'Marketing Kredit Mikro Cabang Singaraja' ? 'selected' : '' }}>Marketing Kredit Mikro Cabang Singaraja</option>
						<option value="Marketing Kredit Bumi Singaraja" {{ request('divisi') == 'Marketing Kredit Bumi Singaraja' ? 'selected' : '' }}>Marketing Kredit Bumi Singaraja</option>
						<option value="Teller Kantor Cabang Singaraja" {{ request('divisi') == 'Teller Kantor Cabang Singaraja' ? 'selected' : '' }}>Teller Kantor Cabang Singaraja</option>
						<option value="Funding Officer Kantor Cabang Singaraja" {{ request('divisi') == 'Funding Officer Kantor Cabang Singaraja' ? 'selected' : '' }}>Funding Officer Kantor Cabang Singaraja</option>
						<option value="Satpam Kantor Cabang Singaraja" {{ request('divisi') == 'Satpam Kantor Cabang Singaraja' ? 'selected' : '' }}>Satpam Kantor Cabang Singaraja</option>
						<option value="Team Leader Bisnis Kantor Cabang Singaraja" {{ request('divisi') == 'Team Leader Bisnis Kantor Cabang Singaraja' ? 'selected' : '' }}>Team Leader Bisnis Kantor Cabang Singaraja</option>
						<option value="Analis Kredit Kantor Cabang Singaraja" {{ request('divisi') == 'Analis Kredit Kantor Cabang Singaraja' ? 'selected' : '' }}>Analis Kredit Kantor Cabang Singaraja</option>
						<option value="P.E. Operasional & Layanan Kantor Cabang Singaraja" {{ request('divisi') == 'P.E. Operasional & Layanan Kantor Cabang Singaraja' ? 'selected' : '' }}>P.E. Operasional & Layanan Kantor Cabang Singaraja</option>
						<option value="Accounting Kantor Cabang Singaraja" {{ request('divisi') == 'Accounting Kantor Cabang Singaraja' ? 'selected' : '' }}>Accounting Kantor Cabang Singaraja</option>
						<option value="Komisaris" {{ request('divisi') == 'Komisaris' ? 'selected' : '' }}>Komisaris</option>
						<option value="Komisaris Utama" {{ request('divisi') == 'Komisaris Utama' ? 'selected' : '' }}>Komisaris Utama</option>
						<option value="Direktur Utama" {{ request('divisi') == 'Direktur Utama' ? 'selected' : '' }}>Direktur Utama</option>
						<option value="Direktur" {{ request('divisi') == 'Direktur' ? 'selected' : '' }}>Direktur</option>
						<option value="Marketing Funding 1" {{ request('divisi') == 'Marketing Funding 1' ? 'selected' : '' }}>Marketing Funding 1</option>
						<option value="Marketing Kredit Mikro" {{ request('divisi') == 'Marketing Kredit Mikro' ? 'selected' : '' }}>Marketing Kredit Mikro</option>
						<option value="Accounting Kantor Pusat" {{ request('divisi') == 'Accounting Kantor Pusat' ? 'selected' : '' }}>Accounting Kantor Pusat</option>
						<option value="Satpam Kantor Pusat" {{ request('divisi') == 'Satpam Kantor Pusat' ? 'selected' : '' }}>Satpam Kantor Pusat</option>
						<option value="P.E. Teknologi Informasi" {{ request('divisi') == 'P.E. Teknologi Informasi' ? 'selected' : '' }}>P.E. Teknologi Informasi</option>
						<option value="Koordinator Keamanan" {{ request('divisi') == 'Koordinator Keamanan' ? 'selected' : '' }}>Koordinator Keamanan</option>
						<option value="Analis Kredit Kantor Pusat" {{ request('divisi') == 'Analis Kredit Kantor Pusat' ? 'selected' : '' }}>Analis Kredit Kantor Pusat</option>
						<option value="Backend Developer Programmer" {{ request('divisi') == 'Backend Developer Programmer' ? 'selected' : '' }}>Backend Developer Programmer</option>
						<option value="P.E. Internal Audit" {{ request('divisi') == 'P.E. Internal Audit' ? 'selected' : '' }}>P.E. Internal Audit</option>
						<option value="Driver" {{ request('divisi') == 'Driver' ? 'selected' : '' }}>Driver</option>
						<option value="Admin Kepatuhan" {{ request('divisi') == 'Admin Kepatuhan' ? 'selected' : '' }}>Admin Kepatuhan</option>
						<option value="Admin Legal" {{ request('divisi') == 'Admin Legal' ? 'selected' : '' }}>Admin Legal</option>
						<option value="Team Leader Kredit Mikro" {{ request('divisi') == 'Team Leader Kredit Mikro' ? 'selected' : '' }}>Team Leader Kredit Mikro</option>
						<option value="Remedial" {{ request('divisi') == 'Remedial' ? 'selected' : '' }}>Remedial</option>
						<option value="Appraisal" {{ request('divisi') == 'Appraisal' ? 'selected' : '' }}>Appraisal</option>
						<option value="Karyawan Tetap" {{ request('divisi') == 'Karyawan Tetap' ? 'selected' : '' }}>Karyawan Tetap</option>
						<option value="Kliring" {{ request('divisi') == 'Kliring' ? 'selected' : '' }}>Kliring</option>
						<option value="P.E. Risiko Kredit" {{ request('divisi') == 'P.E. Risiko Kredit' ? 'selected' : '' }}>P.E. Risiko Kredit</option>
						<option value="P.E. Kepatuhan" {{ request('divisi') == 'P.E. Kepatuhan' ? 'selected' : '' }}>P.E. Kepatuhan</option>
						<option value="Marketing Funding 2" {{ request('divisi') == 'Marketing Funding 2' ? 'selected' : '' }}>Marketing Funding 2</option>
						<option value="Junior HR" {{ request('divisi') == 'Junior HR' ? 'selected' : '' }}>Junior HR</option>
						<option value="P.E. Treasury" {{ request('divisi') == 'P.E. Treasury' ? 'selected' : '' }}>P.E. Treasury</option>
						<option value="P.E. Operasional & Layanan Kantor Pusat" {{ request('divisi') == 'P.E. Operasional & Layanan Kantor Pusat' ? 'selected' : '' }}>P.E. Operasional & Layanan Kantor Pusat</option>
						<option value="Teller Kantor Pusat" {{ request('divisi') == 'Teller Kantor Pusat' ? 'selected' : '' }}>Teller Kantor Pusat</option>
						<option value="Cleaning Service" {{ request('divisi') == 'Cleaning Service' ? 'selected' : '' }}>Cleaning Service</option>
						<option value="Analis Kredit Kantor Cabang Semarapura" {{ request('divisi') == 'Analis Kredit Kantor Cabang Semarapura' ? 'selected' : '' }}>Analis Kredit Kantor Cabang Semarapura</option>
						<option value="Admin Kredit" {{ request('divisi') == 'Admin Kredit' ? 'selected' : '' }}>Admin Kredit</option>
						<option value="P.E. Funding 1" {{ request('divisi') == 'P.E. Funding 1' ? 'selected' : '' }}>P.E. Funding 1</option>
						<option value="Customer Service Kantor Pusat" {{ request('divisi') == 'Customer Service Kantor Pusat' ? 'selected' : '' }}>Customer Service Kantor Pusat</option>
						<option value="P.E. SDM dan Umum" {{ request('divisi') == 'P.E. SDM dan Umum' ? 'selected' : '' }}>P.E. SDM dan Umum</option>
						<option value="Koordinator Project Kredit Sertifikasi Guru" {{ request('divisi') == 'Koordinator Project Kredit Sertifikasi Guru' ? 'selected' : '' }}>Koordinator Project Kredit Sertifikasi Guru</option>
						<option value="P.E. Funding 2" {{ request('divisi') == 'P.E. Funding 2' ? 'selected' : '' }}>P.E. Funding 2</option>
						<option value="Teller Kantor Cabang Semarapura" {{ request('divisi') == 'Teller Kantor Cabang Semarapura' ? 'selected' : '' }}>Teller Kantor Cabang Semarapura</option>
						<option value="Accounting Kantor Cabang Semarapura" {{ request('divisi') == 'Accounting Kantor Cabang Semarapura' ? 'selected' : '' }}>Accounting Kantor Cabang Semarapura</option>
						<option value="P.E. Operasional & Layanan Kantor Cabang Semarapura" {{ request('divisi') == 'P.E. Operasional & Layanan Kantor Cabang Semarapura' ? 'selected' : '' }}>P.E. Operasional & Layanan Kantor Cabang Semarapura</option>
						<option value="Satpam Kantor Cabang Semarapura" {{ request('divisi') == 'Satpam Kantor Cabang Semarapura' ? 'selected' : '' }}>Satpam Kantor Cabang Semarapura</option>
						<option value="Marketing Kredit Mikro Cabang Semarapura" {{ request('divisi') == 'Marketing Kredit Mikro Cabang Semarapura' ? 'selected' : '' }}>Marketing Kredit Mikro Cabang Semarapura</option>
						<option value="Marketing Kredit Komersil Cabang Semarapura" {{ request('divisi') == 'Marketing Kredit Komersil Cabang Semarapura' ? 'selected' : '' }}>Marketing Kredit Komersil Cabang Semarapura</option>
					</select>
				</div>

				{{-- Tahun Mulai --}}
				<div class="col-md-3">
					<select name="tahun_mulai" class="form-select select2">
						<option value="">-- Tahun Mulai --</option>
						@for ($y = date('Y'); $y >= 2000; $y--)
						<option value="{{ $y }}" {{ request('tahun_mulai') == $y ? 'selected' : '' }}>
							{{ $y }}
						</option>
						@endfor
					</select>
				</div>

				{{-- Tahun Akhir --}}
				<div class="col-md-3">
					<select name="tahun_akhir" class="form-select select2">
						<option value="">-- Tahun Akhir --</option>
						@for ($y = date('Y'); $y >= 2000; $y--)
						<option value="{{ $y }}" {{ request('tahun_akhir') == $y ? 'selected' : '' }}>
							{{ $y }}
						</option>
						@endfor
					</select>
				</div>

				{{-- Bulan --}}
				<div class="col-md-3">
					<select name="bulan" class="form-select select2">
						<option value="">-- Bulan --</option>
						@php
						$bulanList = [
						'januari','februari','maret','april','mei','juni',
						'juli','agustus','september','oktober','november','desember'
						];
						@endphp
						@foreach($bulanList as $b)
						<option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
							{{ ucfirst($b) }}
						</option>
						@endforeach
					</select>
				</div>

				<div class="col-md-6">
					<button type="submit" class="btn btn-primary w-100">
						<i class="fa fa-search"></i> Terapkan Filter
					</button>
				</div>
				<div class="col-md-6">
					<a href="{{ route('questions.downloadPdf', request()->all()) }}" class="btn btn-success w-100">
						<i class="fa fa-file-pdf"></i> Download PDF
					</a>
				</div>
			</form>
		</div>
	</div>

	{{-- Info Filter --}}
	@php
	$filterInfo = [];
	if (request('divisi')) $filterInfo[] = request('divisi');
	if (request('tahun_mulai')) $filterInfo[] = request('tahun_mulai');
	if (request('tahun_akhir')) $filterInfo[] = request('tahun_akhir');
	if (request('bulan')) $filterInfo[] = ucfirst(request('bulan'));
	@endphp

	@if(count($filterInfo) > 0)
	<div class="fw-bold mb-3">
		<i class="fa fa-info-circle"></i> Sedang menampilkan data: {{ implode(' - ', $filterInfo) }}
	</div>
	@endif

	{{-- 🔍 Search Bar --}}
	<div class="input-group mb-3">
		<span class="input-group-text bg-dark text-white"><i class="fa fa-search"></i></span>
		<input type="text" id="tableSearch" class="form-control" placeholder="Cari nama, NIK, jabatan, divisi, bulan, atau skor...">
	</div>

	{{-- Tabel --}}
	<div class="card shadow-sm border-0">
		<div class="card-body">
			<table class="table table-striped table-hover align-middle" id="resultTable">
				<thead class="table-dark">
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>NIP</th>
						<th>Jabatan</th>
						<th>Divisi</th>
						<th>Bulan</th>
						<th>Kinerja</th>
						<th>Sikap Kerja</th>
						<th>Skor</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse($results as $res)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>
							<span class="text-ellipsis" title="{{ $res['name'] }}">
								{{ $res['name'] }}
							</span>
						</td>
						<td>{{ $res['nik'] }}</td>
						<td>{{ $res['jabatan'] }}</td>
						<td>{{ $res['divisi'] }}</td>
						<td>{{ $res['bulan'] ? strtoupper($res['bulan']) : "-" }}</td>
						<td>
							<span class="badge bg-primary px-3 py-2">
								{{ $res['kualitas_dan_kuantitas'] }}
							</span>
						</td>
						<td>
							<span class="badge bg-warning px-3 py-2">
								{{ $res['sikap_kerja'] }}
							</span>
						</td>
						<td>
							<span class="badge bg-success px-3 py-2">
								{{ number_format($res['total_nilai'], 2) }}
							</span>
						</td>
						<td>
							<form action="{{ route('questions.destroy', $res['id']) }}" method="POST" class="delete-form d-inline">
								@csrf
								@method('DELETE')
								<button type="button" class="btn btn-outline-danger btn-delete" data-name="{{ $res['name'] ?? 'data ini' }}">
									<i class="fa fa-trash"></i>
								</button>
							</form>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="7" class="text-center text-muted">
							Belum ada hasil penilaian.
						</td>
					</tr>
					@endforelse
				</tbody>
			</table>


			{{-- Pagination --}}
			<nav>
				<ul class="pagination justify-content-end" id="pagination"></ul>
			</nav>

			<hr class="my-4">

			<div class="text-center mb-3">
				<h5><b>Pilih Kategori Kinerja</b></h5>
			</div>

			<!-- Tambahkan di bawah tabel hasil -->
			<div class="container mt-4">
				<!-- Pilih Divisi -->
				<div class="row mb-4 align-items-end justify-content-center">
					<div class="col-md-4">
						<label for="division" class="form-label fw-bold">Pilih Divisi</label>
						<select id="division" class="form-select select2" name="division">
							<option value="">-- Semua Divisi --</option>
							<option value="Team Leader Kredit Bumi" {{ request('divisi') == 'Team Leader Kredit Bumi' ? 'selected' : '' }}>Team Leader Kredit Bumi</option>
							<option value="Marketing Kredit Komersil Cabang Singaraja" {{ request('divisi') == 'Marketing Kredit Komersil Cabang Singaraja' ? 'selected' : '' }}>Marketing Kredit Komersil Cabang Singaraja</option>
							<option value="Marketing Kredit Mikro Cabang Singaraja" {{ request('divisi') == 'Marketing Kredit Mikro Cabang Singaraja' ? 'selected' : '' }}>Marketing Kredit Mikro Cabang Singaraja</option>
							<option value="Marketing Kredit Bumi Singaraja" {{ request('divisi') == 'Marketing Kredit Bumi Singaraja' ? 'selected' : '' }}>Marketing Kredit Bumi Singaraja</option>
							<option value="Teller Kantor Cabang Singaraja" {{ request('divisi') == 'Teller Kantor Cabang Singaraja' ? 'selected' : '' }}>Teller Kantor Cabang Singaraja</option>
							<option value="Funding Officer Kantor Cabang Singaraja" {{ request('divisi') == 'Funding Officer Kantor Cabang Singaraja' ? 'selected' : '' }}>Funding Officer Kantor Cabang Singaraja</option>
							<option value="Satpam Kantor Cabang Singaraja" {{ request('divisi') == 'Satpam Kantor Cabang Singaraja' ? 'selected' : '' }}>Satpam Kantor Cabang Singaraja</option>
							<option value="Team Leader Bisnis Kantor Cabang Singaraja" {{ request('divisi') == 'Team Leader Bisnis Kantor Cabang Singaraja' ? 'selected' : '' }}>Team Leader Bisnis Kantor Cabang Singaraja</option>
							<option value="Analis Kredit Kantor Cabang Singaraja" {{ request('divisi') == 'Analis Kredit Kantor Cabang Singaraja' ? 'selected' : '' }}>Analis Kredit Kantor Cabang Singaraja</option>
							<option value="P.E. Operasional & Layanan Kantor Cabang Singaraja" {{ request('divisi') == 'P.E. Operasional & Layanan Kantor Cabang Singaraja' ? 'selected' : '' }}>P.E. Operasional & Layanan Kantor Cabang Singaraja</option>
							<option value="Accounting Kantor Cabang Singaraja" {{ request('divisi') == 'Accounting Kantor Cabang Singaraja' ? 'selected' : '' }}>Accounting Kantor Cabang Singaraja</option>
							<option value="Komisaris" {{ request('divisi') == 'Komisaris' ? 'selected' : '' }}>Komisaris</option>
							<option value="Komisaris Utama" {{ request('divisi') == 'Komisaris Utama' ? 'selected' : '' }}>Komisaris Utama</option>
							<option value="Direktur Utama" {{ request('divisi') == 'Direktur Utama' ? 'selected' : '' }}>Direktur Utama</option>
							<option value="Direktur" {{ request('divisi') == 'Direktur' ? 'selected' : '' }}>Direktur</option>
							<option value="Marketing Funding 1" {{ request('divisi') == 'Marketing Funding 1' ? 'selected' : '' }}>Marketing Funding 1</option>
							<option value="Marketing Kredit Mikro" {{ request('divisi') == 'Marketing Kredit Mikro' ? 'selected' : '' }}>Marketing Kredit Mikro</option>
							<option value="Accounting Kantor Pusat" {{ request('divisi') == 'Accounting Kantor Pusat' ? 'selected' : '' }}>Accounting Kantor Pusat</option>
							<option value="Satpam Kantor Pusat" {{ request('divisi') == 'Satpam Kantor Pusat' ? 'selected' : '' }}>Satpam Kantor Pusat</option>
							<option value="P.E. Teknologi Informasi" {{ request('divisi') == 'P.E. Teknologi Informasi' ? 'selected' : '' }}>P.E. Teknologi Informasi</option>
							<option value="Koordinator Keamanan" {{ request('divisi') == 'Koordinator Keamanan' ? 'selected' : '' }}>Koordinator Keamanan</option>
							<option value="Analis Kredit Kantor Pusat" {{ request('divisi') == 'Analis Kredit Kantor Pusat' ? 'selected' : '' }}>Analis Kredit Kantor Pusat</option>
							<option value="Backend Developer Programmer" {{ request('divisi') == 'Backend Developer Programmer' ? 'selected' : '' }}>Backend Developer Programmer</option>
							<option value="P.E. Internal Audit" {{ request('divisi') == 'P.E. Internal Audit' ? 'selected' : '' }}>P.E. Internal Audit</option>
							<option value="Driver" {{ request('divisi') == 'Driver' ? 'selected' : '' }}>Driver</option>
							<option value="Admin Kepatuhan" {{ request('divisi') == 'Admin Kepatuhan' ? 'selected' : '' }}>Admin Kepatuhan</option>
							<option value="Admin Legal" {{ request('divisi') == 'Admin Legal' ? 'selected' : '' }}>Admin Legal</option>
							<option value="Team Leader Kredit Mikro" {{ request('divisi') == 'Team Leader Kredit Mikro' ? 'selected' : '' }}>Team Leader Kredit Mikro</option>
							<option value="Remedial" {{ request('divisi') == 'Remedial' ? 'selected' : '' }}>Remedial</option>
							<option value="Appraisal" {{ request('divisi') == 'Appraisal' ? 'selected' : '' }}>Appraisal</option>
							<option value="Karyawan Tetap" {{ request('divisi') == 'Karyawan Tetap' ? 'selected' : '' }}>Karyawan Tetap</option>
							<option value="Kliring" {{ request('divisi') == 'Kliring' ? 'selected' : '' }}>Kliring</option>
							<option value="P.E. Risiko Kredit" {{ request('divisi') == 'P.E. Risiko Kredit' ? 'selected' : '' }}>P.E. Risiko Kredit</option>
							<option value="P.E. Kepatuhan" {{ request('divisi') == 'P.E. Kepatuhan' ? 'selected' : '' }}>P.E. Kepatuhan</option>
							<option value="Marketing Funding 2" {{ request('divisi') == 'Marketing Funding 2' ? 'selected' : '' }}>Marketing Funding 2</option>
							<option value="Junior HR" {{ request('divisi') == 'Junior HR' ? 'selected' : '' }}>Junior HR</option>
							<option value="P.E. Treasury" {{ request('divisi') == 'P.E. Treasury' ? 'selected' : '' }}>P.E. Treasury</option>
							<option value="P.E. Operasional & Layanan Kantor Pusat" {{ request('divisi') == 'P.E. Operasional & Layanan Kantor Pusat' ? 'selected' : '' }}>P.E. Operasional & Layanan Kantor Pusat</option>
							<option value="Teller Kantor Pusat" {{ request('divisi') == 'Teller Kantor Pusat' ? 'selected' : '' }}>Teller Kantor Pusat</option>
							<option value="Cleaning Service" {{ request('divisi') == 'Cleaning Service' ? 'selected' : '' }}>Cleaning Service</option>
							<option value="Analis Kredit Kantor Cabang Semarapura" {{ request('divisi') == 'Analis Kredit Kantor Cabang Semarapura' ? 'selected' : '' }}>Analis Kredit Kantor Cabang Semarapura</option>
							<option value="Admin Kredit" {{ request('divisi') == 'Admin Kredit' ? 'selected' : '' }}>Admin Kredit</option>
							<option value="P.E. Funding 1" {{ request('divisi') == 'P.E. Funding 1' ? 'selected' : '' }}>P.E. Funding 1</option>
							<option value="Customer Service Kantor Pusat" {{ request('divisi') == 'Customer Service Kantor Pusat' ? 'selected' : '' }}>Customer Service Kantor Pusat</option>
							<option value="P.E. SDM dan Umum" {{ request('divisi') == 'P.E. SDM dan Umum' ? 'selected' : '' }}>P.E. SDM dan Umum</option>
							<option value="Koordinator Project Kredit Sertifikasi Guru" {{ request('divisi') == 'Koordinator Project Kredit Sertifikasi Guru' ? 'selected' : '' }}>Koordinator Project Kredit Sertifikasi Guru</option>
							<option value="P.E. Funding 2" {{ request('divisi') == 'P.E. Funding 2' ? 'selected' : '' }}>P.E. Funding 2</option>
							<option value="Teller Kantor Cabang Semarapura" {{ request('divisi') == 'Teller Kantor Cabang Semarapura' ? 'selected' : '' }}>Teller Kantor Cabang Semarapura</option>
							<option value="Accounting Kantor Cabang Semarapura" {{ request('divisi') == 'Accounting Kantor Cabang Semarapura' ? 'selected' : '' }}>Accounting Kantor Cabang Semarapura</option>
							<option value="P.E. Operasional & Layanan Kantor Cabang Semarapura" {{ request('divisi') == 'P.E. Operasional & Layanan Kantor Cabang Semarapura' ? 'selected' : '' }}>P.E. Operasional & Layanan Kantor Cabang Semarapura</option>
							<option value="Satpam Kantor Cabang Semarapura" {{ request('divisi') == 'Satpam Kantor Cabang Semarapura' ? 'selected' : '' }}>Satpam Kantor Cabang Semarapura</option>
							<option value="Marketing Kredit Mikro Cabang Semarapura" {{ request('divisi') == 'Marketing Kredit Mikro Cabang Semarapura' ? 'selected' : '' }}>Marketing Kredit Mikro Cabang Semarapura</option>
							<option value="Marketing Kredit Komersil Cabang Semarapura" {{ request('divisi') == 'Marketing Kredit Komersil Cabang Semarapura' ? 'selected' : '' }}>Marketing Kredit Komersil Cabang Semarapura</option>
						</select>
					</div>

					<div class="col-md-3">
						<label for="year" class="form-label fw-bold">Pilih Tahun</label>
						<select name="year_kpi" id="year" class="form-select select2">
							<option value="">-- Tahun --</option>
							@for ($y = date('Y'); $y >= 2000; $y--)
							<option value="{{ $y }}" {{ request('tahun_mulai') == $y ? 'selected' : '' }}>
								{{ $y }}
							</option>
							@endfor
						</select>
					</div>
				</div>


				<!-- Grid Kotak -->
				<div id="matrix-grid" class="row g-3 text-center" style="display:none;">
					<!-- Baris 1 -->
					<div class="col-md-4">
						<a href="#" data-path="misfit" class="matrix-link d-block text-decoration-none text-dark">
							<div class="p-5 rounded-3" style="background-color: #f5c400;">
								<h4>5. Misfit</h4>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#" data-path="prince-of-waiting" class="matrix-link d-block text-decoration-none text-dark">
							<div class="p-5 rounded-3" style="background-color: #a6ce6e;">
								<h4>2. Prince of waiting</h4>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#" data-path="star" class="matrix-link d-block text-decoration-none text-dark">
							<div class="p-5 rounded-3" style="background-color: #c6df6e;">
								<h4>1. Star</h4>
							</div>
						</a>
					</div>

					<!-- Baris 2 -->
					<div class="col-md-4">
						<a href="#" data-path="critical-hit" class="matrix-link d-block text-decoration-none text-dark">
							<div class="p-5 rounded-3" style="background-color: #e64000;">
								<h4>7. Critical Hit</h4>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#" data-path="cadre" class="matrix-link d-block text-decoration-none text-dark">
							<div class="p-5 rounded-3" style="background-color: #ffe100;">
								<h4>4. Cadre</h4>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#" data-path="eagles" class="matrix-link d-block text-decoration-none text-dark">
							<div class="p-5 rounded-3" style="background-color: #3e833e;">
								<h4>3. Eagles</h4>
							</div>
						</a>
					</div>

					<!-- Baris 3 -->
					<div class="col-md-4">
						<a href="#" data-path="no-hopers" class="matrix-link d-block text-decoration-none text-light">
							<div class="p-5 rounded-3" style="background-color: #600000;">
								<h4>9. No hopers</h4>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#" data-path="foot-soldiers" class="matrix-link d-block text-decoration-none text-light">
							<div class="p-5 rounded-3" style="background-color: #7d0000;">
								<h4>8. Foot Soldiers</h4>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#" data-path="workhorse" class="matrix-link d-block text-decoration-none text-dark">
							<div class="p-5 rounded-3" style="background-color: #f59200;">
								<h4>6. Workhorse</h4>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
{{-- Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
	.select2-container .select2-selection--single {
		height: 45px;
		padding: 6px 12px;
		border-radius: 8px;
		border: 1px solid #ced4da;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 43px;
		right: 10px;
	}

	.card-title {
		font-size: 1.1rem;
		font-weight: 600;
	}

	.text-ellipsis {
		max-width: 250px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		display: inline-block;
		vertical-align: middle;
	}
</style>

<script>
	// ✅ Inisialisasi Select2
	$('.select2[name="divisi"]').select2({
		placeholder: "-- Pilih Divisi --",
		allowClear: true,
		width: '100%'
	});
	$('#division').select2({
		placeholder: "-- Pilih Divisi --",
		allowClear: true,
		width: '100%'
	});
	$('#year_kpi').select2({
		placeholder: "-- Pilih Divisi --",
		allowClear: true,
		width: '100%'
	});
	$('.select2[name="tahun_mulai"]').select2({
		placeholder: "-- Pilih Tahun Mulai --",
		allowClear: true,
		width: '100%'
	});
	$('.select2[name="tahun_akhir"]').select2({
		placeholder: "-- Pilih Tahun Akhir --",
		allowClear: true,
		width: '100%'
	});
	$('.select2[name="bulan"]').select2({
		placeholder: "-- Pilih Bulan --",
		allowClear: true,
		width: '100%'
	});

	// ✅ Pagination sederhana
	$(document).ready(function() {
		let rowsPerPage = 7;
		let rows = $('#resultTable tbody tr');
		let rowsCount = rows.length;
		let pageCount = Math.ceil(rowsCount / rowsPerPage);
		let pagination = $('#pagination');

		function displayRows(page) {
			let start = (page - 1) * rowsPerPage;
			let end = start + rowsPerPage;
			rows.hide();
			rows.slice(start, end).show();
		}

		function createPagination(totalPages, currentPage) {
			let paginationHTML = `<ul class="pagination">`;

			if (currentPage > 1) {
				paginationHTML += `<li class="page-item"><a class="page-link" href="#" data-page="${currentPage - 1}">&laquo;</a></li>`;
			}
			for (let i = 1; i <= totalPages; i++) {
				paginationHTML += `<li class="page-item ${i === currentPage ? 'active' : ''}">
					<a class="page-link" href="#" data-page="${i}">${i}</a>
				</li>`;
			}
			if (currentPage < totalPages) {
				paginationHTML += `<li class="page-item"><a class="page-link" href="#" data-page="${currentPage + 1}">&raquo;</a></li>`;
			}
			paginationHTML += `</ul>`;
			pagination.html(paginationHTML);
		}

		displayRows(1);
		createPagination(pageCount, 1);

		$(document).on('click', '.pagination a', function(e) {
			e.preventDefault();
			let page = parseInt($(this).data('page'));
			displayRows(page);
			createPagination(pageCount, page);
		});

		// ✅ Search Bar fungsi
		$('#tableSearch').on('keyup', function() {
			let value = $(this).val().toLowerCase();
			rows.filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
			});
		});
	});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Tombol delete dengan SweetAlert
		const deleteButtons = document.querySelectorAll('.btn-delete');

		deleteButtons.forEach(button => {
			button.addEventListener('click', function(e) {
				e.preventDefault();

				const form = this.closest('form');
				const itemName = this.getAttribute('data-name');

				Swal.fire({
					title: 'Yakin ingin menghapus?',
					text: `Data ${itemName} akan dihapus secara permanen.`,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#3085d6',
					confirmButtonText: 'Ya, hapus!',
					cancelButtonText: 'Batal'
				}).then((result) => {
					if (result.isConfirmed) {
						// Tampilkan loading sebentar
						Swal.fire({
							title: 'Menghapus...',
							text: 'Mohon tunggu sebentar.',
							allowOutsideClick: false,
							didOpen: () => {
								Swal.showLoading()
							}
						});

						form.submit();
					}
				});
			});
		});

		@if(session('success'))
		Swal.fire({
			icon: 'success',
			title: 'Berhasil',
			text: '{{ session('
			success ') }}',
			timer: 2000,
			showConfirmButton: false
		});
		@endif

		@if(session('error'))
		Swal.fire({
			icon: 'error',
			title: 'Gagal',
			text: '{{ session('
			error ') }}'
		});
		@endif
	});
</script>
<script>
	$(document).ready(function() {
		// inisialisasi select2 (jika kamu pakai)
		$('#division').select2({
			placeholder: "-- Pilih Divisi --",
			allowClear: true,
			width: '100%'
		});

		$('#year').select2({
			placeholder: "-- Pilih Tahun --",
			allowClear: true,
			width: '100%'
		});

		const matrixGrid = document.getElementById('matrix-grid');

		function checkFilters() {
			const divisionVal = $('#division').val();
			const yearVal = $('#year').val();

			if (divisionVal && yearVal) {
				matrixGrid.style.display = 'flex';
			} else {
				matrixGrid.style.display = 'none';
			}
		}

		$('#division, #year').on('change', checkFilters);

		checkFilters();
	});
</script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const yearSelect = document.getElementById('year');
		const divisionSelect = document.getElementById('division');
		const matrixGrid = document.getElementById('matrix-grid');

		function toggleMatrixGrid() {
			if (yearSelect.value !== '' && divisionSelect.value !== '') {
				matrixGrid.style.display = 'flex';
			} else {
				matrixGrid.style.display = 'none';
			}
		}

		yearSelect.addEventListener('change', toggleMatrixGrid);
		divisionSelect.addEventListener('change', toggleMatrixGrid);

		document.querySelectorAll('.matrix-link').forEach(link => {
			link.addEventListener('click', function(e) {
				e.preventDefault();

				const year = yearSelect.value;
				const division = divisionSelect.value;
				const path = this.getAttribute('data-path');

				if (year && division) {
					const targetUrl = `/questions/matrix/${path}?year=${year}&division=${encodeURIComponent(division)}`;
					window.location.href = targetUrl;
				} else {
					alert('Silakan pilih Tahun dan Divisi terlebih dahulu!');
				}
			});
		});
	});
</script>

@endpush