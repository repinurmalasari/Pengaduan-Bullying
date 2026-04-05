<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TindakLanjut extends Model
{
    // nama tabel yang digunakan
    protected $table = 'tindak_lanjut';

    // kolom yang dapat diisi secara massal
    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'nomor_tindakan',
        'jenis_tindakan',
        'deskripsi',
        'tanggal_tindakan',
        
        // KOLOM BARU UNTUK STEP 2: PROSES
        'tanggal_mulai_proses',
        'catatan_proses',
        'pihak_terlibat',
        'kendala',
        
        // KOLOM UNTUK STEP 3: SELESAI
        'tanggal_selesai',
        'hasil',
        'evaluasi',
        'rekomendasi',
        
        'status',
        'status_hasil',  // KOLOM BARU UNTUK STATUS HASIL
        'attachment',
    ];

    protected $casts = [
        'tanggal_tindakan' => 'date',
        'tanggal_mulai_proses' => 'date',  // TAMBAHAN BARU
        'tanggal_selesai' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessor: URL Lampiran Tindak Lanjut
    |--------------------------------------------------------------------------
    */
    public function getAttachmentUrlAttribute(): ?string
    {
        if (!$this->attachment) {
            return null;
        }

        return upload_url($this->attachment, 'tindak_lanjut');
    }

    // Relasi ke Pengaduan
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    // Relasi ke User (Petugas yang menangani tindak lanjut)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Boot method untuk model
    protected static function booted()
    {
        // Hapus file lampiran saat tindak lanjut dihapus
        static::deleting(function ($tindakLanjut) {
            upload_delete($tindakLanjut->attachment);
        });

        // Event listener saat membuat atau mengupdate tindak lanjut
        static::created(function ($tindakLanjut) {
            // Saat pertama kali dibuat tindak lanjut,
            // pastikan status pengaduan menjadi "disetujui"
            if ($tindakLanjut->pengaduan && $tindakLanjut->pengaduan->status != 'disetujui') {
                $tindakLanjut->pengaduan->update([
                    'status' => 'disetujui'
                ]);
            }
        });

        // Event listener saat mengupdate tindak lanjut
        static::updated(function ($tindakLanjut) {
            // Jika status tindak lanjut diubah menjadi selesai, update status pengaduan juga
            if ($tindakLanjut->status == 'selesai' && $tindakLanjut->pengaduan && $tindakLanjut->pengaduan->status != 'selesai') {
                $tindakLanjut->pengaduan->update([
                    'status' => 'selesai'
                ]);
            }
        });
    }
}