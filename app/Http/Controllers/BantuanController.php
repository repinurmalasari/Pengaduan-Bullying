<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BantuanController extends Controller
{
    /**
     * Menampilkan halaman bantuan sesuai role user
     */
    public function index()
    {
        $user = auth()->user();
        return view('bantuan.index', compact('user'));
    }
}
