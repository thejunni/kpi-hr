@extends('layouts.app')

@section('content')
<div class="container mt-4">

	{{-- Header --}}
	<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #000000, #C9A227); color: white;">
		<div class="card-body">
			<h4 class="mb-0 fw-bold">Edit Data Karyawan</h4>
		</div>
	</div>

	{{-- Form --}}
	<div class="card shadow-sm border-0">
		<div class="card-body">
			<form action="{{ route('users.update', $user->id) }}" method="POST">
				@csrf
				@method('PUT')

				<div class="row mb-3">
					<div class="col">
						<label class="form-label fw-bold">Nama</label>
						<input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
					</div>
					<div class="col">
						<label class="form-label fw-bold">NIK</label>
						<input type="text" name="nik" value="{{ $user->nik }}" class="form-control" required>
					</div>
				</div>

				<div class="mb-3">
					<label class="form-label fw-bold">No Telepon</label>
					<input type="text" name="no_telephone" value="{{ $user->no_telephone }}" class="form-control">
				</div>

				<div class="mb-3">
					<label class="form-label fw-bold">Email</label>
					<input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
				</div>

				<div class="row mb-3">
					<div class="col">
						<label class="form-label fw-bold">Jabatan</label>
						<input type="text" name="jabatan" value="{{ $user->jabatan }}" class="form-control">
					</div>
					<div class="col">
						<label class="form-label fw-bold">Role</label>
						<input type="text" name="role" value="{{ $user->role }}" class="form-control" required>
					</div>
					<div class="col">
						<label class="form-label fw-bold">Divisi</label>
						<input type="text" name="divisi" value="{{ $user->divisi }}" class="form-control" required>
					</div>
				</div>

				<div class="d-flex justify-content-end mt-4">
					<a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Batal</a>
					<button type="submit" class="btn btn-dark text-gold fw-bold">Update</button>
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