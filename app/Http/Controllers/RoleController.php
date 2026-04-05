<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Role Controller
|--------------------------------------------------------------------------
*/

class RoleController extends Controller
{
    /**
     * Hanya user login yang boleh akses
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan halaman pilih peran
     */
    public function create()
    {
        // Jika user sudah punya role, langsung ke dashboard
        if (Auth::user()->role) {
            return redirect()->route('dashboard');
        }

        return view('auth.role-selection');
    }

    /**
     * Simpan role user
     */
    public function store(Request $request)
    {
        // HANYA 3 ROLE YANG BOLEH DIPILIH SAAT REGISTRASI
        $request->validate([
            'role' => 'required|in:siswa,guru_bk,wali_kelas'
        ]);

        $user = Auth::user();

        // Cegah overwrite role
        if ($user->role) {
            return redirect()->route('dashboard')
                ->with('warning', 'Anda sudah memiliki peran.');
        }

        $user->update([
            'role' => $request->role
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Peran berhasil dipilih! Selamat datang.');
    }
}