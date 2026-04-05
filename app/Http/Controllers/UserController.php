<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Controller User
|--------------------------------------------------------------------------
*/
class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Index User
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // Ambil semua user
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Tambah User
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        // Daftar role yang boleh dipilih
        $roles = ['admin', 'kepala_sekolah', 'guru_bk', 'wali_kelas', 'siswa'];
        return view('users.create', compact('roles'));
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan User Baru
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,kepala_sekolah,guru_bk,wali_kelas,siswa',
        ]);

        // Hash password sebelum simpan
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Edit User
    |--------------------------------------------------------------------------
    */
    public function edit(User $user)
    {
        // Daftar role yang boleh dipilih
        $roles = ['admin', 'kepala_sekolah', 'guru_bk', 'wali_kelas', 'siswa'];
        return view('users.edit', compact('user', 'roles'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update User
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, User $user)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,kepala_sekolah,guru_bk,wali_kelas,siswa',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Jika password diisi, hash sebelum simpan
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Update user
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus User
    |--------------------------------------------------------------------------
    */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
