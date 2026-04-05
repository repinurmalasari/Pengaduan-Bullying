<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| CONTROLLER SISWA
|--------------------------------------------------------------------------
*/
class SiswaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | API List Siswa untuk Modal Search
    |--------------------------------------------------------------------------
    */
    public function apiList(Request $request)
    {   
        // Pencarian
        $query = User::where('role', 'siswa');

        /*
        |--------------------------------------------------------------------------
        | Pencarian Multi-Kolom
        |-------------------------------------------------------------------------- 
        */
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('nip', 'like', "%$search%")
                  ->orWhere('kelas', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%")
                  ->orWhere('address', 'like', "%$search%") ;
            });
        }
        /*
        |--------------------------------------------------------------------------
        | Return JSON Response
        |--------------------------------------------------------------------------
        */
        $siswas = $query->orderBy('name')->limit(20)->get(['id', 'name', 'kelas', 'email', 'nip', 'phone', 'address']);
        return response()->json($siswas);
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Index Siswa
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        // Basis query siswa
        $query = User::where('role', 'siswa');

        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('nip', 'like', '%' . $search . '%');
            });
        }

        // Filter Kelas
        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('kelas', $request->kelas);
        }

        // Get list kelas untuk dropdown filter
        $kelasList = User::where('role', 'siswa')
                        ->whereNotNull('kelas')
                        ->where('kelas', '!=', '')
                        ->distinct()
                        ->pluck('kelas')
                        ->sort();

        // Pagination dengan append query string
        $siswas = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('siswa.index', compact('siswas', 'kelasList'));
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Tambah Siswa
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('siswa.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Data Siswa
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:users,nip|max:20',
            'kelas' => 'required|string|max:10',
            'email' => 'required|email|unique:users,email',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Simpan ke database
        User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'nip' => $validated['nis'],
            'kelas' => $validated['kelas'],
            'phone' => $validated['no_telepon'],
            'address' => $validated['alamat'],
            'role' => 'siswa',
            'password' => bcrypt('password'), // default password
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Edit Siswa
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {

        // Ambil data siswa
        $siswa = User::where('role', 'siswa')->findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update Data Siswa
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        // Ambil data siswa
        $siswa = User::where('role', 'siswa')->findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:users,nip,' . $siswa->id,
            'kelas' => 'required|string|max:10',
            'email' => 'required|email|unique:users,email,' . $siswa->id,
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // update data siswa
        $siswa->update([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'nip' => $validated['nis'],
            'kelas' => $validated['kelas'],
            'phone' => $validated['no_telepon'],
            'address' => $validated['alamat'],
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Data Siswa
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete Siswa
        |--------------------------------------------------------------------------
        */
        $siswa = User::where('role', 'siswa')->findOrFail($id);
        $siswa->delete();
        
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }
}