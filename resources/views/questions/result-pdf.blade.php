<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Penilaian Karyawan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { margin-bottom: 0; }
        .info { margin-bottom: 20px; }
        .info p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }

        /* Petunjuk kecil */
        .petunjuk { 
            margin-top: 20px; 
            font-size: 10px; 
            width: 50%; 
        }
        .petunjuk h4 { margin-bottom: 5px; font-size: 11px; }
        .petunjuk table { width: 100%; border-collapse: collapse; }
        .petunjuk th, .petunjuk td { border: 1px solid #000; padding: 4px; text-align: center; }

        /* Tanda tangan */
        .signature {
            width: 100%;
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
        .signature .space { margin-top: 60px; }
    </style>
</head>
<body>
    <h2>Hasil Penilaian Karyawan</h2>

    <div class="info">
        <p><strong>Divisi:</strong> {{ $divisi ?? 'Semua Divisi' }}</p>
        <p><strong>Tahun:</strong> 
            @if($tahunMulai && $tahunAkhir)
                {{ $tahunMulai }} - {{ $tahunAkhir }}
            @elseif($tahunMulai)
                {{ $tahunMulai }}
            @else
                Semua Tahun
            @endif
        </p>
    </div>

    {{-- Tabel Hasil --}}
    <table>
        <thead>
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
                    <td>{{ number_format($res->avg_score, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #777;">
                        Belum ada hasil penilaian.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Petunjuk Nilai --}}
    <div class="petunjuk">
        <h4>Petunjuk Nilai</h4>
        <table>
            <thead>
                <tr>
                    <th>Nilai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>5</td><td>Sangat Baik</td></tr>
                <tr><td>4</td><td>Baik</td></tr>
                <tr><td>3</td><td>Cukup</td></tr>
                <tr><td>2</td><td>Kurang</td></tr>
                <tr><td>1</td><td>Sangat Kurang</td></tr>
            </tbody>
        </table>
    </div>

    {{-- Tanda Tangan --}}
    <div class="signature">
        <p>Denpasar, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Hormat Kami,<br>HRD</p>
        <div class="space">__________________________</div>
    </div>
</body>
</html>
