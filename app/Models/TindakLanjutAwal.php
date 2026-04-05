<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TindakLanjutAwal extends Model
{
    // nama tabel yang digunakan
    protected $table = 'tindak_lanjut_awal';

    // kolom yang dapat diisi secara massal
    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'tanggal_tindak_lanjut_awal',
        'catatan',
        'panggil_korban',
        'panggil_pelaku',
        'panggil_korban_id',
        'panggil_pelaku_id',
        'rekomendasi_bk',
        'status',
    ];

    // casting kolom ke tipe data yang sesuai
    protected $casts = [
        'panggil_korban' => 'boolean',
        'panggil_pelaku' => 'boolean',
        'rekomendasi_bk' => 'boolean',
    ];

    // Relasi ke Pengaduan
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    // Relasi ke User (Petugas yang menangani tindak lanjut awal)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke User (Korban dan Pelaku yang dipanggil)
    public function korban()
    {
        return $this->belongsTo(User::class, 'panggil_korban_id');
    }

    // Relasi ke User (Pelaku yang dipanggil)
    public function pelaku()
    {
        return $this->belongsTo(User::class, 'panggil_pelaku_id');
    }

    // Relasi ke User (Wali Kelas yang menangani tindak lanjut awal)
    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
