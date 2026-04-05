<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

Route::get('/api/siswa', [SiswaController::class, 'apiList'])->name('api.siswa.list');
