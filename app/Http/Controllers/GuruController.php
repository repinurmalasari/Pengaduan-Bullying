<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Guru Controller
|--------------------------------------------------------------------------
*/

class GuruController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Tampilkan Daftar Guru BK
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = User::where('role', 'guru_bk');

        /*
        |--------------------------------------------------------------------------
        | Pencarian Guru
        |--------------------------------------------------------------------------
        */
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('nip', 'like', '%' . $search . '%');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */
        $gurus = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('guru.index', compact('gurus'));
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Form Tambah Guru
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('guru.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Data Guru Baru
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:users,nip|max:20',
            'email' => 'required|email|unique:users,email',
            'no_telepon' => 'required|string|max:15',
            'mata_pelajaran' => 'nullable|string|max:255',
            'alamat' => 'required|string',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Simpan Data Guru
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'nip' => $validated['nip'],
            'phone' => $validated['no_telepon'],
            'address' => $validated['alamat'],
            'role' => 'guru_bk',
            'password' => bcrypt('password'), // default password
        ]);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Form Edit Guru
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $guru = User::where('role', 'guru_bk')->findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update Data Guru
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $guru = User::where('role', 'guru_bk')->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:users,nip,' . $guru->id,
            'email' => 'required|email|unique:users,email,' . $guru->id,
            'no_telepon' => 'required|string|max:15',
            'mata_pelajaran' => 'nullable|string|max:255',
            'alamat' => 'required|string',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Data Guru
        |--------------------------------------------------------------------------
        */

        $guru->update([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'nip' => $validated['nip'],
            'phone' => $validated['no_telepon'],
            'address' => $validated['alamat'],
        ]);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Data Guru
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $guru = User::where('role', 'guru_bk')->findOrFail($id);
        $guru->delete();
        
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus');
    }
}