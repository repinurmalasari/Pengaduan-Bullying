<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Halaman Index Wali Kelas
|--------------------------------------------------------------------------
*/

class WaliKelasController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Index Wali Kelas
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        // Basis query wali kelas
        $query = User::where('role', 'wali_kelas');

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
        $kelasList = User::where('role', 'wali_kelas')
                        ->whereNotNull('kelas')
                        ->where('kelas', '!=', '')
                        ->distinct()
                        ->pluck('kelas')
                        ->sort();

        // Pagination dengan append query string
        $waliKelas = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('wali-kelas.index', compact('waliKelas', 'kelasList'));
    }
}