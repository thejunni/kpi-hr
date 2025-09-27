@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Hasil Penilaian Karyawan</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-dark fw-bold">
            ← Kembali ke Dashboard
        </a>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('questions.result') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <select name="divisi" class="form-select">
                <option value="">-- Semua Divisi --</option>
                <option value="IT" {{ request('divisi') == 'IT' ? 'selected' : '' }}>IT</option>
                <option value="HRD" {{ request('divisi') == 'HRD' ? 'selected' : '' }}>HRD</option>
                <option value="Finance" {{ request('divisi') == 'Finance' ? 'selected' : '' }}>Finance</option>
                <option value="Operasional" {{ request('divisi') == 'Operasional' ? 'selected' : '' }}>Operasional</option>
                <option value="Marketing" {{ request('divisi') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
            </select>
        </div>

        <div class="col-md-2">
            <input type="text" id="tahun_mulai" name="tahun_mulai" 
                class="form-control yearpicker"
                placeholder="Tahun Mulai" value="{{ request('tahun_mulai') }}">
        </div>
        <div class="col-md-2">
            <input type="text" id="tahun_akhir" name="tahun_akhir" 
                class="form-control yearpicker"
                placeholder="Tahun Akhir" value="{{ request('tahun_akhir') }}">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-dark w-100">Filter</button>
        </div>

        <div class="col-md-3">
            <a href="{{ route('questions.downloadPdf', request()->all()) }}" class="btn btn-success w-100">
                <i class="fa fa-file-pdf"></i> Download PDF
            </a>
        </div>
    </form>

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jabatan</th>
                        <th>Divisi</th>
                        <th>Rata-rata Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $res)
                        <tr>
                            <td>{{ $res->name }}</td>
                            <td>{{ $res->nik }}</td>
                            <td>{{ $res->jabatan }}</td>
                            <td>{{ $res->divisi }}</td>
                            <td><span class="badge bg-success">{{ number_format($res->avg_score, 2) }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada hasil penilaian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- Datepicker --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(function () {
            $('.yearpicker').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            });
        });
    </script>
@endpush
