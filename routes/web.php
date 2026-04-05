<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\TindakLanjutAwalController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

require_once __DIR__.'/api-siswa.php';

Route::get('/', function () {
    return view('welcome');
});

// Contact form route
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| ROLE SELECTION
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/role-selection', [RoleController::class, 'create'])->name('role.selection');
    Route::post('/role-selection', [RoleController::class, 'store'])->name('role.store');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role.required'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // BANTUAN (untuk semua role)
    Route::get('/bantuan', [BantuanController::class, 'index'])->name('bantuan.index');
    
    // GLOBAL SEARCH API
    Route::get('/search', [SearchController::class, 'search'])->name('search.global');
    
    // TWO-FACTOR AUTHENTICATION
    Route::get('/two-factor/setup', [App\Http\Controllers\TwoFactorController::class, 'setup'])->name('two-factor.setup');
    Route::post('/two-factor/enable', [App\Http\Controllers\TwoFactorController::class, 'enable'])->name('two-factor.enable');
    Route::get('/two-factor/verify', [App\Http\Controllers\TwoFactorController::class, 'showVerify'])->name('two-factor.verify');
    Route::post('/two-factor/verify', [App\Http\Controllers\TwoFactorController::class, 'verify']);
    Route::post('/two-factor/resend', [App\Http\Controllers\TwoFactorController::class, 'resend'])->name('two-factor.resend');
    Route::get('/two-factor/recovery-codes', [App\Http\Controllers\TwoFactorController::class, 'recoveryCodes'])->name('two-factor.recovery-codes');
    Route::delete('/two-factor/disable', [App\Http\Controllers\TwoFactorController::class, 'disable'])->name('two-factor.disable');

    /*
    |--------------------------------------------------------------------------
    | SISWA
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:siswa')->group(function () {
        Route::post('/buat-pengaduan/simpan-draft', [PengaduanController::class, 'saveDraft'])->name('simpan-draft');
    });

    /*
    |--------------------------------------------------------------------------
    | WALI KELAS
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:wali_kelas')->group(function () {
        Route::get('/pengaduan-kelas', [PengaduanController::class, 'pengaduanKelas'])->name('pengaduan.kelas');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,guru_bk,wali_kelas')->group(function () {
        Route::resource('siswa', SiswaController::class);
    });
    Route::middleware('role:admin')->group(function () {
        Route::resource('guru', GuruController::class);
        Route::resource('wali-kelas', WaliKelasController::class);
        Route::resource('users', UserController::class);
        Route::get('/dokumentasi', [DokumentasiController::class, 'index'])->name('dokumentasi.index');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN & KEPALA SEKOLAH
    |--------------------------------------------------------------------------
    */
    /*
|--------------------------------------------------------------------------
| ADMIN & KEPALA SEKOLAH
|--------------------------------------------------------------------------
*/
Route::middleware('role:admin,kepala_sekolah')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/tahunan', [LaporanController::class, 'laporanTahunan'])->name('laporan.tahunan');
    Route::get('/laporan/bulanan', [LaporanController::class, 'laporanBulanan'])->name('laporan.bulanan');
    Route::get('/laporan/pengaduan', [LaporanController::class, 'laporanPengaduan'])->name('laporan.pengaduan');
    Route::get('/laporan/tindak-lanjut', [LaporanController::class, 'laporanTindakLanjut'])->name('laporan.tindak-lanjut');
    Route::get('/laporan/tindak-lanjut-awal', [LaporanController::class, 'laporanTindakLanjutAwal'])->name('laporan.tindak-lanjut-awal');
    Route::get('/laporan/siswa', [LaporanController::class, 'laporanSiswa'])->name('laporan.siswa');
    Route::get('/laporan/guru', [LaporanController::class, 'laporanGuru'])->name('laporan.guru');
    Route::get('/laporan/wali-kelas', [LaporanController::class, 'laporanWaliKelas'])->name('laporan.wali-kelas');
    Route::get('/laporan/user', [LaporanController::class, 'laporanUser'])->name('laporan.user');
});

    /*
    |--------------------------------------------------------------------------
    | ADMIN, GURU BK, WALI KELAS - TINDAK LANJUT
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,guru_bk,wali_kelas')->group(function () {

        Route::get('/tindak-lanjut/{id}/show-proses', [TindakLanjutController::class, 'showProses'])->name('tindak-lanjut.show-proses');
        Route::get('/tindak-lanjut/check-status', [TindakLanjutController::class, 'checkStatus'])->name('tindak-lanjut.check-status');

        Route::get('/tindak-lanjut/{id}/proses', [TindakLanjutController::class, 'proses'])->name('tindak-lanjut.proses');
        Route::patch('/tindak-lanjut/{id}/update-proses', [TindakLanjutController::class, 'updateProses'])->name('tindak-lanjut.update-proses');

        Route::get('/tindak-lanjut/{id}/edit-proses', [TindakLanjutController::class, 'editProses'])->name('tindak-lanjut.edit-proses');
        Route::patch('/tindak-lanjut/{id}/update-proses-edit', [TindakLanjutController::class, 'updateProsesEdit'])->name('tindak-lanjut.update-proses-edit');

        Route::get('/tindak-lanjut/{id}/selesai', [TindakLanjutController::class, 'selesai'])->name('tindak-lanjut.selesai');
        Route::patch('/tindak-lanjut/{id}/update-selesai', [TindakLanjutController::class, 'updateSelesai'])->name('tindak-lanjut.update-selesai');

        Route::get('/tindak-lanjut/{id}/edit-selesai', [TindakLanjutController::class, 'editSelesai'])->name('tindak-lanjut.edit-selesai');
        Route::patch('/tindak-lanjut/{id}/update-selesai-edit', [TindakLanjutController::class, 'updateSelesaiEdit'])->name('tindak-lanjut.update-selesai-edit');

        Route::get('/tindak-lanjut/{id}/show-selesai', [TindakLanjutController::class, 'showSelesai'])->name('tindak-lanjut.show-selesai');
        Route::get('/tindak-lanjut/{id}/detail', [TindakLanjutController::class, 'showDetail'])->name('tindak-lanjut.detail');

        Route::resource('tindak-lanjut', TindakLanjutController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | WALI KELAS, ADMIN & GURU BK - TINDAK LANJUT AWAL (VIEW)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:wali_kelas,admin,guru_bk')->group(function () {
        Route::get('/tindak-lanjut-awal', [TindakLanjutAwalController::class, 'index'])->name('tindak-lanjut-awal.index');
    });

    /*
    |--------------------------------------------------------------------------
    | WALI KELAS - TINDAK LANJUT AWAL (CRUD)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:wali_kelas')->group(function () {
        Route::get('/tindak-lanjut-awal/create', [TindakLanjutAwalController::class, 'create'])->name('tindak-lanjut-awal.create');
        Route::post('/tindak-lanjut-awal', [TindakLanjutAwalController::class, 'store'])->name('tindak-lanjut-awal.store');
        Route::get('/tindak-lanjut-awal/{id}/edit', [TindakLanjutAwalController::class, 'edit'])->name('tindak-lanjut-awal.edit');
        Route::get('/tindak-lanjut-awal/{id}/selesai', [TindakLanjutAwalController::class, 'selesai'])->name('tindak-lanjut-awal.selesai');
        Route::put('/tindak-lanjut-awal/{id}', [TindakLanjutAwalController::class, 'update'])->name('tindak-lanjut-awal.update');
        Route::put('/tindak-lanjut-awal/{id}/selesaikan', [TindakLanjutAwalController::class, 'selesaikan'])->name('tindak-lanjut-awal.selesaikan');
        Route::delete('/tindak-lanjut-awal/{id}', [TindakLanjutAwalController::class, 'destroy'])->name('tindak-lanjut-awal.destroy');
        Route::get('/tindak-lanjut-awal/{id}', [TindakLanjutAwalController::class, 'show'])->name('tindak-lanjut-awal.show');
    });


    /*
    |--------------------------------------------------------------------------
    | PENGADUAN
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:siswa')->group(function () {
        Route::resource('buat-pengaduan', PengaduanController::class);
        Route::get('/pengaduan-saya/{id}', [PengaduanController::class, 'showSiswa'])
                ->name('pengaduan.siswa.show');
        Route::get('/draf-pengaduan', [PengaduanController::class, 'draf'])->name('draf-pengaduan');
        Route::get('/riwayat-pengaduan', [PengaduanController::class, 'riwayat'])->name('riwayat-pengaduan');
        Route::post('/draf-pengaduan/{id}/kirim', [PengaduanController::class, 'kirim'])->name('pengaduan.kirim');
    });

    Route::middleware('role:admin,guru_bk,wali_kelas')->group(function () {
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::post('/pengaduan/{id}/approve', [PengaduanController::class, 'approve'])->name('pengaduan.approve');
        Route::post('/pengaduan/{id}/reject', [PengaduanController::class, 'reject'])->name('pengaduan.reject');
    });

    Route::get('/pengaduan/{id}/download',[PengaduanController::class, 'downloadLampiran'])->name('pengaduan.download');


    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::put('/information', [ProfileController::class, 'updateProfile'])->name('update.information');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
        Route::post('/avatar', [ProfileController::class, 'updateAvatar'])->name('avatar.update');
        Route::delete('/avatar', [ProfileController::class, 'deleteAvatar'])->name('avatar.delete');
        Route::post('/logout-all', [ProfileController::class, 'logoutAllDevices'])->name('logout-all');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | NOTIFIKASI (SUDAH BENAR POSISI)
    |--------------------------------------------------------------------------
    */
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [NotificationController::class, 'show'])->name('show');
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('read');
        Route::post('/{id}/approve', [NotificationController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [NotificationController::class, 'reject'])->name('reject');
    });

});

require __DIR__.'/auth.php';
