<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\TindakLanjutAwal;
use App\Models\Pengaduan;

class TindakLanjutAwalNotification extends Notification
{
    use Queueable;

    protected $tindakLanjutAwal;
    protected $pengaduan;
    protected $type; // 'korban' or 'pelaku'
    protected $catatan;

    /**
     * Create a new notification instance.
     */
    public function __construct(TindakLanjutAwal $tindakLanjutAwal, Pengaduan $pengaduan, string $type, ?string $catatan = null)
    {
        $this->tindakLanjutAwal = $tindakLanjutAwal;
        $this->pengaduan = $pengaduan;
        $this->type = $type;
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
    if ($this->type === 'korban') {
        $judul = 'Anda Dipanggil sebagai Korban';
        $pesan = 'Anda diminta hadir terkait pengaduan bullying yang sedang ditangani oleh wali kelas. '
               . 'Nomor laporan: ' . $this->pengaduan->nomor_laporan;
    } else {
        $judul = 'Anda Dipanggil sebagai Pelaku';
        $pesan = 'Anda diminta hadir terkait dugaan kasus bullying yang sedang ditangani oleh wali kelas. '
               . 'Nomor laporan: ' . $this->pengaduan->nomor_laporan;
    }

    if ($this->catatan) {
        $pesan .= '. Catatan: ' . $this->catatan;
    }

    return [
        'type'           => 'tindak_lanjut_awal',
        'judul'          => $judul,
        'pesan'          => $pesan,

        'pengaduan_id'   => $this->pengaduan->id,
        'nomor_laporan'  => $this->pengaduan->nomor_laporan,

        'nama_siswa' => $notifiable->name
            ?? 'Siswa',

        'nama_korban' => $this->pengaduan->victim_name
            ?? 'Tidak disebutkan',

        'status' => $this->tindakLanjutAwal->status,

        // OPTIONAL tapi berguna
        'role_panggilan' => $this->type, // korban / pelaku
        'tindak_lanjut_awal_id' => $this->tindakLanjutAwal->id,
    ];
}
}
