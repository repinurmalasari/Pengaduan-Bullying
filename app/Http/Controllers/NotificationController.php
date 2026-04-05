<?php

namespace App\Http\Controllers;

use App\Notifications\StatusPengaduanNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;

    /*
    |--------------------------------------------------------------------------
    | Notification Controller
    |--------------------------------------------------------------------------
    */

class NotificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Tampilkan Daftar Notifikasi
    |--------------------------------------------------------------------------
    */
    public function index()
{
    $user = Auth::user();

    // Hapus notifikasi >14 hari
    $user->notifications()
        ->where('created_at', '<', now()->subDays(14))
        ->delete();

    // Ambil semua notifikasi, urut terbaru
    $notifications = $user->notifications()
        ->latest()
        ->paginate(5);

    return view('notifications.index', compact('notifications'));
}


    /*
    |--------------------------------------------------------------------------
    | Detail Notifikasi dan Tandai Dibaca Otomatis
    |--------------------------------------------------------------------------
    */
    public function show($id)
{
    $notification = Auth::user()
        ->notifications()
        ->where('id', $id)
        ->firstOrFail();

    // Tandai sebagai dibaca
    if (!$notification->read_at) {
        $notification->markAsRead();
    }

    // Ambil pengaduan jika ada
    $pengaduan = null;
    $pengaduanId = $notification->data['pengaduan_id'] ?? null;
    if ($pengaduanId) {
        $pengaduan = \App\Models\Pengaduan::find($pengaduanId);
    }

    return view('notifications.show', compact('notification', 'pengaduan'));
}

    // tandai dibaca manual
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return back()->with('success', 'Notifikasi ditandai dibaca');
    }

    // setujui pengaduan
    public function approve($id)
{
    $notification = Auth::user()->notifications()->findOrFail($id);

    $pengaduanId = $notification->data['pengaduan_id'] ?? null;

    if (!$pengaduanId) {
        return back()->with('error', 'Data pengaduan tidak ditemukan.');
    }

    $pengaduan = Pengaduan::findOrFail($pengaduanId);

    // Update status pengaduan
    $pengaduan->update([
        'status' => 'disetujui'
    ]);

    // kirim notifikasi ke siswa
    $siswa = $pengaduan->user;

    if ($siswa) {
        $siswa->notify(new StatusPengaduanNotification($pengaduan));
    }

    // Redirect berdasarkan role
    $user = Auth::user();
    if (in_array($user->role, ['admin', 'guru_bk', 'wali_kelas'])) {
        return redirect()
            ->route('pengaduan.show', $pengaduanId)
            ->with('success', 'Pengaduan berhasil disetujui');
    } else {
        return redirect()
            ->route('notifications.index')
            ->with('success', 'Pengaduan berhasil disetujui');
    }
}

    // tolak pengaduan
    public function reject(Request $request, $id)
{
    // Validasi input alasan penolakan
    $request->validate([
        'reason' => 'required|string|max:500'
    ]);

    // Ambil NOTIFIKASI dan PENGADUAN
    $notification = Auth::user()->notifications()->findOrFail($id);

    // Ambil pengaduan_id dari data notifikasi
    $pengaduanId = $notification->data['pengaduan_id'] ?? null;

    if (!$pengaduanId) {
        return back()->with('error', 'Data pengaduan tidak ditemukan.');
    }

    $pengaduan = Pengaduan::findOrFail($pengaduanId);

    // Update status pengaduan menjadi ditolak dengan alasan
    $pengaduan->update([
        'status' => 'ditolak',
        'alasan_penolakan' => $request->reason,
        'rejected_at' => now(),
        'rejected_by' => Auth::id()
    ]);

    // kirim notifikasi ke siswa
    $siswa = $pengaduan->user;
    if ($siswa) {
        $siswa->notify(new StatusPengaduanNotification($pengaduan));
    }

    // Redirect berdasarkan role
    $user = Auth::user();
    if (in_array($user->role, ['admin', 'guru_bk', 'wali_kelas'])) {
        return redirect()
            ->route('pengaduan.show', $pengaduanId)
            ->with('error', 'Pengaduan berhasil ditolak');
    } else {
        return redirect()
            ->route('notifications.index')
            ->with('error', 'Pengaduan berhasil ditolak');
    }
}

}
