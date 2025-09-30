<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
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
        return view('users.show', compact('user'));
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
				'email'       => $row[3],
				'jabatan'     => $row[4],
				'role'        => $row[5],
				'divisi'      => $row[6],
			]);
		}

		fclose($handle);

		return redirect()->back()->with('success', 'Data karyawan berhasil diimport!');
	}
}
