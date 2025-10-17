@extends('layouts.app')

@section('content')
<div class="container">
	{{-- 🔹 Header --}}
	<div class="card shadow-sm border-0 mb-4"
		style="background: linear-gradient(135deg, #000000, #C9A227); color: white;">
		<div class="card-body d-flex justify-content-between align-items-center">
			<h4 class="mb-0 fw-bold">Form Penilaian Kinerja</h4>
			<div>
				<a href="{{ route('dashboard') }}" class="btn btn-dark fw-bold">
					<i class="fa fa-arrow-left"></i> Kembali ke Dashboard
				</a>
			</div>
		</div>
	</div>

	{{-- 🔹 Floating Header --}}
	<div id="floating-header" class="floating-header shadow-sm mb-3 pt-2">
		<div class="d-flex justify-content-between align-items-center px-3 py-2 text-white"
			style="background: linear-gradient(90deg, #000000, #FFD700); border-radius: 10px;">
			<div class="me-3">
				<small>Nama</small>
				<div class="card p-2">
					<div id="preview-nama"><strong> Tambahkan Nama Dahulu</strong></div>
				</div>
			</div>
			<div>
				<small>Bulan</small>
				<div class="card p-2">
					<div id="preview-bulan"><strong>Pilih Bulan dahulu</strong></div>
				</div>
			</div>
		</div>
	</div>

	<form id="formPenilaian" method="POST" action="{{ route('questions.answer') }}">
		@csrf

		{{-- 🔹 Data Diri --}}
		<div class="card shadow-sm mb-4">
			<div class="card-header text-white" style="background: linear-gradient(90deg, #000000, #FFD700);">
				<i class="fa-solid fa-user fa-lg me-2"></i>
				<strong>Data Karyawan</strong>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<label for="employee_id" class="form-label">Nama</label>
					<select class="form-select" id="employee_id" name="employee_id" required>
						<option value="" disabled selected>--Pilih Karyawan--</option>
						@foreach($employees as $emp)
						<option value="{{ $emp->id }}">{{ $emp->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="mb-3">
					<label for="nik" class="form-label">NIK</label>
					<input type="text" class="form-control" id="nik" name="nik" readonly disabled>
				</div>
				<div class="mb-3">
					<label for="jabatan" class="form-label">Jabatan</label>
					<input type="text" class="form-control" id="jabatan" name="jabatan" readonly disabled>
				</div>
				<div class="mb-3">
					<label for="divisi" class="form-label">Divisi</label>
					<input type="text" class="form-control" id="divisi" name="divisi" readonly disabled>
				</div>
				<div class="mb-3">
					<label for="bulan" class="form-label">Bulan</label>
					<select class="form-select" id="bulan" name="bulan" required>
						<option value="" disabled selected>--Pilih Bulan--</option>
						<option value="januari">Januari</option>
						<option value="februari">Februari</option>
						<option value="maret">Maret</option>
						<option value="april">April</option>
						<option value="mei">Mei</option>
						<option value="juni">Juni</option>
						<option value="juli">Juli</option>
						<option value="agustus">Agustus</option>
						<option value="september">September</option>
						<option value="oktober">Oktober</option>
						<option value="november">November</option>
						<option value="desember">Desember</option>
					</select>
				</div>
			</div>
		</div>

		{{-- 🔹 Pertanyaan --}}
		@foreach($questions as $qIndex => $question)
		<div class="card shadow-sm mb-4">
			<div class="card-header text-white d-flex justify-content-between align-items-center"
				style="background: linear-gradient(90deg, #FFD700, #000000);">
				<div>
					<div><strong>Aspek:</strong> {{ $question['aspek'] }}</div>
					<div><strong>Sub Aspek:</strong> {{ $question['sub_aspek'] }}</div>
				</div>
			</div>
			<div class="card-body">
				<h5 class="mb-3">{{ ($qIndex + 1) . '. ' . $question['pertanyaan'] }}</h5>
				<div class="row row-cols-1 row-cols-md-5 g-3">
					@foreach($question['options'] as $key => $option)
					<div class="col">
						<input type="radio" class="btn-check" name="answers[{{ $qIndex }}]"
							id="q{{ $qIndex }}option{{ $key }}" value="{{ $key }}" autocomplete="off">
						<label class="card h-100 p-3 btn w-100 text-start d-flex flex-column justify-content-between"
							for="q{{ $qIndex }}option{{ $key }}">
							<div style="font-size: 0.9rem;">{{ $option['text'] }}</div>
							<div class="mb-2">
								<span class="score-badge">{{ $key }} = {{ $option['score'] }}</span>
							</div>
						</label>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		@endforeach

		{{-- 🔹 Surat Peringatan --}}
		<div class="card shadow-sm mb-4">
			<div class="card-header bg-warning text-dark">
				<i class="fa-solid fa-circle-exclamation fa-lg me-2"></i>
				<strong>Surat Peringatan (Bila Ada):</strong>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<label for="sp_level" class="form-label">Surat Peringatan (SP)</label>
					<select class="form-select" id="sp_level" name="sp_level">
						<option value="0" selected>Tidak Ada</option>
						<option value="1">SP 1 (-10 poin)</option>
						<option value="2">SP 2 (-20 poin)</option>
						<option value="3">SP 3 (-30 poin)</option>
					</select>
				</div>
			</div>
		</div>

		{{-- 🔹 Submit --}}
		<div class="text-end">
			<button type="submit" class="btn btn-success px-4">Kirim Jawaban</button>
		</div>
	</form>
</div>

{{-- CSS Custom --}}
<style>
	.card.btn {
		border: 1px solid #ddd;
		border-radius: 10px;
		transition: 0.3s;
		cursor: pointer;
	}

	.card.btn:hover {
		border-color: #ffc107;
		box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
	}

	.score-badge {
		display: inline-block;
		padding: 5px 10px;
		border-radius: 5px;
		background: #eee;
		font-weight: bold;
	}

	.btn-check:checked+label .score-badge {
		background: #FFD700;
		color: #000;
	}

	.btn-check:checked+label {
		border: 2px solid #FFD700;
	}

	.floating-header {
		position: sticky;
		top: 0;
		z-index: 1050;
		transition: opacity 0.5s ease, transform 0.5s ease;
		pointer-events: none;
		opacity: 0;
		transform: translateY(-100px);
	}

	#floating-header.show {
		opacity: 1;
		transform: translateY(0);
		pointer-events: auto;
	}
</style>

{{-- Script Floating Header --}}
<script>
	document.addEventListener("scroll", function() {
		const header = document.getElementById("floating-header");
		if (window.scrollY > 100) {
			header.classList.add("show");
		} else {
			header.classList.remove("show");
		}
	});
</script>

{{-- Script Update Data Karyawan + Bulan --}}
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const employeeSelect = document.getElementById("employee_id");
		const nikInput = document.getElementById("nik");
		const jabatanInput = document.getElementById("jabatan");
		const divisiInput = document.getElementById("divisi");
		const previewNama = document.getElementById("preview-nama");
		const bulanSelect = document.getElementById("bulan");
		const previewBulan = document.getElementById("preview-bulan");

		employeeSelect.addEventListener("change", function() {
			const employeeId = this.value;
			if (employeeId) {
				fetch(`/employees/${employeeId}`)
					.then(response => response.json())
					.then(data => {
						nikInput.value = data.nik || "";
						jabatanInput.value = data.jabatan || "";
						divisiInput.value = data.divisi || "";
						previewNama.textContent = data.name || "Nama Karyawan";
						previewNama.style.fontWeight = "bold";
					})
					.catch(error => console.error("Error:", error));
			}
		});

		bulanSelect.addEventListener("change", function() {
			previewBulan.textContent = bulanSelect.options[bulanSelect.selectedIndex].text || "Pilih Bulan";
			previewBulan.style.fontWeight = "bold";
		});
	});
</script>

{{-- Script Select2 --}}
<script>
	$(document).ready(function() {
		$('#employee_id').select2({
			placeholder: "--Pilih Karyawan--",
			allowClear: true,
			width: '100%',
			minimumResultsForSearch: 0
		});
	});
</script>

{{-- SweetAlert2 Konfirmasi Submit --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	document.getElementById("formPenilaian").addEventListener("submit", function (e) {
		e.preventDefault(); // Cegah submit langsung

		Swal.fire({
			title: "Apakah data yang dimasukkan sudah benar?",
			text: "Periksa kembali sebelum mengirim penilaian. Pastikan Nama dan Bulan sudah benar",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Ya, kirim!",
			cancelButtonText: "Batal"
		}).then((result) => {
			if (result.isConfirmed) {
				e.target.submit(); // Kirim form jika dikonfirmasi
			}
		});
	});
</script>
@endsection
