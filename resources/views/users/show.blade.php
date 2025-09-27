@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-3">Detail User</h1>

    <div class="card p-4">
        <p><strong>Nama:</strong>  <strong>{{ $user->name }}</strong> </p>
        <p><strong>NIK:</strong> {{ $user->nik }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>No Telepon:</strong> {{ $user->no_telephone }}</p>
        <p><strong>Jabatan:</strong> {{ $user->jabatan }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
        <p><strong>Divisi:</strong> {{ $user->divisi }}</p>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
