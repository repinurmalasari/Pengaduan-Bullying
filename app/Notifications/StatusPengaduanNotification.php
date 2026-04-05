<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Pengaduan;

class StatusPengaduanNotification extends Notification
{
    use Queueable;

    protected $pengaduan;

    public function __construct(Pengaduan $pengaduan)
    {
        $this->pengaduan = $pengaduan;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
{
    // 🔥 PRIORITAS STATUS DARI PENGADUAN (approve / reject)
    $status = $this->pengaduan->status;

    // Kalau sudah masuk tahap tindak lanjut, pakai status tindak lanjut
    if (in_array($status, ['diproses', 'selesai']) && $this->pengaduan->tindakLanjut) {
        $status = $this->pengaduan->tindakLanjut->status;
    }

    switch ($status) {
        case 'direncanakan':
            $pesan = 'Pengaduan anda sedang direncanakan';
            break;
        case 'diproses':
            $pesan = 'Pengaduan anda sedang diproses';
            break;
        case 'selesai':
            $pesan = 'Pengaduan anda telah selesai';
            break;
        case 'disetujui':
            $pesan = 'Pengaduan anda telah disetujui dan akan segera diproses';
            break;
        case 'ditolak':
            $pesan = 'Pengaduan anda ditolak oleh pihak sekolah';
            break;
        default:
            $pesan = 'Status pengaduan diperbarui';
    }

    return [
    'type'           => 'status_pengaduan',
    'judul'          => 'Status Pengaduan',

    'pengaduan_id'   => $this->pengaduan->id,
    'nomor_laporan'  => $this->pengaduan->nomor_laporan,

    'nama_siswa' => $this->pengaduan->reporter_name
        ?? $this->pengaduan->user->name
        ?? 'Siswa',

    'nama_korban' => $this->pengaduan->victim_name
        ?? 'Tidak disebutkan',

    'status' => $status,
    'pesan'  => $pesan,
];

}

}
