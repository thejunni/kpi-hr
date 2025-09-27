@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Header --}}
    {{-- Header --}}
    <div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #000000, #C9A227); color: white;">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Daftar Karyawan</h4>
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-dark fw-bold me-2">
                    ← Kembali ke Dashboard
                </a>
                <a href="{{ route('users.create') }}" class="btn btn-light fw-bold">
                    + Tambah User
                </a>
            </div>
        </div>
    </div>
    

    {{-- Tabel --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Role</th>
                        <th>Divisi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->nik }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->jabatan }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->divisi }}</td>
                            <td class="text-center">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info text-white">Lihat</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin hapus user ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
</style>
@endsection
