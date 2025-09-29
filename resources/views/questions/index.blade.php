@extends('layouts.app')

@section('content')
<div class="container">
	{{-- 🔹 Header --}}
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h2 class="mb-0">Form Penilaian Kinerja</h2>
		<a href="{{ route('dashboard') }}" class="btn btn-dark fw-bold">
			← Kembali ke Dashboard
		</a>
	</div>

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

	<form method="POST" action="{{ route('questions.answer') }}">
		@csrf

		{{-- 🔹 Data Diri --}}
		<div class="card shadow-sm mb-4">
			<div class="card-header bg-info text-white" style="background: linear-gradient(90deg, #000000, #FFD700);">
				<i class="fa-solid fa-user fa-lg me-2"></i>
				<strong>Data Karyawan</strong>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<label for="name" class="form-label">Nama</label>
					<input type="text" class="form-control" id="name" name="name" required>
				</div>

				<div class="mb-3">
					<label for="nik" class="form-label">NIK</label>
					<input type="text" class="form-control" id="nik" name="nik" required>
				</div>

				<div class="mb-3">
					<label for="jabatan" class="form-label">Jabatan</label>
					<input type="text" class="form-control" id="jabatan" name="jabatan" required>
				</div>

				<div class="mb-3">
					<label for="divisi" class="form-label">Divisi</label>
					<select class="form-select" id="divisi" name="divisi" required>
						<option value="" disabled selected>--Pilih Divisi--</option>
						<option value="HRD">HRD</option>
						<option value="Finance">Finance</option>
						<option value="Marketing">Marketing</option>
						<option value="IT">IT</option>
						<option value="Operasional">Operasional</option>
					</select>
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

				{{-- 🔹 Grid 5 kolom --}}
				<div class="row row-cols-1 row-cols-md-5 g-3">
					@foreach($question['options'] as $key => $option)
					<div class="col">
						<input
							type="radio"
							class="btn-check"
							name="answers[{{ $qIndex }}]"
							id="q{{ $qIndex }}option{{ $key }}"
							value="{{ $key }}"
							autocomplete="off">
						<label class="card h-100 p-3 btn w-100 text-start d-flex flex-column justify-content-between" for="q{{ $qIndex }}option{{ $key }}">
							<div style="font-size: 0.9rem;">
								{{ $option['text'] }}
							</div>
							<div class="mb-2">
								<span class="score-badge h-100 w-100 d-flex flex-colum justify-content-center">
									{{ $key }} = {{ $option['score'] }}
								</span>
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
			<button type="submit" class="btn btn-success px-4">
				Kirim Jawaban
			</button>
		</div>
	</form>
</div>

{{-- CSS custom biar mirip contoh --}}
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

	/* Saat terpilih → hanya badge yang berubah */
	.btn-check:checked+label .score-badge {
		background: #FFD700;
		color: #000;
	}

	.btn-check:checked+label {
		border: 2px solid #FFD700;
	}

	/* Floating Header */
	.floating-header {
		position: sticky;
		/* position: sticky; */
		top: 0;
		z-index: 1050;
		transition: opacity 0.5s ease, transform 0.5s ease;
		pointer-events: none;
		opacity: 0;
		transform: translateY(-100px);
	}

	/* #floating-header {
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		z-index: 1030;
		opacity: 0;
		transform: translateY(-20px);
		transition: opacity 0.5s ease, transform 0.5s ease;
		pointer-events: none;
	} */

	/* #floating-header {
		position: fixed;
		top: 10px;
		left: 20%;
		transform: translateX(-50%);
		width: auto;
		max-width: 1050px;
		opacity: 0;
		transition: opacity 0.5s ease, transform 0.5s ease;
		z-index: 1050;
	} */

	#floating-header.show {
		opacity: 1;
		transform: translateY(0);
		pointer-events: auto;
	}
</style>

{{-- Script update floating header --}}
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const nameInput = document.getElementById("name");
		const bulanSelect = document.getElementById("bulan");
		const previewNama = document.getElementById("preview-nama");
		const previewBulan = document.getElementById("preview-bulan");

		nameInput.addEventListener("input", function() {
			previewNama.textContent = nameInput.value || "Nama Karyawan";
			previewNama.style.fontWeight = "bold"; // 🔹 bikin bold
		});

		bulanSelect.addEventListener("change", function() {
			previewBulan.textContent = bulanSelect.options[bulanSelect.selectedIndex].text || "Pilih Bulan";
			previewBulan.style.fontWeight = "bold"; // 🔹 bikin bold
		});
	});
</script>
<script>
	document.addEventListener("scroll", function() {
		const header = document.getElementById("floating-header");
		if (window.scrollY > 100) { // ganti angka 100 sesuai kebutuhan
			header.classList.add("show");
		} else {
			header.classList.remove("show");
		}
	});
</script>
@endsection