<?php

namespace App\Notifications;

use App\Models\Pengaduan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PengaduanMasukNotification extends Notification
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
    return [
        'type'           => 'pengaduan_masuk',
        'pengaduan_id'   => $this->pengaduan->id,
        'nomor_laporan'  => $this->pengaduan->nomor_laporan,
        'judul'          => 'Pengaduan Baru Masuk',

        'nama_siswa' => $this->pengaduan->reporter_name 
            ?? $this->pengaduan->user->name 
            ?? 'Siswa',

        'nama_korban' => $this->pengaduan->victim_name 
            ?? 'Tidak disebutkan',

        'pesan' => 'Ada pengaduan baru dari siswa: ' . 
            ($this->pengaduan->reporter_name 
                ?? $this->pengaduan->user->name 
                ?? 'Siswa'),

        'status' => $this->pengaduan->status,
    ];
}
}
