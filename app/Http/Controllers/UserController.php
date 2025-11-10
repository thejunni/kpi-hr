<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Question;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // 🔹 Tampilkan semua user
    public function index()
    {
        $users = Employee::all();
        return view('users.index', compact('users'));
    }

    // 🔹 Form tambah user
    public function create()
    {
        return view('users.create');
    }

    // 🔹 Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'nik'          => 'required|string|max:20|unique:employees',
            'no_telephone' => 'nullable|string|max:20',
            'email'        => 'required|string|email|max:255|unique:employees',
            'jabatan'      => 'nullable|string|max:100',
            'role'         => 'required|string|max:50',
            'divisi'       => 'nullable|string|max:100',
            'password'     => 'nullable|string|min:8|confirmed',
        ]);

        Employee::create([
            'name'         => $request->name,
            'nik'          => $request->nik,
            'no_telephone' => $request->no_telephone,
            'email'        => $request->email,
            'jabatan'      => $request->jabatan,
            'role'         => $request->role,
            'divisi'       => $request->divisi,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

	// 🔹 Detail user (by id)
	public function show(Employee $user)
	{
		$nilaiBulanan = DB::table('score_kpi')
			->select(
				DB::raw("Min(id) as id"),
				DB::raw("Min(sp) as sp"),
				DB::raw("CONCAT(bulan, ' ', tahun) as periode"),
				DB::raw("SUM(total_score) as total_score"),
				DB::raw("json_agg(answers) as all_answers")
			)
			->where('nik', $user->nik)
			->groupBy('tahun', 'bulan')
			->orderBy('tahun', 'asc')
			->orderByRaw("
            CASE 
                WHEN bulan = 'januari' THEN 1
                WHEN bulan = 'februari' THEN 2
                WHEN bulan = 'maret' THEN 3
                WHEN bulan = 'april' THEN 4
                WHEN bulan = 'mei' THEN 5
                WHEN bulan = 'juni' THEN 6
                WHEN bulan = 'juli' THEN 7
                WHEN bulan = 'agustus' THEN 8
                WHEN bulan = 'september' THEN 9
                WHEN bulan = 'oktober' THEN 10
                WHEN bulan = 'november' THEN 11
                WHEN bulan = 'desember' THEN 12
            END
        ")
			->get()
			->map(function ($row) {
				// Karena hasil json_agg menghasilkan array of string JSON, gabungkan dulu
				$merged = [];

				foreach (json_decode($row->all_answers, true) ?? [] as $ans) {
					$decoded = json_decode($ans, true);
					if (is_array($decoded)) {
						$merged = array_merge($merged, $decoded);
					}
				}

				$row->decoded_answers = $merged;
				return $row;
			});

		// 👉 siapkan data untuk chart
		$labels = $nilaiBulanan->pluck('periode');
		$scores = $nilaiBulanan->pluck('total_score');
		return view('users.show', compact('user', 'nilaiBulanan', 'labels', 'scores'));
	}


	// 🔹 Form edit user
	public function edit(Employee $user)
    {
        return view('users.edit', compact('user'));
    }

    // 🔹 Update user
    public function update(Request $request, Employee $user)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'nik'          => 'required|string|max:20|unique:employees,nik,' . $user->id,
            'no_telephone' => 'nullable|string|max:20',
            'email'        => 'required|string|email|max:255|unique:employees,email,' . $user->id,
            'jabatan'      => 'nullable|string|max:100',
            'role'         => 'required|string|max:50',
            'divisi'       => 'nullable|string|max:100',
        ]);

        $data = $request->only(['name', 'nik', 'no_telephone', 'email', 'jabatan', 'role', 'divisi']);

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    // 🔹 Hapus user
    public function destroy(Employee $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
	public function getEmployeeById($id)
	{
		$employee = Employee::find($id);
		return response()->json($employee);
	}

	public function import(Request $request)
	{
		// Validasi file
		$validator = Validator::make($request->all(), [
			'file' => 'required|mimes:csv,txt'
		]);

		if ($validator->fails()) {
			return redirect()->back()->with('error', 'File harus berupa CSV.');
		}

		// Baca file
		$file = $request->file('file');
		$handle = fopen($file, 'r');

		// Lewati baris pertama (header)
		$header = fgetcsv($handle, 1000, ',');

		// Loop data CSV
		while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
			// Pastikan jumlah kolom sesuai
			if (count($row) < 7) continue;

			Employee::create([
				'name'        => $row[0],
				'nik'         => $row[1],
				'no_telephone' => $row[2],
				'jabatan'     => $row[4],
				'role'        => $row[5],
				'divisi'      => $row[6],
			]);
		}

		fclose($handle);

		return redirect()->back()->with('success', 'Data karyawan berhasil diimport!');
	}
	public function downloadPDF($id)
	{
	    $penilaian = Question::findOrFail($id);

	    $answersRaw = $penilaian->answers;

	    $decoded = json_decode($answersRaw, true);
	    if (is_string($decoded)) {
	        $decoded = json_decode($decoded, true);
	    }

	    $answers = $decoded ?? [];

	    $pdf =Pdf::loadView('users.pdf', [
	        'penilaian' => $penilaian,
	        'answers' => $answers
	    ])->setPaper('a4', 'portrait');

	    return $pdf->download("Penilaian {$penilaian->name} - {$penilaian->divisi} - {$penilaian->jabatan}_{$penilaian->bulan}_{$penilaian->tahun}.pdf");
	}

}
