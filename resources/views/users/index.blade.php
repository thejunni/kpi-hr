@extends('layouts.app')

@section('content')
<div class="container mt-4">

	{{-- Header --}}
	<div class="card shadow-sm border-0 mb-4"
		style="background: linear-gradient(135deg, #000000, #C9A227); color: white;">
		<div class="card-body d-flex justify-content-between align-items-center">
			<h4 class="mb-0 fw-bold">Daftar Karyawan</h4>
			<div>
				<a href="{{ route('dashboard') }}" class="btn btn-dark fw-bold me-2">
					← Kembali ke Dashboard
				</a>
				<a href="{{ route('users.create') }}" class="btn btn-light fw-bold me-2">
					+ Tambah karyawan
				</a>
				<button class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#importModal">
					📂 Import CSV
				</button>
			</div>
		</div>
	</div>

	{{-- Tabel --}}
	<div class="card shadow-sm border-0">
		<div class="card-body">
			<div class="d-flex justify-content-between mb-3">
				<input type="text" id="searchInput" class="form-control w-25" placeholder="🔍 Cari data...">
				<select id="rowsPerPage" class="form-select w-auto">
					<option value="5">5</option>
					<option value="10" selected>10</option>
					<option value="25">25</option>
				</select>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-hover align-middle text-nowrap" id="userTable" style="table-layout: fixed; width: 100%;">
					<thead class="table-dark">
						<tr>
							<th style="width: 5%;">No</th>
							<th style="width: 18%;">Nama</th>
							<th style="width: 10%;">NIP</th>
							<th style="width: 20%;">Jabatan</th>
							<th style="width: 10%;">Role</th>
							<th style="width: 20%;">Divisi</th>
							<th style="width: 17%;" class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@forelse($users as $user)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->nik }}</td>
							<td>{{ $user->jabatan }}</td>
							<td>{{ $user->role }}</td>
							<td class="text-truncate" title="{{ $user->divisi }}">{{ $user->divisi }}</td>
							<td class="text-center">
								<a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info text-white">Lihat</a>
								<a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
								<form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline delete-form">
									@csrf
									@method('DELETE')
									<button type="button" class="btn btn-sm btn-danger btn-delete">
										Hapus
									</button>
								</form>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="7" class="text-center text-muted">Belum ada data karyawan.</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>

			{{-- Pagination --}}
			<nav>
				<ul class="pagination justify-content-center" id="pagination"></ul>
			</nav>
		</div>
	</div>
</div>

<!-- Modal Import CSV -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-dark text-white">
				<h5 class="modal-title fw-bold" id="importModalLabel">📂 Import Data Karyawan (CSV)</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">
					<p class="text-muted">Pastikan file CSV sesuai format berikut:</p>
					<pre class="bg-light p-2 rounded small">
name,nip,no_telephone,email,jabatan,role,divisi
Budi,12345,08123456789,budi@example.com,Staff,User,Finance
Siti,67890,08987654321,siti@example.com,Manager,Admin,HRD
					</pre>
					<div class="mb-3">
						<label for="file" class="form-label fw-bold">Pilih File CSV</label>
						<input type="file" name="file" class="form-control" id="file" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success">✅ Import</button>
				</div>
			</form>
		</div>
	</div>
</div>

{{-- Custom Style --}}
<style>
	body {
		background-color: #f8f9fa;
	}

	.table-dark th {
		background-color: #000 !important;
		color: #FFD700 !important;
	}

	.btn-light {
		background-color: #FFD700;
		border: none;
		color: black;
	}

	.btn-light:hover {
		background-color: #e6c200;
		color: black;
	}

	.pagination .page-item.active .page-link {
		background-color: #000;
		border-color: #000;
		color: #FFD700;
	}

	.pagination .page-link {
		color: #000;
	}

	/* Pastikan kolom Divisi (dan lainnya) punya lebar tetap */
	#userTable th,
	#userTable td {
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	/* Agar teks panjang tidak merusak layout */
	.table-responsive {
		overflow-x: auto;
	}

	/* Opsional: supaya kolom aksi tidak terlalu sempit */
	#userTable td .btn {
		margin: 1px;
	}
</style>

{{-- Script Search + Pagination + Delete Alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		let table = document.getElementById("userTable");
		let allRows = Array.from(table.querySelectorAll("tbody tr"));
		let searchInput = document.getElementById("searchInput");
		let pagination = document.getElementById("pagination");
		let rowsPerPageSelect = document.getElementById("rowsPerPage");
		let currentPage = 1;
		let rowsPerPage = parseInt(rowsPerPageSelect.value);

		function renderTable() {
			let input = searchInput.value.toLowerCase();
			let filteredRows = allRows.filter(row =>
				row.textContent.toLowerCase().includes(input)
			);
			allRows.forEach(row => row.style.display = "none");
			let totalPages = Math.ceil(filteredRows.length / rowsPerPage);
			if (totalPages === 0) totalPages = 1;
			if (currentPage > totalPages) currentPage = 1;
			filteredRows.forEach((row, index) => {
				if (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) {
					row.style.display = "";
				}
			});
			pagination.innerHTML = "";

			let prev = document.createElement("li");
			prev.className = "page-item " + (currentPage === 1 ? "disabled" : "");
			let prevLink = document.createElement("a");
			prevLink.className = "page-link";
			prevLink.href = "#";
			prevLink.innerText = "«";
			prevLink.addEventListener("click", function(e) {
				e.preventDefault();
				if (currentPage > 1) {
					currentPage--;
					renderTable();
				}
			});
			prev.appendChild(prevLink);
			pagination.appendChild(prev);

			for (let i = 1; i <= totalPages; i++) {
				let li = document.createElement("li");
				li.className = "page-item " + (i === currentPage ? "active" : "");
				let a = document.createElement("a");
				a.className = "page-link";
				a.href = "#";
				a.innerText = i;
				a.addEventListener("click", function(e) {
					e.preventDefault();
					currentPage = i;
					renderTable();
				});
				li.appendChild(a);
				pagination.appendChild(li);
			}

			let next = document.createElement("li");
			next.className = "page-item " + (currentPage === totalPages ? "disabled" : "");
			let nextLink = document.createElement("a");
			nextLink.className = "page-link";
			nextLink.href = "#";
			nextLink.innerText = "»";
			nextLink.addEventListener("click", function(e) {
				e.preventDefault();
				if (currentPage < totalPages) {
					currentPage++;
					renderTable();
				}
			});
			next.appendChild(nextLink);
			pagination.appendChild(next);
		}

		searchInput.addEventListener("keyup", function() {
			currentPage = 1;
			renderTable();
		});

		rowsPerPageSelect.addEventListener("change", function() {
			rowsPerPage = parseInt(this.value);
			currentPage = 1;
			renderTable();
		});

		renderTable();

		// 🔥 SweetAlert konfirmasi delete
		document.querySelectorAll(".btn-delete").forEach(button => {
			button.addEventListener("click", function(e) {
				e.preventDefault();
				let form = this.closest("form");
				Swal.fire({
					title: "Yakin ingin menghapus?",
					text: "Data ini tidak bisa dikembalikan!",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#d33",
					cancelButtonColor: "#6c757d",
					confirmButtonText: "Ya, hapus!",
					cancelButtonText: "Batal"
				}).then((result) => {
					if (result.isConfirmed) {
						form.submit();
					}
				});
			});
		});
	});
</script>

@endsection