<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokumentasiController extends Controller
{
    /**
     * Menampilkan halaman dokumentasi sistem
     * Hanya dapat diakses oleh admin
     */
    public function index()
    {
        return view('dokumentasi.index');
    }
}
