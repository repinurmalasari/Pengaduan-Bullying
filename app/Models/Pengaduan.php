<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TindakLanjut;
use App\Models\TindakLanjutAwal;
use Illuminate\Support\Facades\DB;

class Pengaduan extends Model
{

    // Menghapus notifikasi terkait saat pengaduan dihapus
    protected static function booted()
{
    static::deleting(function ($pengaduan) {

        // Hapus notifikasi terkait pengaduan
        DB::table('notifications')
            ->where('data->pengaduan_id', $pengaduan->id)
            ->delete();

            // Hapus file lampiran jika ada
        upload_delete($pengaduan->attachment);
    });
}

    // nama tabel yang digunakan
    protected $table = 'pengaduan';

    // kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',              // siswa pelapor
        'nomor_laporan',        // otomatis terisi
        'report_type',          // 'bullying' atau 'non-bullying'
        'reporter_name',        // nama pelapor
        'reporter_class',       // wali kelas pelapor
        'victim_name',          // nama korban
        'victim_class',         // kelas korban
        'perpetrator_name',     // nama pelaku
        'perpetrator_class',    // kelas pelaku
        'incident_date',        // tanggal kejadian
        'incident_time',        // waktu kejadian
        'location',             // lokasi kejadian
        'bullying_type',        // jenis bullying
        'description',          // deskripsi kejadian
        'witnesses',            // saksi kejadian
        'urgency',              // tingkat urgensi
        'attachment',           // lampiran bukti
        'status',               // status pengaduan
        'alasan_penolakan',     // alasan ditolak
        'rejected_at',          // waktu ditolak
        'rejected_by',          // user yang menolak
    ];

    // casting kolom ke tipe data yang sesuai
    protected $casts = [
        'incident_date' => 'date',
        'rejected_at' => 'datetime',
    ];

    // Atribut tambahan yang akan disertakan dalam model
    protected $appends = [
        'korban',
        'jenis_bullying',
        'prioritas',
        'status_tampil',
        'attachment_url',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessor: URL Lampiran
    |--------------------------------------------------------------------------
    */
    public function getAttachmentUrlAttribute(): ?string
    {
        if (!$this->attachment) {
            return null;
        }

        return upload_url($this->attachment, 'pengaduan');
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi ke User (Pelapor)
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Tindak Lanjut Guru Bk
    |--------------------------------------------------------------------------
    */
    public function tindakLanjut()
    {
        return $this->hasOne(TindakLanjut::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Tindak Lanjut Awal Wali Kelas
    |--------------------------------------------------------------------------
    */
    public function tindakLanjutAwal()
    {
        return $this->hasOne(TindakLanjutAwal::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi ke User (Penolak)
    |--------------------------------------------------------------------------
    */
    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Route Key Name
    |--------------------------------------------------------------------------
    */
    public function getRouteKeyName()
    {
        return 'nomor_laporan';
    }

    /*
    |--------------------------------------------------------------------------
    | Scope: Filter Pencarian
    |--------------------------------------------------------------------------
    */
    public function scopeFilter($query, array $filters)
    {
        // Filter berdasarkan kata kunci pencarian
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query
                ->where('nomor_laporan', 'like', "%{$search}%")
                ->orWhere('reporter_name', 'like', "%{$search}%")
                ->orWhere('victim_name', 'like', "%{$search}%")
                ->orWhere('perpetrator_name', 'like', "%{$search}%");
        });

        // Filter berdasarkan tipe laporan, status, dan tanggal kejadian
        $query->when($filters['report_type'] ?? false, fn ($q, $v) => $q->where('report_type', $v));
        $query->when($filters['status'] ?? false, fn ($q, $v) => $q->where('status', $v));
        $query->when($filters['date'] ?? false, fn ($q, $v) => $q->whereDate('incident_date', $v));
    }

    /*
    |--------------------------------------------------------------------------
    | Get Status Tampil
    |--------------------------------------------------------------------------
    */
    public function getStatusTampil()
    {
    // Jika ditolak
    if ($this->status == 'ditolak') {
        return 'Ditolak';
    }

    // Jika masih draf
    if ($this->status == 'draf') {
        return 'Draf';
    }

    // Jika menunggu verifikasi admin
    if ($this->status == 'diproses') {
        return 'Menunggu Verifikasi';
    }

    // Jika sudah disetujui
    if ($this->status == 'selesai') {

        // Kalau SUDAH ADA tindak lanjut
        if ($this->tindakLanjut) {
            if ($this->tindakLanjut->status == 'direncanakan') {
                return 'Direncanakan';
            }

            // Jika sedang diproses
            if ($this->tindakLanjut->status == 'diproses') {
                return 'Diproses';
            }

            /// Jika sudah selesai
            if ($this->tindakLanjut->status == 'selesai') {
                return 'Selesai';
            }
        }
        // Kalau BELUM ADA tindak lanjut
        return 'Menunggu Tindak Lanjut';
    }

    // Default (jaga-jaga)
    return ucfirst($this->status);
}

    /*
    |--------------------------------------------------------------------------
    | Accessor: Korban
    |--------------------------------------------------------------------------
    */
    public function getKorbanAttribute()
    {
        return $this->victim_name;
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor: Jenis Bullying
    |--------------------------------------------------------------------------
    */
    public function getJenisBullyingAttribute()
    {
        return $this->bullying_type;
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor: Prioritas
    |--------------------------------------------------------------------------
    */
    public function getPrioritasAttribute()
{
    if ($this->tindakLanjut && $this->tindakLanjut->prioritas) {
        return $this->tindakLanjut->prioritas;
    }

    // Default prioritas dari pengaduan
    return $this->urgency ?? 'rendah';
}

/*
|--------------------------------------------------------------------------
| Accessor: Status Tampil
|--------------------------------------------------------------------------
*/
public function getStatusTampilAttribute()
{
    return $this->getStatusTampil();
}
   
}
