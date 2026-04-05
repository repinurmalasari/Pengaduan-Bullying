<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\TindakLanjutAwal;
use App\Models\Pengaduan;

class PengaduanDirekomendasiNotification extends Notification
{
    use Queueable;

    protected $tindakLanjutAwal;
    protected $pengaduan;
    protected $catatan;

    /**
     * Create a new notification instance.
     */
    public function __construct(TindakLanjutAwal $tindakLanjutAwal, Pengaduan $pengaduan, $catatan = null)
    {
        $this->tindakLanjutAwal = $tindakLanjutAwal;
        $this->pengaduan = $pengaduan;
        $this->catatan = $catatan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
{
    $pesan = 'Wali kelas telah merekomendasikan pengaduan bullying '
           . 'untuk ditindaklanjuti oleh Guru BK. '
           . 'Nomor laporan: ' . $this->pengaduan->nomor_laporan;

    if ($this->catatan) {
        $pesan .= '. Catatan: ' . $this->catatan;
    }

    return [
        'type'           => 'pengaduan_direkomendasi',
        'judul'          => 'Pengaduan Direkomendasikan ke BK',
        'pesan'          => $pesan,

        'pengaduan_id'   => $this->pengaduan->id,
        'nomor_laporan'  => $this->pengaduan->nomor_laporan,

        // KONSISTEN DENGAN NOTIFIKASI LAIN
        'nama_siswa' => $this->pengaduan->reporter_name
            ?? $this->pengaduan->user->name
            ?? 'Siswa',

        'nama_korban' => $this->pengaduan->victim_name
            ?? 'Tidak disebutkan',

        'status' => 'direkomendasi_bk',

        // OPTIONAL (kalau mau dipakai detail)
        'tindak_lanjut_awal_id' => $this->tindakLanjutAwal->id,
    ];
}
}
