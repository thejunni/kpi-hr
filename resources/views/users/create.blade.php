@extends('layouts.app')

@section('content')
<div class="container mt-4">

	{{-- Header --}}
	<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #000000, #C9A227); color: white;">
		<div class="card-body">
			<h4 class="mb-0 fw-bold">Tambah Karyawan</h4>
		</div>
	</div>

	{{-- Form --}}
	<div class="card shadow-sm border-0">
		<div class="card-body">
			<form action="{{ route('users.store') }}" method="POST">
				@csrf

				<div class="row mb-3">
					<div class="col">
						<label class="form-label fw-bold">Nama</label>
						<input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
					</div>
					<div class="col">
						<label class="form-label fw-bold">NIP</label>
						<input type="text" name="nik" class="form-control" placeholder="Masukkan NIK" required>
					</div>
				</div>

				<div class="mb-3">
					<label class="form-label fw-bold">No Telepon</label>
					<input type="text" name="no_telephone" class="form-control" placeholder="Masukkan nomor telepon">
				</div>

				<div class="mb-3">
					<label class="form-label fw-bold">Email</label>
					<input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
				</div>

				<div class="row mb-3">
					<div class="col">
						<label class="form-label fw-bold">Jabatan</label>
						<input type="text" name="jabatan" class="form-control" placeholder="Masukkan jabatan">
					</div>
					<div class="col">
						<label class="form-label fw-bold">Role</label>
						<input type="text" name="role" class="form-control" placeholder="Masukkan role" required>
					</div>
					<div class="col">
						<label class="form-label fw-bold">Divisi</label>
						<input type="text" name="divisi" class="form-control" placeholder="Masukkan Divisi" required>
					</div>
				</div>

				<div class="d-flex justify-content-end mt-4">
					<a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Batal</a>
					<button type="submit" class="btn btn-dark text-gold fw-bold">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

{{-- Custom Style --}}
<style>
	.btn-dark.text-gold {
		background-color: #000;
		color: #FFD700;
		border: 1px solid #FFD700;
	}

	.btn-dark.text-gold:hover {
		background-color: #FFD700;
		color: #000;
	}
</style>
@endsection