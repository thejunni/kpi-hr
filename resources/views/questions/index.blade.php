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

    <form method="POST" action="{{ route('questions.answer') }}">
        @csrf

        {{-- 🔹 Data Diri --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
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
            </div>
        </div>

        {{-- 🔹 Pertanyaan --}}
        @foreach($questions as $qIndex => $question)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <div><strong>Aspek:</strong> {{ $question['aspek'] }}</div>
                    <div><strong>Sub Aspek:</strong> {{ $question['sub_aspek'] }}</div>
                </div>
                <div class="card-body">
                    <h5 class="mb-3">{{ ($qIndex + 1) . '. ' . $question['pertanyaan'] }}</h5>
                    
                    @foreach($question['options'] as $key => $option)
                        <div class="form-check mb-2">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="answers[{{ $qIndex }}]" 
                                id="q{{ $qIndex }}option{{ $key }}" 
                                value="{{ $key }}"
                                required
                            >
                            <label class="form-check-label" for="q{{ $qIndex }}option{{ $key }}">
                                <strong>{{ $key }}.</strong> 
                                {{ $option['text'] }} 
                                <span class="badge bg-secondary">Nilai: {{ $option['score'] }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="text-end">
            <button type="submit" class="btn btn-success px-4">
                Kirim Jawaban
            </button>
        </div>
    </form>
</div>
@endsection
