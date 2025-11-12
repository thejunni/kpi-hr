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
						<option value="Division-IT" {{ request('divisi') == 'Division-IT' ? 'selected' : '' }}>IT</option>
						<option value="HRD" {{ request('divisi') == 'HRD' ? 'selected' : '' }}>HRD</option>
						<option value="Finance" {{ request('divisi') == 'Finance' ? 'selected' : '' }}>Finance</option>
						<option value="Operasional" {{ request('divisi') == 'Operasional' ? 'selected' : '' }}>Operasional</option>
						<option value="Marketing" {{ request('divisi') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
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
						<th>Kualitas & Kuantitas</th>
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
									<i class="fa fa-trash"></i> Delete
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
@endpush